# -*- coding: utf-8 -*-
import requests, random, string
import rsa
from zeroweapon import oracle

import sys
reload(sys)
sys.setdefaultencoding('utf-8')

service = 'z0ne'
timeout = 3					# define timeout here
author = 'md5_salt'			# author

def genRandomLetters(length):
	return ''.join([random.choice(string.letters) for i in xrange(length)])

def getTeamID(host):
	return int(host[8:10])

def exploit(host):
	port = 8000
	with open('private.pem') as privatefile:
		p = privatefile.read()
		privkey = rsa.PrivateKey.load_pkcs1(p)
	nonce = genRandomLetters(8)
	teamid = getTeamID(host)
	message = str(teamid)+nonce
	signature = rsa.sign(message, privkey, 'SHA-1').encode('hex')

	team_flag = requests.get('http://%s:%s/check_flag?teamid=%s&nonce=%s&signature=%s'%(host, port, teamid, nonce, signature)).text
	#real_flag = oracle(service, getTeamID(host))
	print team_flag
	return team_flag
	'''
	if team_flag == real_flag:
		return 'OK'
	else:
		return 'rsa check flag error'
		return team_flag
	'''


if __name__ == '__main__':
	print exploit('100.64.105.11')