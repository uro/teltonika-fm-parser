build:
	docker build --target php-81-dev -t php-81-dev .

ssh:
	docker run --rm -it -v $(PWD):/app -w /app php-81-dev bash

composer_install:
	docker run --rm -v $(PWD):/app -w /app php-81-dev composer install

phpunit:
	docker run --rm -v $(PWD):/app -w /app php-81-dev vendor/bin/phpunit

phpstan:
	docker run --rm -v $(PWD):/app -w /app php-81-dev vendor/bin/phpstan analyze

phpcsfixer:
	docker run --rm -v $(PWD):/app -w /app php-81-dev vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
