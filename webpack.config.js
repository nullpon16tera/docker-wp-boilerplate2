const webpack = require("webpack");
const path = require("path");
const terserPlugin = require('terser-webpack-plugin');

process.noDeprecation = true;

module.exports = {
  entry: {
    app: path.resolve(__dirname, "src/js/app.js")
  },
  output: {
    filename: "[name].bundle.js",
    path: path.resolve(__dirname, "assets/js")
  },
  devtool: "source-map",
  cache: true,
  // watch: true,
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules\/(?!(dom7|ssr-window|swiper)\/).*/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env']
					}
				}
      }
    ]
  },
  resolve: {
    extensions: ['.js'],
    alias: {
      "@": path.resolve(__dirname, "src/js")
    }
  },
  mode: "development",
  optimization: {
    splitChunks: {
      chunks: "all",
      name: "vendor"
		},
		minimizer: [
			new terserPlugin({
				extractComments: 'all',
				terserOptions: {
					compress: {
						drop_console: true
					}
				}
			})
		]
  }
};
