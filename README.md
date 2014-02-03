Práctica Cocorocó IV/DAI - Cafeteros
====================================

## ¿Quiénes somos?

- José Miguel Colella Carbonara [@josecolella](https://github.com/josecolella)

- Javier Collado López [@javiercollado](https://github.com/javiercollado)

- Antonio Ángel Guirola Vicente [@antonioguirola](https://github.com/antonioguirola)

- Sergio Muñoz Gamarra [@sergiomgamarra](https://github.com/)

- Francisco Ruíz López [@elmendacorp](https://github.com/elmendacorp)

![captura](img/equipo.png)


## Descripción

El objetivo de este proyecto es facilitar la supervisión remota de máquinas de vending de café. Actualmente el usuario tiene que acudir físicamente al lugar donde se encuentra la máquina y conectar su ordenador mediante puerto serie para leer la información de los distintos sensores de las mismas. Nuestra misión es leer la información de las máquinas y transmitirla a un sitio web de forma que el usuario pueda consultar desde cualquier lugar el estado de las mismas.


## Interpretación del problema

En la reunión del equipo tras evaluar lo que el cliente necesitaba empezamos dividiendo el problema en dos partes: una sería la creación de una aplicación web que interpretase los datos y se los mostrara al cliente de una manera simple y amena para conocer el estado de la red de máquinas y por otra parte una interfaz con el equipo de vending; nuestra primera impresión fue usar una Raspberry pi o un microcontrolador arduino.

Lo que necesitábamos saber es cómo se interpretan los datos de la maquina por parte del cliente, ya sea por algún protocolo en particular o si se necesitaba alguna interacción especial con el equipo.


## Entrevista con el cliente

Tras reunirnos con el cliente para ver cuáles eran sus necesidades se aclararon algunos de los puntos que teníamos en duda, en particular la interfaz con la máquina y las características que debían mostrarse en el sitio web.

En primer lugar nos explicó que la máquina requiere pulsar una serie de botones para realizar las acciones de mantenimiento, con lo que decidimos crear una interfaz mediante una raspberry pi usando los pines GPIO y unos relés para evitar posibles picos de tensión para la placa.

El equipo estaría conectado a Internet ya sea por wifi o por la red 3g, dependiendo de las ubicaciones de las máquinas.

La idea era crear pequeños scripts que realizaran lo pertinente en la maquina, lo cual crearía una capa de abstracción entre el cliente y las mismas, siendo el modelo de éstas independiente para la plataforma que estamos creando.

En cuanto a la interfaz web nos pidió ciertos requisitos mínimos, como una pantalla de autentificación en primer lugar, y luego un panel de administración para controlar las máquinas.

Las funcionalidades deseadas eran las de poder conocer el estado de las máquinas, así como reiniciarlas o activar la función de limpiado de las mismas, aunque disponiendo de control de todos los botones de la misma se podría hacer cualquier cosa.


## Diseño y maquetación del proyecto

Tras cconversar con el cliente estuvimos decidiendo cómo realizar todo el proyecto y qué cosas serían necesarias para que todo fuera bien, o al menos para hacernos una idea de como sería el producto final.

Para la parte del cliente crearíamos una aplicación para centralizar los servicios, utilizando el SaaS OpenShift, a la cual las máquinas accederían y actualizarían su estado. Utilizando las tecnologías PHP, CSS y Python tendríamos la parte del servidor completa, usando para la base de datos MySQL. En el aspecto gráfico usaríamos Twitter Bootstrap para gestionar los estilos y hacer un diseño responsive que funcionara en cualquier dispositivo.

En cuanto a la raspberry pi usaríamos el lenguaje Python para programar los scripts que se ejecutarían en ella, ya que los drivers para interactuar con los pines de la placa están disponibles en varios lenguajes, como Java, pero Python es ligero y de aplicación para la asignatura de DAI.


## Funcionalidad extra

Aparte del proyecto planteamos ciertos aspectos que se podrían incluir en el mismo pero, que dado el espacio de tiempo del que disponemos, no serian posibles de realizar.
Analizando la parte del servidor, ya que tendríamos un acceso abstracto a la maquina, teneniendo acceso a los botones de la misma, podríamos tener acceso a toda la funcionalidad, como por ejemplo, realizar desde una web una interfaz para comprar un café y pagarlo por paypal, y que la maquina lo sirviera.
Respecto a la parte de hardware se podría añadir el control del monedero, pero dado que la empresa propietaria no indican muy bien protocolos e información del funcionamiento, no podemos saber como funciona muy bien, pero seria posible. La idea era crear scripts que activaran funcionalidades al ser llamados de manera remota.


## Fase de desarrollo

En esta parte dividiremos en dos las ramas en las que avanza el proyecto, una seria la de hardware y otra la se de software.
La parte de hardware desarrolla un sistema para leer e interactuar con la maquina con los botones.
la parte de sofware desarrolla una interfaz web y ademas de algunos scripts para manejar los ficheros de la maquina.

La parte de hardware usa una raspberry pi usando la librería GPIO, mediante un script en python activamos la secuencia de los botones de la maquina, otro script pone un puerto serial en escucha para recibir la entrada de datos y escribirla en un fichero plano.

###Programación Raspberry pi

En esta sección nos centramos en la creación de dos scripts:

  - Script de automatización de la secuencia de los botones que se deben pulsar para llegar a hacer que la máquina de café empiece a imprimir las estadísticas. Para este script solo se necesitó la biblioteca GPIO para gestionar los pins de la raspberry pi y la biblioteca time para gestionar los tiempos de pulsaciones y esperas. El script resultante se divide en dos partes, la configuración de los pins de salida y la secuencia de pulsaciones, teniendo esta parte pulsaciones de medio segundo y pausas entre pulsación y pulsación de tres segundos, para respetar el tiempo de procesamiento de la máquina de café. 
  A continuación podemos ver el script desarrollado:

```python
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
```
      
  - Script para la lectura de la información emitida por la máquina. En este script leeremos por el puerto serie y los resultados se irán escribiendo en un fichero status.txt. En este caso usamos las bibliotecas io y serial, ambas usadas en tareas de lectura.
  En la tarea de lectura desde la máquina encontramos un problema, la raspberry pi no era capaz de leer y escribir en el fichero todas las líneas que mandaba la máquina de café, lo que hacía que al fichero con las estadísticas le faltasen algunas líneas, por lo que intentamos dos alternativas, la primera de ellas fue configurar la escucha del puerto serie con la configuración que el dueño de la máquina utilizaba normalmente (líneas comentadas), y la otra alternativa fue leer directamente desde el ttyUSB0. En ambos casos nos encontramos con la falta de líneas completas en el fichero. Quedando esta sección como pendiente de mejora para el futuro.
  A continuación podemos ver el script:

```python
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
```

###Parsing y Conexión Remota con las bases de datos en OpenShift

En esta sección se denota el proceso de coger el fichero que saca
la máquina de cafe, procesar dicho fichero para que la información
pueda ser mandada a las bases de datos de Openshift. Este último proceso
se hace remotamente y de manera segura.

El fichero que hay que procesar tiene información sobre:
  - Nombre del Fabricante
  - Modelo
  - Revision del fireware de la máquina
  - Codigo de la máquina
  - Número de Impresion
  - Contador de todos los cafes del inicio
  - Los diferentes cafes con la informacion de la venta
  que corresponde al cafe que se ha vendido
  - La maquina emite 8 precios diferentes.
  - Averias de la maquina

El objetivo a cumplir era estructurar dicha información de una manera que
si se ve en un futuro se pueda manipular más facilmente, y además que dicha
información se vaya alojando en la aplicación web para que pueda ser visualizada
por cualquier persona que necesite administrar las máquinas de cafe.

El primer objetivo que se ha planteado se ha tratado de cumplir estructurando
los datos proporcionados de dichos fichero en forma de un fichero json. JSON
es una alternativo a XML para el intercambio de información. Son estructuras fácil
de entender y manejar.

A continuación podemos el resultado de transformar la información proporcionada
de la máquina en un fichero JSON que esta denotado por el fecha y el tiempo en
el cual se ha hecho el análisis.



```json
{
    "Codigo de la Maquina": "0001",
    "Contador de todos los cafes del inicio del tiempo": "1224",
    "Errores": [
        {
            "1": "0"
        },
        {
            "2": "0"
        },
        {
            "3": "5"
        },
        {
            "4": "0"
        },
        {
            "5": "3"
        },
        {
            "6": "1"
        },
        {
            "7": "0"
        },
        {
            "8": "0"
        },
        {
            "9": "0"
        },
        {
            "10": "7"
        },
        {
            "11": "0"
        },
        {
            "12": "0"
        },
        {
            "13": "0"
        },
        {
            "14": "0"
        },
        {
            "15": "0"
        }
    ],
    "Modelo": "D.A. COLIBRI",
    "Nombre de Fabricante": "NECTA VENDING",
    "Numero de Impresion": "17",
    "Precio": [
        {
            "1": "1217"
        },
        {
            "2": "0"
        },
        {
            "3": "0"
        },
        {
            "4": "0"
        },
        {
            "5": "0"
        },
        {
            "6": "0"
        },
        {
            "7": "0"
        },
        {
            "8": "0"
        }
    ],
    "Revision del Firmware": "Rev. 1.9 LVZ",
    "Tecla": [
        {
            "1": [
                "0",
                "0",
                "0"
            ]
        },
        {
            "2": [
                "32",
                "4",
                "0"
            ]
        },
        {
            "3": [
                "80",
                "0",
                "0"
            ]
        },
        {
            "4": [
                "38",
                "0",
                "0"
            ]
        },
        {
            "5": [
                "0",
                "0",
                "0"
            ]
        },
        {
            "6": [
                "270",
                "1",
                "0"
            ]
        },
        {
            "7": [
                "282",
                "3",
                "0"
            ]
        },
        {
            "8": [
                "506",
                "1",
                "0"
            ]
        }
    ],
    "Vaso f.n.": "1217",
    "Vaso mant.": "0"
}
```


Para crear dicha estructura he usado Python, especificamente su modulo de json
para poder crear el fichero JSON. Lo primero que se ha hecho es crear un objeto
[`VendingMachine`](https://github.com/IV-GII/Cafeteros/blob/master/scripts/VendingMachine.py)
que encapsula la estructura y toda la información relacionada con la máquina de cafe que se esta tratando.

Para parsear el fichero y guardar la información relevante he usado el modulo de
expresiones regulares de python.

El script que hace todo el procedimiento es el siguiente:

```python
#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import sys
from VendingMachine import *


if __name__ == '__main__':
    try:
        coffeeMachine = VendingMachine(sys.argv[1])
        coffeeMachine.saveToFile()
    except IndexError:
        print("Se requiere un argumento de linea de comando")
```

Se le pasa un argumento por linea. Dicho argumento es el fichero a parsear.
Cuando finaliza de procesar guarda la información en un fichero JSON.
Además que se va guardando información sobre cuando se hace el parseo guardando
información sobre la fecha y el tiempo en un fichero `tiempo.txt`.

Ahora llegamos al segundo objetivo que es la parte de transferir la información
remotamente desde el raspberry pi hasta las bases de datos de Openshift, para que
se pueda visualizar desde la aplicación web.

La única dependencia que se tiene que tener en cuenta es el modulo
para conectar python a MySQL. Dicho modulo se llama `MySQLdb`. Esto
se previente en el provisionamiento con ansible.

En dicho programa se tiene en cuenta cuatro tablas.
  - La tabla de las maquina, que diferencia las máquinas
  - El producto, que tiene en cuenta la máquina con sus diversos cafes
  - El precio que tiene la máquina
  - Los errores que esta ligado con la máquina

A continuación se puede ver las cuatro funciones creadas para insertar en las
bases de datos.

```python
def insertMachineInfo(id_maquina, model, firmware, fabricante, n_cafes, vasos_totales, vasos_mantenido, n_impresion):
    db.execute(
        """
        INSERT INTO maquinas VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
        """,
        (id_maquina, model, firmware, fabricante, n_cafes, vasos_totales, vasos_mantenido, n_impresion))


def insertProduct(id_maquina, boton, pago, gratis, test):
    db.execute(
        """
        INSERT INTO Producto VALUES (%s, %s, %s, %s, %s)
        """,
        (id_maquina, boton, pago, gratis, test))


def insertPrice(id_maquina, precio1, precio2, precio3, precio4, precio5, precio6, precio7, precio8):
    db.execute(
        """
        INSERT INTO precio VALUES (%s,%s, %s, %s, %s, %s, %s, %s, %s)
        """,
        (id_maquina, precio1, precio2, precio3,
         precio4, precio5, precio6, precio7, precio8)
    )


def insertError(id_maquina, er1, er2, er3, er4, er5, er6, er7, er8, er9, er10, er11, er12, er13, er14, er15):
    db.execute(
        """
        INSERT INTO errores VALUES (%s, %s,%s, %s,%s, %s,%s, %s,%s, %s,%s, %s,%s, %s,%s, %s)
        """,
        (id_maquina, er1, er2, er3, er4, er5, er6, er7, er8, er9, er10, er11, er12, er13, er14, er15))

```

####Importante

Para poder hacer la conexión con las bases de datos en Openshift se tiene que usar
la funcionalidad que proporciona el cliente de Openshift **(rhc)** con port-forwarding.
Esto significa que el raspberry pi podra transferir todas la información a openshift
usando el host de localhost y usando un puerto dado que transfiere toda la información
a las bases de datos MySQL.

El script que gestiona la conexión e inserción en las bases de datos se puede
visualizar [aquí](https://github.com/IV-GII/Cafeteros/blob/master/scripts/databaseconn.py)


Ejecucion del programa:
A continuación podemos ver como se hace para procesar los ficheros y mandar la información a 
las bases de datos de OpenShift.

Primero se han parseado tres fichero proporcionados, con los siguientes comandos:

```bash
python3 fileparser.py captura\ 20140120\ iznalloz.txt
python3 fileparser.py captura\ 20140121\ tecnoszubia.txt
python3 fileparser.py captura\ 20140124\ cocoroco.txt
```

Segundo se ha conectado con las bases de datos con los siguientes comandos, donde
primero tiene que hacer el port-forwarding para conectarse y mandar la información

```bash
rhc port-forward -a cafeteros
```

Se termina la secuencia usando el siguiente comando:

```bash
python databaseconn.py
```

Esto graba todos los datos procesado en dicho día en las bases de datos.

##Interfaz Web

Características que necesitamos:
  - Necesitamos una interfaz web sencilla. 
  - No tenemos que olvidar que la aplicación web que estamos realizando es una herramienta de trabajo. Así que tiene que ser comoda de usar.  
  - Necesitamos mostrar el máximo de información, pero de la forma mas clara posible.  
  - Nuestra aplicación web debe tener una interfaz responsiva. Es decir, tiene que poder ser visualizada fácilmente desde los diferentes dispositivos que tenemos. Es decir tablets, Smartphone, ordenadores...  

Para facilitar esta tarea, vamos a usar Bootstrap, php y mysqli para la conexion con la base de datos. 

Lo primero que vamos a necesitar es una página de login. Pues la información que vamos a obtener de las diferentes máquinas solo debe ser vista por aquellos que están autorizados a verla.  

![login](https://github.com/IV-GII/Cafeteros/blob/master/img/login.png?raw=true)

Una vez que entramos a nuestra interfaz web, nos mostrará la página principal, en la que podemos ver directamente la información sobre las máquinas de manera rápida. 
La página esta distribuida en 2 columnas. La columna de la izquierda consiste en un índice de las máquinas sobre las que podemos ver la información. Al pulsar sobre la máquina accederemos directamente a la parte de la web donde esta la información de esta.  
  
En la columna de la derecha encontramos la parte principal de la página. La información.  
Cada recuadro grande representa una máquina con su información (Información general, pulsación de teclas...). Para facilitar el mantenimiento, estos recuadros cambiarán de color. Es decir. El color del recuadro nos da información del estado de la máquina.  

  * Verde: El estado de la máquina es bueno. Tiene suficiente café, vasos...
  * Amarillo: Quiere decir que ha pasado alguno de los límites. Y que en poco tiempo le va a faltar algo.
  * Rojo: La máquina presenta algún error, algo se ha gastado...  

![main](https://github.com/IV-GII/Cafeteros/blob/master/img/main.png?raw=true)

En futuras actualizaciones se mostrará la información de manera más visual. Por ejemplo, el conteo de pulsación de botones con una botonera...

Pasamos finalmente a la última parte de la aplicación web. El mantenimiento. Además de controlar el estado de los vasos, café, leche... también existe la posibilidad de que la máquina se atasque, que necesitemos que esta se limpie sola (Este tipo de máquina tiene esa función). Para que mayor comodidad se ponen estas opciones en un apartado diferente. 
En esta parte de la pagina también se mantiene el código de color en los recuadros, pues nos será útil para ver que máquina tiene el error (Que se puede solucionar desde esta página).  

![mantenimiento](https://github.com/IV-GII/Cafeteros/blob/master/img/mantenimiento.png?raw=true)  

Futuro de nuestro proyecto
==========================

El futuro más inmediato de nuestro proyecto, es que este funcione al 100%. Es decir, no nos basta solo con el prototipo. Además necesitamos que funciones correctamente para que sea una herramienta de trabajo usable. 
  - La tarea principal es acabar es la conexión hardware de la cafetera a la raspberry pi. Evidentemente no sólo de la cafetera con la que hemos empezado a funcionar. Si no con todas las del cliente. Para tener una estructura clara sobre la que obtener los datos, tratarlos y mostrarlos en la aplicación web. 
  - A nivel de hardware:
    * diseñar una placa y hacer las correcciones correctamente. De manera que se simplifique la instación en diferentes cafeteras.
    * Utilizar los pines del puerto de serie y no un conversor. 
    * Añadir relé para poder resetear la máquina desde la raspberry pi.
    *Integrar la circuitería dentro de la máquina. 
  - A nivel software podemos añadir más caracteristicas, que incluirian en la aplicación web no solo al administrador de las máquinas, si no tambien a los clientes:
    * Administrador: Enviar odenes no solo desde el cron (Obtener datos en el momento, resetear máquina, generar estadísticas, limpiar máquina...)
    * Cliente: 
      + Interfaz web de la máquina (Pedir cafes desde la mesa, para que cuando llegues a la maquina ya este preparado).
      + Gestion de pagos por paypal.
      + Gestión de cuenta de cliente: Bonificación por uso...

  - Y finalmente, seguridad de la aplicación web. Es necesaria, si no queremos que cualquiera pueda atacar nuestro sistema.

  
Bibliografía
============
[Como enlazar mensajes a issues][1]

[Como conectarse de manera remota a las bases de datos en Openshift][2]

[1]: http://stackoverflow.com/questions/1687262/link-to-github-issue-number-with-commit-message
[2]: https://www.openshift.com/blogs/getting-started-with-port-forwarding-on-openshift

LICENCIA
========
  Copyright 2014 Jose Miguel Colella Carbonara, 
          Javier Collado López, 
          Antonio Ángel Guirola Vicente, 
          Sergio Muñoz Gamarra, 
          Francisco Ruíz López.

  This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.*/ 
