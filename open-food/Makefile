COMPOSE_FILE=docker-compose.yml

up:
	docker-compose -f $(COMPOSE_FILE) up -d

down:
	docker-compose -f $(COMPOSE_FILE) down

build:
	docker-compose up -d --build

logs:
	docker-compose -f $(COMPOSE_FILE) logs -f

in:
	docker exec -it open_food_app /bin/bash

permissions:
	docker exec -it open_food_app bash -c "chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache"
