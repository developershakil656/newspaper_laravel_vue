const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


//frontend ----------------------


mix.styles([
    'resources/sass/frontend/css/bootstrap.min.css',
    'resources/sass/frontend/css/bootstrap-theme.min.css',
    'resources/sass/frontend/css/bootstrap-theme.min.css.map',
    'resources/sass/frontend/css/slick.css',
    'resources/sass/frontend/css/style.css',
], 'public/css/all.css');

mix.scripts([
    'resources/js/frontend/js/jquery.min.js',
    'resources/js/frontend/js/slick.min.js',
    'resources/js/frontend/js/bootstrap.min.js',
], 'public/js/all.js');

mix.js('resources/js/app2.js', 'public/js/app2.js')
    .sass('resources/sass/frontend/app.scss', 'public/css/app2.css');
