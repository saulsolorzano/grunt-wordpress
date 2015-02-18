(function ( $ ) {
	$.fn.mantenerAlto = function(selector){
		return this.each(function(){
			var maxHeight	= -1,
				$this		= $(this),
				elemento	= $this.find(selector);

			elemento.each(function() {
				maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
			});
			elemento.each(function() {
				$(this).height(maxHeight);
			});
		});
	};
}( jQuery ));