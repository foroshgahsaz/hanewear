jQuery(document).ready(function($) {
    $('.mi-toggle-section__button').on('click', function() {
        let content = $(this).next('.mi-toggle-section__content');

        if (content.hasClass('active')) {
            content.removeClass('active');
        } else {
            $('.mi-toggle-section__content').removeClass('active');
            content.addClass('active');
        }
    });

    $('.mi-toggle-section__close').on('click', function() {
        $('.mi-toggle-section__content').removeClass('active');
    });
});
