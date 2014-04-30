<?php
/**
 * smartshop Theme Customizer
 *
 * @package smartshop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function smartshop_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}

add_action('customize_register', 'smartshop_customize_register', 12);

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function smartshop_customize_preview_js() {
    wp_enqueue_script('smartshop_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20130508', true);
}

add_action('customize_preview_init', 'smartshop_customize_preview_js');

function smartshop_customizer($wp_customize) {

    class smartshop_customize_textarea_control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>

            <?php
        }

    }

    // Add new section for theme layout and color schemes
    $wp_customize->add_section('smartshop_theme_layout_settings', array(
        'title' => __('Layout & Color Scheme', 'smartshop'),
        'priority' => 30,
    ));

    // Add setting for theme layout
    $wp_customize->add_setting('smartshop_theme_layout', array(
        'default' => 'full-width',
    ));

    $wp_customize->add_control('smartshop_theme_layout', array(
        'label' => 'Theme Layout',
        'section' => 'smartshop_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'full-width' => __('Full Width', 'smartshop'),
            'boxed' => __('Boxed', 'smartshop'),
        ),
    ));

    // Add new setting for color schemes
    $wp_customize->add_setting('smartshop_color_scheme', array(
        'default' => 'red',
    ));

    $wp_customize->add_control('smartshop_color_scheme', array(
        'label' => 'Color schemes',
        'section' => 'smartshop_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'blue' => __('Blue', 'smartshop'),
            'red' => __('Red', 'smartshop'),
            'green' => __('Green', 'smartshop'),
            'gray' => __('Gray', 'smartshop'),
            'purple' => __('Purple', 'smartshop'),
            'orange' => __('Orange', 'smartshop'),
            'brown' => __('Brown', 'smartshop'),
            'pink' => __('Pink', 'smartshop'),
        ),
    ));

	//Add featured products on front page
    if (class_exists('Easy_Digital_Downloads')) {
        $wp_customize->add_section('smartshop_edd_options', array(
            'title' => __('Easy Digital Downloads', 'smartshop'),
            'description' => __('All other EDD options are under Dashboard => Downloads.', 'smartshop'),
            'priority' => 70,
        ));

        // enable featured products on front page?
        $wp_customize->add_setting('smartshop_edd_front_featured_products', array('default' => 0));
        $wp_customize->add_control('smartshop_edd_front_featured_products', array(
            'label' => __('Show featured products on Front Page', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'priority' => 10,
            'type' => 'checkbox',
        ));

        // store front/archive item count
        $wp_customize->add_setting('smartshop_store_front_featured_count', array('default' => 6));
        $wp_customize->add_control('smartshop_store_front_featured_count', array(
            'label' => __('Number of Featured Products', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_store_front_featured_count',
            'priority' => 20,
        ));

        // store front/downloads archive headline
        $wp_customize->add_setting('smartshop_edd_store_archives_title', array('default' => null));
        $wp_customize->add_control('smartshop_edd_store_archives_title', array(
            'label' => __('Store/Download Archives Main Title', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_edd_store_archives_title',
            'priority' => 30,
        ));
        // store front/downloads archive description
        $wp_customize->add_setting('smartshop_edd_store_archives_description', array('default' => null));
        $wp_customize->add_control(new smartshop_customize_textarea_control($wp_customize, 'smartshop_edd_store_archives_description', array(
            'label' => __('Store/Download Archives Description', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_edd_store_archives_description',
            'priority' => 40,
        )));
        // read more link
        $wp_customize->add_setting('smartshop_product_view_details', array('default' => __('View Details', 'smartshop')));
        $wp_customize->add_control('smartshop_product_view_details', array(
            'label' => __('Store Link', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_product_view_details',
            'priority' => 50,
        ));
        // store front/archive item count
        $wp_customize->add_setting('smartshop_store_front_count', array('default' => 9));
        $wp_customize->add_control('smartshop_store_front_count', array(
            'label' => __('Store Item Count', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_store_front_count',
            'priority' => 60,
        ));
    }


    // Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('smartshop_front_page_post_options', array(
        'title' => __('Front Page Featured Posts', 'smartshop'),
        'description' => __('Settings for displaying featured posts on Front Page', 'smartshop'),
        'priority' => 60,
    ));
    // enable featured posts on front page?
    $wp_customize->add_setting('smartshop_front_featured_posts_check', array('default' => 0));
    $wp_customize->add_control('smartshop_front_featured_posts_check', array(
        'label' => __('Show featured posts on Front Page', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    // Front featured posts section headline
    $wp_customize->add_setting('smartshop_front_featured_posts_title', array('default' => __('Latest Posts', 'smartshop')));
    $wp_customize->add_control('smartshop_front_featured_posts_title', array(
        'label' => __('Featured Section Title', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'settings' => 'smartshop_front_featured_posts_title',
        'priority' => 10,
    ));

    // select number of posts for featured posts on front page
    $wp_customize->add_setting('smartshop_front_featured_posts_count', array('default' => 3));
    $wp_customize->add_control('smartshop_front_featured_posts_count', array(
        'label' => __('Number of posts to display', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'settings' => 'smartshop_front_featured_posts_count',
        'priority' => 20,
    ));


    // featured post read more link
    $wp_customize->add_setting('smartshop_front_featured_link_text', array('default' => __('Read more', 'smartshop')));
    $wp_customize->add_control('smartshop_front_featured_link_text', array(
        'label' => __('Posts Read More Link Text', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'settings' => 'smartshop_front_featured_link_text',
        'priority' => 30,
    ));

    // Add footer text section
    $wp_customize->add_section('smartshop_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 70,
    ));

    $wp_customize->add_setting('smartshop_footer_footer_text', array(
        'default' => '',
    ));
    $wp_customize->add_control(new smartshop_customize_textarea_control($wp_customize, 'smartshop_footer_footer_text', array(
        'section' => 'smartshop_footer', // id of section to which the setting belongs
        'settings' => 'smartshop_footer_footer_text',
    )));

    
    // Add custom CSS section
    $wp_customize->add_section('smartshop_custom_css', array(
        'title' => 'Custom CSS', // The title of section
        'priority' => 80,
    ));
    
    $wp_customize->add_setting('smartshop_custom_css');
    
    $wp_customize->add_control(new smartshop_customize_textarea_control($wp_customize, 'smartshop_custom_css', array(
        'section' => 'smartshop_custom_css', // id of section to which the setting belongs
        'settings' => 'smartshop_custom_css', 
    )));
    
    //remove default customizer sections
    $wp_customize->remove_section('background_image'); 
    $wp_customize->remove_section('colors');
}

add_action('customize_register', 'smartshop_customizer', 11);

function smartshop_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true) {
    $return = '';
    $mod = get_theme_mod($mod_name);
    if (!empty($mod)) {
        $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
        );
        if ($echo) {
            echo $return;
        }
    }
    return $return;
}

function smartshop_header_output() {
    ?>
    <!--Customizer CSS--> 
    <style type="text/css">
    <?php smartshop_generate_css('#site-name', 'color', 'title_textcolor', ''); ?>
    <?php smartshop_generate_css('.sidebarwidget a', 'color', 'link_textcolor', ''); ?>
    <?php smartshop_generate_css('.site-logo', 'display', 'name', 'none'); ?>
    <?php echo esc_attr(get_theme_mod('smartshop_custom_css')); ?>
    </style> 
    <!--/Customizer CSS-->
    <?php
}

// Output custom CSS to live site
add_action('wp_head', 'smartshop_header_output');
