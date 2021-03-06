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

    mix.sass('app.scss');
    mix.styles([
		'resources/assets/css/default.css',
		'resources/assets/css/default.date.css',
		'resources/assets/css/default.time.css'
	], 'public/css/picker.css');

    var appjs = ([
    	'picker.js',
    	'picker.date.js',
    	'picker.time.js',
        'map.js'
    ]);

    mix.scripts(appjs, 'public/js/all.js');

});
