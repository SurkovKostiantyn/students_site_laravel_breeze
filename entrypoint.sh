#!/bin/bash
dockerize -wait tcp://db:3306 -timeout 30s
php artisan migrate
php artisan db:seed --class=UserTableSeeder
exec "$@"
