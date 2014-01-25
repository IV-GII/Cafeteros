The OpenShift `php` cartridge documentation can be found at:

https://github.com/openshift/origin-server/tree/master/cartridges/openshift-origin-cartridge-php/README.md



@Antonio
-> Para hacer el acceso a las bases de datos hay que hacer
los siguientes pasos:
  - El raspberrypi tiene que tener el cliente de rhc para poder manejar la aplicación
  - Tienes que copiar la llave ssh del raspberry pi hacia la maquina de openshift
  - rhc port-forward -a cafeteros -> donde cafeteros es el nombre de la aplicación
  Esto hace que se puede acceder desde local y se forwardea a la maquina
  de openshift
  -