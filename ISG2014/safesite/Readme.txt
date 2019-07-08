[题目名称]
Safe Site
[题目描述]
这是一个非常安全的网站，该如何拿到flag呢 ？
*注意：在ip为x.x.x.x的服务器上绑定了reallysafesite.org的相关域名
[作者]
md5_salt
[建议分值]
400

[运行环境]
php5.x 魔术引号关闭
MySQL 5.x
[配置说明]
webserver中设置域名reallysafesite.org，对应文件夹为main
webserver中设置域名admin.reallysafesite.org，对应文件夹为admin
在数据库中导入install.sql
配置admin文件夹下config.php，设置数据库连接信息以及flag

[出题意图]
模拟真实环境下的大中型网站。该类型网站后台一般由二级域名指定，主站安全性较高，而在后台等地方安全性较弱。
本题主要考察后台登陆框注入相关知识。

[题目分析]
首先需要在hosts里绑定域名和ip。
根据主站提示，主站很安全，考虑通过分站进行渗透。
猜测到管理后台的域名为admin.reallysafesite.org。
经过测试可知在后台登陆框处有SQL注入，返回信息在cookie中给出。通过cookie中用户名部分可以获取数据库中管理员的密码hash。由cookie中密码部分特征可以得知为经过sha1加密后的数据，经过测试可知为sha1(md5(password))。而数据库中密码hash为md5(password)，因此可以通过修改cookie为sha1(hash)来bypass登陆验证。
登陆成功即可得到flag。
