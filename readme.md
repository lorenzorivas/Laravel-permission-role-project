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

Lo primero que debes hacer es definir tu usuario Admin en el seeder UserTableSeeder.php

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
Definir propiedades de la BBDD en el archivo .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=root
```
Y correr las migraciones y seeders
```
php artisan migrate:refresh --seed
```
## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
