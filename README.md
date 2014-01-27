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




Ejecucion del programa:
- python3 fileparser.py captura\ 20140120\ iznalloz.txt
- python3 fileparser.py captura\ 20140121\ tecnoszubia.txt
- python3 fileparser.py captura\ 20140124\ cocoroco.txt

Bibliografía
============
[Como enlazar mensajes a issues][1]
[Como conectarse de manera remota a las bases de datos en Openshift][2]

[1]: http://stackoverflow.com/questions/1687262/link-to-github-issue-number-with-commit-message
[2]: https://www.openshift.com/blogs/getting-started-with-port-forwarding-on-openshift
