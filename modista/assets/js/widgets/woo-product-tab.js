document.addEventListener('DOMContentLoaded', function() {
    /**
     * Find all elements with the mi-product-tabs class
     * Used for Woo_Product_Tab widget.
     */
    document.querySelectorAll('.mi-product-tabs').forEach(function (elementTabs) {
        let tabTitle = elementTabs.querySelectorAll('.tab-title');
        let tabContent = elementTabs.querySelectorAll('.tab-content');
        let moreButtons = elementTabs.querySelectorAll('.mi-tab__more-button a');

        tabTitle.forEach((elementTab, index) => {
            elementTab.addEventListener('click', function () {

                // Tabs activation status
                tabTitle.forEach((element) => element.classList.remove('active'));
                elementTab.classList.add('active');

                // More buttons
                if ( moreButtons.length ) {
                    moreButtons.forEach((element) => element.classList.add('d-none'));
                    // If button exists
                    let activeButton = elementTabs.querySelector(`.mi-tab__more-button .more-tab-${index}`)
                    if (activeButton) {
                        activeButton.classList.remove('d-none');
                    }
                }

                // Slider content
                tabContent.forEach((element) => element.classList.add('d-none'));
                tabContent[index].classList.remove('d-none');
            });
        })
    });
});
