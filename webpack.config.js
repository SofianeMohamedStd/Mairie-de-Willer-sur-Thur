const Encore = require('@symfony/webpack-encore');
const path = require('path')

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .enableReactPreset()
    .addAliases({
        '@': path.resolve('assets/js')
    })
    .addEntry('app', './assets/js/app.js')
    .splitEntryChunks()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .disableSingleRuntimeChunk()
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    .addLoader({
        test: /\.(png|woff|woff2|eot|ttf|svg|jpg)$/,
        loader:'url-loader'
    })

    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[hash:8].[ext]'
    })

    //.enableSassLoader();
    .enablePostCssLoader()

module.exports = Encore.getWebpackConfig();
