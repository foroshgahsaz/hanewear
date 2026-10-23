jQuery(window).on('elementor/frontend/init', function() {

    elementorFrontend.hooks.addAction('frontend/element_ready/global', function($scope) {
        document.querySelectorAll('.mi-carousel').forEach(function(element) {
            
            const swiper_wrapper = element.querySelector('.swiper');

            const slidesPerView = swiper_wrapper.getAttribute('data-slides-per-view') || 4;
            const slidesPerViewTablet = swiper_wrapper.getAttribute('data-slides-per-view-tablet') || slidesPerView;
            const slidesPerViewMobile = swiper_wrapper.getAttribute('data-slides-per-view-Mobile') || slidesPerViewTablet;

            new Swiper(swiper_wrapper, {
                // Check for specific classes for different settings
                loop: swiper_wrapper.classList.contains('loop--enabled'),
                direction: swiper_wrapper.getAttribute('data-direction') || 'horizontal',
                autoplay: swiper_wrapper.classList.contains('autoplay--enabled'),
                centeredSlides: swiper_wrapper.classList.contains('centered--mobile'),
                slidesPerView: slidesPerViewMobile,
                navigation: {
                    nextEl: element.querySelector('.swiper-button-next'),
                    prevEl: element.querySelector('.swiper-button-prev')
                },
                breakpoints: {
                    512: {
                        slidesPerView: slidesPerViewTablet - 1,
                    },
                    768: {
                        slidesPerView: slidesPerViewTablet,
                        centeredSlides: swiper_wrapper.classList.contains('centered--tablet')
                    },
                    1024: {
                        slidesPerView: slidesPerView,
                        centeredSlides: swiper_wrapper.classList.contains('centered')
                    },
                },
                pagination: {
                    el: element.querySelector('.swiper-pagination'),
                }
            });
        });
    });
});