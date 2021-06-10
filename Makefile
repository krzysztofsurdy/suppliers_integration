#####################
# DEV SERVER
#####################

start: stop up

up:
	docker-compose up -d --remove-orphans

stop:
	docker-compose stop
	docker-compose rm -f -v

cli_php:
	docker-compose exec php sh

cli_nginx:
	docker-compose exec nginx sh

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