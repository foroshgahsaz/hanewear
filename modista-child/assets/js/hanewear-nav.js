document.addEventListener('DOMContentLoaded', function () {
    const mobileNavMedia = window.matchMedia('(max-width: 1023.98px)');

    document.querySelectorAll('.elementor-widget-dp-nav-menu .menu-item-has-children > a').forEach(function (item) {
        item.addEventListener('click', function (event) {
            if (!mobileNavMedia.matches) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();

            const parentItem = this.parentElement;
            if (!parentItem) {
                return;
            }

            parentItem.classList.toggle('open');
        }, { passive: false });
    });
});
