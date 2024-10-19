FROM node:20 AS viteBuilder
WORKDIR /app
COPY . .
RUN npm install
RUN npm run build

FROM php:8.1-apache
COPY docker-resource/gen_remote_ip.sh /usr/local/bin/gen_remote_ip.sh
RUN chmod +x /usr/local/bin/gen_remote_ip.sh

RUN DEFAULT_SITE_FILE=/etc/apache2/sites-enabled/000-default.conf && TMP=$(mktemp) && sed 's!/var/www/html!/var/www/html/public!' $DEFAULT_SITE_FILE > $TMP && mv $TMP $DEFAULT_SITE_FILE
RUN curl -L https://raw.githubusercontent.com/php/php-src/master/php.ini-production | sed 's/expose_php = On/expose_php = Off/' > /usr/local/etc/php/php.ini
RUN a2enmod rewrite
RUN a2enmod remoteip
RUN /usr/local/bin/gen_remote_ip.sh | tee -a /etc/apache2/conf-available/remoteip.conf
RUN a2enconf remoteip
RUN apt update && apt install -y libpq-dev libxml2-dev libzip-dev
RUN docker-php-ext-install pgsql xml zip
RUN docker-php-ext-enable opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY --from=viteBuilder /app /var/www/html
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod a+w /var/www/html/storage
RUN chmod a+w /var/www/html/bootstrap/cache
RUN composer install --working-dir=/var/www/html

CMD ["apache2-foreground"]
