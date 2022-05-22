
CLI = docker-compose -f docker/compose/docker-compose-cli.yml
PHPUNIT = /var/www/html/vendor/bin/phpunit

.PHONY: build_dev
build_dev:
	docker build -f docker/php/Dockerfile . \
	-t blog.returnnull.de/php:dev
	docker build -f docker/nginx/Dockerfile . \
	-t blog.returnnull.de/nginx:dev
	docker build -f docker/database/Dockerfile . \
	-t blog.returnnull.de/database:dev
	docker build -f docker/php_cli/Dockerfile . \
	-t blog.returnnull.de/php_cli:dev

.PHONY: run
run:
	docker-compose -f docker/compose/docker-compose-dev.yml up -d

.PHONY: stop
stop:
	docker-compose -f docker/compose/docker-compose-dev.yml down --remove-orphans

.PHONY: install
install:
	$(CLI) run --rm --no-deps php_cli php -d memory_limit=-1 /usr/local/bin/composer install

.PHONY: update
update:
	$(CLI) run --rm --no-deps php_cli php -d memory_limit=-1 /usr/local/bin/composer update

.PHONY: logs
logs:
	docker-compose -f docker/compose/docker-compose-dev.yml logs

.PHONY: tests
tests:
	$(CLI) run php_cli php -dxdebug.coverage_enable=1 -dxdebug.mode=coverage $(PHPUNIT) \
                             --coverage-clover tests/reports/coverage/phpunit.coverage.xml \
                             --configuration tests/phpunit.xml
	sed -i "s|/var/www/html|$$(pwd)/code|g" code/tests/reports/coverage/phpunit.coverage.xml #replace docker folder path with out
	git update-index --assume-unchanged code/tests/reports/coverage/phpunit.coverage.xml #ignore changes in the coverage file, but keep in version control