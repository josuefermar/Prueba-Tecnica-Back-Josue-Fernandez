# PruebaBackEnd

Este proyecto esta creado con PHP y GraphQL.

## Requisitos para su ejecucion

- php v8.1.2 o superior
- composer v2.3.5 o superior
- Docker v17.03.1 o superior
- docker-compose v1.11.2 o superior

Tanto docker como docker-compose son opcionales, se utilizan si quieres que se cree un docker con la base de datos de forma automatica.

## Ejecucion

Para la ejecucion del proyecto puedes utilizat XAMP, LAMP o WAMP colocando el proyecto en la carpeta de proyectos del sistema utilizado.

Antes de poder acceder a la aplicacion es necesario ejecutar los siguientes comandos: 

```
#comando para la instalacion de las dependencias de composer
composer install

#comando para la instalacion del docker el cual contiene la base de datos
composer run-script install-db-docker 

```

Las credenciales por defecto se encuentran en el archivo `docker-compose.yml`.
En caso de modificarlas recuerde modificar el archivo `app/config/db_credentials.php`

En caso de querer utilizar su propia base de datos modificar las credenciales en `app/config/db_credentials.php`

Luego de modificar las credenciales deberas ejecutar el siguiente comando para correr las migraciones de la base de datos (ideal que sea una base de datos MySQL).


```
composer run-script migrations
```

En caso de querer utilizar otro tipo de base de datos revisar el archivo `app/Migrations/queries.sql` para validar la estructura y relaciones de las tablas `users` y `tickets`

## Consulta de datos

Para realizar la consulta de datos puede utiliza Postman o la extension de chrome [chromeiql](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij)

## Conulta de prueba

```
{
	tickets(status: "abierto"){
    id
    status
    user {
      name
    }
  }
}
```