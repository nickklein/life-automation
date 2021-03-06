from app import config
from app import configCamera
from fetch import Fetch
import subprocess
import hashlib
import os
import datetime;

class Camera:
    def handle(self, deviceJobId):
        cameraFolder = os.listdir(configCamera['CAMERA_FROM_FOLDER'])
        # make sure it's not empty
        if cameraFolder:
            hashname = self.compressFiles()
            checksum = self.checksum(configCamera['CAMERA_TEMP_FOLDER'] + hashname + ".7z")
            self.uploadFiles(hashname, checksum)
            self.cleanFolders(cameraFolder, hashname)
        
        Fetch.patch(config['API_URL'] + "/api/device/" + str(deviceJobId) + "/jobs/update?status=done")
        #Fetch.patch(config['API_URL'] + "/api/device/" + str(config['CLIENT_ID']) + "/updateLastSync?type=camera_last_synced")

    def moveFiles(self):
        cameraFolder = os.listdir(configCamera['CAMERA_FROM_FOLDER'])
        for item in cameraFolder:
            os.rename(configCamera['CAMERA_FROM_FOLDER'] + item, configCamera['CAMERA_TEMP_FOLDER'] + item)

        return cameraFolder

    def compressFiles(self):
        currentdatetime = str(datetime.datetime.now())
        name = hashlib.md5(currentdatetime.encode())
        rc = subprocess.call(['7z', 'a', '-p' + config['ENCRYPTION_KEY'], '-y', configCamera['CAMERA_TEMP_FOLDER'] + name.hexdigest() + '.7z', '-xr!node_modules', '-xr!vendor', '-xr!easymarkit', '-xr!_ignore_backup', '-xr!dconf', '-xr!Bitwarden CLI', '-mhe'] + [configCamera['CAMERA_FROM_FOLDER']])
        
        return name.hexdigest()

    def checksum(self, file):
        return hashlib.md5(open(file,'rb').read()).hexdigest()

    def uploadFiles(self, hashname, checksum):
        files = {
            'file': open(configCamera['CAMERA_TEMP_FOLDER'] + hashname + '.7z','rb')
        }
        data = {
            'device_id': config['CLIENT_ID'], 
            'type': 'camera', 
            'filename': hashname + '.7z',
            'checksum': checksum,
            'status': 'done'
        }
        response = Fetch.post(config['API_URL'] + "/api/files/store", files, data)

    def cleanFolders(self, folder, hashname):
        for item in folder:
            os.remove(configCamera['CAMERA_FROM_FOLDER'] + item)

        os.remove(configCamera['CAMERA_TEMP_FOLDER'] + hashname + '.7z')