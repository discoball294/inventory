const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.styles([
        'bootstrap.css',
        'AdminLTE.css',
        'skins/skin-blue.min.css'
        ]
    )
       .scripts([
           'jquery-2.2.3.min.js',
           'bootstrap.js',
           'app.js'
       ]);
});
