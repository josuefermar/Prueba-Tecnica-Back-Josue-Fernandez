# PruebaBackEnd

Este proyecto está creado con PHP y GraphQL.

## Requisitos para su ejecución

- php v8.1.2 o superior
- composer v2.3.5 o superior
- Docker v17.03.1 o superior
- docker-compose v1.11.2 o superior

Tanto docker como docker-compose son opcionales, se utilizan si quieres que se cree un docker con la base de datos de forma automática.

## Ejecución

Para la ejecución del proyecto puedes utilizar XAMPP, LAMP o WAMP colocando el proyecto en la carpeta de proyectos del sistema utilizado.

Antes de poder acceder a la aplicación es necesario ejecutar los siguientes comandos:

```
#comando para la instalación de las dependencias de composer
composer install


#comando para la instalación del docker el cual contiene la base de datos
composer run-script install-db-docker
```

Las credenciales por defecto se encuentran en el archivo `docker-compose.yml`.
En caso de modificarlas recuerde modificar el archivo `app/config/db_credentials.php`

En caso de querer utilizar su propia base de datos modificar las credenciales en `app/config/db_credentials.php`

Luego de modificar las credenciales deberás ejecutar el siguiente comando para correr las migraciones de la base de datos (ideal que sea una base de datos MySQL).

```
composer run-script migrations
```

En caso de querer utilizar otro tipo de base de datos revisar el archivo `app/Migrations/queries.sql` para validar la estructura y relaciones de las tablas `users` y `tickets`

## Consulta de datos

Para realizar la consulta de datos puede utiliza [Postman](https://www.postman.com/downloads/) o la extension de chrome [chromeiql](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij)

## Consulta de prueba

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

## Estructura Tablas

Tabla users

- id: Int(AutoIncrement)
- name: String
- email: String

Tabla tickets

- id: Int(AutoIncrement)
- user_id: Int
- status: String

Esta tabla tiene un foreign key con la tabla usuario en el campo user_id

## Lista de queries

A continuacion se enlistan las diferentes consultas y los parametros que reciben

```
    user(
        id: Int //Recibe un id obligatorio
    ): Retorna un User

    users(
        pagination: Int // Recibe el parametro pagination, numero de usuarios por pagina. Campo opcional
        page: Int // Recibe el parametro page, numero de pagina. Campo opcional
    ): Retorna un listado de Users

    ticket(
        id: Int //Recibe un id obligatorio
    ): Retorna un Ticket

    tickets(
        pagination: Int // Recibe el parametro pagination, numero de usuarios por pagina. Campo opcional
        page: Int // Recibe el parametro page, numero de pagina. Campo opcional
        user_id: Int // Recibe el parametro user_id, id usuario asignado al ticket. Campo opcional
        status: String // Recibe el parametro status, estado del ticket. Campo opcional
    ): Retorna un listado de Tickets
```

## Lista de mutaciones

A continuacion se enlistan las diferentes consultas y los parametros que reciben

```
  addUser(
      name: String!
      email: String!
  ): User
  Metodo para creacion de usuarios

  modifyUser(
      id: Int!
      name: String
      email: String
  ): User
  Metodo para modificacion de usuarios

  deleteUser(
      id: Int!
  ): User
  Metodo para eliminacion de usuarios

  createTicket(
      user_id: Int!
      status: String!
  ): Ticket
  Metodo para creacion de tickets

  modifyTicket(
      id: Int!
      user_id: Int
      status: String
  ): Ticket
  Metodo para modificacion de tickets

  deleteTicket(
      id: Int!
  ): Ticket
  Metodo para eliminacion de tickets
```