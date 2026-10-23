document.addEventListener('DOMContentLoaded', function() {
    /**
     * Find all elements with the swiper-container class
     * Used for Woo_Product_Carousel_Slide widget.
     */
    document.querySelectorAll('.mi-carousel--slide').forEach(function (element) {

        const swiper_wrapper = element.querySelector('.swiper');

        const slidesPerView = swiper_wrapper.getAttribute('data-slides-per-view') || 5;
        const slidesPerViewTablet = swiper_wrapper.getAttribute('data-slides-per-view-tablet') || slidesPerView;
        const slidesPerViewMobile = swiper_wrapper.getAttribute('data-slides-per-view-Mobile') || slidesPerViewTablet;

        new Swiper(swiper_wrapper, {
            // Check for specific classes for different settings
            loop: swiper_wrapper.classList.contains('loop--enabled'),
            autoplay: swiper_wrapper.classList.contains('autoplay--enabled'),
            centeredSlides: swiper_wrapper.classList.contains('centered--mobile'),
            slidesPerView: slidesPerViewMobile,
            navigation: {
                nextEl: element.querySelector('.swiper-button-next'),
                prevEl: element.querySelector('.swiper-button-prev')
            },
            breakpoints: {
                768: {
                    slidesPerView: slidesPerViewTablet,
                    centeredSlides: swiper_wrapper.classList.contains('centered--tablet')
                },
                1024: {
                    slidesPerView: slidesPerView,
                    centeredSlides: swiper_wrapper.classList.contains('centered')
                },
            },
            on: {
                slideChange: function (swiper) {
                    if (window.innerWidth >= 1024) {
                        swiper.slides.forEach( (slide, index) => {
                            const distanceFromActive = Math.abs(swiper.activeIndex - index);
                            // Active slide
                            if (distanceFromActive === 0) {
                                slide.style.flexBasis = `30%`;
                            }
                            // After and before active
                            else if (distanceFromActive <= 2 || distanceFromActive >= swiper.slides.length - 2) {
                                slide.style.flexBasis = `17.5%`;
                            }
                            // Other slide
                            else {
                                slide.style.flexBasis = 'unset';
                            }
                        });
                    } else {
                        swiper.slides.forEach((slide, index) => {
                            const distanceFromActive = Math.abs(swiper.activeIndex - index);
                            // Active slide
                            if (distanceFromActive === 0) {
                                slide.style.flexBasis = `100%`;
                            }
                        });
                    }
                }
            }
        });
    });
});
