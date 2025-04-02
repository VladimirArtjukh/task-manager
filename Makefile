# Makefile
.PHONY: install up down test migrate seed

install:
	cp .env.example .env || true
	./vendor/bin/sail up -d
	./vendor/bin/sail composer install
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail artisan key:generate
	./vendor/bin/sail npm install
	./vendor/bin/sail npm run build

ifeq ($(OS),Windows_NT)
	start http://localhost/
else
ifeq ($(shell uname),Darwin)
	open http://localhost/
else
	xdg-open http://localhost/
endif
endif

up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

test:
	./vendor/bin/sail artisan test

migrate:
	./vendor/bin/sail artisan migrate

seed:
	./vendor/bin/sail artisan db:seed
