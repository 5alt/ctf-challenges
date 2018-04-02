# -*- coding: utf-8 -*-
__author__ = 'luchanghong'
import rsa

#http://www.aikaiyuan.com/5204.html
'''
# 先生成一对密钥，然后保存.pem格式文件，当然也可以直接使用
(pubkey, privkey) = rsa.newkeys(1024)

pub = pubkey.save_pkcs1()
pubfile = open('public.pem','w+')
pubfile.write(pub)
pubfile.close()

pri = privkey.save_pkcs1()
prifile = open('private.pem','w+')
prifile.write(pri)
prifile.close()
'''
# load公钥和密钥
message = 'hello'
with open('public.pem') as publickfile:
    p = publickfile.read()
    pubkey = rsa.PublicKey.load_pkcs1(p)

with open('private.pem') as privatefile:
    p = privatefile.read()
    privkey = rsa.PrivateKey.load_pkcs1(p)

# 用公钥加密、再用私钥解密
crypto = rsa.encrypt(message, pubkey)
print crypto.encode('hex')
message = rsa.decrypt(crypto, privkey)
print message

# sign 用私钥签名认真、再用公钥验证签名
signature = rsa.sign(message, privkey, 'SHA-1')
print signature.encode('hex')
print rsa.verify('hello', signature, pubkey)
