var Encore = require('@symfony/webpack-encore');
var path = require('path');
var CopyWebpackPlugin  = require('copy-webpack-plugin');

Encore
    .setOutputPath('public/assets/')
    .setPublicPath('/assets')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .createSharedEntry('material', [
        'jquery',
        './assets/vendor/material-dashboard/js/core/popper.min.js',
        './assets/vendor/material-dashboard/js/bootstrap-material-design.js',
        './assets/vendor/material-dashboard/js/plugins/moment.min.js',
        './assets/vendor/material-dashboard/js/plugins/bootstrap-selectpicker.js',
        './assets/vendor/material-dashboard/js/plugins/bootstrap-tagsinput.js',
        './assets/vendor/material-dashboard/js/plugins/jasny-bootstrap.min.js',
        './assets/vendor/material-dashboard/js/plugins/arrive.min.js',
        './assets/vendor/material-dashboard/js/plugins/jquery.validate.min.js',
        './assets/vendor/material-dashboard/js/plugins/bootstrap-notify.js',
        './assets/vendor/material-dashboard/js/plugins/jquery-jvectormap.js',
        './assets/vendor/material-dashboard/js/plugins/nouislider.min.js',
        './assets/vendor/material-dashboard/js/plugins/jquery.select-bootstrap.js',
        './assets/vendor/material-dashboard/js/plugins/jquery.datatables.js',
        './assets/vendor/material-dashboard/js/plugins/perfect-scrollbar.jquery.min.js',
        './assets/vendor/material-dashboard/js/plugins/sweetalert2.js',
        './assets/vendor/material-dashboard/js/plugins/bootstrap-datetimepicker.min.js',
        './assets/vendor/material-dashboard/js/material-dashboard.js?v=2.0.1',

        // CSS
        './assets/vendor/material-dashboard/scss/material-dashboard.scss'
    ])

    // uncomment to define the assets of the project
    .addEntry('app', [
        // JS
        'jquery',
        'select2',
        './assets/js/app.js',

        // CSS
        './assets/vendor/select2.min.css',
        './assets/css/app.css'
    ])

    // SASS and COMPASS
    .enableSassLoader(function(options) {
        options.includePaths = [
            path.resolve(__dirname, './node_modules/compass-mixins/lib')
        ];
    })

    .autoProvidejQuery()

    .autoProvideVariables({
        Popper: ['popper.js', 'default']
    })

    /*.addPlugin(new CopyWebpackPlugin([
        { from: './assets/img', to: 'img' }
    ]))*/

    .configureUglifyJsPlugin(function(options) {

    });

module.exports = Encore.getWebpackConfig();
