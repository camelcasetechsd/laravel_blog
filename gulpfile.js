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


var paths = {
    'jquery': './vendor/bower_components/jquery/',
    'bootstrap': './vendor/bower_components/bootstrap-sass/assets/'
}

elixir(function(mix) {

    mix.sass([
     'app.scss'
      ], './public/css/app.css');

    //style sheets (array , output , option)
    mix.styles([
           paths.bootstrap + '../../bootstrap/dist/css/',
           'styles.css'
           ],'public/css/app.css');



    // not planning to edit but just move
    mix.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts');

    mix.scripts([
            paths.jquery + "dist/jquery.js",
            paths.bootstrap + "javascripts/bootstrap.js",
            'app.js',
            'comment.js'
        ], './public/js/app.js');

});


