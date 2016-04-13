(function ( $ ) {
    $.validator.addMethod("customemail", 
        function(value, element) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(value);
        }, 
        "Tu correo no es válido"
    );
    /**
     * Validación del formulario usando jQuery Validate
     */
    function validacionFormulario() {
        $('<div class="loading"><span class="bounce1"></span><span class="bounce2"></span><span class="bounce3"></span></div>').appendTo('.js-form-container');
        $('<div class="message"></div>').appendTo('.js-form-container');
        $('.js-form').validate({
            rules: {
                nombre: "required",
                correo: {
                    required: {
                        depends: function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        } 
                    },
                    customemail: true
                },
                comentario: "required"
            },
            messages: {
                nombre: "Este campo es requerido",
                correo: {
                    required: "Este campo es requerido",
                    email: "Correo inválido"
                },
                comentario: "Este campo es requerido"
            },
            errorElement: 'span',
            errorClass: 'form__error',
            validClass: 'form__valid',
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.form__box').addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.form__box').removeClass(errorClass).addClass(validClass);
            },
            submitHandler: function (form) {
                $('.js-form-container .loading').css({opacity: 0}).animate({opacity: 1});
                $('.js-form-submit').text('Enviando...');
                $('.js-form-submit').prop('disabled', true);
                var form = $('.js-form'),
                    formURL = form.attr("action");

                var formData = new FormData($('.js-form')[0]);
                formData.append("action","contacto");

                $.ajax( {
                    url: ajax_contacto.ajaxurl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    fail : function(result) {
                        $('.js-form .message').html('<div class="message__container error"><p class="warning-msg">Error inesperado, intentalo mas tarde.</p><button class="btn btn--white js-close-form-message">Volver a intentar nuevamente</button></div>').removeClass('hidden');
                    },
                    success : function(result) {
                        var obj = result;
                        if (obj.exito === 'exito') {
                            $('.js-form-container .loading').fadeOut();
                            $('.js-form-container .message').html('<div class="message__container success"><p class="success-msg">Tu Mensaje ha sido enviado con éxito</p><button class="btn btn--white js-close-form-message">Volver a enviar otro mensaje</button></div>').fadeIn();
                            $('.js-close-form-message').on('click', function() {
                                $('.js-form-container .message').hide();
                            });
                            $('.js-form').find('.form__valid').removeClass('form__valid');
                            $('.js-form')[0].reset();
                            $('.js-form-submit').prop('disabled', false);
                            $('.js-form-submit').text('Enviar');
                        } else {
                            $('.js-form .message').html('<p class="warning-msg">'+obj.message+'</p>').removeClass('hidden');
                        }
                    }
                } );
                return false;
            }
        });
    }
});