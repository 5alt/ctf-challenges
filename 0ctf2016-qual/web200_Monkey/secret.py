from flask import Flask
app = Flask(__name__)

@app.route('/secret')
def secret():
    return '0ctf{monkey_likes_banananananananaaaa}'

if __name__ == '__main__':
    app.run(host="127.0.0.1", port=8080)
