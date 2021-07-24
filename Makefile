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

composer-install:
	docker-compose exec app \
	composer install

composer-require:
	docker-compose exec app \
	composer require $(PKG)

composer-remove:
	docker-compose exec app \
	composer remove $(PKG)

artisan:
	docker-compose exec app \
	php artisan $(CMD)

reseed:
	$(MAKE) artisan CMD=migrate:fresh
	$(MAKE) artisan CMD=db:seed