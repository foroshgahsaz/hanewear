document.addEventListener("DOMContentLoaded", function () {

    /**
     * Update add to cart variation for default skin.
     */
    const variationsForm = document.querySelector('.variations_form_without_button');
    const variationsAddToCartForms = document.querySelectorAll('.variations_form');

    // If product type is variable.
    if (variationsForm && variationsAddToCartForms) {
        let customSelects = variationsForm.querySelectorAll('select');

        customSelects.forEach(function (select) {

            select.addEventListener('change', function () {

                var attributeName = select.getAttribute('data-attribute_name');
                var value = select.value;

                variationsAddToCartForms.forEach(function (form) {
                    var originalSelect = form.querySelector('select[data-attribute_name="' + attributeName + '"]');

                    if (originalSelect) {
                        originalSelect.value = value;

                        originalSelect.dispatchEvent(new Event('change'));

                        form.dispatchEvent(new Event('check_variations'));
                    }
                });

            });
        });

        variationsAddToCartForms.forEach(function (form) {
            form.dispatchEvent(new Event('check_variations'));
        });
    }

    /**
     * Update add to cart variation for custom skin.
     */
    const variationsForms = document.querySelectorAll('.mi-variation-select');

    // Helper function to update selected title form
    function updateFormTitle(variationTitle, textValue) {
        if (variationTitle) {
            variationTitle.innerHTML = textValue;
        }
    }

    // Helper function to update add-to-cart form
    function updateAddToCartForm(attributeName, value) {
        variationsAddToCartForms.forEach(form => {
            const originalSelect = form.querySelector(`select[data-attribute_name="${attributeName}"]`);
            if (originalSelect) {
                originalSelect.value = value;
                originalSelect.dispatchEvent(new Event('change'));
                form.dispatchEvent(new Event('check_variations'));
            }
        });
    }

    // Main function to handle color variation selection
    function handleColorVariation( variationForm ) {

        const customSelects = variationForm.querySelectorAll('li');
        const attributeName = variationForm.getAttribute('data-variation-name');
        const variationTitle = variationForm.querySelector('.mi-variation-select__title span');

        if ( ! attributeName ) return false;

        customSelects.forEach(li => {
            // Pre-select logic
            if (li.classList.contains('selected')) {
                // Add selected item to header.
                let textValue = li.querySelector('.option-name').innerHTML;
                updateFormTitle(variationTitle, textValue)
            }

            // Click event handler
            li.addEventListener('click', () => {
                const textValue = li.querySelector('.option-name').innerHTML;
                let value = li.id;

                // Toggle selected class and handle deselection
                if (li.classList.contains('selected')) {
                    li.classList.remove('selected');
                    value = '';
                    updateFormTitle(variationTitle, 'انتخاب نشده')
                } else {
                    customSelects.forEach(item => item.classList.remove('selected'));
                    li.classList.add('selected');
                    updateFormTitle(variationTitle, textValue)
                }

                // Update the add-to-cart form
                updateAddToCartForm(attributeName, value);
            });
        });

        // Trigger initial variation check
        variationsAddToCartForms.forEach(form => form.dispatchEvent(new Event('check_variations')));
    }

    // Apply event listeners if forms exist
    if (variationsForms) {
        variationsForms.forEach( (form) => { handleColorVariation(form); });
    }

    /**
     * Image Gallery slider.
     */
    const mainImage = document.querySelector('.woocommerce-product-gallery__wrapper');

    document.querySelectorAll('.mi-gallery-carousel').forEach( function(element) {

        const swiper_wrapper = element.querySelector('.swiper');

        if (swiper_wrapper === null)
            return;

        let hasInitialized = false;

        const slidesPerView = swiper_wrapper.getAttribute('data-slides-per-view') || 4;
        const slidesPerViewTablet = swiper_wrapper.getAttribute('data-slides-per-view-tablet') || slidesPerView;
        const slidesPerViewMobile = swiper_wrapper.getAttribute('data-slides-per-view-Mobile') || slidesPerViewTablet;

        const swiperGallery = new Swiper(swiper_wrapper, {
            // Check for specific classes for different settings
            loop: swiper_wrapper.classList.contains('loop--enabled'),
            direction: swiper_wrapper.getAttribute('data-direction') || 'horizontal',
            autoplay: swiper_wrapper.classList.contains('autoplay--enabled'),
            centeredSlides: swiper_wrapper.classList.contains('centered--mobile'),
            slidesPerView: slidesPerViewMobile,
			allowTouchMove: true,
			simulateTouch: true,
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
            pagination: {
                el: element.querySelector('.swiper-pagination'),
            },
            on: {
                slideChange: function (swiper) {
                    const activeSlide = swiper.slides[swiper.activeIndex];

                    const newImageSrc = activeSlide.querySelector('img').getAttribute('data-large_image');

                    if (mainImage && newImageSrc && hasInitialized) {

                        // Update the light box of post image.
                        mainImage.querySelector('a').setAttribute('href', newImageSrc);
                        // Update the post image src.
                        mainImage.querySelector('img').setAttribute('src', newImageSrc);
                        mainImage.querySelector('img').setAttribute('data-src', newImageSrc);
                        mainImage.querySelector('img').setAttribute('data-large_image', newImageSrc);
                    }
                },
                init: function () {
                    hasInitialized = true;
                },
            }
        });
    });

    /**
     * Tabs
     *
     * Add active class to selected tab.
     */
    const woocommerceTabs = document.querySelectorAll('.woocommerce-tabs ul[role="tablist"] li');

    if ( woocommerceTabs ) {

        woocommerceTabs.forEach( function(element) {

            woocommerceTabs[0].classList.add('active');

            element.addEventListener('click', function () {
                // Remove all tab active class.
                woocommerceTabs.forEach( (element) => { element.classList.remove('active'); });
                // add active class to selected tab.
                element.classList.add('active');
            });
        });
    }

    /**
     * Mini Modal
     * used for product attribute size modal
     */
    if (MicroModal) {
        MicroModal.init({
            openTrigger: 'data-micromodal-trigger',
            closeTrigger: 'data-micromodal-close',
            disableScroll: true,
            awaitCloseAnimation: true,
        });
    }
});