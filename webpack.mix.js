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

mix.js(['resources/js/app.js',
        'resources/js/jquery.js'], 'public/js').vue()
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/admin.scss', 'public/css')
   .sass('resources/sass/level_1.scss', 'public/css')
   .sass('resources/sass/level_2.scss', 'public/css')
   .sass('resources/sass/level_3.scss', 'public/css');
