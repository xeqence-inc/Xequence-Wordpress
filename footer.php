<?php
/**
 * The template for displaying the footer
 *
 * @package Xequence
 */
?>

    <footer id="colophon" class="site-footer py-12 bg-dark-900/70 mt-auto">
        <div class="container mx-auto px-4">
            <!-- Newsletter Section -->
            <div class="max-w-4xl mx-auto mb-12">
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="mb-6 md:mb-0 md:mr-8">
                            <h3 class="text-2xl font-bold mb-2">Stay in the loop</h3>
                            <p class="text-gray-300">Get the latest updates, news, and product announcements delivered straight to your inbox.</p>
                        </div>
                        <div class="w-full md:w-auto">
                            <form class="flex flex-col sm:flex-row gap-3">
                                <input type="email" placeholder="Enter your email" class="bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                <button type="submit" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-6 py-3 rounded-lg">
                                    Subscribe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mb-8">
                <!-- Company Info -->
                <div class="md:col-span-2">
                    <div class="flex items-center mb-4">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                            <?php if (has_custom_logo()): ?>
                                <?php the_custom_logo(); ?>
                            <?php else: ?>
                                <span class="font-mono font-bold text-xl text-white"><?php bloginfo('name'); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md">
                        <?php echo get_bloginfo('description'); ?> Building the future of developer communication, one code block at a time.
                    </p>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                            <i class="fab fa-discord text-xl"></i>
                        </a>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Tech Street, San Francisco, CA 94107</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Product</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">API</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Integrations</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Press</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Community</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Tutorials</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Webinars</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Support</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">Status</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="/privacy-policy" class="text-gray-500 hover:text-primary-400 transition-colors text-sm">Privacy Policy</a>
                    <a href="/terms-of-service" class="text-gray-500 hover:text-primary-400 transition-colors text-sm">Terms of Service</a>
                    <a href="/cookie-policy" class="text-gray-500 hover:text-primary-400 transition-colors text-sm">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    // Mobile dropdown toggles
    document.querySelectorAll('.mobile-dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('hidden');
            
            // Toggle icon rotation
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        });
    });

    // Sticky header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.sticky-header');
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, {
            threshold: 0.1
        });
        
        animatedElements.forEach(element => {
            observer.observe(element);
        });
    });
</script>

</body>
</html>
