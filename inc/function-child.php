<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{

    if (class_exists('Kirki')) :

        Kirki::add_panel('panel_toko9', [
            'priority'    => 10,
            'title'       => esc_html__('Toko 9', 'justg'),
            'description' => esc_html__('', 'justg'),
        ]);

        // section title_tagline
        Kirki::add_section('title_tagline', [
            'panel'    => 'panel_toko9',
            'title'    => __('Site Identity', 'justg'),
            'priority' => 10,
        ]);
        // section title_tagline
        Kirki::add_section('header_image', [
            'panel'    => 'panel_toko9',
            'title'    => __('Header Image', 'justg'),
            'priority' => 10,
        ]);


        ///Section Color
        Kirki::add_section('section_colorweb', [
            'panel'    => 'panel_toko9',
            'title'    => __('Warna', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Background(
            [
                'settings'    => 'background_website',
                'label'       => esc_html__('Background', 'justg'),
                'description' => esc_html__('', 'justg'),
                'section'     => 'section_colorweb',
                'default'     => [
                    'background-color'      => '#ffffff',
                    'background-image'      => '',
                    'background-repeat'     => 'repeat',
                    'background-position'   => 'center center',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                ],
                'transport'   => 'auto',
                'output'      => [
                    [
                        'element'   => ':root[data-bs-theme=light] body',
                    ],
                ],
            ]
        );

        ///Section Home
        Kirki::add_section('section_homeweb', [
            'panel'    => 'panel_toko9',
            'title'    => __('Home', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Repeater(
            [
                'settings' => 'slider_home',
                'label'    => esc_html__('Slider Home', 'justg'),
                'section'  => 'section_homeweb',
                'priority' => 10,
                'row_label'    => [
                    'type'  => 'field',
                    'value' => esc_html__('Slider', 'justg'),
                ],
                'button_label' => esc_html__('Tambah', 'justg'),
                'fields'   => [
                    'imgslider'   => [
                        'type'        => 'image',
                        'label'       => esc_html__('Gambar', 'justg'),
                        'description' => esc_html__('', 'justg'),
                        'default'     => '',
                    ],
                ],
            ]
        );


        // remove panel in customizer 
        Kirki::remove_panel('global_panel');
        Kirki::remove_panel('panel_header');
        Kirki::remove_panel('panel_footer');
        Kirki::remove_control('display_header_text');

    endif;

    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
    remove_theme_support('widgets-block-editor');
}

if (!function_exists('justg_header_open')) {
    function justg_header_open()
    {
        echo '<header id="wrapper-header">';
        echo '<div id="wrapper-navbar" class="px-0" itemscope itemtype="http://schema.org/WebSite">';
    }
}
if (!function_exists('justg_header_close')) {
    function justg_header_close()
    {
        echo '</div>';
        echo '</header>';
    }
}

///add action builder part
add_action('justg_header', 'justg_header_toko9');
function justg_header_toko9()
{
    require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_toko9');
function justg_footer_toko9()
{
    require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

add_action('justg_before_wrapper_content', 'justg_before_wrapper_content');
function justg_before_wrapper_content()
{
    echo '<div class="px-2">';
    echo '<div class="card rounded-0 border-0 p-2 container mx-auto">';
}
add_action('justg_after_wrapper_content', 'justg_after_wrapper_content');
function justg_after_wrapper_content()
{
    echo '</div>';
    echo '</div>';
}

if (!function_exists('justg_right_sidebar_check')) {
    /**
     * Right sidebar check
     * 
     */
    function justg_right_sidebar_check()
    {
        $sidebar_pos            = velocitytheme_option('justg_sidebar_position', 'right');
        $pages_sidebar_pos      = velocitytheme_option('justg_pages_sidebar_position');
        $singular_sidebar_pos   = velocitytheme_option('justg_blogs_sidebar_position');
        $archives_sidebar_pos   = velocitytheme_option('justg_archives_sidebar_position');
        $shop_sidebar_pos       = velocitytheme_option('justg_shop_sidebar_position', 'default');

        if ($sidebar_pos === 'disable') {
            return;
        }

        if (is_page() && !in_array($pages_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $pages_sidebar_pos;
        }

        if (is_singular() && !in_array($singular_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $singular_sidebar_pos;
        }

        if (is_archive() && !in_array($archives_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $archives_sidebar_pos;
        }

        if (is_singular('fl-builder-template')) {
            return;
        }

        if ('right' === $sidebar_pos) {
            if (!is_active_sidebar('main-sidebar') && !has_action('justg_before_main_sidebar') && !has_action('justg_after_main_sidebar')) {
                return;
            }

?>
            <div class="widget-area right-sidebar col-sm-4 order-md-1 order-3" id="right-sidebar" role="complementary">
                <div class="sticky-top">
                    <?php do_action('justg_before_main_sidebar'); ?>
                    <?php dynamic_sidebar('main-sidebar'); ?>
                    <?php do_action('justg_after_main_sidebar'); ?>
                </div>
            </div>
    <?php
        }
    }
}

function vd_limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

remove_action('velocitytoko_product_loop', 'velocitytoko_content_product', 20);
add_action('velocitytoko_product_loop', 'velocitytoko9_content_product', 30);
function velocitytoko9_content_product($post)
{
    ?>
    <article <?php post_class('col-xl-4 col-md-4 col-6 mb-2'); ?> id="post-<?php the_ID(); ?>">
        <div class="card h-100 card-product p-2 overflow-hidden">
            <?php echo do_shortcode("[thumbnail width='200' height='200' crop='false' upscale='true']"); ?>
            <div class="card-body text-center position-relative p-0">
                <a class="d-block my-2 fw-bold " style="min-height:3rem; max-height:4rem; overflow:hidden;" href="<?php echo get_the_permalink(); ?>">
                    <?php echo get_the_title(); ?>
                </a>
                <div class="fw-bold">
                    <?php echo do_shortcode("[harga]"); ?>
                </div>
                <div class="p-3 text-center">
                    <a class="btn btn-sm btn-primary border-theme bg-theme shadow-sm" href="<?php echo get_the_permalink(); ?>">
                        Detail
                    </a>
                    <?php echo do_shortcode("[beli class='btn btn-sm btn-primary border-theme bg-theme shadow-sm']"); ?>
                </div>
            </div>
        </div>
    </article><!-- #post-## -->
<?php
}

// single product
remove_action('velocitytoko_content_single_product', 'velocitytoko_content_single_product', 20);
add_action('velocitytoko_content_single_product', 'velocitytoko_content_single_products', 30);
function velocitytoko_content_single_products($post)
{ ?>
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

        <div class="block-primary">
            <div class="row">
                <div class="col-md-6 col-xl-5">
                    <?php echo do_shortcode('[slider-produk width="350" height="350"]'); ?>
                </div>
                <div class="col-md">
                    <h1 class="fs-4 fw-bold mb-3">
                        <?php echo do_shortcode("[vtoko-title link='true' class='text-dark ' node-cart='cartsingle']"); ?>
                    </h1>
                    <div class="mb-2">
                        <small>
                            Kategori: <?php echo velocitytoko_term_list('category-product', ",", get_the_ID()); ?>
                            | Dilihat: <?php echo do_shortcode('[view]'); ?>
                        </small>
                    </div>
                    <div class="single-harga mb-3">Harga: <?php echo do_shortcode('[harga node-cart="cartsingle"]'); ?></div>
                    <div class="mb-3"><?php echo do_shortcode('[detail-produk]'); ?></div>
                    <div class="mb-3"><?php echo do_shortcode('[beli modal="false" node-cart="cartsingle" text="true"]'); ?></div>
                    <div class="mb-3"><?php echo do_shortcode('[love text="true"]'); ?></div>
                    <div class="mb-3"><?php echo do_shortcode('[beli-lain]'); ?></div>
                    <div class="mb-3"><?php echo do_shortcode('[share]'); ?></div>
                </div>
            </div>
        </div>

        <div class="block-primary pb-3">
            <img src="<?php echo velocitytheme_option('banner_single'); ?>" />
        </div>
        <div class="block-primary pt-2">
            <h6 class="title-single-part fs-5 fw-bold">Detail Produk</h6>
            <div><?php echo get_the_content(); ?></div>
        </div>

    </article><!-- #post-## -->
<?php
}
