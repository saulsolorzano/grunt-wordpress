import jQuery from "jquery";
import breakPoints from './breakpoints.js';

(function($) {
	// Tamaño de la pantalla
	var $window = $(window),
		windowSize	= $window.width();
})(jQuery);


/* develblock:start */
var __svg__ = { path: '../svgs/*.svg', name: '../img/svg-defs.svg' };
require('webpack-svgstore-plugin/src/helpers/svgxhr')(__svg__);
/* develblock:end */