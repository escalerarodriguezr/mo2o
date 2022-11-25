# MO2O - Backend Test

La prueba consiste en realizar una API aplicando arquitectura hexagonal y DDD.

Requisitos obligatorios:

- Busqueda mediante una cadena de caracteres. (El campo a filtrar será food)
- Mostrar los datos de una cerveza especifica según el id especificado.

Requisitos opcionales realizados:

- Cachear las peticiones a PunkAPI temporalmente mediante FileSystem
- Construir documentacion del API mediante OpenAPI

La documentacion se ha implementado mediante Swagger


## Instalación usando Makefile

````shell
$ make build 'to build the docker environment'
$ make run 'to spin up containers'
$ make composer-install 'to install composer dependencies'
$ make all-tests 'to run the test suite'
$ make ssh-be 'to access the PHP container bash'
$ make stop 'to stop and start containers'
$ make restart 'to stop and start containers'
````

## Instalación sin Makefile
````shell
$ docker network create witrac-network
$ U_ID=$UID docker-compose up -d --build
$ U_ID=$UID docker exec --user $UID -it beer-be composer install --no-scripts --no-interaction --optimize-autoloader 
$ U_ID=$UID docker exec --user $UID -it beer-be bin/phpunit
$ U_ID=$UID docker exec -it --user $UID beer-be bash
$ U_ID=$UID docker-compose stop
````

## Uso de la Documentación
````shell
En la caperta doc:

$ make build 'to build the docker environment'
$ make run 'to spin up containers'
- Navegar to `http://localhost:2500/index.html` to check the Open API v3 documentation and testing endpoints
$ make restart 'to stop and start containers'
````

## Stack:
- `NGINX 1.19` container
- `PHP 8.1 FPM` container
- `Symfony 6.1` framework
















