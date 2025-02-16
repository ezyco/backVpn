#!/bin/bash

echo "Running Laravel setup commands..............";

#docker exec ezy-laravel-1 php artisan backup:run --disable-notifications;

chmod -R 777 storage;
chmod -R 777 bootstrap;
chmod -R 777 database;
#chmod +x ./docker/cronjob/timestamp.sh;
#mkdir ./docker/cronjob/logs;
#crontab -u root ./docker/cronjob/cronjob.txt

# Install composer dependencies
composer install;

#.env
rm .env;
cp ./docker/.env ./;
chmod -R 777 .env;

php artisan key:generate --force;
php artisan cache:clear;
php artisan optimize:clear;
php artisan storage:link;
#php artisan migrate --force;
docker exec ezy_ton_laravel php artisan migrate --force;

echo "Laravel setup completed.";

echo "Docker setup.";
docker compose up --build --force-recreate -d;
docker exec ezy_ton_laravel php artisan storage:link;
systemctl restart docker.service;
echo "Docker done.";
