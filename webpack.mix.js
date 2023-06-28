const mix = require('laravel-mix');

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      //'vue$': 'vue/dist/vue.esm.js',
      '@': __dirname + '/resources/js/dashboard/',
      '@posts': __dirname + '/resources/js/web/vue/posts/',
      '@orders': __dirname + '/resources/js/web/vue/orders/',
      '@shared': __dirname + '/resources/js/web/vue/shared/',
    },
  },
});


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

// Web
mix.sass('resources/sass/web/app.scss', 'public/assets/css/app.css').options({processCssUrls: false}).version();
mix.js('resources/js/web/app.js', 'public/assets/js/app.js').vue();
mix.js('resources/js/web/vue/posts/app.js', 'public/assets/js/posts.js').version();
mix.js('resources/js/web/vue/orders/app.js', 'public/assets/js/orders.js').version();

// Dashboard
mix.js('resources/js/dashboard/app.js', 'public/assets/dashboard/js/bundle.administration.js').vue().version();
mix.sass('resources/sass/dashboard/app.scss', 'public/assets/dashboard/css/app.css').options({processCssUrls: false}).version();

