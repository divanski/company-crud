<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This project was created for testing purposes.

## Steps to start it locally:

1. Run composer install and composer update. 
```composer
composer install
composer update
```
2. Generate an application key:
```composer
php artisan key:generate
```
3. Add credentials for your MySQL database to .env:
```composer
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=< database name >
DB_USERNAME=<database user>
DB_PASSWORD=<database password>
```
4. Run migration with seeding: 
```composer
php artisan migrate --seed
```
5. If you want to start from the beginning, you can run:
```composer
php artisan migrate:fresh --seed
```

# Enjoy!

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
