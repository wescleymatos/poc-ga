# POC GA


- Após subir o container pela primeira vez rodar o comando dentro do container
```sh
composer install
```

- Criar o arquivo .env para configuração do banco de dados
```md
APP_KEY=

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=ga
DB_USERNAME=ga
DB_PASSWORD=ga
```

- Depois rodar o comando
```sh
php artisan key:generate
```

- Melhor visualização de logs de desenvolvimento com [log viewer](https://log-viewer.opcodes.io/)

- [Ferramentas de profile](https://laraveldaily.com/post/laravel-eloquent-tools-debug-slow-sql-queries)
