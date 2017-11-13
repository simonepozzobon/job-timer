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

mix
  .js('resources/assets/js/admin-todo.js', 'public/js')
  .js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .extract(['jquery', 'tether', 'bootstrap'])
  .autoload({
      jquery: ['$', 'jQuery', 'jquery'],
      tether: ['Tether'],
      'popper.js/dist/umd/popper.js': ['Popper'],
  })
  .browserSync({
    proxy: 'http://www.timer.dev:8888/',
    browser: 'google chrome'
  });
