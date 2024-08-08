FROM php:8.2-apache

# Instalar dependências necessárias
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

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos do projeto
COPY . /var/www/html

# Copiar arquivo de configuração do Apache
#COPY 000-default.conf /etc/apache2/sites-available/000-default.conf #Comentado para deixar usar o default da imagem

# Configurar o Apache
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Configurar o diretório de trabalho
WORKDIR /var/www/html

# Executar o Composer para instalar dependências
#RUN composer install --no-scripts --no-autoloader

RUN composer install

# Expor a porta 80
EXPOSE 80

# Define o comando de entrada
CMD ["apache2-foreground"]
