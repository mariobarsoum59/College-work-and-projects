#!/bin/python3
import socket

host = '127.0.0.1'
port = 50000
size = 1024

s=socket.socket(socket.AF_INET, socket.SOCK_STREAM)
mymsg = socket.gethostname()
mymsg = mymsg.replace('-','')
s.connect((host,port))
s.send(mymsg.encode())
data = s.recv(size)
s.close()
print('Received From server : %s' %data)
