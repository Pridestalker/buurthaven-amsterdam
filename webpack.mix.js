let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
	.sass('assets/styles/bundle/_all.sass', 'dist/styles/buurthaven.combined.css');

mix
	.combine(['assets/js/bundle/sticky-header.js'], 'dist/scripts/buurthaven.combined.js');


mix
	.webpackConfig(
		{
			devtool: "source-map"
		})
	.sourceMaps();

