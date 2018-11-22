#!/bin/bash
(cd /var/www/sites/ && composer install)

(cd /var/www/sites && php artisan migrate && php artisan db:seed)