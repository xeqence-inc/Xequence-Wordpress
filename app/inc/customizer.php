<?php
/**
 * Xequence Theme Customizer
 *
 * @package Xequence
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function xequence_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'xequence_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'xequence_customize_partial_blogdescription',
            )
        );
    }

    // Header Section
    $wp_customize->add_section(
        'xequence_header_section',
        array(
            'title'    => __('Header Settings', 'xequence'),
            'priority' => 30,
        )
    );

    // Header Login URL
    $wp_customize->add_setting(
        'header_login_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'header_login_url',
        array(
            'label'    => __('Login URL', 'xequence'),
            'section'  => 'xequence_header_section',
            'type'     => 'url',
        )
    );

    // Header Login Text
    $wp_customize->add_setting(
        'header_login_text',
        array(
            'default'           => 'Log in',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'header_login_text',
        array(
            'label'    => __('Login Text', 'xequence'),
            'section'  => 'xequence_header_section',
            'type'     => 'text',
        )
    );

    // Header Signup URL
    $wp_customize->add_setting(
        'header_signup_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'header_signup_url',
        array(
            'label'    => __('Signup URL', 'xequence'),
            'section'  => 'xequence_header_section',
            'type'     => 'url',
        )
    );

    // Header Signup Text
    $wp_customize->add_setting(
        'header_signup_text',
        array(
            'default'           => 'Sign up',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'header_signup_text',
        array(
            'label'    => __('Signup Text', 'xequence'),
            'section'  => 'xequence_header_section',
            'type'     => 'text',
        )
    );

    // Hero Section
    $wp_customize->add_section(
        'xequence_hero_section',
        array(
            'title'    => __('Hero Settings', 'xequence'),
            'priority' => 40,
        )
    );

    // Hero Subtitle
    $wp_customize->add_setting(
        'hero_subtitle',
        array(
            'default'           => 'The next generation social platform for developers, launching August 2025.',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'hero_subtitle',
        array(
            'label'    => __('Hero Subtitle', 'xequence'),
            'section'  => 'xequence_hero_section',
            'type'     => 'text',
        )
    );

    // Hero Primary Button Text
    $wp_customize->add_setting(
        'hero_button_primary_text',
        array(
            'default'           => 'Get Started',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'hero_button_primary_text',
        array(
            'label'    => __('Primary Button Text', 'xequence'),
            'section'  => 'xequence_hero_section',
            'type'     => 'text',
        )
    );

    // Hero Primary Button URL
    $wp_customize->add_setting(
        'hero_button_primary_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'hero_button_primary_url',
        array(
            'label'    => __('Primary Button URL', 'xequence'),
            'section'  => 'xequence_hero_section',
            'type'     => 'url',
        )
    );

    // Hero Secondary Button Text
    $wp_customize->add_setting(
        'hero_button_secondary_text',
        array(
            'default'           => 'Learn More',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'hero_button_secondary_text',
        array(
            'label'    => __('Secondary Button Text', 'xequence'),
            'section'  => 'xequence_hero_section',
            'type'     => 'text',
        )
    );

    // Hero Secondary Button URL
    $wp_customize->add_setting(
        'hero_button_secondary_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'hero_button_secondary_url',
        array(
            'label'    => __('Secondary Button URL', 'xequence'),
            'section'  => 'xequence_hero_section',
            'type'     => 'url',
        )
    );

    // Features Section
    $wp_customize->add_section(
        'xequence_features_section',
        array(
            'title'    => __('Features Settings', 'xequence'),
            'priority' => 50,
        )
    );

    // Features Title
    $wp_customize->add_setting(
        'features_title',
        array(
            'default'           => 'Powerful Features for Developers',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'features_title',
        array(
            'label'    => __('Features Title', 'xequence'),
            'section'  => 'xequence_features_section',
            'type'     => 'text',
        )
    );

    // Features Subtitle
    $wp_customize->add_setting(
        'features_subtitle',
        array(
            'default'           => 'Everything you need to connect, share, and grow with the developer community.',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'features_subtitle',
        array(
            'label'    => __('Features Subtitle', 'xequence'),
            'section'  => 'xequence_features_section',
            'type'     => 'text',
        )
    );

    // CTA Section
    $wp_customize->add_section(
        'xequence_cta_section',
        array(
            'title'    => __('CTA Settings', 'xequence'),
            'priority' => 60,
        )
    );

    // CTA Badge
    $wp_customize->add_setting(
        'cta_badge',
        array(
            'default'           => 'LAUNCHING AUGUST 2025',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'cta_badge',
        array(
            'label'    => __('CTA Badge Text', 'xequence'),
            'section'  => 'xequence_cta_section',
            'type'     => 'text',
        )
    );

    // CTA Title
    $wp_customize->add_setting(
        'cta_title',
        array(
            'default'           => 'Ready to join the revolution?',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'cta_title',
        array(
            'label'    => __('CTA Title', 'xequence'),
            'section'  => 'xequence_cta_section',
            'type'     => 'text',
        )
    );

    // CTA Description
    $wp_customize->add_setting(
        'cta_description',
        array(
            'default'           => 'Be among the first to experience the future of developer collaboration.',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'cta_description',
        array(
            'label'    => __('CTA Description', 'xequence'),
            'section'  => 'xequence_cta_section',
            'type'     => 'textarea',
        )
    );

    // CTA Button Text
    $wp_customize->add_setting(
        'cta_button_text',
        array(
            'default'           => 'Join the Waitlist',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'cta_button_text',
        array(
            'label'    => __('CTA Button Text', 'xequence'),
            'section'  => 'xequence_cta_section',
            'type'     => 'text',
        )
    );

    // CTA Button URL
    $wp_customize->add_setting(
        'cta_button_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'cta_button_url',
        array(
            'label'    => __('CTA Button URL', 'xequence'),
            'section'  => 'xequence_cta_section',
            'type'     => 'url',
        )
    );

    // Footer Section
    $wp_customize->add_section(
        'xequence_footer_section',
        array(
            'title'    => __('Footer Settings', 'xequence'),
            'priority' => 70,
        )
    );

    // Footer Description
    $wp_customize->add_setting(
        'footer_description',
        array(
            'default'           => 'The next generation social platform for developers. Connect, share, and build together.',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'footer_description',
        array(
            'label'    => __('Footer Description', 'xequence'),
            'section'  => 'xequence_footer_section',
            'type'     => 'textarea',
        )
    );

    // Footer Column Titles
    $columns = array(
        'col1' => 'Product',
        'col2' => 'Resources',
        'col3' => 'Company',
        'col4' => 'Legal',
    );

    foreach ($columns as $key => $default) {
        $wp_customize->add_setting(
            'footer_' . $key . '_title',
            array(
                'default'           => $default,
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'footer_' . $key . '_title',
            array(
                'label'    => sprintf(__('Footer %s Title', 'xequence'), ucfirst($key)),
                'section'  => 'xequence_footer_section',
                'type'     => 'text',
            )
        );
    }

    // Newsletter Settings
    $wp_customize->add_setting(
        'newsletter_title',
        array(
            'default'           => 'Subscribe to our newsletter',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'newsletter_title',
        array(
            'label'    => __('Newsletter Title', 'xequence'),
            'section'  => 'xequence_footer_section',
            'type'     => 'text',
        )
    );

    $wp_customize->add_setting(
        'newsletter_description',
        array(
            'default'           => 'Get the latest updates and articles delivered straight to your inbox.',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'newsletter_description',
        array(
            'label'    => __('Newsletter Description', 'xequence'),
            'section'  => 'xequence_footer_section',
            'type'     => 'textarea',
        )
    );

    // Social Media Links
    $social_platforms = array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'github'    => 'GitHub',
        'linkedin'  => 'LinkedIn',
        'instagram' => 'Instagram',
    );

    foreach ($social_platforms as $key => $label) {
        $wp_customize->add_setting(
            'social_' . $key,
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            'social_' . $key,
            array(
                'label'    => $label . ' URL',
                'section'  => 'xequence_footer_section',
                'type'     => 'url',
            )
        );
    }

    // Blog Settings
    $wp_customize->add_section(
        'xequence_blog_section',
        array(
            'title'    => __('Blog Settings', 'xequence'),
            'priority' => 80,
        )
    );

    // Blog Description
    $wp_customize->add_setting(
        'blog_description',
        array(
            'default'           => 'Insights, updates, and stories from the Xequence team',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'blog_description',
        array(
            'label'    => __('Blog Description', 'xequence'),
            'section'  => 'xequence_blog_section',
            'type'     => 'textarea',
        )
    );
}
add_action('customize_register', 'xequence_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function xequence_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function xequence_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function xequence_customize_preview_js() {
    wp_enqueue_script('xequence-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), XEQUENCE_VERSION, true);
}
add_action('customize_preview_init', 'xequence_customize_preview_js');
