(function ( $ ) {
    function popupLinks() {
        var $trigger = $('.js-popup');
        $trigger.on('click', function (event) {
            event.preventDefault();
            var width = 575,
                height = 400,
                left = ($window.width() - width) / 2,
                top = ($window.height() - height) / 2,
                opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;

            window.open(this.href, 'compartir', opts);
        });
    }
    popupLinks();
}( jQuery ));