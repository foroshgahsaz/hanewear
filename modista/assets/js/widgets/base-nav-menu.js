document.addEventListener('DOMContentLoaded', function() {    

    /**
     * Used for mega menu horizontal carousel widget.
     */
    document.querySelectorAll('.slide-vertical--category').forEach( function(sliderElement, index) {

        const menu_side_height      = document.querySelectorAll('.main-sub-menu')[index].offsetHeight;
        const side_banner_height    = document.querySelectorAll('.mega-default__side-banner')[index].offsetHeight;
        sliderElement.style.height  = menu_side_height >= side_banner_height ? `${menu_side_height}px` : `${side_banner_height}px`;
            
        new Swiper(sliderElement, {
            // Check for specific classes for different settings
            loop: sliderElement.classList.contains('loop-enabled'),
            direction: sliderElement.getAttribute('data-direction') || 'horizontal',
            slidesPerView: 6,
            spaceBetween: 8,
        });
    });
});