document.addEventListener('DOMContentLoaded', function () {

    // single ticket scroll to down
    const elements_scroll = document.querySelectorAll(".mini-scroll--down");
    
    if (elements_scroll) {
        elements_scroll.forEach(element => setTimeout(() => {
            element.scrollTop = element.scrollHeight
        }, 100));
    }

    /**
     * Tickets actions
     * 
     * reply to ticket
     * in /my-account/tickets/{ticket_id} endpoint
     */
    const ticket_reply_form = document.querySelector('#modista-mi_tickets_view button[name="ticket_send"]');

    if (ticket_reply_form) {
        // Create reply message ticket event
        ticket_reply_form.addEventListener("click", function(event) {
            
            event.preventDefault();

            const form_data = new URLSearchParams();            

            form_data.append('action', 'mi_ticket_reply');
            form_data.append('security', mi_ajax_object.security);
            form_data.append('ticket_id', document.querySelector('input[name="ticket_id"]').value);
            form_data.append('message', document.querySelector('#ticket_message').value);

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
                    const chat_list = document.querySelector('#modista-mi_tickets_view .card__content');
                    const lastMessage = chat_list.lastElementChild;
            
                    if (lastMessage) {
                        const newMessage = lastMessage.cloneNode(true);
                        newMessage.classList.remove('justify-content-end');
                        
                        newMessage.querySelector('p').innerHTML = form_data.get('message');
                        newMessage.querySelector('h4').innerHTML = 'پاسخ شما';
            
                        chat_list.appendChild(newMessage);
                    }
            
                document.querySelector('#ticket_message').value = ''
                chat_list.scrollTop = chat_list.scrollHeight;
                }
            });
            
        });
    }
});

/**
 * Tickets update
 * 
 * update ticket status
 * in /my-account/tickets/{ticket_id} endpoint
 */
function changeTicketStatus(event) {
    const select = event.target;
    const newStatus = select.value;
    const ticketId = select.getAttribute('data-ticket-id');

    const form_data = new URLSearchParams();
    form_data.append('action', 'mi_ticket_update');
    form_data.append('security', mi_ajax_object.security);
    form_data.append('ticket_id', ticketId);
    form_data.append('status', newStatus);

    fetch(mi_ajax_object.ajax_url, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: form_data
    })
    .then(response => response.json())
    .then(data => {});
}