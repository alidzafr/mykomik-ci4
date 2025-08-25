FROM php:7.4-apache

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Set DocumentRoot ke public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Izinkan .htaccess override di folder public
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/ci4.conf \
    && a2enconf ci4

WORKDIR /var/www/html

# Jangan COPY kalau pakai volume di docker-compose
# COPY . /var/www/html

EXPOSE 80
