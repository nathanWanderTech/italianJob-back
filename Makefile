build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

restart: down up

env-init:
	ln -s "${PWD}/app/.env" "${PWD}/.env"

container-list:
	docker-compose ps

app-exec:
	docker-compose exec app

composer-install:
	docker-compose exec app \
	composer install

composer-require:
	docker-compose exec app \
	composer require $(PACKAGE)

artisan:
	docker-compose exec app \
	php artisan $(COMMAND)