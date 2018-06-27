## Prueba tecnica, parte Backend.

Al clonar repositorio, se debe habilitar para la maquina destino de la siguiente forma:

### Requisitos:

Composer, Mysql, PHP 7.1+.

Comandos:

`composer install` para instalar las dependencias del proyecto.

`cp .env.example .env` para crear archivo con variables de entorno.

`php artisan key:generate` para crear la key en base64 que Laravel usa para la creacion de hashes.

En el archivo .env debemos editar las siguientes lineas, segun la config de tu maquina:

```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=CTS_TURISMO_TECH_TEST
DB_USERNAME=root
DB_PASSWORD=
```

En tu administrador de mysql favorito, debes crear la BD `CTS_TURISMO_TECH_TEST`

Luego de esto, usamos:

`php artisan migrate` para crear las tablas a usar.

`php artisan db:seed` para insertar el usuario admin, el cual tiene las siguientes credenciales:

```
email: admin@test.com
pass: nimda
```

Para que funcione el login por API passport, usamos los siguientes comandos:

`php artisan passport:install` y `php artisan passport:keys`

### Todo junto:

```
composer install &&
cp .env.example .env &&
php artisan key:generate &&
php artisan migrate &&
php artisan db:seed &&
php artisan passport:install &&
php artisan passport:keys
```

Lo mas importante... para iniciar el server:

`php artisan serve`

Para ver los endpoint disponibles, usar el siguiente comando:

`php artisan route:list`
