#coding=utf-8
#!/usr/bin/python

from tornado.wsgi import WSGIContainer
from tornado.httpserver import HTTPServer
from tornado.ioloop import IOLoop

from functools import wraps
from flask import request, Flask, session, redirect, url_for, render_template_string, make_response, flash

app = Flask(__name__)
app.secret_key = 'A0@#$8jdfsdfs~XHH!jmasddas?RT'
app.config['SERVER_NAME'] = 'admin.government.vip:8000'

users = {'test':'test'}

index_html = '''
<!doctype html>
<head>
<title>Admin Panel</title>
<script>
//sandbox
delete window.Function;
delete window.eval;
delete window.alert;
delete window.XMLHttpRequest;
delete window.Proxy;
delete window.Image;
delete window.postMessage;
</script>
</head>
{% autoescape false %}
<h1>Hello {{ username }}</h1>
{% endautoescape %}
{% if user == 'admin' %}
<p>Upload your shell</p>
<form action="/upload" method="post" enctype="multipart/form-data">
<p><input type="file" name="file"></input></p>
<p><input type="submit" value="upload">
</form>
{% else %}
<p>Only admin can upload a shell</p>
{% endif %}
'''

def logged_in(f):
	@wraps(f)
	def decorated_function(*args, **kwargs):
		if request.cookies.get('admin_secret') == 'md5_salt_is_the_real_admin':
			session['username'] = 'admin'
		if session.get('username') is not None:
			return f(*args, **kwargs)
		else:
			flash('Please log in first.', 'error')
			return redirect(url_for('login'))
	return decorated_function

@app.route('/')
@logged_in
def index():
	return render_template_string(index_html, username=request.cookies.get('username'), user=session['username'])

@app.route('/login', methods=['GET', 'POST'])
def login():
	if request.method == 'POST':
		if users.get(request.form['username']) == request.form['password']:
			session['username'] = request.form['username']
			resp = make_response(redirect(url_for('index')))
			resp.set_cookie('username', request.form['username'])
			return resp
	return '''
		<form action="" method="post">
			<p>Username <input type="text" name="username" value="test">
			<p>Password <input type="password" name="password" value="test">
			<p><input type="submit" value="Login">
		</form>
	'''

@app.route('/upload', methods=['POST'])
@logged_in
def upload_file():
	if request.method == 'POST' and session['username'] == 'admin':
		file = request.files['file']
		if file:
			return 'flag{xss_is_fun_2333333}'
	return 'hey dude, upload your shell'


if __name__ == '__main__':
	http_server = HTTPServer(WSGIContainer(app))
	http_server.listen(8000)  #flask默认的端口,可任意修改
	IOLoop.instance().start()
	#app.run(debug=True,port=8000)