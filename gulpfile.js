var elixir = require('laravel-elixir');

var vendorDir = 'vendor/';
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

elixir(function (mix) {
   /**
	* All types starts reading from /resources/assets/
    */
   mix.sass('app.scss');

   mix.scripts([
       
       '../bower/jquery/dist/jquery.min.js',
       '../bower/bootstrap/dist/js/bootstrap.min.js',
       'app.js',
       'comment.js'
       ]);

   mix.styles([
       '../bower/bootstrap/dist/css/bootstrap.min.css',
       '../bower/bootstrap/dist/css/bootstrap.min.css.map',
       'styles.css'
       ]);
//            .copy(nodeDir + 'font-awesome/fonts', 'public/fonts')
//            .copy(nodeDir + 'bootstrap/fonts', 'public/fonts');
//

//    mix.styles([
//       vendorDir+'twbs/dist/css/bootstrap.min.css' 
//    ]);

});
