run:
	docker-compose -f "docker-compose.yml" up -d --build

down:dump
	docker-compose -f "docker-compose.yml" down

up:
	docker-compose -f "docker-compose.yml" up -d --build

restart:down
	docker-compose -f "docker-compose.yml" up -d --build

set:
	docker-compose exec db mysql_config_editor set -u root -p

dumpset:
	docker-compose exec db mysql_config_editor set --login-path=mysqldump -u root -p

dump:dumpset
	docker-compose exec db mysqldump wordpress > ./init/wordpress.sql

restore:
	docker-compose exec db mysql wordpress < ./init/wordpress.sql

bash:
	docker-compose exec wordpress /bin/bash

build:
	npm run prod

watch:
	npm run watch