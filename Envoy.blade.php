@servers(['production' => 'az1-ss13.a2hosting.com'])

{{-- deploy task --}}
@task('deploy', ['on' => 'production'])
	cd /home/projec64/deploy/
	composer install --no-dev
	npm install
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