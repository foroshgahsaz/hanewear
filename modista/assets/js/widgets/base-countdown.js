jQuery(document).ready(function ($) {
    let mi_countdown = $('.mi-countdown');
    for ( let el = 0; mi_countdown.length > el; el++ ) {
        mi_widget_contDown_update(mi_countdown[el]);
    }
});

function mi_widget_contDown_update (element) {

    let countDownDueDate = jQuery(element).attr('data-due-date');

    if ( ! countDownDueDate ) return;

    let dueDateTime = new Date(countDownDueDate).getTime();

    // Update the count down every 1 second
    let countDown = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = dueDateTime - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        jQuery(element).find('.mi-countdown__day .digits').html(days);
        jQuery(element).find('.mi-countdown__hour .digits').html(hours);
        jQuery(element).find('.mi-countdown__minute .digits').html(minutes);
        jQuery(element).find('.mi-countdown__second .digits').html(seconds);

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(countDown);
            jQuery(element).find('.mi-countdown__day .digits').html('00');
            jQuery(element).find('.mi-countdown__hour .digits').html('00');
            jQuery(element).find('.mi-countdown__minute .digits').html('00');
            jQuery(element).find('.mi-countdown__second .digits').html('00');
        }
    }, 1000);
}