#!/bin/bash

if [ ! -f ".env" ]; then
  cp .env.example .env
fi

docker-compose run --rm --user $UID php vendor/bin/phpunit --testsuite TestingWorkshop

docker-compose down