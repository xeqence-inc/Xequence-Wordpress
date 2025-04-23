<?php
/**
 * Template Name: Contact Page
 *
 * @package Xequence
 */

get_header();
?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <header class="page-header text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php the_title(); ?></h1>
            <?php if (get_field('contact_subtitle')) : ?>
                <p class="text-xl text-gray-300"><?php echo get_field('contact_subtitle'); ?></p>
            <?php else : ?>
                <p class="text-xl text-gray-300">We'd love to hear from you. Get in touch with our team.</p>
            <?php endif; ?>
        </header>

        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Information -->
                <div class="lg:col-span-1">
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 h-full">
                        <h2 class="text-2xl font-bold mb-6">Get In Touch</h2>
                        
                        <div class="space-y-6">
                            <?php if (get_field('contact_email') || get_theme_mod('contact_email')) : ?>
                                <div class="flex items-start">
                                    <div class="text-primary-400 mr-4">
                                        <i class="fas fa-envelope text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold mb-1">Email Us</h3>
                                        <a href="mailto:<?php echo get_field('contact_email') ?: get_theme_mod('contact_email', 'info@xequence.com'); ?>" class="text-gray-300 hover:text-primary-400 transition-colors">
                                            <?php echo get_field('contact_email') ?: get_theme_mod('contact_email', 'info@xequence.com'); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (get_field('contact_phone') || get_theme_mod('contact_phone')) : ?>
                                <div class="flex items-start">
                                    <div class="text-primary-400 mr-4">
                                        <i class="fas fa-phone-alt text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold mb-1">Call Us</h3>
                                        <a href="tel:<?php echo get_field('contact_phone') ?: get_theme_mod('contact_phone', '+1 (555) 123-4567'); ?>" class="text-gray-300 hover:text-primary-400 transition-colors">
                                            <?php echo get_field('contact_phone') ?: get_theme_mod('contact_phone', '+1 (555) 123-4567'); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (get_field('contact_address') || get_theme_mod('contact_address')) : ?>
                                <div class="flex items-start">
                                    <div class="text-primary-400 mr-4">
                                        <i class="fas fa-map-marker-alt text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold mb-1">Visit Us</h3>
                                        <address class="text-gray-300 not-italic">
                                            <?php echo get_field('contact_address') ?: get_theme_mod('contact_address', '123 Tech Street, San Francisco, CA 94107'); ?>
                                        </address>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Social Media Links -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Connect With Us</h3>
                            <div class="flex space-x-4">
                                <?php if (get_theme_mod('social_twitter')) : ?>
                                    <a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-twitter text-2xl"></i>
                                    </a>
                                <?php else : ?>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-twitter text-2xl"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (get_theme_mod('social_linkedin')) : ?>
                                    <a href="<?php echo esc_url(get_theme_mod('social_linkedin')); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-linkedin text-2xl"></i>
                                    </a>
                                <?php else : ?>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-linkedin text-2xl"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (get_theme_mod('social_github')) : ?>
                                    <a href="<?php echo esc_url(get_theme_mod('social_github')); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-github text-2xl"></i>
                                    </a>
                                <?php else : ?>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-github text-2xl"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <h2 class="text-2xl font-bold mb-6">Send Us a Message</h2>
                        
                        <?php
                        // Check if Contact Form 7 is active
                        if (function_exists('wpcf7_contact_form')) {
                            // Replace 123 with your actual Contact Form 7 ID
                            echo do_shortcode('[contact-form-7 id="123" title="Contact Form"]');
                        } else {
                        ?>
                            <form method="post" class="contact-form">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="name" class="block text-gray-300 mb-2">Your Name *</label>
                                        <input type="text" id="name" name="name" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-gray-300 mb-2">Email Address *</label>
                                        <input type="email" id="email" name="email" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <label for="subject" class="block text-gray-300 mb-2">Subject *</label>
                                    <input type="text" id="subject" name="subject" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                </div>
                                
                                <div class="mb-6">
                                    <label for="message" class="block text-gray-300 mb-2">Your Message *</label>
                                    <textarea id="message" name="message" rows="6" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500"></textarea>
                                </div>
                                
                                <div class="mb-6">
                                    <label class="flex items-start">
                                        <input type="checkbox" name="privacy" required class="mt-1 mr-3">
                                        <span class="text-gray-300 text-sm">I agree to the <a href="/privacy-policy" class="text-primary-400 hover:underline">Privacy Policy</a> and consent to having my data processed. *</span>
                                    </label>
                                </div>
                                
                                <div>
                                    <button type="submit" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-8 py-3 rounded-lg inline-flex items-center">
                                        Send Message
                                        <i class="fas fa-paper-plane ml-2"></i>
                                    </button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <!-- FAQ Section -->
            <section class="mt-16">
                <h2 class="text-3xl font-bold mb-8 text-center">Frequently Asked Questions</h2>
                
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <div class="space-y-6">
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">How can I get started with Xequence?</h3>
                            <p class="text-gray-300">You can sign up for a free account on our website and start using our platform immediately. We also offer guided onboarding for teams.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">Do you offer enterprise plans?</h3>
                            <p class="text-gray-300">Yes, we offer custom enterprise plans with additional features, dedicated support, and custom integrations. Contact our sales team for more information.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">What kind of support do you offer?</h3>
                            <p class="text-gray-300">We offer email support for all users, with priority support and dedicated account managers for our premium and enterprise customers.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">Can I integrate Xequence with my existing tools?</h3>
                            <p class="text-gray-300">Yes, Xequence integrates with popular developer tools including GitHub, GitLab, Jira, Slack, and more. We also offer an API for custom integrations.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Map Section (if Google Maps API is available) -->
            <?php if (get_field('show_map') && get_field('map_embed_code')) : ?>
                <section class="mt-16">
                    <h2 class="text-3xl font-bold mb-8 text-center">Find Us</h2>
                    
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-4 overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9">
                            <?php echo get_field('map_embed_code'); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
