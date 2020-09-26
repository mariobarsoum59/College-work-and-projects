#!/bin/python3

import socket
import sys

def isPowerOfTwo(n): #Function returns true or false if it is a power of two
	if (n==0):
		return False
	while (n != 1):
		if (n % 2 != 0):
			return False
		n = n // 2
	return True



host = "127.0.0.1" #Setting variables for sockets
port = 50000
backlog = 5
size = 1024

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.bind((host,port)) #Sets up socket object and binds it 
s.listen(backlog) #Make socket listen

while 1:
	client,address = s.accept() #Infinite loop wait for connection
	data = client.recv(size) #Wait for data
	if data:  #If there is data
		data=data.decode() #Decode the data
		data=data.split(',') #Split it into an array on delimiter
		integerData = list(map(int,data)) #Convert the string to int
		numbersArePowersOf2 = True #Assume nums are powers of 2
		for num in integerData: #For every num in array of nums
			if isPowerOfTwo(num) == False: 
				numbersArePowersOf2 = False #If a num is not
		if (numbersArePowersOf2):		    #A power of 2
			mymsg = 'true'			   #Set bool to false
		else:
			mymsg = 'false'
					#Change the message based on
					#Value of numbersArePowersOf2
		#Send back msg
		client.send(mymsg.encode())
		#Close connection
		client.close()
		sys.exit() #Exits program and loop 
		
