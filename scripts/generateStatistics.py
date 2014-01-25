import serial 
serial = serial.Serial("/dev/ttyUSB0", baudrate=9600, bytesize=8, parity='N', stopbits=1, xonxoff=1)
 
f = open("status.txt", "w")

string=""

cont=0
inicioPasado=False

while True:
#uses the serial port
  data = serial.read()
  string += data
  #print data
  f.write(data)
  f.flush()
  #print("Contador: "+str(cont))
  #print (string)
  if data=="=":
  	cont+=1
  else:
  	cont=0

  if cont==20 and inicioPasado==False:
  	inicioPasado=True
  elif cont==20 and inicioPasado==True:
  	break
 
f.close()

print (string)

exit()