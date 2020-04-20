import os
import subprocess
import json
from app import config
from app import configBackup
from fetch import Fetch
from camera import Camera
from backup import Backup

class Client:
    lastSync = '';
    remoteBackup = 0;
    remoteCamera = 0;

    def handle(self):
        self.getDeviceInformation()
        self.runJobs()
        
    # use getDeviceInformation to updateLastOnline, above is reduntent
    def getDeviceInformation(self):
        response = Fetch.get(config['API_URL'] + "/api/device/" + config['CLIENT_ID'] + "/");
        self.lastSync = response['last_sync']

        if 'camera_feature' in response['device_settings']:
            self.remoteCamera = int(response['device_settings']['camera_feature'])

        if 'backup_feature' in response['device_settings']:
            self.remoteBackup = int(response['device_settings']['backup_feature'])

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
        
            if item["key"] == "camera" and self.remoteCamera and config['LOCAL_CAMERA']:
                postResponse = Fetch.patch(config['API_URL'] + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=inprogress")
                if postResponse['status'] == 'success':
                    camera = Camera()
                    camera.handle(item["device_job_id"])

            if item["key"] == "backup" and self.remoteBackup and config['LOCAL_BACKUP']:
                backup = Backup(item["device_job_id"])

            if item['key'] == 'backdoor' and config['BACKDOOR']:
                postResponse = Fetch.patch(config['API_URL'] + "/api/device/" + str(item["device_job_id"]) + "/jobs/update?status=done")
                if postResponse['status'] == 'success':
                    subprocess.call([item['value']], shell=True)



client = Client()
client.handle()
