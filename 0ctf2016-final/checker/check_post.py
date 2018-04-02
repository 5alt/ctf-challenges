#!/usr/bin/env python
#coding=utf-8
import MySQLdb
import requests
import random
import string

service = 'z0ne'
timeout = 10					# define timeout here
author = 'md5_salt'			# author

sql_list = ['',
''
]


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
		email = genRandomLetters(8)+'@example.com'
		password = genRandomLetters(8)
		if not 'User added' in requests.post('http://%s:%d/save_user'%(host, port), data={'user-email': email, 'user-new-password': password}).text:
			raise Exception("Reg user error")
		
		sql = "SELECT * FROM users WHERE email = %s"
		cursor.execute(sql, [email])
		result = cursor.fetchone()

		secret = result[4]
		s = requests.Session()
		if not 'activate successfully' in s.post('http://%s:%d/activate'%(host, port), data={'user-email': email, 'secret': secret}).text:
			raise Exception("Active user error")

		s = requests.Session()
		if not 'You are logged in' in s.post('http://%s:%d/login'%(host,port), data={'login-username':email, 'login-password': password}).text:
			raise Exception("Login error")

		post_title = genRandomLetters(8)
		post_content = genRandomLetters(64)
		if 'New post created!' not in s.post('http://%s:%d/newpost'%(host, port), data={'post-title':post_title, 'post-full':post_content}).text:
			raise Exception("New post error")

		sql = "select pid from posts where title=%s and author=%s"
		cursor.execute(sql, [post_title, email])
		result = cursor.fetchone()
		if not result:
			raise Exception("New post not in database")
		pid = result[0]

		if post_content not in s.get('http://%s:%d/post/%d'%(host, port, int(pid))).text:
			raise Exception("post content error")

		message = 'OK'
	except Exception as e:
		message = str(e)

	sql = "DELETE FROM users WHERE email = %s"
	cursor.execute(sql, [email])
	sql = "DELETE FROM posts WHERE pid = %d"%int(pid)
	cursor.execute(sql)

	return message

if __name__ == '__main__':
	print exploit('100.64.105.11')
