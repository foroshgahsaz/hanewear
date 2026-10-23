<?php
get_header();

    global $redux_mi_theme;

    if ($redux_mi_theme) {
        $selected_section_ID = $redux_mi_theme['mi_404_section_id'] ?? false;
        \Modista\Classes\PostType_Modista_Library::load($selected_section_ID);
    } else {
        ?>
        <div class="w-100 py-16">
            <p class="fs-8 text-center">404</p>
        </div>
        <?php
    }

get_footer();