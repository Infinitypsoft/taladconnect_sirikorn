const mix = require('laravel-mix');
const webpack = require('webpack');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
const { VuetifyLoaderPlugin } = require('vuetify-loader')

mix.options({
  terser: {
    extractComments: false,
  }
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

const config_path = () => {
  let path = (process.env.CONFIG_PATH || '/');
  if ( path.substr(path.length - 1) != '/' ) {
    path = path + '/';
  }
  return path;
};

const plugin = new webpack.DefinePlugin({
  'process.env.APP_URL': JSON.stringify(process.env.APP_URL || 'http://localhost/taladconnect'),
  'process.env.API_URL': JSON.stringify(process.env.API_URL || 'http://localhost/taladconnect/api'),
  'process.env.CONFIG_PATH': JSON.stringify(process.env.CONFIG_PATH || '/'),
});

mix.webpackConfig({
  plugins: [
    plugin,
    // new BundleAnalyzerPlugin(),
    new VuetifyLoaderPlugin()
  ],
  resolve: {
    extensions: ['.js', '.vue'],
    alias: {
      '@': __dirname + '/resources'
    }
  },
  output: {
    chunkFilename: 'js/[name].bundle.js',
    publicPath: config_path
  },
  // optimization: {
  //   splitChunks: {
  //     chunks: 'all'
  //   }
  // },
});


mix.js('resources/js/appAdmin.js', 'public/js/admin.js')
.vue()
.sass('resources/sass/appAdmin.scss', 'public/css/admin.css' , {
  additionalData: `$base-url: "${process.env.APP_URL || 'http://localhost/taladconnect'}";`
});

mix.js('resources/js/app.js', 'public/js')
.vue()
.sass('resources/sass/app.scss', 'public/css' , {
  additionalData: `$base-url: "${process.env.APP_URL || 'http://localhost/taladconnect'}";`
});

// Versioning
if (mix.inProduction()) {
  mix.version();
}
