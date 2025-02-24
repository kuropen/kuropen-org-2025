FROM public.ecr.aws/docker/library/php:8.3-cli-alpine3.20

RUN apk --no-cache add postgresql16-dev libxml2-dev libzip-dev
RUN docker-php-ext-install pgsql pdo_pgsql xml zip
RUN docker-php-ext-enable opcache

COPY --from=public.ecr.aws/docker/library/composer:2 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
WORKDIR /var/www/html
RUN composer install --working-dir=/var/www/html
