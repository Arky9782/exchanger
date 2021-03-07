FROM composer:latest as builder
COPY /app /tmp/app
WORKDIR /tmp/app

RUN composer install

FROM php:latest

COPY /app /www/app
COPY --from=builder /tmp/app/vendor /www/app/vendor

RUN file="$(ls /www/app/vendor)" && echo $file

WORKDIR /www/app