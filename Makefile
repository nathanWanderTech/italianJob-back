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
	composer require $(pkg)

composer-remove:
	docker-compose exec app \
	composer remove $(pkg)

composer-update:
	docker-compose exec app \
	composer update

artisan:
	docker-compose exec app \
	php artisan $(cmd)

reseed:
	$(MAKE) artisan cmd=migrate:fresh
	$(MAKE) artisan cmd=db:seed
