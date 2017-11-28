(function ( $ ) {
	"use strict";
	$.fn.mismoAlto   = function( options ) {

		// Opciones del plugin. Primero el selector
		// Luego un callback
		var settings    = $.extend({
			item:       null,
			complete:   null
		}, options);

		// Variables generales del código
		var currentTallest = 0,
			currentRowStart = 0,
			rowDivs = new Array(),
			$el,
			topPosition = 0;

		return this.each( function(){
			var $el			=	$(this),
				currentDiv,
				topPostion	=	$el.position().top;


			if ( currentRowStart != topPostion ) {
				// Tenemos una nueva fila, colocamos todos los altos
				for ( currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++ ) {
					rowDivs[currentDiv].height(currentTallest);
				}

				// Colocamos las variables para la nueva fila
				rowDivs.length	= 0; // Vaciamos el array
				currentRowStart	= topPostion;
				currentTallest	= $el.outerHeight();
				rowDivs.push($el);

			} else {

				// Nos encontramos con otro div en la misma fila
				// Lo agregamos a la lista si es más alto
				rowDivs.push( $el );
				currentTallest = ( currentTallest < $el.height() ) ? ( $el.height() ) : (currentTallest);
			}

			// Última fija
			for ( currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++ ) {
				rowDivs[currentDiv].outerHeight(currentTallest);
			}

			// Callback una vez la función esté lista
			if ( $.isFunction( settings.complete ) ) {
				settings.complete.call( this );
			}
		});
	};

}( jQuery ));