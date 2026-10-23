document.addEventListener('DOMContentLoaded', function () {
    
    // Upload Profile
    const profile_file_input = document.querySelectorAll('.profile-file-input');    

    profile_file_input.forEach((element) => {
        update_value_profile_file_input(element)
    });
    
    function update_value_profile_file_input(element) {
        
        // Get the file input and label elements within the passed element
        const fileInput = element.querySelector('[type="file"]');
        const label = element.querySelector('[data-js-label]');
        const previewImage = document.querySelector('.avatar-wrapper__default img.avatar');
        
        // Ensure the fileInput exists before proceeding
        if ( !fileInput || !label || !previewImage ) return;
    
        // Attach event listeners for 'change' and 'mouseout' events
        fileInput.onchange = fileInput.onmouseout = function () {

            // If no file is selected, return early
            if (!fileInput.files || fileInput.files.length === 0) return;

            console.log(fileInput.files);
            
            let value = fileInput.files[0].name;
            label.innerText = value; // Set the label text to the file name
            // element.className += ' -chosen';  // Add the '-chosen' class to the element

            // Create a FileReader to read the image file and display it
            const reader = new FileReader();
            reader.onload = function(e) {
                // Set the image preview source to the file's data URL
                previewImage.src = e.target.result;
            };

            // Read the file as a data URL (this is suitable for images)
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    // Notification
    const notifications = document.querySelectorAll('.notification');    

    notifications.forEach((element) => {
        toggle_accordion(element)
    });
    
    function toggle_accordion(element) {
        element.querySelector('.notification__toggle').addEventListener('click', function() {
            element.classList.toggle('collapse');
            // Change vector
            $svg_ID = element.classList.contains('collapse') ? '#minus-square' : '#plus-square' ;
            element.querySelector('use').setAttribute('xlink:href', $svg_ID);
        });
    }

    // Tickets toggle create modal
    const toggles = document.querySelectorAll('a[toggle-section]');

    toggles.forEach((toggle) => {
        
        toggle.addEventListener('click', function(event) {

            event.preventDefault();

            let show_element = toggle.getAttribute('data-show');
            if (show_element) {
                show_element = document.querySelector(`${show_element}`);
                
                (show_element !== null) && show_element.classList.toggle('hidden');
            }
            
            let hide_element = toggle.getAttribute('data-hide');
            if (hide_element) {
                hide_element = document.querySelector(`${hide_element}`);

                (hide_element !== null) && hide_element.classList.toggle('hidden');
            }
        });    
    });

    /**
     * Tickets actions
     * 
     * create new ticket
     * in /my-account/tickets/ endpoint
     */
    const ticket_form = document.getElementById('woocommerce_NewTicketForm');

    if (ticket_form) {
        // Create a ticket event
        ticket_form.addEventListener("submit", function(event) {

            ticket_form.querySelector('button[name="ticket_send"]').setAttribute('disabled', 'true');
            
            event.preventDefault();

            const form_data = new URLSearchParams(new FormData(this));

            form_data.append('action', 'mi_ticket');
            form_data.append('security', mi_ajax_object.security);
    
            fetch(mi_ajax_object.ajax_url, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: form_data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.data.redirect) {
                        window.location.href = data.data.redirect
                    }
                } else {
                    ticket_form.querySelector('button[name="ticket_send"]').removeAttribute('disabled');
                }            
            });
        });
    }

    /**
     * Tickets actions
     * 
     * reply to ticket
     * in /my-account/tickets/{ticket_id} endpoint
     */
    const ticket_reply_form = document.getElementById('woocommerce_replyTicketForm');

    if (ticket_reply_form) {
        // Create reply message ticket event
        ticket_reply_form.addEventListener("submit", function(event) {
            
            event.preventDefault();

            const form_data = new URLSearchParams(new FormData(this));            

            form_data.append('action', 'mi_ticket_reply');
            form_data.append('security', mi_ajax_object.security);
    
            fetch(mi_ajax_object.ajax_url, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: form_data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const chat_list = document.querySelector('.ticket-messages .card__content');
                    const lastMessage = chat_list.lastElementChild;
            
                    if (lastMessage) {
                        const newMessage = lastMessage.cloneNode(true);
                        newMessage.classList.remove('justify-content-end');
                        
                        newMessage.querySelector('p').innerHTML = form_data.get('message');
                        newMessage.querySelector('h4').innerHTML = 'پاسخ شما';
            
                        chat_list.appendChild(newMessage);
                    }
            
                    chat_list.scrollTop = chat_list.scrollHeight;
                }
            });
            
        });
    }  

    // single ticket scroll to down
    const elements_scroll = document.querySelectorAll(".mini-scroll--down");
    if (elements_scroll) {
        elements_scroll.forEach(element => element.scrollTop = element.scrollHeight)
    }
});

/**
 * Use select 2 plugin
 */
jQuery(document).ready(function ($) {
    $('.mi-select2-results').selectWoo();
})