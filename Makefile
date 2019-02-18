.PHONY: install build start run stop php

all: build start install yarn-build yarn cache-clear


install:
	make stop \
	&& make build \
	&& make start \
	&& docker-compose exec -T php-fpm-beer make composer-install \
	&& docker-compose exec -T php-fpm-beer make yarn \
	&& docker-compose exec -T php-fpm-beer make yarn-build \
	&& docker-compose exec -T php-fpm-beer make create-db \
	&& docker-compose exec -T php-fpm-beer make link-storage \
	&& docker-compose exec -T php-fpm-beer make generate-key

link-storage:
	php artisan storage:link

generate-key:
	php artisan key:generate

yarn:
	yarn install

composer-install:
	composer install

build:
	docker-compose build

force-build:
	docker-compose build --force-rm --no-cache --pull

start:
	docker-compose up -d

run:
	docker-compose up

stop:
	docker-compose stop

destroy:
	docker-compose down

create-db:
	php artisan migrate:fresh \
	&& php artisan db:seed \

