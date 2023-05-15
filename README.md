# Run backend

## Installation and configuration

Install **php** and **composer** before running this project

Create .env file based on .env.example and config your database connection

`cd back-end`  
`composer install` to install dependencies  
`composer update` to update dependencies  
`composer key:generate` to generate key

## Migration and seeding (optional)

`php artisan migrate` to migrate database  
(if you want to reset database, run `php artisan migrate:fresh`)

`php artisan db:seed` to seed database
`php artisan migrate:fresh --seed` to reset and seed database (migration and seeding at the same time)

## Run project

`php artisan serve` to run the project  
`php artisan serve --port=[PORT]` to run the project on port [PORT]
