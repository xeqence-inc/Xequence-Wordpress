<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Xequence
 */

?>

    </div><!-- #content -->

    <footer class="bg-dark-900 border-t border-gray-800 pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-8 mb-12">
                <!-- Logo and Newsletter -->
                <div class="lg:col-span-2">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center mb-6">
                        <?php 
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="' . get_bloginfo('name') . '" class="w-8 h-8">';
                        }
                        ?>
                        <span class="ml-2 font-mono font-bold text-xl text-white"><?php bloginfo('name'); ?></span>
                    </a>
                    <p class="text-gray-400 mb-6 max-w-md">
                        <?php echo get_theme_mod('footer_description', 'The next generation social platform for developers. Connect, share, and build together.'); ?>
                    </p>
                    <div class="space-y-3">
                        <h4 class="font-medium text-white"><?php echo get_theme_mod('newsletter_title', 'Subscribe to our newsletter'); ?></h4>
                        <?php echo do_shortcode('[newsletter_form]'); ?>
                    </div>
                </div>

                <!-- Footer Links -->
                <div>
                    <h4 class="font-medium text-white mb-4"><?php echo get_theme_mod('footer_col1_title', 'Product'); ?></h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-1',
                            'menu_id'        => 'footer-menu-1',
                            'container'      => false,
                            'menu_class'     => 'space-y-2',
                            'fallback_cb'    => false,
                            'link_before'    => '<span class="text-gray-400 hover:text-primary-400 transition-colors">',
                            'link_after'     => '</span>',
                        )
                    );
                    ?>
                </div>

                <div>
                    <h4 class="font-medium text-white mb-4"><?php echo get_theme_mod('footer_col2_title', 'Resources'); ?></h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-2',
                            'menu_id'        => 'footer-menu-2',
                            'container'      => false,
                            'menu_class'     => 'space-y-2',
                            'fallback_cb'    => false,
                            'link_before'    => '<span class="text-gray-400 hover:text-primary-400 transition-colors">',
                            'link_after'     => '</span>',
                        )
                    );
                    ?>
                </div>

                <div>
                    <h4 class="font-medium text-white mb-4"><?php echo get_theme_mod('footer_col3_title', 'Company'); ?></h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-3',
                            'menu_id'        => 'footer-menu-3',
                            'container'      => false,
                            'menu_class'     => 'space-y-2',
                            'fallback_cb'    => false,
                            'link_before'    => '<span class="text-gray-400 hover:text-primary-400 transition-colors">',
                            'link_after'     => '</span>',
                        )
                    );
                    ?>
                </div>

                <div>
                    <h4 class="font-medium text-white mb-4"><?php echo get_theme_mod('footer_col4_title', 'Legal'); ?></h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-4',
                            'menu_id'        => 'footer-menu-4',
                            'container'      => false,
                            'menu_class'     => 'space-y-2',
                            'fallback_cb'    => false,
                            'link_before'    => '<span class="text-gray-400 hover:text-primary-400 transition-colors">',
                            'link_after'     => '</span>',
                        )
                    );
                    ?>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-500 text-sm mb-4 md:mb-0">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </div>
                <div class="flex space-x-4">
                    <?php if (get_theme_mod('social_facebook')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_facebook')); ?>" class="text-gray-500 hover:text-primary-400 transition-colors" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_twitter')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" class="text-gray-500 hover:text-primary-400 transition-colors" aria-label="Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_github')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_github')); ?>" class="text-gray-500 hover:text-primary-400 transition-colors" aria-label="GitHub">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_linkedin')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_linkedin')); ?>" class="text-gray-500 hover:text-primary-400 transition-colors" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_instagram')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_instagram')); ?>" class="text-gray-500 hover:text-primary-400 transition-colors" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    
                    // Toggle icon
                    const icon = mobileMenuToggle.querySelector('i');
                    if (icon) {
                        if (icon.classList.contains('fa-bars')) {
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-xmark');
                        } else {
                            icon.classList.remove('fa-xmark');
                            icon.classList.add('fa-bars');
                        }
                    }
                });
            }
            
            // Handle dropdown menus
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdown = this.nextElementSibling;
                    
                    if (dropdown) {
                        dropdown.classList.toggle('hidden');
                        
                        // Toggle icon
                        const icon = this.querySelector('.dropdown-icon');
                        if (icon) {
                            icon.classList.toggle('rotate-180');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
