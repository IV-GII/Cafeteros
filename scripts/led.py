import time
import RPi.GPIO as GPIO 


## Configuración de los pines

# PIN 7 BOTON 9
# PIN 11 BOTON 6
# PIN 15 BOTON 5

boton9 = 7
boton6 = 11
boton5 = 15

GPIO.setup(7, GPIO.OUT) # 9
GPIO.setup(11, GPIO.OUT) # 6
GPIO.setup(15, GPIO.OUT) # 5

## Inicio de la secuencia
GPIO.output(boton9,True)
time.sleep(0.5)
GPIO.output(boton9,False)

time.sleep(3) # Pausa entre pulso

GPIO.output(boton6,True)
time.sleep(0.5)
GPIO.output(boton6,False)

time.sleep(3) # Pausa entre pulso

GPIO.output(boton6,True)
time.sleep(0.5)
GPIO.output(boton6,False)

time.sleep(2) # Pausa entre pulso

GPIO.output(boton5,True)
time.sleep(0.5)
GPIO.output(boton5,False)

time.sleep(2) # Pausa entre pulso

GPIO.output(boton6,True)
time.sleep(0.5)
GPIO.output(boton6,False)

time.sleep(2) # Pausa entre pulso

GPIO.output(boton6,True)
time.sleep(0.5)
GPIO.output(boton6,False)
