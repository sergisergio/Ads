# Fichier Makefile

.PHONY: install quality tests

install:
	# Composer
	@composer update
	# Db
	@bin/console doctrine:database:drop --force --if-exists
	@bin/console doctrine:database:create --if-not-exists
	@bin/console doctrine:schema:update --force
	# Db - Fixtures
	@bin/console doctrine:fixtures:load --no-interaction

quality:
	@vendor/bin/phpmetrics --report-html=var/phpmetrics ./src

tests:
	# PHPUnit
	@bin/phpunit --coverage-html=var/tests