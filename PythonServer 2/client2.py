#!/bin/python3

import socket #Imports needed socket module

host = "127.0.0.1" #Defining socket Info
port = 50000
size = 1024

s = socket.socket(socket.AF_INET,socket.SOCK_STREAM)  #Creating socket object
s.connect((host,port)) #Connecting to server socket
mymsg = "" 
i = 0
while i < 5:
	number = input("Please enter an integer : ") #Gets user input 5 times
	if number.isdigit() == True: #If the input Number is a digit
		if (i == 4): 
			mymsg += number #If it is the last number
					#Do not put a comma limiter
			i += 1
		else:
			mymsg  += (number + ",") #Add the number to string
			i += 1
		print("Number added to the list!") #Displays feedback
	else:
		print("Input is not a number please try again") #If it is not a number

s.send(mymsg.encode()) #Sends message
data = s.recv(size) #Recieves message
s.close() #Closes the connection
print('Received from server %s' %data) #Prints recieved data
