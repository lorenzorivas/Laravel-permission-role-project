<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Acerca del Proyecto

Construi este proyecto pensando en tener una aplicación en Laravel con un sistema de roles y permisos, pero además con un panel que facilite la administración de usuarios, roles y permisos. Para ello use la última versión de Laravel 5.8 y los siguientes componentes:

- [spatie/laravel-permission](https://github.com/spatie/laravel-permission).
- [Bootstrap 4.3.1](https://github.com/twbs/bootstrap).

Espero que este repositorio sea de ayuda para todos aquellos que quieran un sistema de administración de usuarios y roles en el increible framework Laravel.

## Cómo empezar?

Inportamos e instalamos todos los paquetes de proveedor necesarios con el script de carga automática


```
λ composer install
```
Copiamos el contenido del archivo .env.example en .env y definimos las propiedades de la BBDD en el archivo .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=root
```
Creamos la llave encriptada

```
λ php artisan key:generate
```
Luego debes hacer es definir tu usuario Admin en el seeder UserTableSeeder.php

```
    public function run()
    {
        App\User::create([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'     => bcrypt('qwe123'),
        ]);
    }
```
Y correr las migraciones y seeders
```
λ php artisan migrate:refresh --seed
```
