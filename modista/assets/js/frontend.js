document.addEventListener('DOMContentLoaded', function () {

    /**
     * Orderby Dropdown
     *
     * Used for ordering in shop page and post archives.
     */
    const customSelect = document.querySelector('.mi-orderby');

    if (customSelect) {

        const selectedOption = customSelect.querySelector('.selected-option');
        const optionsContainer = customSelect.querySelector('.options');
        const options = customSelect.querySelectorAll('.option');
        const selectElement = document.querySelector('select[name="orderby"]');
        // Show dropdown.
        selectedOption.addEventListener('click', () => {
            optionsContainer.style.display = optionsContainer.style.display === 'block' ? 'none' : 'block';
        });
        // Insert selected option into form and auto form submit.
        options.forEach(option => {
            option.addEventListener('click', () => {
                selectElement.value = option.getAttribute('data-value');
                selectElement.form.submit();
            });
        });
        // Hide dropdown.
        document.addEventListener('click', (event) => {
            if ( ! customSelect.contains(event.target)) {
                optionsContainer.style.display = 'none';
            }
        });
    }

    /**
     * Data Action in Single Pages
     *
     * Used for submit data in single post or single templates.
     * Actions: Like, Share.
     */
    let elements = document.querySelectorAll('.count-action');

    if (elements.length) elements.forEach( elementElements => {

        const elementsItem = elementElements.querySelectorAll('.count-action__item');

        elementsItem.forEach(element => {
            element.addEventListener('click', () => {
                if (element.classList.contains('processing')) return;
    
                const countSpan = element.querySelector('span');
                const currentCount = parseInt(countSpan.innerText);
    
                if (!element.classList.contains('active')) {                
                    element.classList.add('active');
                    countSpan.innerText = currentCount + 1;
    
                    // check if alrady user clicked on opposite action
                    removeOppositeAction(element);

                    request(element);                    
                }
            });
        });
    
        function request(element) {
            const postID = elementElements.getAttribute('data-id');
            const action = element.getAttribute('data-action');
    
            element.classList.add('processing');
    
            fetch(mi_ajax_object.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'update_action_count',
                    action_type: action,
                    post_id: postID,
                    security: mi_ajax_object.security
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let countElement = element.querySelector('span');
                    countElement.textContent = Math.max(0, data.data.new_count); // جلوگیری از مقادیر منفی
                } else {
                    console.error('Error:', data.message || 'Unknown error');
                }
            })
            .catch(error => console.error('Request failed:', error))
            .finally(() => {
                element.classList.remove('processing'); // حذف حالت پردازش
            });
        }
    
        function removeOppositeAction(element) {
            const action = element.getAttribute('data-action');
            
            if ( !['like', 'dislike'].includes(action) ) return;
            
            let oppositeAction = action === 'like' ? 'dislike' : 'like';
    
            let secondElement = elementElements.querySelector(`.count-action__item[data-action="${oppositeAction}"]`);
    
            if (secondElement && secondElement.classList.contains('active')) {
                secondElement.classList.remove('active');
    
                let countSpan = secondElement.querySelector('span');
                let currentCount = parseInt(countSpan.innerText);
                countSpan.innerText = Math.max(0, currentCount - 1);
            }
        }
    });

    /**
     * Side Modals handle
     *
     * Used for show and hide modal aside.
     */
    elements = document.querySelectorAll('.mi-modal__toggle');

    if (elements.length) {
        elements.forEach(element => {
            let modal_id = element.getAttribute('data-modal');

            if (!modal_id) {
                console.error('Target modal not found!');
                return; // Exit if no modal ID
            }

            const modal = document.getElementById(modal_id);
            if (!modal) {
                console.error(`Modal with ID "${modal_id}" not found!`);
                return; // Exit if modal element not found
            }

            element.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent immediate closing
                modal.classList.toggle('active');
            });

            modal.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent closing when clicking inside
            });
        });

        // Single event listener for the whole document (performance improvement)
        document.addEventListener('click', function (event) {
            document.querySelectorAll('.mi-modal-side.active').forEach(activeModal => {
                if (!activeModal.contains(event.target)) {
                    activeModal.classList.remove('active');
                }
            });
        });
    }

    /**
     * Action button copy element have link attribute
     */
    const action_button = document.querySelectorAll('.action-button > div, .action-button .have-data-link');
    
    if (action_button.length) {

        action_button.forEach(element => {
            element.addEventListener('click', function() {

                // For link action
                const link = this.getAttribute('data-link');
                if (link) {
                    navigator.clipboard.writeText(link);                
                } else {
                    console.info('link not found.');
                }

                element.classList.add('show-tooltip');
                setTimeout(() => {
                    element.classList.remove('show-tooltip')
                }, 1500);

            });
        });
    }
    
    /**
     * Toggle wishlist
     * 
     * Add post id to wishlist
     */
    document.querySelectorAll('.action-button__wishlist').forEach((button) => {
        button.addEventListener("click", function() {

            let postID = this.getAttribute("data-id");
            let action = this.getAttribute("data-action");

            fetch(mi_ajax_object.ajax_url, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'mi_toggle_wishlist',
                    post_id: postID,
                    action_type: action,
                    security: mi_ajax_object.security
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.setAttribute("data-action", data.data.action);

                    // Hide after remove if remove action .
                    if (data.data.action === 'add' && this.getAttribute("data-action-hide")) {
                        this.closest('.item').style.display = 'none';
                    }                    
                }
            });
        });
    });

    /**
     * Manage quantity Add to cart input.
     * Use in Product type.
     */
    function updateQuantityButtons() {
        const quantityInputs = document.querySelectorAll('.quantity input');
        const minusButtons = document.querySelectorAll('.quantity-btn-minus');
        const plusButtons = document.querySelectorAll('.quantity-btn-plus');
    
        if (quantityInputs.length > 0) {
            quantityInputs.forEach((input, index) => {
                let newInput = input.cloneNode(true);
                input.replaceWith(newInput);
    
                plusButtons[index].addEventListener('click', function () {
                    let value = parseInt(newInput.value, 10);
                    if (!isNaN(value)) {
                        value += 1;
                        newInput.value = value;
                        newInput.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
    
                minusButtons[index].addEventListener('click', function () {
                    let value = parseInt(newInput.value, 10);
                    if (!isNaN(value) && value > parseInt(newInput.min, 10)) {
                        value -= 1;
                        newInput.value = value;
                        newInput.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        }
    } updateQuantityButtons();
    
    // in Cart page update cart Ajax button
    jQuery(document.body).on('updated_wc_div', function () {
        updateQuantityButtons();
    });
    
    /**
     * Slide on gallery card.
     * 
     * Used in card with gallery and single product gallery
     */
    const productCards = document.querySelectorAll('.mi-product-card__item');

    productCards.forEach(function (card) {

        const mainImage     = card.querySelector('.mi-product-card__image img');
        const thumbnails    = card.querySelectorAll('.mi-product-card__gallery-thumbnails .thumbnail img');
        const colors        = card.querySelectorAll('.mi-product-card__color-options .color-circle');
        const prevButton    = card.querySelector('.prev-button');
        const nextButton    = card.querySelector('.next-button');

        let currentIndex = 0;
        let color_currentIndex = 0;

        function updateMainImage(index) {
            const newSrc = thumbnails[index].getAttribute('src');
            mainImage.setAttribute('src', newSrc);
            mainImage.setAttribute('srcset', newSrc);
            currentIndex = index;
        }

        // Update by color
        function updateMainImageByColor(index) {
            const newSrc = colors[index].getAttribute('data-image-src');
            mainImage.setAttribute('src', newSrc);
            mainImage.setAttribute('srcset', newSrc);
            color_currentIndex = index;
        }

        // Update by color
        function updateColorOption(index) {
            colors.forEach((color) => color.classList.remove('active') );
            colors[index].classList.add('active');
        }

        if (mainImage) {            

            // Update with gallery image
            if (thumbnails.length > 0) {
                thumbnails.forEach((thumbnail, index) => {
                    thumbnail.addEventListener('click', function (event) {

                        event.preventDefault();

                        thumbnails.forEach((thumbnail) => thumbnail.closest('.thumbnail').classList.remove('active'));
                        thumbnail.closest('.thumbnail').classList.add('active');

                        updateMainImage(index);
                    });
                });
            }

            // Update with color attribute
            if (colors.length > 0) {
                colors.forEach((color, index) => {
                    color.addEventListener('click', function () {
                        updateMainImageByColor(index);
                        updateColorOption(index);
                    });
                });
            }

            if (prevButton) {
                prevButton.addEventListener('click', function (event) {                
                    event.preventDefault();

                    if ( thumbnails.length > 0 ) {
                        currentIndex = (currentIndex > 0) ? currentIndex - 1 : thumbnails.length - 1;
                        updateMainImage(currentIndex);
                    }
                    else if (colors.length > 0) {
                        color_currentIndex = (color_currentIndex > 0) ? color_currentIndex - 1 : colors.length - 1;
                        updateMainImageByColor(color_currentIndex);
                        updateColorOption(color_currentIndex);
                    }
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function (event) {
                    event.preventDefault();

                    if ( thumbnails.length > 0 ) {
                        currentIndex = (currentIndex < thumbnails.length - 1) ? currentIndex + 1 : 0;
                        updateMainImage(currentIndex);
                    }
                    else if (colors.length > 0) {
                        color_currentIndex = (color_currentIndex < colors.length - 1) ? color_currentIndex + 1 : 0;
                        updateMainImageByColor(color_currentIndex);
                        updateColorOption(color_currentIndex);
                    }
                });
            }
        }
    });

    /**
     * Handle ux navigations in Mobile screen.
     * 
     * Used Nav menus widgets
     */
    const mobileNavMedia = window.matchMedia('(max-width: 1023.98px)');

    document.querySelectorAll('.elementor-widget-dp-nav-menu .menu-item-has-children > a').forEach(function(item) {
        item.addEventListener('click', function(event) {
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