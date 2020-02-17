import os
import requests;
import subprocess;
import json;

class Client:
    apiUrl = "http://lifeautomation.loc"
    clientId = "3";
    personalAccessToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNWJjODViYjFiNDUzMTVmNWEzN2NmYWYyNGE5OGU2NGFhYzRiMmE2NjJmZGUwYTk5NzU3Y2RhMDNlNDNiYWNhNzE1ZGNiMmU0ZDIzMGQ1NTAiLCJpYXQiOjE1ODE5NTg1MzQsIm5iZiI6MTU4MTk1ODUzNCwiZXhwIjoxNjEzNTgwOTM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.M073mJ4MQh-4kauYug0c5-xDoJ6OkYkmWSqpe2jKOomEMw_ecXK4DDQGsPuTeZO6sbQnitkb3DkG2XFIBM1DHegWYYpUnzRQ1UhKfoVl9pMd5DM1czYss4K5fUFp5Q8wo4CvR3C0COyCELxq0KFVWicJwjU-9C5fF__5ZwfffcQFSv3S7zifpVPvKN6qMk3GTyWHFVj3rqObbUnCVoLihU7TDYttbFdTRzxvNKViiIJM5wrkk5JC-RY8hSSo1ujSPJUY3KpkbV91zdKh8t4rpahrxE3lfcv03Jn_Hak5g1-VZwY_8zafc8ZZ9BKeTxu6YrPIxzUBmvv9HRh3QzKGqUtgSaTUker3aFVf54OKuTqAl2A7pi-IcjuSydkQdndJVQKWRfVORmvgAUl3AQeyVsX3VJfpaESk06dbwZE2GcnKYkfUcko1LVqJn4lb3vpkiFrZdWNfjTil1yyP54ubFgzGISVa7aJhXAw640i1kIrPhHhmlxrQA38jTrO7pWp4gb3z3AsvsmjpYC63a9R07MHcUedWQ-BJq43hbKKSb7H77rew9D5C3jiqsg4JED1Vwd6hx-BC12KImLqDSXtW12Ahi9bjSCWEhiGqQ1UwRxY_cxYYT_rUHR0QnuXFddBbkYP6fSlJzpd9Lu2qEa6ZnJjGkrq-Pa-GaChxCh2THXo"
    
    def handle(self):
        response = self.get(self.apiUrl + "/api/device/" + self.clientId + "/jobs?status=queue");
        for item in response:
            if item["key"] == "shutdown":
                postResponse = self.patch(self.apiUrl + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=done")
                if postResponse['status'] == 'success':
                    subprocess.call(["poweroff"])

            if item["key"] == "restart":
                postResponse = self.patch(self.apiUrl + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=done")
                if postResponse['status'] == 'success':
                    subprocess.call(["reboot"])

    def get(self, url):
        bearerToken = 'Bearer ' + self.personalAccessToken
        header = {'Authorization': bearerToken}
        response = requests.get(url, headers=header)
        return response.json()
        
    def patch(self, url):
        bearerToken = 'Bearer ' + self.personalAccessToken
        header = {'Authorization': bearerToken}
        response = requests.patch(url, headers=header)
        return response.json()



client = Client()
client.handle()