build:
	docker build --target php-81-dev -t php-81-dev .
	docker build --target php-82-dev -t php-82-dev .
	docker build --target php-83-dev -t php-83-dev .

ssh: ssh_83

ssh_81:
	docker run --rm -it -v $(PWD):/app -w /app php-81-dev bash

ssh_82:
	docker run --rm -it -v $(PWD):/app -w /app php-82-dev bash

ssh_83:
	docker run --rm -it -v $(PWD):/app -w /app php-83-dev bash

composer_install: composer_install_83

composer_install_81:
	docker run --rm -v $(PWD):/app -w /app php-81-dev composer install

composer_install_82:
	docker run --rm -v $(PWD):/app -w /app php-82-dev composer install

composer_install_83:
	docker run --rm -v $(PWD):/app -w /app php-83-dev composer install

phpunit: phpunit_83

phpunit_81:
	docker run --rm -v $(PWD):/app -w /app php-81-dev vendor/bin/phpunit

phpunit_82:
	docker run --rm -v $(PWD):/app -w /app php-82-dev vendor/bin/phpunit

phpunit_83:
	docker run --rm -v $(PWD):/app -w /app php-83-dev vendor/bin/phpunit

phpstan: phpunit_83

phpstan_81:
	docker run --rm -v $(PWD):/app -w /app php-81-dev vendor/bin/phpstan analyze

phpstan_82:
	docker run --rm -v $(PWD):/app -w /app php-82-dev vendor/bin/phpstan analyze

phpstan_83:
	docker run --rm -v $(PWD):/app -w /app php-83-dev vendor/bin/phpstan analyze

phpcsfixer: phpcsfixer_83

phpcsfixer_81:
	docker run --rm -v $(PWD):/app -w /app php-81-dev vendor/bin/php-cs-fixer fix --dry-run --diff --verbose

phpcsfixer_82:
	docker run --rm -v $(PWD):/app -w /app php-82-dev vendor/bin/php-cs-fixer fix --dry-run --diff --verbose

phpcsfixer_83:
	docker run --rm -v $(PWD):/app -w /app php-83-dev vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
