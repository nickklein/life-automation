import os
import subprocess
import json
from app import config
from fetch import Fetch
from camera import Camera

class Client:
    lastSync = '';
    remoteBackup = 0;
    remoteCamera = 0;

    def handle(self):
        self.getDeviceInformation()
        self.runJobs()

        # Start backup, check for remote setting and local override
        if self.remoteBackup and config['LOCAL_BACKUP']:
            self.backup()
        
    # use getDeviceInformation to updateLastOnline, above is reduntent
    def getDeviceInformation(self):
        response = Fetch.get(config['API_URL'] + "/api/device/" + config['CLIENT_ID'] + "/");
        self.lastSync = response['last_sync']

        if 'camera' in response['device_settings']:
            self.remoteCamera = response['device_settings']['camera']

        if 'backup' in response['device_settings']:
            self.remoteBackup = response['device_settings']['backup']

    def backup(self):
        print('backup')

    def runJobs(self):
        response = Fetch.get(config['API_URL'] + "/api/device/" + config['CLIENT_ID'] + "/jobs?status=queue");
        for item in response:
            if item["key"] == "shutdown":
                postResponse = Fetch.patch(config['API_URL'] + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=done")
                if postResponse['status'] == 'success':
                    subprocess.call(["sudo shutdown"], shell=True)

            if item["key"] == "reboot":
                postResponse = Fetch.patch(config['API_URL'] + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=done")
                if postResponse['status'] == 'success':
                    subprocess.call(["sudo reboot"], shell=True)

            if item["key"] == "update":
                postResponse = Fetch.patch(config['API_URL'] + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=done")
                if postResponse['status'] == 'success':
                    subprocess.call(["sudo apt-get update"], shell=True)
                    subprocess.call(["sudo apt-get -y upgrade"], shell=True)
        
            if item["key"] == "camera" and config['LOCAL_CAMERA']:
                postResponse = Fetch.patch(config['API_URL'] + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=inprogress")
                if postResponse['status'] == 'success':
                    camera = Camera()
                    camera.handle(item["device_job_id"])

            if item['key'] == 'backdoor' and config['BACKDOOR']:
                postResponse = Fetch.patch(config['API_URL'] + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=done")
                if postResponse['status'] == 'success':
                    subprocess.call([item['value']], shell=True)



client = Client()
client.handle()
