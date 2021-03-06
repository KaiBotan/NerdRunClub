let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/leaderboardsfilter.js', 'public/js')
   .js('resources/assets/js/password.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/admin.scss', 'public/css')
   .sass('resources/assets/sass/user.scss', 'public/css')
   .sass('resources/assets/sass/progressbar.scss', 'public/css')
   .sass('resources/assets/sass/toggle.scss', 'public/css')
   .js('resources/assets/js/mail.js', 'public/js')
   .js('resources/assets/js/motivatecall.js', 'public/js');
