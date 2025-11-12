# Käytetään virallista PHP + Apache imagea
FROM php:8.2-apache

# Kopioidaan kaikki projektin tiedostot konttiin
COPY . /var/www/html/

# Asennetaan yleisimmät PHP-laajennukset (esim. MySQL-yhteyksiä varten)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Sallitaan .htaccess-tiedostojen käyttö
RUN a2enmod rewrite

# Varmistetaan oikeudet
RUN chown -R www-data:www-data /var/www/html

# Avaa portti 10000 (Renderin web-palveluille)
EXPOSE 10000

# Apache käynnistyy automaattisesti kontissa
CMD ["apache2-foreground"]