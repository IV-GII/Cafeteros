import serial 
serial = serial.Serial("/dev/ttyUSB0", 9600, bytesize=8)
 
f = open("status.txt", "w")
 
while True:
#uses the serial port
  data = serial.read()
  print data
  f.write(data)
  #f.flush()
 
f.close()

exit()