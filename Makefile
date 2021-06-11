PHPCLI=docker-compose exec php
#####################
# DEV SERVER
#####################

start: stop up

up:
	docker-compose up -d --remove-orphans

stop:
	docker-compose stop
	docker-compose rm -f -v

build: start build_local_clear build_docker_php
	docker-compose down --remove-orphans -v

build_local_clear:
	rm -rf var/cache/*
	echo $(CI_BUILD_REF) > .revision

build_docker_php:
	$(PHPCLI) composer install
	$(PHPCLI) php bin/console cache:clear
	$(PHPCLI) php bin/console cache:warmup

cli_php:
	$(PHPCLI) ash

#####################
# TESTS
#####################

phpunit:
	$(PHPCLI) ./vendor/phpunit/phpunit/phpunit

#####################
# DEV SERVER
#####################

phpcs:
	docker run --init --rm -v "$(PWD)":/app -w /app jakzal/phpqa phpcs --standard=PSR12 ./src

phpcbf:
	docker run --init --rm -v "$(PWD)":/app -w /app jakzal/phpqa phpcbf --standard=PSR12 ./src

phpstan-analyse:
	docker pull phpstan/phpstan
	docker run --rm -v "$(PWD)":/app phpstan/phpstan analyse ./src --level=5

#####################
# TASK
#####################

integration_sup_1:
	$(PHPCLI) php bin/console divante:supplier-sync XYZLogistics

integration_sup_2:
	$(PHPCLI) php bin/console divante:supplier-sync SuperDistribution

integration_sup_3:
	$(PHPCLI) php bin/console divante:supplier-sync AwesomeSixEleven