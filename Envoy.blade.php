@servers(['production' => ' projec64@az1-ss13.a2hosting.com -p 7822'])

{{-- deploy task --}}
@task('deploy', ['on' => 'production'])
    echo "Begining to run Envoy script"
	cd /home/projec64/deploy/

    echo "Composer command starting:"
	/opt/cpanel/composer/bin/composer install --no-dev

    echo "npm command starting"
	npm install

    echo "Running gulp"
    gulp --production --all

	cd /home/projec64/public_html/
	if [ -f ./artisan]
        then
            echo 'Taking Site Down'
            php artisan down
    fi
    echo 'rsync command starting'
    rsync -v -az --no-o --no-g --no-p --delete \
        --exclude ".env" \
        --exclude "/storage" \
        /home/projec64/deploy/ \
        /home/projec64/public_html
    echo 'Running Artisan commands'
    php artisan migrate --force
    php artisan cache:clear
    php artisan config:clear
    php artisan up

@endtask