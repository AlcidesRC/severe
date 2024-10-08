.DEFAULT_GOAL := help

###
# CONSTANTS
###

ifneq (,$(findstring xterm,$(TERM)))
	BLACK   := $(shell tput -Txterm setaf 0)
	RED     := $(shell tput -Txterm setaf 1)
	GREEN   := $(shell tput -Txterm setaf 2)
	YELLOW  := $(shell tput -Txterm setaf 3)
	BLUE    := $(shell tput -Txterm setaf 4)
	MAGENTA := $(shell tput -Txterm setaf 5)
	CYAN    := $(shell tput -Txterm setaf 6)
	WHITE   := $(shell tput -Txterm setaf 7)
	RESET   := $(shell tput -Txterm sgr0)
else
	BLACK   := ""
	RED     := ""
	GREEN   := ""
	YELLOW  := ""
	BLUE    := ""
	MAGENTA := ""
	CYAN    := ""
	WHITE   := ""
	RESET   := ""
endif

#---

RANDOM_ORDER_SEED := $(shell head -200 /dev/urandom | cksum | cut -f1 -d " ")

#---

###
# HELP
###

.PHONY: help
help:
	@clear
	@echo "╔══════════════════════════════════════════════════════════════════════════════╗"
	@echo "║                                                                              ║"
	@echo "║                           ${YELLOW}.:${RESET} AVAILABLE COMMANDS ${YELLOW}:.${RESET}                           ║"
	@echo "║                                                                              ║"
	@echo "╚══════════════════════════════════════════════════════════════════════════════╝"
	@echo ""
	@grep -E '^[a-zA-Z_0-9%-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "· ${YELLOW}%-30s${RESET} %s\n", $$1, $$2}'
	@echo ""

###
# FUNCTIONS
###

require-%:
	@if [ -z "$($(*))" ] ; then \
		echo "" ; \
		echo " ${RED}⨉${RESET} Parameter [ ${YELLOW}${*}${RESET} ] is required!" ; \
		echo "" ; \
		echo " ${YELLOW}ℹ${RESET} Usage [ ${YELLOW}make COMMAND${RESET} ${RED}${*}=${RESET}${YELLOW}xxxxxx${RESET} ]" ; \
		echo "" ; \
		exit 1 ; \
	fi;

define taskDone
	@echo ""
	@echo " ${GREEN}✓${RESET}  ${GREEN}Task done!${RESET}"
	@echo ""
endef

###
# COMPOSER
###

.PHONY: composer-dump
composer-dump: ## [COMPOSER] Executes <composer dump-auto> inside the container
	$(DOCKER_RUN_AS_USER) composer dump-auto --ansi --no-plugins --profile --classmap-authoritative --apcu --strict-psr
	$(call taskDone)

.PHONY: composer-install
composer-install: ## [COMPOSER] Executes <composer install> inside the container
	$(DOCKER_RUN_AS_USER) composer install --ansi --no-plugins --classmap-authoritative --audit --apcu-autoloader
	$(call taskDone)

.PHONY: composer-remove
composer-remove: require-package ## [COMPOSER] Executes <composer remove> inside the container
	$(DOCKER_RUN_AS_USER) composer remove --ansi --no-plugins --classmap-authoritative --apcu-autoloader --with-all-dependencies --unused
	$(call taskDone)

.PHONY: composer-require-dev
composer-require-dev: ## [COMPOSER] Executes <composer require --dev> inside the container
	$(DOCKER_RUN_AS_USER) composer require --ansi --no-plugins --classmap-authoritative --apcu-autoloader --with-all-dependencies --prefer-stable --sort-packages --dev
	$(call taskDone)

.PHONY: composer-require
composer-require: ## [COMPOSER] Executes <composer require> inside the container
	$(DOCKER_RUN_AS_USER) composer require --ansi --no-plugins --classmap-authoritative --apcu-autoloader --with-all-dependencies --prefer-stable --sort-packages
	$(call taskDone)

.PHONY: composer-update
composer-update: ## [COMPOSER] Executes <composer update> inside the container
	$(DOCKER_RUN_AS_USER) composer update --ansi --no-plugins --classmap-authoritative --apcu-autoloader --with-all-dependencies
	$(call taskDone)

###
# QA
###

.PHONY: check-syntax
check-syntax: ## [QA] Executes <check-syntax [filter=app]> inside the container
	@$(eval filter ?= 'src')
	@vendor/bin/parallel-lint --colors -e php -j 10 $(filter)
	$(call taskDone)

.PHONY: check-style
check-style: ## [QA] Executes <check-style [filter=app]> inside the container
	@$(eval filter ?= 'src')
	@vendor/bin/phpcs -p --colors --standard=phpcs.xml $(filter)
	$(call taskDone)

.PHONY: fix-style
fix-style: ## [QA] Executes <fix-style [filter=app]> inside the container
	@$(eval filter ?= 'src')
	@vendor/bin/phpcbf -p --colors --standard=phpcs.xml $(filter)
	$(call taskDone)

.PHONY: phpstan
phpstan: ## [QA] Executes <phpstan [filter=app]> inside the container
	@$(eval filter ?= 'src')
	@vendor/bin/phpstan analyse --ansi --memory-limit=1G --no-progress --configuration=phpstan.neon $(filter)
	$(call taskDone)

.PHONY: tests
tests: ## [QA] Executes <phpunit --testsuite=[testsuite=Unit] --filter=[filter=.]> inside the container
	@$(eval testsuite ?= 'Unit')
	@$(eval filter ?= '.')
	@vendor/bin/phpunit --testsuite=$(testsuite) --filter=$(filter) --configuration=phpunit.xml --coverage-text --testdox --colors --order-by=random --random-order-seed=$(RANDOM_ORDER_SEED)
	$(call taskDone)

.PHONY: coverage
coverage: ## [QA] Executes <phpunit --coverage-html=[folder=./coverage]> inside the container
	@$(eval folder ?= './coverage')
	@rm -Rf $(folder) || true
	@mkdir $(folder)
	@vendor/bin/phpunit --coverage-html=$(folder) --configuration=phpunit.xml --coverage-text --testdox --colors --order-by=random --random-order-seed=$(RANDOM_ORDER_SEED)
	$(call taskDone)
