const path                 = require('path')
const webpack              = require('webpack')
const WebpackChunkHash     = require('webpack-chunk-hash')
const ChunkManifestPlugin  = require('chunk-manifest-webpack-plugin')
const UglifyJSPlugin       = require('uglifyjs-webpack-plugin')
const SvgStore             = require('webpack-svgstore-plugin')

module.exports = {
    context: path.resolve(__dirname, 'js'),
    // devtool: 'inline-source-map',
    entry: {
        app: './main.js'
    },
    output: {
        path:           path.resolve(__dirname, 'js'),
        filename:       '[name].js',
        chunkFilename:  '[name].js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: ['babel-loader', 'webpack-strip-block']
            }
        ]
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name:       'vendor',
            minChunks: (module) => {
                console.log(module.resource)
                return module.resource && (/node_modules/).test(module.resource)
            }
        }),
        new SvgStore({
            svgoOptions: {
                plugins: [
                    { removeTitle: true }
                ]
            },
            name: '[hash].icons.svg',
            prefix: 'shape-',
            cleanup: true,
            svg: {
                style: "display: none;"
            }
        }),
        new webpack.optimize.CommonsChunkPlugin({
            name:       'manifest',
            minChunks:  Infinity,
            filename:   'manifest.js'
        }),
        new webpack.HashedModuleIdsPlugin(),
        new WebpackChunkHash(),
        new ChunkManifestPlugin({
            filename:           'manifest.json',
            manifestVariable:   'webpackManifest',
            inlineManifest:     true
        }),
        new UglifyJSPlugin({
          compress: {
            warnings: false
          }
        })
    ]
}