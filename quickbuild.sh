#!/bin/bash

rm -rf app/cache/*
php app/console doctrine:database:drop --force
php app/console doctrine:database:create

php app/console doctrine:phpcr:init:dbal

# idempotent task, this one:
php app/console doctrine:phpcr:repository:init

php app/console doctrine:phpcr:fixtures:load -n