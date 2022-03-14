PARALLELISM := $(shell nproc)

.PHONY: all
all: install phpcbf phpcs phpstan phpunit infection

.PHONY: install
install: vendor/composer/installed.json

vendor/composer/installed.json: composer.json composer.lock
	@composer install $(INSTALL_FLAGS)
	@touch -c composer.json composer.lock vendor/composer/installed.json

.PHONY: phpunit
phpunit:
	@php -dzend.assertions=1 vendor/bin/phpunit $(PHPUNIT_FLAGS)

.PHONY: infection
infection:
	@XDEBUG_MODE=coverage php -d zend.assertions=1 vendor/bin/infection -s --threads=$(PARALLELISM) $(INFECTION_FLAGS)

.PHONY: phpcbf
phpcbf:
	@vendor/bin/phpcbf --parallel=$(PARALLELISM) || true

.PHONY: phpcs
phpcs:
	@vendor/bin/phpcs --parallel=$(PARALLELISM) $(PHPCS_FLAGS)

.PHONY: phpstan
phpstan:
	@vendor/bin/phpstan analyse
