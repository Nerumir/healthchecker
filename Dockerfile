FROM php:8.2-apache

# PHP
RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y cron curl
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions openssl
COPY src /var/www/html
RUN mkdir app
COPY app /app
RUN chown -R www-data:www-data /app
RUN chmod -R 0755 /app

COPY crontab.txt /etc/cron.d/my-cron
RUN chmod 0644 /etc/cron.d/my-cron
RUN crontab /etc/cron.d/my-cron

RUN echo "<Directory /app>" >> /etc/apache2/sites-available/000-default.conf 
RUN echo "    Options Indexes FollowSymLinks" >> /etc/apache2/sites-available/000-default.conf 
RUN echo "    AllowOverride None" >> /etc/apache2/sites-available/000-default.conf 
RUN echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf 
RUN echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf 

COPY start.sh /start.sh
RUN chmod +x /start.sh

# Apache
# RUN a2enmod rewrite
# RUN service apache2 restart

EXPOSE 80

CMD ["/start.sh"]
