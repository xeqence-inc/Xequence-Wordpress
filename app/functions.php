<?php
/**
 * Xequence WordPress Theme functions and definitions
 *
 * @package Xequence
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Define constants
 */
define('XEQUENCE_VERSION', '1.0.0');
define('XEQUENCE_DIR', get_template_directory());
define('XEQUENCE_URI', get_template_directory_uri());

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function xequence_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary Menu', 'xequence'),
            'footer-1' => esc_html__('Footer Menu 1', 'xequence'),
            'footer-2' => esc_html__('Footer Menu 2', 'xequence'),
            'footer-3' => esc_html__('Footer Menu 3', 'xequence'),
            'footer-4' => esc_html__('Footer Menu 4', 'xequence'),
        )
    );

    // Switch default core markup to output valid HTML5.
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add support for custom logo.
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'xequence_setup');

/**
 * Register widget area.
 */
function xequence_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'xequence'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'xequence'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'xequence_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function xequence_scripts() {
    // Enqueue Tailwind CSS
    wp_enqueue_style('xequence-tailwind', XEQUENCE_URI . '/assets/css/tailwind.css', array(), XEQUENCE_VERSION);
    
    // Enqueue main stylesheet
    wp_enqueue_style('xequence-style', get_stylesheet_uri(), array(), XEQUENCE_VERSION);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap', array(), null);
    
    // Enqueue main JavaScript file
    wp_enqueue_script('xequence-main', XEQUENCE_URI . '/assets/js/main.js', array('jquery'), XEQUENCE_VERSION, true);

    // If comments are open or we have at least one comment, load the comment-reply script.
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'xequence_scripts');

/**
 * Custom template tags for this theme.
 */
require XEQUENCE_DIR . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require XEQUENCE_DIR . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require XEQUENCE_DIR . '/inc/customizer.php';

/**
 * Load custom widgets.
 */
require XEQUENCE_DIR . '/inc/widgets.php';

/**
 * Load custom shortcodes.
 */
require XEQUENCE_DIR . '/inc/shortcodes.php';

/**
 * Load custom blocks.
 */
require XEQUENCE_DIR . '/inc/blocks.php';

/**
 * Load custom post types.
 */
require XEQUENCE_DIR . '/inc/post-types.php';

/**
 * Load custom taxonomies.
 */
require XEQUENCE_DIR . '/inc/taxonomies.php';

/**
 * Load custom meta boxes.
 */
require XEQUENCE_DIR . '/inc/meta-boxes.php';

/**
 * Load custom admin functions.
 */
require XEQUENCE_DIR . '/inc/admin.php';

/**
 * Load custom frontend functions.
 */
require XEQUENCE_DIR . '/inc/frontend.php';

/**
 * Load custom API functions.
 */
require XEQUENCE_DIR . '/inc/api.php';

/**
 * Load custom helper functions.
 */
require XEQUENCE_DIR . '/inc/helpers.php';
