#!/usr/bin/python3
import pymysql.cursors
from bs4 import BeautifulSoup
import requests
import os
import time
import arrow
from datetime import datetime
import re
from dateutil.parser import parse
from dotenv import load_dotenv

#load env file

if (True):
	path = '/var/www/vhosts/nickklein.ca/subdomains/life.nickklein.ca/.env'
else:
	path = '../.env'

load_dotenv(path)

class Crawler:

	MYSQL_HOST = os.environ.get("DB_HOST")
	MYSQL_PORT = os.environ.get("DB_PORT")
	MYSQL_USER = os.environ.get("DB_USERNAME")
	MYSQL_PASSWORD = os.environ.get("DB_PASSWORD")
	MYSQL_DATABASE = os.environ.get("DB_DATABASE")
	MYSQL_CHARSET = 'utf8'

	def __init__(self):

		# Connect to the database
		connection = pymysql.connect(host=self.MYSQL_HOST,
									 port=int(self.MYSQL_PORT),
		                             user=self.MYSQL_USER,
		                             password=self.MYSQL_PASSWORD,
		                             db=self.MYSQL_DATABASE,
		                             charset=self.MYSQL_CHARSET,
		                             cursorclass=pymysql.cursors.DictCursor)

		try:
		    with connection.cursor() as cursor:
		    	self.collectLinks(cursor)
		    	connection.commit()
		    	
		    	self.crawlThroughLinks(cursor)
		    	connection.commit()
		finally:
			connection.close()

	def collectLinks(self, cursor):
		# Fetch Sources from DB
		sql = 'SELECT source_id, source_domain, source_main_url, aggregator FROM sources WHERE aggregator = 0';
		cursor.execute(sql)
		items = cursor.fetchall()
		for item in items:
			insert_sql = ''
			links = []

			# fetch and parse using BeautifulSoup
			content = self.fetchAndParseWebsite(item['source_main_url'])
			for anchor in content.find_all('a'):
				link_label = anchor.text.encode('utf-8').decode('ascii', 'ignore').strip()
				link_url = anchor.get('href', '/')


				# Aggregator websites may not necessarily link to news, but could also link to pdfs, images or cool apis, so we need to save the link label
				sourceTitle = ''
				if item['aggregator'] is 1:
					sourceTitle = anchor.text.encode('utf-8').decode('ascii', 'ignore').strip()


				# Remove links where the label is less than 30 characters (Articles usally have longer labels), exclude things like <img, <source, #comments, /users/
				if len(link_label) > 30 and '<img' not in link_label and '<source' not in link_label  and "#comments" not in link_url and "/users/" not in link_url and "javascript:void(0)" not in link_url and link_url != item['source_main_url']: 
					#Prepare list item
					links.append([item['source_id'], self.convertToAbsoluteURL(item['aggregator'], item['source_domain'],anchor.get('href', '/')), sourceTitle])
					insert_sql =  "INSERT IGNORE INTO source_links (source_id, source_link, source_title, created_at, updated_at, active) VALUES (%s, %s, %s, now(), now(), 0)"
					
			cursor.executemany(insert_sql, links)


	def crawlThroughLinks(self, cursor):
		#crawl through links and collect website articles
		
		sql = 'SELECT source_links.source_link_id, source_links.source_link, sources.aggregator FROM source_links INNER JOIN sources ON source_links.source_id=sources.source_id INNER JOIN user_sources ON user_sources.source_id=sources.source_id WHERE source_links.active = 0';

		cursor.execute(sql)
		items = cursor.fetchall()
		for item in items:
			print('Crawled: %s' % (item['source_link']))

			content = self.fetchAndParseWebsite(item['source_link'])
			success = 0
			dump = ''

			# For semantic websites that use the article element
			if content.select('article h1, article h2'):
				success = 1
				dump = self.getContent(content, 'article', 'article p')

			# For websites that aren't sementic
			elif content.select('meta[property="author"],meta[property="article:published_time"],meta[content="article"]'):
				success = 1
				dump = self.getContent(content, '', 'p')
			# turn off source_link row so it doesn't get fetched again
			else:
				# Can't find the article on the page. Deactivate the link so it's not used anymore
				update = 'UPDATE source_links SET active = -1 WHERE source_link_id = %s'
				cursor.execute(update, (item['source_link_id']))



			if success is 1:
				if item['aggregator'] is 1:
					update = 'UPDATE source_links SET source_raw = %s WHERE source_link_id = %s'
					cursor.execute(update, (dump[1], item['source_link_id']))
				else:
					update = 'UPDATE source_links SET source_title = %s, source_date = %s, source_raw = %s, active = %s WHERE source_link_id = %s'
					cursor.execute(update, (dump[0], dump[1], dump[2], dump[3], item['source_link_id']))					

	def getContent(self, content, title, paragraph):
		time_success = 0
		title = timestamp = content_dump = ''
		time = None
		active = 0
		if content.select(title + ' h1'):
			for item_h1 in content.select(title + ' h1'):
				title = item_h1.text.encode('utf-8').decode('ascii', 'ignore')
		elif content.select(title + ' h2'):
			for item_h2 in content.select(title + ' h2'):
				title = item_h2.text.encode('utf-8').decode('ascii', 'ignore')

		for item_p in content.select(paragraph):
			content_dump += item_p.encode('utf-8').decode('ascii', 'ignore')

		if len(title) and len(content_dump):
			active = 1
		
		#Fetching time is a bit tricky. Different websites use different elements, classes and date formats to display their time
		if content.findAll("div", {"class" : re.compile('date.*')}):
			time_success = 1
			dates = content.findAll("div", {"class" : re.compile('date.*')})
			try:
				timestamp = dates[0]['data-seconds']
			except KeyError:
			    pass

		if content.find("p", {"class" : re.compile('date.*')}):
			time_success = 1
			dates = content.find("p", {"class" : re.compile('date.*')})
			try:
				timestamp = dates.text
			except KeyError:
			    pass


		if content.find("time"):
			time_success = 1
			dates = content.find("time")
			try:
				timestamp = dates['datetime']
			except KeyError:
			    pass
			try:
				timestamp = dates['data-timestamp']
			except KeyError:
			    pass

		# Only format time if something is found
		if time_success and len(timestamp) > 8:
			if timestamp.isdigit() is False:
				timestamp = parse(timestamp,fuzzy=True)

			if isinstance(timestamp,str):
				# Some date formats have a weird string format with 000, that needs to be divided by 1000
				if timestamp[-3:] == '000':
					timestamp = arrow.get(int(timestamp) / 1000)
				else:
					# If there's a + in the string, remove the rest
					if "+" in timestamp:
						print('+')
						timestamp = timestamp.split("+")
						timestamp = timestamp[0]
			timestamp = arrow.get(timestamp)
			time = timestamp.format('YYYY-MM-DD HH:mm:ss')
			
		return [title, time, content_dump, active]
	def fetchAndParseWebsite(self, link_url):
		try:
			headers = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36'}
			story = requests.get(url=link_url, headers=headers)
			return BeautifulSoup(story.content, 'html.parser')
		except KeyError:
			pass

	def convertToAbsoluteURL(self, aggregator, source_domain, link):
		# Some websites use relative URLs not absolute URLS


		if source_domain in link and aggregator is 0 and 'https' not in link and 'http' not in link:
			return 'http:' + link

		if source_domain not in link and aggregator is 0 and 'https' not in link and 'http' not in link:
			return 'http://' + source_domain + link

		return link


crawler = Crawler()
