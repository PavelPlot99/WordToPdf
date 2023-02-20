# Info

- php - 8.1
- laravel - 10

# Start 

> docker compose up -d

> docker exec -it php_word composer install && php artisan key:generate && npm install && npm run dev 

## resources/js/app.js

>axios.defaults.baseURL = '{{host}}';

host - ваш хост 

