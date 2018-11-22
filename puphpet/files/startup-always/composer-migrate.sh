#!/bin/bash
(cd /var/www/sites/ && composer install)

# Run any migrations we might have
(cd /var/www/sites && php artisan migrate)