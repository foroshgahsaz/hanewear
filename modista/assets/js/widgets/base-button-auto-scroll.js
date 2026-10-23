document.addEventListener('DOMContentLoaded', function() {
    /**
     * Used for 'mi-button-auto-scroll' widget.
     */
    const scrollButtons = document.querySelectorAll('.mi-auto-scroll');
    scrollButtons.forEach(function (scrollButton) {
        scrollButton.addEventListener('click', function () {
            const direction = this.getAttribute('data-direction');
            const offset = parseInt(this.getAttribute('data-offset'), 10);

            if (direction === 'up') {
                if (offset === 0) {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    window.scrollBy({ top: -offset, behavior: 'smooth' });
                }
            } else if (direction === 'down') {
                if (offset === 0) {
                    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
                } else {
                    window.scrollBy({ top: offset, behavior: 'smooth' });
                }
            }
        });
    });
});
