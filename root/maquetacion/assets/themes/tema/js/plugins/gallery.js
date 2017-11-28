(function($) {
    // Tamaño de la pantalla
    var $window = $(window),
        windowSize  = $window.width();
    var GalleryLightbox = {
        el: {
            btnOpen: $('.js-gallery-trigger'),
            body: $('body'),
            lightboxSkeleton: $('<div class="overlay js-overlay"><div class="overlay__container js-overlay-container"><button class="overlay__close box-shadow js-overlay-close close-btn"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M16 14.364l-5.728-5.728-1.636 1.636L14.364 16l-5.728 5.728 1.636 1.636L16 17.636l5.728 5.728 1.636-1.636L17.636 16l5.728-5.728-1.636-1.636L16 14.364z" fill-rule="evenodd"/></svg></button><div class="gallery-slider js-gallery-slider"><ul class="gallery-container js-gallery-container slides"></ul><div class="gallery-extras"><div class="gallery__counter"><span class="gallery__counter__current js-gallery-current"></span><span class="gallery__counter__sep">/</span><span class="gallery__counter__total js-gallery-total"></span></div><div class="js-gallery-controls"></div></div></div></div></div>')
        },
        cacheDOM: function () {
            this.overlay = $('.js-overlay', this.el.lightboxSkeleton);
            this.controls = $('.js-gallery-controls', this.el.lightboxSkeleton);
            this.galleryContainer = $('.js-gallery-container', this.el.lightboxSkeleton);
        },
        init: function () {
            this.createLightbox();
            this.bindEvents();
            this.cacheDOM();
        },
        bindEvents: function () {
            GalleryLightbox.el.btnOpen.on('click', this.openLightbox.bind());
            $('.js-overlay-close').on('click', this.closeLightbox.bind(this));
            // GalleryLightbox.el.body.on('click', $('.js-overlay-close'), this.closeLightbox.bind(this));
        },
        getGalleryData: function (thisItem) {
            var wholeItem = thisItem.parents('.js-gallery');
            var data = wholeItem.data('gallery');
            return data;
        },
        createItems: function (imageLink, imageTitle, imageDescription) {
            var html = '<li class="gallery-image">' +
                    '<div class="gallery-image__container">' +
                    '<div class="gallery-image__img">' +
                    '<img src="' + imageLink + '" alt="' + imageTitle + '">' +
                    '</div>' +
                    '<div class="gallery-image__info">' +
                    '<div class="gallery-image__info__container">' +
                    '<div class="gallery-image__info__title fifth-title">' + imageTitle + '</div>' +
                    '<div class="gallery-image__info__label copy-simple"><p>' + imageDescription + '</p></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';
            return html;
        },
        createGallery: function (photos) {
            for (var i = 0; i < photos.length; i++) {
                this.galleryContainer.append(GalleryLightbox.createItems(photos[i].link, photos[i].title, photos[i].copy));
            }
        },
        createLightbox: function () {
            GalleryLightbox.el.lightboxSkeleton.prependTo(GalleryLightbox.el.body);
        },
        openLightbox: function (event) {
            $('.js-overlay').addClass('overlay-is-open');
            var event = $(event.currentTarget);
            var galleryImages = GalleryLightbox.getGalleryData(event);
            GalleryLightbox.createGallery(galleryImages);


            $('.js-gallery-slider').flexslider({
                controlNav: false,
                slideshow: false,
                controlsContainer: $('.js-gallery-controls'),
                prevText: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"><path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z"/></svg>',
                nextText: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></svg>',
                start: function (slider) {
                    $('.js-gallery-current').text(slider.currentSlide + 1);
                    $('.js-gallery-total').text(slider.count);
                },
                after: function (slider) {
                    $('.js-gallery-current').text(slider.currentSlide + 1);
                    $('.js-gallery-total').text(slider.count);
                }
            });
        },
        destroySlide: function () {
            this.galleryContainer.empty();
            this.controls.empty();
            $('.js-gallery-slider').removeData('flexslider');
        },
        closeLightbox: function () {
            $('.js-overlay').removeClass('overlay-is-open');
            this.destroySlide();
        }
    };
    $window.on('load', function () {
        if ($('.js-gallery-trigger').length > 0) {
            GalleryLightbox.init();
        }
    });
})(jQuery);