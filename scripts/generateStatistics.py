import serial 
import io
#serial = serial.Serial("/dev/ttyUSB0", timeout=10,baudrate=9600, bytesize=8, parity='N', stopbits=1, xonxoff=1)
f = open("status.txt", "w")
serial=open("/dev/ttyUSB0","rw")

#string=""
while True:
#uses the serial port
	data = serial.read()
#string+=data
#print data
	f.write(data)
	f.flush()
#print("Contador: "+str(cont))
#print (string)
 
#f.write(string) 
f.close()

#exit()
