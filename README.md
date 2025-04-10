# mogitate

## 環境構築

### 1. リポジトリをクローン
```sh
git clone git@github.com:lillian-angelina/mogitate-test.git
cd ~/coachtech/laravel/mogitate-test

## コンテナの起動
docker-compose up -d --build

## Laravel のセットアップ
docker-compose exec php bash
composer install
php artisan key:generate
php artisan migrate --seed

## キャッシュクリア（エラー回避のため）
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

## 権限設定（ストレージ関連）
chmod -R 777 storage bootstrap/cache

docker-compose.yml
services:
  nginx:
    image: nginx:latest
    ports:
      - "8082:80"
    volumes:
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
      - ./src:/var/www/
    depends_on:
      - php

  php:
    build: ./docker/php
    volumes:
      - ./src:/var/www/

  mysql:
    image: mysql:8
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel_db
      MYSQL_USER: laravel_user
      MYSQL_PASSWORD: laravel_pass
    ports:
      - "3306:3306"
    volumes:
      - ./docker/mysql_data:/var/lib/mysql
      - ./docker/mysql/my.cnf:/etc/mysql/conf.d/my.cnf

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - "8081:80"
    environment:
      PMA_ARBITRARY: 1
      PMA_HOST: mysql
      PMA_USER: laravel_user
      PMA_PASSWORD: laravel_pass
    depends_on:
      - mysql

## .env ファイルの作成・編集
cp .env.example .env

## .env を開き、以下を設定
.env (Database)
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db_new
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

## 使用技術(実行環境)
php: "8.2"
laravel/framework: "12.0"

## ER図
![ER図](https://github.com/lillian-angelina/mogitate-test/blob/main/er-diagram.png.png)


## URL
- 開発環境: http://localhost:8082
- phpMyAdmin: https://localhost:8081
