<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="woocommerce-auth-form d-flex flex-column gap-8" id="customer_login">

    <h2 class="title text-center fw-800"><?php esc_html_e( 'ورود به پنل کاربری', 'modista' ); ?></h2>

    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    <div class="tab d-flex align-self-center gap-4 py-2 px-4 rounded-4">
        <button <?php echo isset($_GET['reset-link-sent']) ?: 'class="active"'; ?> data-tab="tab-content-1"
            data-title="<?php esc_html_e( 'ورود به پنل کاربری', 'modista' ); ?>">
            <?php esc_html_e( 'Login', 'woocommerce' ); ?>
        </button>
        <button data-tab="tab-content-2" data-title="<?php esc_html_e( 'ثبت نام  در پنل کاربری', 'modista' ); ?>">
            <?php esc_html_e( 'Register', 'woocommerce' ); ?>
        </button>
    </div>

    <div class="tab-content tab-content-1<?php echo isset($_GET['reset-link-sent']) ? ' d-none' : ''; ?>">

        <?php endif; ?>

        <form class="woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <p class="input-field mb-3">
                <label for="username">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.4816 5.82475 21.7706 6.69989 21.8985 8"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M18 8L15.8411 9.79908C14.0045 11.3296 13.0861 12.0949 12 12.0949C11.3507 12.0949 10.7614 11.8214 10 11.2744M6 8L6.9 8.75L7.8 9.5"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                </label>
                <input type="text" placeholder="نام کاربری وارد کنید"
                    class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username"
                    autocomplete="username"
                    value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
                    required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
            </p>
            <p class="input-field">
                <label for="password">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M9 16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16C7 15.4477 7.44772 15 8 15C8.55228 15 9 15.4477 9 16Z"
                            fill="#989898" />
                        <path
                            d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16Z"
                            fill="#989898" />
                        <path
                            d="M17 16C17 16.5523 16.5523 17 16 17C15.4477 17 15 16.5523 15 16C15 15.4477 15.4477 15 16 15C16.5523 15 17 15.4477 17 16Z"
                            fill="#989898" />
                        <path
                            d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                </label>
                <input type="password" name="password" id="password" autocomplete="current-password" required
                    aria-required="true" placeholder="رمزعبور خود را وارد کنید" />
                <span class="password-show d-flex cursor-pointer ps-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M9 4.45962C9.91153 4.16968 10.9104 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C3.75612 8.07914 4.32973 7.43025 5 6.82137"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="#989898" stroke-width="1.5" />
                    </svg>
                </span>
            </p>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <p class="form-row">
                <label class="d-flex py-2 gap-1">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                        type="checkbox" id="rememberme" value="forever" />
                    <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                </label>
                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                <button type="submit"
                    class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                    name="login"
                    value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
            </p>
            <p class="tab pt-2 default">
                <button data-tab="tab-content-3" data-title="<?php esc_html_e( 'فراموشی رمز عبور', 'modista' ); ?>">
                    <?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?>
                </button>
            </p>

            <?php do_action( 'woocommerce_login_form_end' ); ?>

        </form>

        <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    </div>

    <div class="tab-content tab-content-2 d-none">

        <form method="post" class="woocommerce-form woocommerce-form-register register"
            <?php do_action( 'woocommerce_register_form_tag' ); ?>>

            <?php do_action( 'woocommerce_register_form_start' ); ?>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

            <p class="input-field mb-3">
                <label for="reg_username">
                    <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                </label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                    id="reg_username" autocomplete="username"
                    value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
                    required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
            </p>

            <?php endif; ?>

            <p class="input-field mb-3">
                <label for="reg_email">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.4816 5.82475 21.7706 6.69989 21.8985 8"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M18 8L15.8411 9.79908C14.0045 11.3296 13.0861 12.0949 12 12.0949C11.3507 12.0949 10.7614 11.8214 10 11.2744M6 8L6.9 8.75L7.8 9.5"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                </label>
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
                    id="reg_email" autocomplete="email" placeholder="ایمیل"
                    value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"
                    required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
            </p>

            <p class="input-field mb-3">
                <label for="reg_phone">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M14 2C14 2 16.2 2.2 19 5C21.8 7.8 22 10 22 10" stroke="#989898" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path
                            d="M14.207 5.53564C14.207 5.53564 15.197 5.81849 16.6819 7.30341C18.1668 8.78834 18.4497 9.77829 18.4497 9.77829"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M4.00655 7.93309C3.93421 9.84122 4.41713 13.0817 7.6677 16.3323C8.45191 17.1165 9.23553 17.7396 10 18.2327M5.53781 4.93723C6.93076 3.54428 9.15317 3.73144 10.0376 5.31617L10.6866 6.4791C11.2723 7.52858 11.0372 8.90532 10.1147 9.8278C10.1147 9.8278 10.1147 9.8278 10.1147 9.8278C10.1146 9.82792 8.99588 10.9468 11.0245 12.9755C13.0525 15.0035 14.1714 13.8861 14.1722 13.8853C14.1722 13.8853 14.1722 13.8853 14.1722 13.8853C15.0947 12.9628 16.4714 12.7277 17.5209 13.3134L18.6838 13.9624C20.2686 14.8468 20.4557 17.0692 19.0628 18.4622C18.2258 19.2992 17.2004 19.9505 16.0669 19.9934C15.2529 20.0243 14.1963 19.9541 13 19.6111"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                </label>
                <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text text-right" name="reg_phone"
                    id="reg_phone" autocomplete="phone" placeholder="شماره تماس"
                    value="<?php echo ( ! empty( $_POST['reg_phone'] ) ) ? esc_attr( $_POST['reg_phone'] ) : ''; ?>"
                    required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
            </p>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

            <p class="input-field">
                <label for="reg_password">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M9 16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16C7 15.4477 7.44772 15 8 15C8.55228 15 9 15.4477 9 16Z"
                            fill="#989898" />
                        <path
                            d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16Z"
                            fill="#989898" />
                        <path
                            d="M17 16C17 16.5523 16.5523 17 16 17C15.4477 17 15 16.5523 15 16C15 15.4477 15.4477 15 16 15C16.5523 15 17 15.4477 17 16Z"
                            fill="#989898" />
                        <path
                            d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                </label>
                <input type="password" name="password" id="reg_password" autocomplete="new-password" required
                    aria-required="true" placeholder="پسورد" />
                <span class="password-show d-flex cursor-pointer ps-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M9 4.45962C9.91153 4.16968 10.9104 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C3.75612 8.07914 4.32973 7.43025 5 6.82137"
                            stroke="#989898" stroke-width="1.5" stroke-linecap="round" />
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="#989898" stroke-width="1.5" />
                    </svg>
                </span>
            </p>

            <?php else : ?>

            <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?>
            </p>

            <?php endif; ?>

            <?php do_action( 'woocommerce_register_form' ); ?>

            <p class="woocommerce-form-row form-row">
                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                <button type="submit"
                    class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit"
                    name="register"
                    value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
            </p>

            <?php do_action( 'woocommerce_register_form_end' ); ?>

        </form>

    </div>

    <?php endif; ?>

    <div class="tab-content tab-content-3<?php echo isset($_GET['reset-link-sent']) ? '' : ' d-none'; ?>">

        <?php
        if (function_exists('wc_print_notices')) {
            wc_print_notices();
        }

        $lost_template = 'form-lost-password';

        if (!empty($_GET['reset-link-sent'])) {
            $lost_template = 'lost-password-confirmation';
        } 

        wc_get_template('myaccount/' . $lost_template . '.php');
        ?>

    </div>


</div>

<?php do_action( 'woocommerce_after_customer_login_form' );