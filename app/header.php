<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Xequence
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-dark-900 text-gray-100 font-sans'); ?>>
<?php wp_body_open(); ?>

<header class="sticky top-0 z-50 w-full bg-dark-900/80 backdrop-blur-md border-b border-gray-800">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                <div class="flex items-center bg-dark-900 rounded-xl">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="' . get_bloginfo('name') . '" class="w-8 h-8">';
                    }
                    ?>
                    <span class="ml-2 font-mono font-bold text-xl text-white"><?php bloginfo('name'); ?></span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex items-center space-x-6',
                        'fallback_cb'    => false,
                        'walker'         => new Xequence_Nav_Walker(),
                    )
                );
                ?>
            </nav>

            <!-- CTA Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="<?php echo get_theme_mod('header_login_url', '#'); ?>" class="text-gray-300 hover:text-white transition-colors">
                    <?php echo get_theme_mod('header_login_text', 'Log in'); ?>
                </a>
                <a href="<?php echo get_theme_mod('header_signup_url', '#'); ?>" class="inline-flex items-center bg-primary-600 hover:bg-primary-500 text-white px-4 py-2 rounded-lg transition-colors">
                    <?php echo get_theme_mod('header_signup_text', 'Sign up'); ?>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" class="md:hidden text-gray-300 focus:outline-none">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobile-menu" class="md:hidden hidden bg-dark-900 border-b border-gray-800">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex flex-col space-y-4">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'mobile-menu',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col space-y-4',
                        'fallback_cb'    => false,
                        'walker'         => new Xequence_Mobile_Nav_Walker(),
                    )
                );
                ?>
            </nav>
            <div class="mt-6 space-y-3">
                <a href="<?php echo get_theme_mod('header_login_url', '#'); ?>" class="block w-full text-center border border-gray-700 text-gray-300 hover:text-white px-4 py-2 rounded-lg transition-colors">
                    <?php echo get_theme_mod('header_login_text', 'Log in'); ?>
                </a>
                <a href="<?php echo get_theme_mod('header_signup_url', '#'); ?>" class="block w-full text-center bg-primary-600 hover:bg-primary-500 text-white px-4 py-2 rounded-lg transition-colors">
                    <?php echo get_theme_mod('header_signup_text', 'Sign up'); ?>
                </a>
            </div>
        </div>
    </div>
</header>

<div id="content" class="site-content">
