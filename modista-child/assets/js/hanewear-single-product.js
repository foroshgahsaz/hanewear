document.addEventListener("DOMContentLoaded", function () {

    /**
     * Update add to cart variation for default skin.
     */
    const variationsForm = document.querySelector('.variations_form_without_button');
    const variationsAddToCartForms = document.querySelectorAll('.variations_form');

    if (variationsForm && variationsAddToCartForms.length) {
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

    const variationsForms = document.querySelectorAll('.mi-variation-select');

    function getOptionLabel(li) {
        const optionName = li.querySelector('.option-name');
        if (optionName) {
            return optionName.innerHTML;
        }
        return li.textContent.trim();
    }

    function updateFormTitle(variationTitle, textValue) {
        if (variationTitle) {
            variationTitle.innerHTML = textValue;
        }
    }

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

    function handleColorVariation( variationForm ) {

        const customSelects = variationForm.querySelectorAll('li');
        const attributeName = variationForm.getAttribute('data-variation-name');
        const variationTitle = variationForm.querySelector('.mi-variation-select__title span');

        if ( ! attributeName ) return false;

        customSelects.forEach(li => {
            if (li.classList.contains('selected')) {
                updateFormTitle(variationTitle, getOptionLabel(li));
            }

            li.addEventListener('click', () => {
                const textValue = getOptionLabel(li);
                let value = li.id;

                if (li.classList.contains('selected')) {
                    li.classList.remove('selected');
                    value = '';
                    updateFormTitle(variationTitle, 'انتخاب نشده');
                } else {
                    customSelects.forEach(item => item.classList.remove('selected'));
                    li.classList.add('selected');
                    updateFormTitle(variationTitle, textValue);
                }

                updateAddToCartForm(attributeName, value);
            });
        });

        variationsAddToCartForms.forEach(form => form.dispatchEvent(new Event('check_variations')));
    }

    if (variationsForms.length) {
        variationsForms.forEach( (form) => { handleColorVariation(form); });
    }

    /**
     * Product gallery: main swiper + horizontal thumbnails.
     */
    document.querySelectorAll('.mi-gallery-carousel').forEach( function(element) {

        const mainSwiperEl = element.querySelector('.mi-product-gallery-main');
        const thumbsSwiperEl = element.querySelector('.woocommerce-product-gallery__thumbnails.swiper');

        if ( mainSwiperEl === null ) {
            return;
        }

        let thumbsSwiper = null;

        if ( thumbsSwiperEl ) {
            thumbsSwiper = new Swiper(thumbsSwiperEl, {
                loop: false,
                direction: 'horizontal',
                slidesPerView: 'auto',
                spaceBetween: 12,
                freeMode: true,
                watchSlidesProgress: true,
                slideToClickedSlide: true,
            });
        }

        const slideCount = mainSwiperEl.querySelectorAll('.swiper-slide').length;

        const mainConfig = {
            loop: false,
            allowTouchMove: slideCount > 1,
            simulateTouch: true,
            grabCursor: slideCount > 1,
            navigation: {
                nextEl: element.querySelector('.mi-gallery-main-next'),
                prevEl: element.querySelector('.mi-gallery-main-prev'),
            },
            on: {
                init: function () {
                    element.style.opacity = '1';
                },
            },
        };

        if ( thumbsSwiper ) {
            mainConfig.thumbs = { swiper: thumbsSwiper };
        }

        new Swiper(mainSwiperEl, mainConfig);
    });

    const woocommerceTabs = document.querySelectorAll('.woocommerce-tabs ul[role="tablist"] li');

    if ( woocommerceTabs.length ) {

        woocommerceTabs[0].classList.add('active');

        woocommerceTabs.forEach( function(tab) {

            tab.addEventListener('click', function () {
                woocommerceTabs.forEach( (item) => { item.classList.remove('active'); });
                tab.classList.add('active');
            });
        });
    }

    if (typeof MicroModal !== 'undefined') {
        MicroModal.init({
            openTrigger: 'data-micromodal-trigger',
            closeTrigger: 'data-micromodal-close',
            disableScroll: true,
            awaitCloseAnimation: true,
        });
    }
});
