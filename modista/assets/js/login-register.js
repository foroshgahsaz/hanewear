document.addEventListener('DOMContentLoaded', function () {

    // Handle tab toggle for login or register method.
    let buttonTab = document.querySelectorAll('.tab button');

    if (buttonTab.length) {
        buttonTab.forEach((button) => {
            button.addEventListener('click', function () {
                if (!button.classList.contains('active')) {
                    // Set tab status.
                    buttonTab.forEach((button) => button.classList.remove('active'));
                    button.classList.add('active');
                    // Show target content.
                    let content = button.getAttribute('data-tab');

                    // Change form name.
                    document.querySelector('h2.title').innerHTML = button.getAttribute('data-title');

                    if (content) {
                        document.querySelectorAll('.tab-content').forEach((content) => content.classList.add('d-none'));
                        document.querySelector(`.${content}`).classList.remove('d-none');
                    }
                }
            });
        })
    }

    // Change the password inputs visiblity.
    let showPassword = document.querySelectorAll('.input-field .password-show');

    if (showPassword.length) {
        showPassword.forEach((element) => {
            element.addEventListener('click', function () {
                // Get password input.
                let targetInput = element.closest('.input-field').querySelector('input');
                // Change input visiblity.
                if (targetInput.getAttribute('type') == 'password') {
                    targetInput.setAttribute('type', 'text');
                } else {
                    targetInput.setAttribute('type', 'password');
                }

            });
        })
    }
});

// Google Identity Services or Google Api callback for login
function gis_login(response) {

    if (mi_ajax_object === undefined) {
        return false;
    }
    
    const credential = (typeof response === 'object') ? response.credential : response;    

    fetch( mi_ajax_object.ajax_url , {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "action=auth_with_google" +
             "&code=" + credential +
             "&nonce=" + mi_ajax_object.security
             
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.data.redirect;
            } else {
                console.log(data.data.meesage);
            }
        });
}

