#coding=utf8
from web3 import Web3, HTTPProvider
import json, re

from flask import Flask,request

def get_balance(team, wallet):
	port = 8000+team

	contract_addr = '0xb3883b88A48923187A22Ee27d4cb840a4Be68fD3'
	token_t_abi = '[ { "constant": true, "inputs": [ { "name": "", "type": "address" } ], "name": "balanceOf", "outputs": [ { "name": "", "type": "uint256", "value": "0" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "name": "guess", "type": "uint256" } ], "name": "bet", "outputs": [], "payable": true, "stateMutability": "payable", "type": "function" }, { "constant": false, "inputs": [], "name": "init", "outputs": [], "payable": true, "stateMutability": "payable", "type": "function" }, { "inputs": [], "payable": false, "stateMutability": "nonpayable", "type": "constructor" } ]'
	#wallet_w = wallet#'0xAC9E27B1fABd55D3E85104d9FEB945C57d99f43A'
	wallet_w = Web3.toChecksumAddress(wallet.lower())#'0xAC9E27B1fABd55D3E85104d9FEB945C57d99f43A'

	w3 = Web3(HTTPProvider('http://127.0.0.1:%d' % port))
	token = w3.eth.contract(
		contract_addr,
		abi=json.loads(token_t_abi),
	)
	return token.call().balanceOf(wallet_w)

def ip2team(ip):
	'''
	192.168.100.1
	192.168.101.1
	'''
	#return 0
	return int(ip.split('.')[2]) - 100


app = Flask(__name__)

@app.route('/')
def index():
	return 'Welcome to ZeroLottery.'


@app.route('/flag')
def flag():
	wallet = request.args.get('wallet', '')
	if not wallet or not re.match(r'0x[0-9a-fA-F]{32,}', wallet):
		return 'bad address format'

	ip = request.remote_addr
	team = ip2team(ip)
	balance = get_balance(team, wallet)
	if balance > 500:
		return 'flag{smart_contracts_is_not_so_secure}'

	return 'Your balance is ' + str(balance)

if __name__ == '__main__':
	from tornado.wsgi import WSGIContainer
	from tornado.httpserver import HTTPServer
	from tornado.ioloop import IOLoop

	http_server = HTTPServer(WSGIContainer(app))
	http_server.listen(5000)
	IOLoop.instance().start()
	#app.run(debug=True)