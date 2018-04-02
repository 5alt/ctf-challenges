#!/usr/bin/env python
#coding=utf-8

import MySQLdb
import MySQLdb.cursors
import subprocess
from urllib import quote_plus
import base64
import time

host = 'localhost'
port = 3306
user = 'checker'
passwd = 'rMbMBpRQvBJhzNGj'
db = 'guestbook'
conn = MySQLdb.connect(host=host, port=port, user=user, passwd=passwd, db=db, cursorclass = MySQLdb.cursors.DictCursor)

while True:
	try:
		cursor = conn.cursor()
		sql = 'SELECT secret FROM `message` WHERE status=0'
		cursor.execute(sql)
		res = cursor.fetchall()
		for i in res:
			try:
				url = 'http://127.0.0.1/admin/show.php?secret='+quote_plus(base64.b64decode(i['secret']))	
				subprocess.Popen(["nohup", "phantomjs", "run.js", url])
			except:
				pass
			sql = "UPDATE message SET status=1 WHERE secret='%s'"%i['secret']
			cursor.execute(sql)
			conn.commit()
		cursor.close()
		time.sleep(3)
	except Exception as e:
		print e

#subprocess.Popen(["nohup", "python", "test.py"])

