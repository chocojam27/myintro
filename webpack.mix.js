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

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
                Popper: ['popper.js', 'default'],
            })
        ]
    };
});

mix.scripts([
    'resources/frontend/js/vendor/jquery-v3.3.1.min.js',
    'resources/frontend/js/vendor/popper.min.js',
    'resources/frontend/js/vendor/bootstrap.min.js',
    'resources/frontend/js/owl.carousel.min.js',
    'resources/frontend/js/dataTables.js',
    'resources/frontend/js/dataTablesbs4.js',
    'resources/frontend/js/main.js',
    'resources/frontend/js/colorpicker.js',
    ], 'public/frontend/js/app.js')
    .styles([
        'resources/frontend/css/bootstrap.min.css',
        'resources/frontend/css/font-awesome.min.css',
        'resources/frontend/css/owl.carousel.min.css',
        'resources/frontend/css/main.css',
        'resources/frontend/css/style.css',
        'resources/frontend/css/styleTemp.css',
        'resources/frontend/css/responsive.css',
        'resources/frontend/css/templateResponsive.css',
        'resources/frontend/css/colorpicker.css',
        'resources/frontend/css/dataTablesbs4.css',
    ], 'public/frontend/css/app.css')
    .copyDirectory('resources/frontend/js/ckeditor','public/frontend/js/ckeditor')
    .copyDirectory('resources/frontend/fonts','public/frontend/fonts')
    .copyDirectory('resources/frontend/img','public/frontend/img')
    .copyDirectory('resources/frontend/images','public/frontend/images')
    .copyDirectory('resources/backend','public/backend')
    .copyDirectory('resources/public','public')
    .js('resources/js/app.js', 'public/backend/js')
    .sass('resources/sass/app.scss', 'public/backend/css')
    .browserSync('http://192.168.0.195:8000')
    .version()
    .sourceMaps();
