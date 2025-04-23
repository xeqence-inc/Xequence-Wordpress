<?php
/**
 * Template Name: Services Page
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
            <?php if (get_field('services_subtitle')) : ?>
                <p class="text-xl text-gray-300"><?php echo get_field('services_subtitle'); ?></p>
            <?php else : ?>
                <p class="text-xl text-gray-300">Comprehensive solutions to help your development team succeed.</p>
            <?php endif; ?>
        </header>

        <!-- Introduction Section -->
        <section class="mb-16">
            <div class="max-w-4xl mx-auto">
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <div class="prose prose-invert max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="mb-16">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Service 1 -->
                    <div class="service-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-code text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Developer Platform</h3>
                        <p class="text-gray-300 mb-6">Our core platform for developer communication, code sharing, and collaboration.</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Interactive code sharing</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Version control integration</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">AI-powered discovery</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Developer community</span>
                            </li>
                        </ul>
                        <a href="/platform" class="text-primary-400 hover:text-primary-300 transition-colors font-medium inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    
                    <!-- Service 2 -->
                    <div class="service-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-users-cog text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Team Collaboration</h3>
                        <p class="text-gray-300 mb-6">Enhanced tools for team collaboration, knowledge sharing, and project management.</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Private team spaces</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Code review workflows</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Knowledge base integration</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Project management tools</span>
                            </li>
                        </ul>
                        <a href="/team-collaboration" class="text-primary-400 hover:text-primary-300 transition-colors font-medium inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    
                    <!-- Service 3 -->
                    <div class="service-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-shield-alt text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Enterprise Security</h3>
                        <p class="text-gray-300 mb-6">Advanced security features for enterprise customers with sensitive data requirements.</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Single sign-on (SSO)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Role-based access control</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Audit logs and compliance</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Data encryption</span>
                            </li>
                        </ul>
                        <a href="/enterprise-security" class="text-primary-400 hover:text-primary-300 transition-colors font-medium inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    
                    <!-- Service 4 -->
                    <div class="service-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-plug text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">API & Integrations</h3>
                        <p class="text-gray-300 mb-6">Connect Xequence with your existing tools and workflows through our API and integrations.</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">RESTful API access</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Webhook support</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Pre-built integrations</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Custom integration development</span>
                            </li>
                        </ul>
                        <a href="/api-integrations" class="text-primary-400 hover:text-primary-300 transition-colors font-medium inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    
                    <!-- Service 5 -->
                    <div class="service-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-graduation-cap text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Training & Onboarding</h3>
                        <p class="text-gray-300 mb-6">Comprehensive training and onboarding services to help your team get the most out of Xequence.</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Personalized onboarding</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Custom training sessions</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Documentation and resources</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Ongoing education</span>
                            </li>
                        </ul>
                        <a href="/training" class="text-primary-400 hover:text-primary-300 transition-colors font-medium inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    
                    <!-- Service 6 -->
                    <div class="service-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-headset text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Premium Support</h3>
                        <p class="text-gray-300 mb-6">Dedicated support services for enterprise customers with priority response times.</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Dedicated account manager</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Priority support queue</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">24/7 emergency support</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-primary-400 mt-1 mr-2"></i>
                                <span class="text-gray-300">Regular check-ins and reviews</span>
                            </li>
                        </ul>
                        <a href="/premium-support" class="text-primary-400 hover:text-primary-300 transition-colors font-medium inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="mb-16">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl font-bold mb-8 text-center">Our Process</h2>
                
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-full bg-primary-500/20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-primary-400 text-2xl font-bold">1</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Discovery</h3>
                            <p class="text-gray-300">We learn about your needs and challenges.</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-full bg-primary-500/20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-primary-400 text-2xl font-bold">2</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Planning</h3>
                            <p class="text-gray-300">We create a tailored implementation plan.</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-full bg-primary-500/20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-primary-400 text-2xl font-bold">3</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Implementation</h3>
                            <p class="text-gray-300">We set up and configure your solution.</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-full bg-primary-500/20 flex items-center justify-center mx-auto mb-4">
                                <span class="text-primary-400 text-2xl font-bold">4</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Support</h3>
                            <p class="text-gray-300">We provide ongoing support and optimization.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="mb-16">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl font-bold mb-8 text-center">What Our Clients Say</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-primary-400 mr-2">
                                <i class="fas fa-quote-left text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-6 italic">Xequence has transformed how our development team communicates and collaborates. The platform is intuitive and the support team is exceptional.</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-dark-900 overflow-hidden mr-4">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/testimonial-1.jpg" alt="Client" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold">Sarah Johnson</h4>
                                <p class="text-gray-400 text-sm">CTO, TechCorp</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-primary-400 mr-2">
                                <i class="fas fa-quote-left text-2xl"></i>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-6 italic">The API and integrations service has allowed us to seamlessly connect Xequence with our existing tools. It's been a game-changer for our workflow.</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-dark-900 overflow-hidden mr-4">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/testimonial-2.jpg" alt="Client" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold">Michael Chen</h4>
                                <p class="text-gray-400 text-sm">Lead Developer, DevStudio</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="mb-16">
            <div class="max-w-4xl mx-auto text-center">
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
                    <p class="text-xl text-gray-300 mb-8">Contact us today to discuss how Xequence can help your team.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="/contact" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-8 py-3 rounded-lg inline-flex items-center justify-center">
                            <i class="fas fa-envelope mr-2"></i>
                            Contact Us
                        </a>
                        <a href="/demo" class="btn-hover bg-dark-900 border border-primary-500 text-primary-400 font-medium px-8 py-3 rounded-lg inline-flex items-center justify-center">
                            <i class="fas fa-desktop mr-2"></i>
                            Request a Demo
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
