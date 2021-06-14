#!/bin/sh

echo "-> Copia o .env.example para .env"
cp .env.example .env

echo "-> Inicializa os containers do Docker"
docker-compose up -d

echo "-> Instala os pacotes do composer"
docker exec tracking-api-php-fpm composer install

echo "-> Gera a chave a aplicação"
docker exec tracking-api-php-fpm php artisan key:generate

echo "-> Executa as migrations e as seeders no banco de dados"
docker exec tracking-api-php-fpm php artisan migrate:fresh --seed

echo "-> Instala o Laravel Passport (Gera o token)"
docker exec tracking-api-php-fpm php artisan passport:install > clients.txt
echo "-> Utilizar o segundo token gerado na hora de testar a aplicação"
