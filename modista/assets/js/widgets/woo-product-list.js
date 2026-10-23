document.addEventListener('DOMContentLoaded', function() {
    /**
     * Find all elements with the swiper-container class
     * Used for Woo_Product_Tab widget.
     */
    document.querySelectorAll('.mi-product-list').forEach( function(listElement) {

        let content_tab = listElement.querySelectorAll('.tab-content');

        listElement.querySelectorAll('.mi-product-carousel--list').forEach( function(sliderElement, index) {
            new Swiper(sliderElement, {
                // Check for specific classes for different settings
                loop: sliderElement.classList.contains('loop--enabled'),
                autoplay: sliderElement.classList.contains('autoplay--enabled'),
                centeredSlides: sliderElement.classList.contains('centered--enabled'),
                slidesPerView: sliderElement.getAttribute('data-slides-per-view') || 4
            });
        });

    });
});
