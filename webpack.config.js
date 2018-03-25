var Encore = require('@symfony/webpack-encore');
var webpack = require('webpack');

Encore
    .setOutputPath('public/assets/')
    .setPublicPath('/assets')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .createSharedEntry('material', [
        // JS
        'jquery',
        './assets/material/js/01_bootstrap.min.js',
        './assets/material/js/02_material.min.js',
        './assets/material/js/03_perfect-scrollbar.jquery.min.js',
        './assets/material/js/05_core.js',
        './assets/material/js/06_arrive.min.js',
        './assets/material/js/07_jquery.validate.min.js',
        './assets/material/js/08_moment.min.js',
        './assets/material/js/09_chartist.min.js',
        './assets/material/js/10_jquery.bootstrap-wizard.js',
        './assets/material/js/11_bootstrap-notify.js',
        './assets/material/js/12_jquery.sharrre.js',
        './assets/material/js/13_bootstrap-datetimepicker.js',
        './assets/material/js/14_jquery-jvectormap.js',
        './assets/material/js/15_nouislider.min.js',
        './assets/material/js/16_jquery.select-bootstrap.js',
        './assets/material/js/17_jquery.datatables.js',
        './assets/material/js/18_sweetalert2.js',
        './assets/material/js/19_jasny-bootstrap.min.js',
        './assets/material/js/20_fullcalendar.min.js',
        './assets/material/js/21_jquery.tagsinput.js',
        './assets/material/js/22_material-dashboard.js',

        // CSS
        './assets/material/css/bootstrap.min.css',
        './assets/material/css/material-dashboard.css'
    ])

    // uncomment to define the assets of the project
    .addEntry('app', [
        // JS
        'jquery',
        './assets/js/app.js',

        // CSS
        './assets/css/app.css'
    ])

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()

    ;

module.exports = Encore.getWebpackConfig();
