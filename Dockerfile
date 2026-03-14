FROM php:8.2-cli
RUN docker-php-ext-install mysqli
WORKDIR /var/www/html
COPY . /var/www/html
EXPOSE 8765
CMD ["php", "-S", "0.0.0.0:8765"]
