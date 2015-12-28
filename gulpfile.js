var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
        var lightboxPath = 'node_modules/lightbox2/dist';
        mix.copy(lightboxPath + '/js/lightbox.js', 'public/js') . copy(lightboxPath + '/css/lightbox.min.css', 'public/css');
	var bootstrapPath = 'node_modules/bootstrap-sass/assets';
	mix.sass('app.scss') .copy(bootstrapPath + '/fonts', 'public/fonts') .copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js');
});
