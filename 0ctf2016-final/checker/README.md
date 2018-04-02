安装sendmail

第一天lua waf
第二天直接给源码？


提供重启的接口

不能删除root@5alt.me这个用户

因为不能改源码，所以需要防止别人读到secret之后直接模拟管理员，每次restart都重置


nginx lua用户为nobody

/etc/sudoers

nginx ALL=(root) NOPASSWD: /usr/local/openresty/nginx/sbin/nginx -c /usr/local/openresty/nginx/conf/nginx.conf,/usr/local/openresty/nginx/sbin/nginx -s reload,/usr/local/openresty/nginx/sbin/nginx -s stop


ctf ALL=(root) NOPASSWD: killall -u z0ne
ctf ALL=(z0ne) NOPASSWD: python /home/z0ne/web.py


killall web.py

控制权限！
目录不能可改，只能修改pyc文件和.secret文件

#洞
secret key重启会变 重启不清除pyc，secretkey被偷了自己想办法改
因为可能注册@5alt.me的用户，提供删除用户接口，密码checker抓

xss打管理员！

1. debug
2. check flag没检查id，流量转发
3. 注册@5alt.me的用户
4. 任意文件下载(下secret，伪造session)
5. 任意文件上传(上传secret？写pyc？重启解决。写pyc有用么)
6. reset password: newpwd处有注入
7. activate处注入
8. reg处注入
9. reg处命令执行
10. post处注入 删掉

#安装ngix
https://openresty.org/en/installation.html

https://github.com/loveshell/ngx_lua_waf

/usr/local/openresty/nginx/conf


    lua_package_path "/usr/local/openresty/nginx/conf/waf/?.lua";
    lua_shared_dict limit 10m;
    init_by_lua_file  /usr/local/openresty/nginx/conf/waf/init.lua;
    access_by_lua_file /usr/local/openresty/nginx/conf/waf/waf.lua;
    access_log /dev/null;
    #error_log /dev/null;
    
    
        location / {
            #root   html;
            #index  index.html index.htm;
            proxy_pass http://127.0.0.1:8080;
        }