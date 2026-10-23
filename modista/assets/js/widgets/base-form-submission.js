document.addEventListener('DOMContentLoaded', function() {

  // Handle modal actions.
  let forms_wrapper = document.querySelectorAll('.elementor-widget-mi_form_submission');

  if (forms_wrapper.length) {
    forms_wrapper.forEach(form_wrapper => {
      closeHandle(form_wrapper); // Close form modal
      shubmitHandle(form_wrapper); // Submit form data
    });
  }

  function closeHandle(form_wrapper) {
    form_wrapper.querySelector('.mi-form-submission__close').addEventListener('click', function() {
      form_wrapper.style.display = 'none';
    });
  }

  function shubmitHandle(form_wrapper) {

      // Submit number
      form_wrapper.querySelector('.mi-form-submission__form').addEventListener("submit", function(event) {
            
        event.preventDefault();
        
        const form_data = new URLSearchParams(new FormData(this));

        form_data.append('action', 'mi_el_widget_form_submission');

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
              let message = this.getAttribute('data-message');
              console.log(message);
              
              if (message) {
                this.classList.toggle('d-none');

                form_wrapper.querySelector('.mi-form-submission__result').innerHTML = message;
                form_wrapper.querySelector('.mi-form-submission__result').classList.toggle('d-none');
              }
            }
        });
      });
    }
});