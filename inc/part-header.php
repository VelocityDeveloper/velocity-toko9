<div class="container bg-white">
    <?php if (has_header_image()) : ?>
        <div class="haeder-images">
            <?php
            echo '<a class="d-block" href="' . get_home_url() . '">';
            echo '<img class="w-100" src="' . esc_url(get_header_image()) . '" />';
            echo '</a>';
            ?>
        </div>
    <?php endif; ?>
</div>

<div class="container bg-white">
    <?php require_once(get_stylesheet_directory() . '/inc/part-headertop.php'); ?>
</div>

<div class="container bg-white px-0">
    <nav id="main-nav" class="navbar navbar-expand-md d-block navbar-light p-0" aria-labelledby="main-nav-label">

        <h2 id="main-nav-label" class="screen-reader-text">
            <?php esc_html_e('Main Navigation', 'justg'); ?>
        </h2>

        <button class="navbar-toggler text-start text-white w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
            <span class="navbar-toggler-icon bg-light pe-2"></span> Menu
        </button>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

            <div class="offcanvas-header justify-content-end">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!-- The WordPress Menu goes here -->
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                    'container_class' => 'offcanvas-body',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 pe-3',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 4,
                    'walker'          => new justg_WP_Bootstrap_Navwalker(),
                )
            );
            ?>
        </div><!-- .offcanvas -->
    </nav>
</div>