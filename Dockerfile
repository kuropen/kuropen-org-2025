# SPDX-FileCopyrightText: 2024 Kuropen
#
# SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

FROM public.ecr.aws/docker/library/node:22.15.0-alpine3.20 AS vite-builder
WORKDIR /app
COPY . .
RUN npm install
RUN npm run build

FROM public.ecr.aws/docker/library/caddy:2.10.0-builder-alpine AS caddy-builder

RUN xcaddy build --with github.com/baldinof/caddy-supervisor

FROM public.ecr.aws/docker/library/php:8.4.7-fpm-alpine3.20

RUN apk --no-cache add postgresql16-dev libxml2-dev libzip-dev
RUN docker-php-ext-install pgsql pdo_pgsql xml zip
RUN docker-php-ext-enable opcache

COPY --from=public.ecr.aws/docker/library/composer:2.8.6 /usr/bin/composer /usr/bin/composer

COPY docker-resource/Caddyfile /etc/caddy/Caddyfile
COPY --from=caddy-builder /usr/bin/caddy /usr/bin/caddy

COPY --from=vite-builder /app /var/www/html
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod a+w /var/www/html/storage
RUN chmod a+w /var/www/html/bootstrap/cache
RUN composer install --working-dir=/var/www/html

EXPOSE 8000
CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile"]
