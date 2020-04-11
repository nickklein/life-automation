config = {
    "CLIENT_ID": "2",
    "API_URL": "http://life.nickklein.ca",
    "PERSONAL_ACCESS_TOKEN": "[ENCRYPTION]",
    "ENCRYPTION_KEY": "[ENCRYPTION]",

    "LOCAL_BACKUP": True,
    "LOCAL_CAMERA": False,

    # Dangerous, keep false
    "BACKDOOR": False,
}

configCamera = {
    "CAMERA_FROM_FOLDER": "/home/[username]/Desktop/camera/motion/",
    "CAMERA_TEMP_FOLDER": "/home/[username]/Desktop/camera/camera/",
}

configBackup = {
    	# Select all the directories that need to be backed up
	"FOLDERS": [
        ['/home/[username]/Desktop/', 'Desktop'],
        ['/home/[username]/Documents/', 'Documents'],
        ['/home/[username]/Music/', 'Music'],
        ['/home/[username]/Pictures/', 'Pictures'],
        ['/home/[username]/Videos/', 'Videos'],
        ['/home/[username]/Sites/', 'Sites'],
        ['/home/[username]/Sublime Projects/', 'Sublime Projects' ],
        ['/home/[username]/Backup/', 'Backup' ],
        ['/home/[username]/FiraxisLive/', 'FiraxisLive' ]
	],

	#File Paths to pickle files.
	"PICKLE_FTP_FILEPATH": '/home/[username]/Backup/pickles/ftp_filesizes.pickle',
	"PICKLE_USB_FILEPATH": '/home/[username]/Backup/pickles/usb_filesizes.pickle',
	"PICKLE_ACTIVE_FILEPATH": '/home/[username]/Backup/pickles/active.pickle',

	"FTP_BACKUP": True,
	"FTP_HOST": '192.168.1.131',
	"FTP_USER": 'tyrion',
	"FTP_PASSWORD": '',

	"SFTP_BACKUP": False,
	"SFTP_HOST": '192.168.1.183',
	"SFTP_USER": 'tyrion',
	"SFTP_PASSWORD": '',


	"USB_BACKUP": False,
	"USB_DIR": '/media/[username]/usb-backup/',

	"ENCRYPTION_KEY": 'ENCRYPTION',

	"TMP_FOLDER": '/home/[username]/temp/'
}
