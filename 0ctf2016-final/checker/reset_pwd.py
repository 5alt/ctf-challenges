#!/usr/bin/env python
#coding=utf-8
import MySQLdb
import requests
import random
import string

service = 'z0ne'
timeout = 10					# define timeout here
author = 'md5_salt'			# author


def genRandomLetters(length):
	return ''.join([random.choice(string.letters) for i in xrange(length)])

def getTeamID(host):
	return int(host[8:10])

def exploit(host):
	port = 8000
	#这里host应该为mysql的host，改unix_socket
	conn = MySQLdb.connect(host=host,user='root',passwd='v8y1qjq9Xx8mDcwd',db='z0ne',charset="utf8")#, unix_socket='/Applications/MAMP/tmp/mysql/mysql.sock')
	conn.autocommit(True)
	cursor = conn.cursor()
	
	try:
		email = genRandomLetters(8)+'@2333.me'
		password = genRandomLetters(8)
		if not 'User added' in requests.post('http://%s:%d/save_user'%(host, port), data={'user-email': email, 'user-new-password': password}).text:
			raise Exception("Reg user error")
		
		sql = "SELECT * FROM users WHERE email = %s"
		cursor.execute(sql, [email])
		result = cursor.fetchone()

		secret = result[4]
		s = requests.Session()
		data = s.post('http://%s:%d/activate'%(host, port), data={'user-email': email, 'secret': secret}).text
		if not 'activate successfully' in data:
			print data
			raise Exception("Active user error")

		new_password = genRandomLetters(8)
		s.post('http://%s:%d/reset_password'%(host, port), data={'user-old-password':password, 'user-new-password':new_password}).text

		if not 'You are logged in' in requests.post('http://%s:%d/login'%(host,port), data={'login-username':email, 'login-password': new_password}).text:
			raise Exception("Login error")

		message = 'OK'
	except Exception as e:
		message = str(e)

	sql = "DELETE FROM users WHERE email = %s"
	cursor.execute(sql, [email])

	return message

if __name__ == '__main__':
	print exploit('100.64.105.11')

