.PHONY: up down build restart logs ps composer-install composer-update artisan-migrate artisan-migrate-fresh artisan-cache-clear artisan-config-clear artisan-route-clear artisan-view-clear artisan-optimize artisan-seed artisan-generate-docs test test-coverage phpcs phpcbf test-setup

# Docker commands
up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

restart:
	docker-compose restart

logs:
	docker-compose logs -f

ps:
	docker-compose ps

# Shell commands
shell:
	docker-compose exec --user www-data app /bin/bash

# Composer commands
composer-install:
	docker-compose exec app composer install

composer-update:
	docker-compose exec app composer update

# Artisan commands
artisan-migrate:
	docker-compose exec app php artisan migrate

artisan-migrate-fresh:
	docker-compose exec app php artisan migrate:fresh

artisan-cache-clear:
	docker-compose exec app php artisan cache:clear

artisan-config-clear:
	docker-compose exec app php artisan config:clear

artisan-route-clear:
	docker-compose exec app php artisan route:clear

artisan-view-clear:
	docker-compose exec app php artisan view:clear

artisan-route-list:
	docker-compose exec app php artisan route:list

artisan-optimize:
	docker-compose exec app php artisan optimize

artisan-seed:
	docker-compose exec app php artisan db:seed

# Documentation commands
artisan-generate-docs:
	docker-compose exec app php artisan api:docs

# Test setup
test-setup:
	docker-compose exec app php artisan migrate:fresh --env=testing
	# docker-compose exec app php artisan db:seed --env=testing

# Test commands
test:
	docker-compose exec app ./vendor/bin/phpcs --standard=phpcs.xml app/ || true
	docker-compose exec app php artisan test --env=testing

test-coverage:
	docker-compose exec app ./vendor/bin/phpcs --standard=phpcs.xml app/ || true
	docker-compose exec app php artisan test --coverage-html coverage --env=testing

# Code Style commands
phpcs:
	docker-compose exec app ./vendor/bin/phpcs --standard=phpcs.xml

phpcbf:
	docker-compose exec app ./vendor/bin/phpcbf --standard=phpcs.xml 
	
# Combined commands
clear-all: artisan-cache-clear artisan-config-clear artisan-route-clear artisan-view-clear artisan-optimize

setup: composer-install artisan-migrate-fresh artisan-seed 