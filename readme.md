## Fichero .env variables entorno

El repositorio incluye el fichero .env para facilitar las pruebas.

## Trabajo con Git

He empleando el método Git Flow. Para ello uso los comandos desde la consola.

En esta prueba se ha trabajado con dos principales, develop y master.

Para desarrollar la api he creado la rama feature-request-country-check.

Se ha mezclado la rama feature en develop y develop en master.

En un proyecto real, crearía una rama release a partir de develop para desplegar el desarrollo en un entorno de test. Una vez que se validara, se procedería a mezclar la release en master.

## Instalación del proyecto

1. Clonar el proyecto

$ git clone https://github.com/memento86/miliga-api-rest.git

2. Instalar las dependencias PHP.

$ composer install -o

## Tests unitarios y funcionales

Se han implementado tests sobre la mayoría de clases desarrolladas.

Para ejecutalos escribir lo siguiente.

$ ./bin/phpunit tests

## Proyecto Postman

Se ha exportado el proyecto de pruebas en el fichero api_freepik.postman_collection.

Se ha implementado un listener para capturar y procesar las excepciones producidas en la aplicación.

## Aclaraciones

Para dar soporte a diferentes tipos de criterios, se ha empleado el patrón Factory Method.

## Posibles mejoras

- Desarrollar un método de autenticación para securizar la api.
- En el listener de captura de excepciones, añadir un servicio de almacenamiento de logs.
- Los diferentes criterios implementados se podrían gestionar a través de entidades de base de datos. De forma que se pudieran añadir y quitar criterios existentes sin necesidad de tocar el código. Pensaba hacer esto, pero no me daba tiempo.
