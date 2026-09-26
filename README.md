# AG-Lab SUST — Events & Activities Module

**Project:** aglab-sust.com — Laboratory Management System
**Member 2 Task:** Events & Activities (Database design) — Full CRUD
**Stack:** Laravel 11, Blade, Bootstrap 5, MySQL

## What this does
Manages lab events, seminars, workshops, conferences, and training sessions with full
Create / Read / Update / Delete functionality, image upload, search, and filtering
— no authentication required (public CRUD as scoped for this task).

## Setup — see the full chat guide for Laragon steps.
Quick version:
```
composer install
copy .env.example .env
php artisan key:generate
# set DB name in .env, then create that DB in HeidiSQL/phpMyAdmin
php artisan migrate --seed
php artisan storage:link
php artisan serve
```
