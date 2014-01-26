## Descripción
El cliente nos presenta el problema de realizar el mantenimiento de su red de maquinas de vending de café, a las cuales tiene que hacer un recorrido por la ciudad de Granada. Su intención es tener un sistema que le comunique de una manera cómoda el estado de las maquinas, evitando así desplazamientos innecesarios.

## Interpretación
En la reunión del equipo tras evaluar lo que el cliente nos pidió empezamos planteando el problema en dos partes, una que seria la creación de una aplicación web que interpretase los datos y se los mostrara al cliente de una manera simple y amena para conocer el estado de la red de maquinas. Por otra parte lo que nos queda es una interfaz con el equipo de vending, nuestra primera impresión seria usar una raspberry pi o un arduino.
Lo que necesitamos saber es como se interpretan los datos de la maquina por parte del cliente, ya sea por algún protocolo en particular o si se necesita alguna interacción especial con el equipo.

## Entrevista con el cliente
Tras quedar con el cliente para ver cuales eran sus necesidades, se aclararon algunos de los puntos que teníamos en duda, en particular la interfaz con la maquina y las características del interprete web.
En primer lugar nos explico que la maquina requiere de una serie de botones para realizar las acciones de mantenimiento, con lo que decidimos crear una interfaz mediante una raspberry pi usando los pines GPIO y unos relés para evitar posibles picos de tensión para la pi.
El equipo estaría conectado a Internet ya sea por wifi o por la red 3g, dependiendo de las ubicaciones de las maquinas.
La idea en particular era crear pequeños scripts que realizaran lo pertinente en la maquina, lo cual crearía una capa de abstracción entre el cliente y sus maquinas, siendo el modelo de estas independiente par la plataforma que estamos creando.
En cuanto a la interfaz web nos pidió cosas en concreto, como una pantalla de autentificación en primer lugar, y luego un panel de administración para controlar las maquinas.
Las funcionalidades deseadas eran las de poder conocer el estado de las maquinas, así como reiniciarlas o activar la función de limpiado de las mismas, aunque disponiendo de control de todos los botones de la misma se podría hacer cualquier cosa.
## Diseño y maquetación del proyecto
Tras charlar con el cliente estuvimos hablando de como realizar todo el proyecto y que cosas serian necesarias para que todo fuera bien, o al menos para hacernos una idea de como seria el producto final.
Para la parte del cliente crearíamos una aplicación para centralizar los servicios, un Saas, con el cual los cliente, en este caso las maquinas, accederían y actualizarían su estado. Utilizando php, css y python tendríamos la parte del servidor completa, usando para la base de datos mysql. En el aspecto gráfico usaríamos bootstrap para gestionar los estilos y hacer un diseño responsive que funcionara en cualquier dispositivo.
En cuanto a la raspberry pi usaríamos python, ya que los drivers para los pines de la placa están disponibles en varios lenguajes, como java, pero python era ligero y de aplicación para la asignatura de DAI.

## Funcionalidad extra
A parte del proyecto planteamos ciertos aspectos que se podrían incluir en el mismo pero, que dado el espacio de tiempo del que disponemos, no serian posibles de realizar.
Analizando la parte del servidor, ya que tendríamos un acceso abstracto a la maquina, teneniendo acceso a los botones de la misma, podríamos tener acceso a toda la funcionalidad, como por ejemplo, realizar desde una web una interfaz para comprar un café y pagarlo por paypal, y que la maquina lo sirviera.
Respecto a la parte de hardware se podría añadir el control del monedero, pero dado que la empresa propietaria no indican muy bien protocolos e información del funcionamiento, no podemos saber como funciona muy bien, pero seria posible. La idea era crear scripts que activaran funcionalidades al ser llamados de manera remota.

## Fase de desarrollo
En esta parte dividiremos en dos las ramas en las que avanza el proyecto, una seria la de hardware y otra la se de software.
La parte de hardware desarrolla un sistema para leer e interactuar con la maquina con los botones.
la parte de sofware desarrolla una interfaz web y ademas de algunos scripts para manejar los ficheros de la maquina.

La parte de hardware usa una raspberry pi usando la librería GPIO, mediante un script en python activamos la secuencia de los botones de la maquina, otro script pone un puerto serial en escucha para recibir la entrada de datos y escribirla en un fichero plano.
