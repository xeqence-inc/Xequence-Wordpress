<?php
/**
 * Template Name: Jobs/Careers Page
 *
 * @package Xequence
 */

get_header();
?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Page Header -->
            <header class="page-header text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php the_title(); ?></h1>
                <?php if (get_field('page_subtitle')) : ?>
                    <p class="text-xl text-gray-300"><?php echo get_field('page_subtitle'); ?></p>
                <?php else : ?>
                    <p class="text-xl text-gray-300">Join our team and help build the future of developer communication</p>
                <?php endif; ?>
            </header>

            <!-- Introduction Section -->
            <section class="mb-16 bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                <div class="prose prose-invert max-w-none">
                    <?php the_content(); ?>
                </div>
            </section>

            <!-- Job Listings -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold mb-8 flex items-center">
                    <i class="fas fa-briefcase text-primary-400 mr-3"></i>
                    Open Positions
                </h2>

                <?php
                // Check if there are job posts
                $jobs = new WP_Query(array(
                    'post_type' => 'job',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($jobs->have_posts()) :
                    while ($jobs->have_posts()) : $jobs->the_post();
                ?>
                    <div class="job-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl p-6 mb-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h3 class="text-2xl font-bold mb-2"><?php the_title(); ?></h3>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <?php if (get_field('job_location')) : ?>
                                        <span class="inline-flex items-center bg-dark-900/80 text-gray-300 px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-map-marker-alt mr-2 text-primary-400"></i>
                                            <?php echo get_field('job_location'); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (get_field('job_type')) : ?>
                                        <span class="inline-flex items-center bg-dark-900/80 text-gray-300 px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-clock mr-2 text-primary-400"></i>
                                            <?php echo get_field('job_type'); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (get_field('job_department')) : ?>
                                        <span class="inline-flex items-center bg-dark-900/80 text-gray-300 px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-users mr-2 text-primary-400"></i>
                                            <?php echo get_field('job_department'); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="text-gray-300 mb-6">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <a href="<?php the_permalink(); ?>" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-6 py-3 rounded-lg inline-flex items-center">
                                    View Details
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8 text-center">
                        <i class="fas fa-info-circle text-4xl text-primary-400 mb-4"></i>
                        <h3 class="text-2xl font-bold mb-2">No Open Positions</h3>
                        <p class="text-gray-300 mb-4">We don't have any open positions at the moment, but we're always looking for talented individuals.</p>
                        <div class="mt-4">
                            <a href="#contact-form" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-6 py-3 rounded-lg inline-flex items-center">
                                Send Spontaneous Application
                                <i class="fas fa-paper-plane ml-2"></i>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </section>

            <!-- Benefits Section -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold mb-8 flex items-center">
                    <i class="fas fa-gift text-primary-400 mr-3"></i>
                    Why Work With Us
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="benefit-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-laptop-code text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Remote-First Culture</h3>
                        <p class="text-gray-300">Work from anywhere in the world. We believe in hiring the best talent regardless of location.</p>
                    </div>
                    
                    <div class="benefit-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-chart-line text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Growth Opportunities</h3>
                        <p class="text-gray-300">We're growing fast, which means plenty of opportunities to take on new challenges and advance your career.</p>
                    </div>
                    
                    <div class="benefit-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-balance-scale text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Work-Life Balance</h3>
                        <p class="text-gray-300">We value your time and understand the importance of balancing work with personal life.</p>
                    </div>
                    
                    <div class="benefit-card bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-hands-helping text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Inclusive Environment</h3>
                        <p class="text-gray-300">We're committed to creating a diverse and inclusive workplace where everyone feels welcome.</p>
                    </div>
                </div>
            </section>

            <!-- Application Form -->
            <section id="contact-form" class="mb-16">
                <h2 class="text-3xl font-bold mb-8 flex items-center">
                    <i class="fas fa-paper-plane text-primary-400 mr-3"></i>
                    Get in Touch
                </h2>
                
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <p class="text-gray-300 mb-6">Don't see a position that fits your skills? We're always looking for talented individuals to join our team. Send us your resume and we'll keep it on file for future opportunities.</p>
                    
                    <?php
                    // Check if Contact Form 7 is active
                    if (function_exists('wpcf7_contact_form')) {
                        // Replace 123 with your actual Contact Form 7 ID
                        echo do_shortcode('[contact-form-7 id="123" title="Job Application Form"]');
                    } else {
                    ?>
                        <div class="application-form">
                            <form method="post" enctype="multipart/form-data">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="name" class="block text-gray-300 mb-2">Full Name *</label>
                                        <input type="text" id="name" name="name" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-gray-300 mb-2">Email Address *</label>
                                        <input type="email" id="email" name="email" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <label for="position" class="block text-gray-300 mb-2">Position of Interest</label>
                                    <input type="text" id="position" name="position" class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                </div>
                                
                                <div class="mb-6">
                                    <label for="message" class="block text-gray-300 mb-2">Cover Letter *</label>
                                    <textarea id="message" name="message" rows="5" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500"></textarea>
                                </div>
                                
                                <div class="mb-6">
                                    <label for="resume" class="block text-gray-300 mb-2">Resume/CV (PDF) *</label>
                                    <input type="file" id="resume" name="resume" accept=".pdf" required class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary-500">
                                </div>
                                
                                <div class="mb-6">
                                    <label class="flex items-start">
                                        <input type="checkbox" name="privacy" required class="mt-1 mr-3">
                                        <span class="text-gray-300 text-sm">I agree to the <a href="/privacy-policy" class="text-primary-400 hover:underline">Privacy Policy</a> and consent to having my data processed for recruitment purposes. *</span>
                                    </label>
                                </div>
                                
                                <div>
                                    <button type="submit" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-8 py-3 rounded-lg inline-flex items-center">
                                        Submit Application
                                        <i class="fas fa-paper-plane ml-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold mb-8 flex items-center">
                    <i class="fas fa-question-circle text-primary-400 mr-3"></i>
                    Frequently Asked Questions
                </h2>
                
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <div class="space-y-6">
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">What is the hiring process like?</h3>
                            <p class="text-gray-300">Our hiring process typically includes an initial application review, a screening call, a technical assessment, and a final interview with the team. The entire process usually takes 2-3 weeks.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">Do you offer relocation assistance?</h3>
                            <p class="text-gray-300">Yes, we offer relocation assistance for certain roles. This will be discussed during the interview process if applicable.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">What benefits do you offer?</h3>
                            <p class="text-gray-300">We offer competitive salaries, health insurance, retirement plans, flexible working hours, professional development opportunities, and more.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h3 class="text-xl font-bold mb-2">Can I apply for multiple positions?</h3>
                            <p class="text-gray-300">Yes, you can apply for multiple positions if you feel qualified for them. Please submit separate applications for each position.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php
get_footer();
