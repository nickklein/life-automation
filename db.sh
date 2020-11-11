php artisan migrate:reset && php artisan migrate && php artisan db:seed
chown -R tyrion:www-data /var/www/html/
chmod -R 777 storage
php artisan passport:install
