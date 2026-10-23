document.addEventListener('DOMContentLoaded', function () {
    // Used for inputs need used media uploader.
    document.querySelectorAll('.mi-media-select-image').forEach((element) => {
        element.querySelector('button').addEventListener('click', (event) => {
            event.preventDefault();
            mi_insert_selected_media(element)
        } );
    });

    // Used for inputs need used grouped media uploader.
    document.querySelectorAll('.mi-media-select-image-group').forEach((element) => {
        element.querySelector('button').addEventListener('click', (event) => {
            event.preventDefault();
            mi_insert_selected_media(element, true)
        } );
    });
    
    const mi_insert_selected_media = (element, multiple = false) => {
        
        let mediaUploader = wp.media({
            multiple: multiple,
            library: { type: 'image' }, 
        });

        mediaUploader.on('select', function() {

            let attachment = mediaUploader.state().get('selection').toJSON();

            // Single media select
            if ( multiple === false ) {                
                element.querySelector('input').value = attachment[0].url;
            } else { // Multiple media select
                let imageUrls = [];
                attachment.forEach((attachment) => imageUrls.push(attachment.url));
                element.querySelector('input').value = imageUrls.join(', ');
            }
        });
        
        mediaUploader.open();
    }

    /**
     * Repeatre
     * 
     * Add item to reapeter Listener
     */
    document.querySelectorAll('.mi-media-select-image-repeater').forEach((element) => {
        element.querySelector('button.upload-gallery-image').addEventListener('click', (event) => {
            event.preventDefault();
            mi_repeater_append_selected_media(element, true)
        });
    });

    /**
     * Repeatre
     * 
     * Add item to reapeter
     */
    const mi_repeater_append_selected_media = (element, multiple = false) => {
        
        let galleryContainer = element.querySelector('.menu-gallery-list');
        let galleryItems = galleryContainer.querySelectorAll('li');
        let menuItemId = element.getAttribute('data-id');
        let menuFieldName = element.getAttribute('data-name');

        let mediaUploader = wp.media({
            multiple: multiple,
            library: { type: 'image' }, 
        });

        mediaUploader.on('select', function() {

            let attachment = mediaUploader.state().get('selection').toJSON();

            // Multiple media select
            attachment.forEach((attachment, index) => {

                index = galleryItems.length ? index + galleryItems.length : index;
                
                let repeaterItem = document.createElement('li');
                repeaterItem.innerHTML = `
                    <img src="${attachment.url}" width="50" height="50" style="object-fit:contain;">
                    <input type="hidden" name="${menuFieldName}[${menuItemId}][${index}]" value="${attachment.url}">
                    <input type="text" class="flex-1" name="${menuFieldName}_links[${menuItemId}][${index}]" placeholder="لینک تصویر">
                    <button type="button" class="remove-gallery-image">×</button>
                `;
                repeaterItem.classList.add("d-flex", "align-items-center", "gap-2", "p-3");

                galleryContainer.appendChild(repeaterItem);
            });

        });
        
        mediaUploader.open();
    }

    /**
     * Repeatre
     * 
     * Remove item from repeater
     */
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-gallery-image")) {
            event.preventDefault();
            event.target.closest("li").remove();
        }
    });
});

