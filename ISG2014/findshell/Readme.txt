[题目名称]
Find Shell
[题目描述]
找到你上传的shell吧！
[作者]
md5_salt
[建议分值]
200

[运行环境]
windows
php5.x
[配置说明]
上传findshell文件夹
flag写在tthisiiisttheflllaaag.txt文件中

[出题意图]
考察windows上的短文件名漏洞
在一些cms里，数据库备份文件命名不规范可以用此漏洞下载
[题目分析]
首先在返回的响应头里发现提示。
根据提示得知上传后的文件名由两部分拼接而成，前半部分与上传的文件名有关可控。
因此可以通过windows上的短文件名漏洞猜测出上传后的文件名。
对高版本IIS如IIS 7.5(Windows 2008 R2) / IIS 8.0(Windows 2012)可能需要通过发送OPTIONS请求来绕过限制。
