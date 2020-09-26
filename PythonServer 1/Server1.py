#!/bin/python3
import socket
import sys
host = '127.0.0.1' #Setting Ip for 
port = 50000 #Setting A port for the socket
backlog = 5 #The amount of connections possible
size = 1024 #The size of the data being sent

s=socket.socket(socket.AF_INET, socket.SOCK_STREAM) #Socket Ipv4, TCP
s.bind((host,port)) # Bind the Host and Port number to the socket
s.listen(backlog) #Make the socket listen on the port
done = True
while done:
	client,address = s.accept() #server creates a 'client' socket related to the connection
	data = client.recv(size) #Receive Data on this connection
	if data: #If there is data
		data = data.decode("utf-8")
		print(data)
		if data.isalpha():
			print('Data : %s ' %data) #Print it
			msg = 'Got your message! it was :' + data
			print(msg)
			client.send(msg.encode()) #Send a msg encoded 
			client.close() #Close the socket
			done = False
		else:
			print('Data is not alphabetic')
			msg = 'Data was not alphabetic'
			client.send(msg.encode())
			client.close()
			done = False
client.close()
sys.exit()
