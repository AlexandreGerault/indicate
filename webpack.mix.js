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

mix.copyDirectory('resources/js', 'public/js')
    .sass('resources/sass/guest.scss', 'public/css')
    .sass('resources/sass/authenticated.scss', 'public/css')
    .sass('resources/sass/dashboard.scss', 'public/css')
    .sass('resources/sass/landpage.scss', 'public/css');
