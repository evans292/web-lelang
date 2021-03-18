<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Web Lelang Online
Aplikasi web berbasis laravel ini adalah ujikom paket 4 pilihan saya.

## Cara Install 
1. Clone project ini 
```
git clone https://github.com/evans292/web-lelang.git
```
2. Pindah ke folder project
```
cd web-lelang
```
4. Jalankan composer install
```
composer install
```
5. Jalankan npm / yarn install
```
npm install 
yarn install
```
4. Copy dan konfigurasi file .env (database, pusher, storage)
```
cp .env.example .env
```
5. Generate key baru
```
php artisan key:generate
```
6. Jalankan migrasi dan seeder
```
php artisan migrate --seeder
```
7. Buat symbionic link (pastikan di env FILESYSTEM_DRIVER=public)
```
php artisan storage:link
```
8. Compile css & js
```
npm run dev / yarn dev
```
9. Jalankan project
```
php artisan serve
```
