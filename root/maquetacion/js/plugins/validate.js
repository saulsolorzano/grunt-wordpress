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
        var formContainer   = $('.js-form-container');
        formContainer.each(function() {
            var $this       = $(this),
                form        = $this.find('.js-form'),
                formBox     = $this.find('.js-form-box'),
                formSubmit  = $this.find('.form__submit input');
            $('<div class="loading"><span class="bounce1"></span><span class="bounce2"></span><span class="bounce3"></span></div>').appendTo($this);
            $('<div class="message"></div>').appendTo($this);
            form.validate({
                rules: {
                    nombre: "required",
                    apellido: "required",
                    email: {
                        required: true,
                        customemail: true
                    },
                    telefono: {
                        required: true,
                        number: true
                    },
                    empresa: "required",
                    cargo: "required",
                    detalle: "required"
                },
                messages: {
                    nombre: "Este campo es requerido",
                    apellido: "Este campo es requerido",
                    email: {
                        required: "Este campo es requerido",
                        email: "Correo no válido"
                    },
                    telefono: {
                        required: "Este campo es requerido",
                        number: "Sólo números"
                    },
                    empresa: "Este campo es requerido",
                    cargo: "Este campo es requerido",
                    detalle: "Este campo es requerido"
                },
                errorElement: 'span',
                errorClass: 'form__error',
                validClass: 'form__valid',
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(formBox).addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(formBox).removeClass(errorClass).addClass(validClass);
                },
                submitHandler: function (form) {
                    $this.find('.loading').css({opacity: 0}).animate({opacity: 1});
                    formSubmit.val('Enviando...');
                    formSubmit.prop('disabled', true);
                    var formURL = form.attr("action");

                    var formData = new FormData(form[0]);

                    $.ajax( {
                        url: formURL,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        fail: function(result) {
                            form.find('.message').html('<div class="message__container error"><p class="warning-msg">Error inesperado, intentalo mas tarde.</p></div>').removeClass('hidden');
                        },
                        success: function(result) {
                            var obj = result;
                            if (obj.exito === 'exito') {
                                $this.find('.loading').fadeOut();
                                $this.find('.message').html('<div class="message__container success"><p class="success-msg">Tu Mensaje ha sido enviado con éxito</p></div>').fadeIn();
                                form.find('.form__valid').removeClass('form__valid');
                                form[0].reset();
                                formSubmit.prop('disabled', false);
                                formSubmit.val('Enviar');
                            } else {
                                form.find('.message').html('<p class="warning-msg">'+obj.message+'</p>').removeClass('hidden');
                            }
                        }
                    } );
                    return false;
                }
            });
        });
    }
}(jQuery));