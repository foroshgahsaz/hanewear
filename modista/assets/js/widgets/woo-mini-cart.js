document.addEventListener("DOMContentLoaded", function () {
    
    jQuery(document).on("added_to_cart", function () {
        updateMiniCart();
    });

    document.querySelector(".mi-mini-cart__result").addEventListener("click", function (e) {
        let removeButton = e.target.closest(".mi-remove-from-cart");
        if (!removeButton) return;

        e.preventDefault();
        let cartKey = removeButton.dataset.cartKey;

        fetch(wc_add_to_cart_params.ajax_url, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                action: "mi_remove_cart_item",
                cart_key: cartKey
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let cartItem = document.querySelector(`div[data-cart-key="${cartKey}"]`);
                if (cartItem) {
                    cartItem.closest("li").style.transition = "opacity 0.3s";
                    cartItem.closest("li").style.opacity = "0";
                    setTimeout(() => cartItem.closest("li").remove(), 300);
                }
                updateMiniCart(); // آپدیت سبد خرید بعد از حذف آیتم
            }
        })
        .catch(error => console.error("Error:", error));
    });

    function updateMiniCart() {
        fetch(wc_add_to_cart_params.ajax_url, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                action: "woocommerce_get_refreshed_fragments"
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.fragments) {
                document.querySelector(".mi-mini-cart__result").innerHTML = data.fragments["div.widget_shopping_cart_content"];
            }
        })
        .catch(error => console.error("Error:", error));
    }
});

document.addEventListener("DOMContentLoaded", function () {

    let debounceTimer;

    document.body.addEventListener("click", function (e) {
        let increaseBtn = e.target.closest(".quantity-btn-plus");
        let decreaseBtn = e.target.closest(".quantity-btn-minus");

        if (increaseBtn || decreaseBtn) {
            e.preventDefault();

            let inputField = increaseBtn 
                ? increaseBtn.parentElement.querySelector(".mini-cart__quantity-value")
                : decreaseBtn.parentElement.querySelector(".mini-cart__quantity-value");
                
            let newQuantity = parseInt(inputField.value);

            /**
             * Canibal issues, with same function in frontend.js
             */
            // if (increaseBtn) newQuantity++;
            // if (decreaseBtn && newQuantity > 1) newQuantity--;

            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                triggerCartUpdate(inputField.dataset.cartKey, newQuantity);
            }, 500);
        }
    });

    function triggerCartUpdate(cartKey, quantity) {
        fetch(wc_add_to_cart_params.ajax_url, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                action: "mi_update_cart_item",
                cart_key: cartKey,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .catch(error => console.error("Error:", error));
    }
});