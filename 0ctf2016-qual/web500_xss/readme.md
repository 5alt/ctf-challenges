apt-get install nginx
apt-get install mysql-server
apt-get install redis-server
apt-get install php5
apt-get install php5-fpm
apt-get install php5-curl
apt-get install php5-mysql
apt-get install php5-redis
apt-get install mailutils



apt-get install unzip
apt-get install phantomjs
apt-get install python-pip
 apt-get install python-dev libmysqlclient-dev
pip install MySQL-python


/etc/php5/fpm/php.ini

disable_functions
passthru,exec,system,chroot,scandir,chgrp,chown,shell_exec,proc_open,proc_get_status,popen,ini_alter,ini_restore,dl,openlog,syslog,readlink,symlink,popepassthru,stream_socket_server

open_basedir	/usr/share/nginx/html:/tmp/:/proc/

session.save_handler = redis
session.save_path = "tcp://127.0.0.1:6379"


/etc/nginx/sites-enabled/default

service php5-fpm restart


cd /usr/share/nginx/html
chown -R root:www-data *
chmod -R 650 *
chmod 777 uploads


设置iptables允许服务器访问外面的脚本！