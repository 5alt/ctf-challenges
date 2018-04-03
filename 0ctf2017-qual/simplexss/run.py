import requests
import os, shutil
import time
import json

data_dir = '/var/www/html/data/'
backup_dir = "/root/backup/"
base_url = 'https://router.vip/data/'

def getTabs():
	return json.loads(requests.get("http://127.0.0.1:9222/json").text)

def openTab(fname):
	requests.get("http://127.0.0.1:9222/json/new?"+base_url+fname)

def closeTab(id):
	requests.get("http://127.0.0.1:9222/json/close/"+id)

def closeAll(data):
	for i in data:
		if i['id'] == 'cd201794-aaf2-44bf-b960-79e369765a7f':
			continue
		else:
			closeTab(i['id'])

def getHtml():
	l = []
	for rt, dirs, files in os.walk(data_dir):
		for f in files:
			if f.endswith('.html'):
				l.append(f)
	return l

def moveFile(fname):
	shutil.move(data_dir+fname, backup_dir)  

def process(fname):
	print(fname)
	openTab(fname)
	time.sleep(3)
	closeAll(getTabs())
	moveFile(fname)

while True:
	try:
		files = getHtml()
		for i in files:
			process(i)
		time.sleep(5)
	except Exception as e:
		print(e)
