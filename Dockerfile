# Etapa de construção
FROM arm64v8/php:8.2-cli as build

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Configura o diretório de trabalho
WORKDIR /app

# Copia os arquivos do projeto
COPY . .

# Instala dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --no-scripts --no-progress --prefer-dist

# Etapa de produção
FROM arm64v8/php:8.2-apache

# Instala dependências necessárias
RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install zip

# Configura o diretório de trabalho
WORKDIR /var/www/html

# Copia arquivos do build
COPY --from=build /app /var/www/html

# Copia o arquivo de configuração do Apache
#COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Configura permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expõe a porta 80
EXPOSE 80

# Define o comando de entrada
CMD ["apache2-foreground"]
