[题目名称]
X-Area
[题目描述]
限制区域，非请勿入！
[作者]
md5_salt
[建议分值]
300

[出题意图]
在代码审计中经常会遇到一些代码保护措施，有时候黑客留下的后门也经常以加密的形式存在。
此题主要考察对加密后php源码文件的解密能力。

[题目分析]
首先需要通过Http基础认证，可以从最近泄露的GMail数据库中查到密码。
接下来可以查看源码得到经过base64加密后的php代码。将eval替换成echo，并按照加密的逻辑解密之后便可以得到写在注释里的flag。

[题目答案]
ISG{tHe_MaGic_pHP_S0UrCE_c0D3}
