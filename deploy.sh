#!/usr/bin/env bash

set -v
static_server="stg-racingjunk-web1.internetbrands.com"
echo "Push started:   " `date`
npm install
echo "Removing outdated laravel css/js assets:"
rm -rv media/laravel/*
php process_assets_assetic.php
(cd www.racingjunk.com/; composer install)
(cd www.racingjunk.com/; npm install)
(cd www.racingjunk.com/; /bin/gulp --production --all)
rsync -v -az --no-o --no-g --no-p --delete \
    --rsync-path="rsync" \
    -e "ssh -oStrictHostKeyChecking=no -oUserKnownHostsFile=/dev/null" \
    --exclude "deploy.sh" \
    --exclude ".idea/" \
    --exclude ".vagrant/" \
    --exclude ".env" \
    --exclude "puphpet/" \
    --exclude "vendor/" \
    ./ \
    jenkins@$static_server:/var/www/deploy-int
ssh -oStrictHostKeyChecking=no -oUserKnownHostsFile=/dev/null \
    jenkins@$static_server \
    '/var/www/push-deploy-int.sh'
ssh -oStrictHostKeyChecking=no -oUserKnownHostsFile=/dev/null \
    jenkins@$static_server \
    '{ echo "flush_all"; sleep 2; } | /bin/telnet localhost 11211'
ssh -oStrictHostKeyChecking=no -oUserKnownHostsFile=/dev/null \
    jenkins@$static_server \
    '(cd /var/www/sites/integration/www.racingjunk.com/; php artisan route:cache)'
echo "Push completed: " `date`
date