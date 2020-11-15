#!/usr/bin/python3
import pymysql.cursors
import os
from dotenv import load_dotenv

#load env file
if (True):
	path = '/var/www/vhosts/nickklein.ca/subdomains/life.nickklein.ca/.env'
else:
	path = '../.env'
	
load_dotenv(path)

class User:

	MYSQL_HOST = os.environ.get("DB_HOST")
	MYSQL_PORT = os.environ.get("DB_PORT")
	MYSQL_USER = os.environ.get("DB_USERNAME")
	MYSQL_PASSWORD = os.environ.get("DB_PASSWORD")
	MYSQL_DATABASE = os.environ.get("DB_DATABASE")
	MYSQL_CHARSET = 'utf8'

	PT_TITLE = 3;
	PT_RAW = 1;

	def __init__(self):

		# Connect to the database
		connection = pymysql.connect(host=self.MYSQL_HOST,
									 port=25060,
		                             user=self.MYSQL_USER,
		                             password=self.MYSQL_PASSWORD,
		                             db=self.MYSQL_DATABASE,
		                             charset=self.MYSQL_CHARSET,
		                             cursorclass=pymysql.cursors.DictCursor)

		try:
		    with connection.cursor() as cursor:
    			self.clearRank(cursor)
		    	self.fetchUserTags(cursor)
		    	connection.commit()
		finally:
			connection.close()


	def fetchUserTags(self, cursor):
		links = []
		summary_sql = 'INSERT IGNORE INTO news_summary (source_link_id, user_id, tag_id, points) VALUES (%s, %s, %s, %s)'

		sql = """
				SELECT users.id, tags.tag_id, tags.tag_name FROM users 
				LEFT JOIN user_tags ON user_tags.user_id=users.id 
				INNER JOIN tags ON user_tags.tag_id=tags.tag_id 
				ORDER BY users.id ASC"""

		cursor.execute(sql)
		userTags = cursor.fetchall()
		for tag in userTags:
			# Fetch Users Sources
			srcIds = self.returnSourceIds(cursor, 'SELECT source_id FROM user_sources WHERE user_id = %s', tag['id'])

			# Fetch and rank article importance
			#sourceIDs.append(tag['tag_name'])
			articles = self.processRanking(cursor, tag['tag_name'], srcIds)

			#Prepare all links
			for article in articles:
				links.append([article['source_link_id'], tag['id'], tag['tag_id'], article['rank']])

		cursor.executemany(summary_sql, links)
 
	def processRanking(self, cursor, word, srcIds):
		rank = ''
		src_query = ''
		ids = []

		#Prepare query strings
		for i in srcIds:
			src_query += '%s,'

		values = self.processRankSearchValues(srcIds.copy(),srcIds.copy(),word)

		it_titles = self.returnLinkIds(cursor, 'SELECT source_link_id FROM source_links WHERE source_date >= DATE_SUB(NOW(), INTERVAL 30 HOUR) AND active = 1 AND source_id IN(' + src_query[:-1] + ') AND source_title LIKE %s', values[0])
		it_raws = self.returnLinkIds(cursor, 'SELECT source_link_id FROM source_links WHERE source_date >= DATE_SUB(NOW(), INTERVAL 30 HOUR) AND active = 1 AND source_id IN(' + src_query[:-1] + ') AND source_raw LIKE %s', values[1])


		for item in it_titles:
			number = self.PT_TITLE

			if item in it_raws:
				number = number + self.PT_RAW

			ids.append({'source_link_id': item, 'rank': number})

		for item in it_raws:
			number = self.PT_RAW

			if item not in it_titles:
				ids.append({'source_link_id': item, 'rank': number})

		return ids

	def processRankSearchValues(self,q_title_val, q_raw_val, word):
		q_title_val.append('%' + word + '%')
		q_raw_val.append('% ' + word + ' %')

		return [q_title_val,q_raw_val]

	def returnSourceIds(self, cursor, query, id):
		ids = []
		cursor.execute(query, (id))

		items = cursor.fetchall()
		for item in items:
			ids.append(item['source_id'])

		return ids

	def returnLinkIds(self, cursor, query, array):
		ids = []
		
		cursor.execute(query, (array))
		items = cursor.fetchall()
		for item in items:
			ids.append(item['source_link_id'])
			
		return ids
	def clearRank(self, cursor):
		sql = 'TRUNCATE news_summary'
		cursor.execute(sql)


User()