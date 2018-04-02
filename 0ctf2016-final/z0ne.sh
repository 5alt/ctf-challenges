#sh -c "$(curl -fsSL http://100.64.80.11/z0ne.sh)"

apt-get -qq -y update

DEBIAN_FRONTEND=noninteractive apt-get -y install mailutils
DEBIAN_FRONTEND=noninteractive apt-get -q -y install mysql-server
mysqladmin -u root password v8y1qjq9Xx8mDcwd
mysql -uroot -pv8y1qjq9Xx8mDcwd -N -B -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'v8y1qjq9Xx8mDcwd';"
sed -i "s/127.0.0.1/*/g" /etc/mysql/my.cnf
service mysql restart

apt-get -y install python-pip
apt-get -y install python-dev libmysqlclient-dev
pip install MySQL-python
pip install rsa
pip install flask
pip install werkzeug==0.10
pip install tornado

apt-get -y install libreadline-dev libncurses5-dev libpcre3-dev libssl-dev perl make build-essential

wget https://openresty.org/download/openresty-1.9.7.4.tar.gz
tar xzvf openresty-1.9.7.4.tar.gz
cd /root/openresty-1.9.7.4/ && ./configure
cd /root/openresty-1.9.7.4/ && make
cd /root/openresty-1.9.7.4/ && make install
cd ~

/usr/local/openresty/nginx/sbin/nginx
/usr/local/openresty/nginx/sbin/nginx -s stop

useradd ctf -d /home/ctf -s /bin/bash
useradd z0ne -d /home/z0ne -s /usr/sbin/nologin

mkdir /home/ctf
chown root:ctf /home/ctf
chmod 770 /home/ctf

mkdir /home/z0ne
chown root:z0ne /home/z0ne
chmod 770 /home/z0ne

mkdir /home/ctf/waf/
chmod 770 /home/ctf/waf/
chown ctf:ctf /home/ctf/waf/
touch /home/ctf/waf/init.lua
touch /home/ctf/waf/waf.lua
chown ctf:ctf /home/ctf/waf/init.lua
chown ctf:ctf /home/ctf/waf/waf.lua
chmod 770 /home/ctf/waf/init.lua
chmod 770 /home/ctf/waf/waf.lua

apt-get install unzip
#wget http://100.64.80.11/z0ne.zip

unzip z0ne.zip
mv readme.txt /home/ctf/readme.txt

mysql -uroot -pv8y1qjq9Xx8mDcwd < install.sql
cp nginx.conf /usr/local/openresty/nginx/conf/nginx.conf
cp sudoers /etc/sudoers
cp -r z0ne/* /home/z0ne/

chown root:ctf /usr/local/openresty/nginx/conf/nginx.conf
chmod 760 /usr/local/openresty/nginx/conf/nginx.conf

chown root:z0ne /home/z0ne/uploads/
chmod 770 /home/z0ne/uploads/
chmod 750 /home/z0ne/

iptables -I INPUT -p tcp --dport 8080 -j DROP
iptables -I INPUT -s 127.0.0.1 -p tcp --dport 8080 -j ACCEPT

rm -rf z0ne
rm -f install.sql nginx.conf readme.txt sudoers openresty-1.9.7.4.tar.gz z0ne.zip