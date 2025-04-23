<?php
/**
 * Template Name: About Us Page
 *
 * @package Xequence
 */

get_header();
?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <section class="mb-16">
            <div class="max-w-5xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6"><?php the_title(); ?></h1>
                <?php if (get_field('about_subtitle')) : ?>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8"><?php echo get_field('about_subtitle'); ?></p>
                <?php else : ?>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8">Building the future of developer communication, one code block at a time.</p>
                <?php endif; ?>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mt-8 rounded-xl overflow-hidden border border-gray-700/50 glow">
                        <?php the_post_thumbnail('full', array('class' => 'w-full h-auto')); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="mb-16">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center justify-center mb-8">
                    <div class="bg-primary-900/30 text-primary-300 rounded-full border border-primary-700/30 font-mono text-sm tracking-wider px-4 py-2">
                        OUR STORY
                    </div>
                </div>
                
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <div class="prose prose-invert max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision Section -->
        <section class="mb-16">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-bullseye text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
                        <p class="text-gray-300">
                            <?php echo get_field('mission_statement') ?: 'To revolutionize how developers communicate, share knowledge, and collaborate by creating a platform that seamlessly integrates with their workflow.'; ?>
                        </p>
                    </div>
                    
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-eye text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold mb-4">Our Vision</h2>
                        <p class="text-gray-300">
                            <?php echo get_field('vision_statement') ?: 'A world where every developer has access to the collective knowledge and expertise of the global developer community, right at their fingertips.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="mb-16">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl font-bold mb-8 text-center">Our Core Values</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-code text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Innovation</h3>
                        <p class="text-gray-400">We constantly push the boundaries of what's possible, embracing new technologies and ideas.</p>
                    </div>
                    
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-users text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Community</h3>
                        <p class="text-gray-400">We believe in the power of community and strive to create an inclusive environment for all developers.</p>
                    </div>
                    
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-shield-alt text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Trust</h3>
                        <p class="text-gray-400">We build trust through transparency, reliability, and a commitment to privacy and security.</p>
                    </div>
                    
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-lightbulb text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Knowledge Sharing</h3>
                        <p class="text-gray-400">We believe that knowledge should be accessible to all and encourage sharing and learning.</p>
                    </div>
                    
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-rocket text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Excellence</h3>
                        <p class="text-gray-400">We strive for excellence in everything we do, from code quality to customer service.</p>
                    </div>
                    
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
                        <div class="text-primary-400 mb-4">
                            <i class="fas fa-balance-scale text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Integrity</h3>
                        <p class="text-gray-400">We act with integrity in all our dealings, being honest, ethical, and fair.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="mb-16">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl font-bold mb-8 text-center">Meet Our Team</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    // Check if there are team members
                    $team_members = new WP_Query(array(
                        'post_type' => 'team_member',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ));

                    if ($team_members->have_posts()) :
                        while ($team_members->have_posts()) : $team_members->the_post();
                            $position = get_field('position');
                            $linkedin = get_field('linkedin');
                            $twitter = get_field('twitter');
                            $github = get_field('github');
                    ?>
                        <div class="team-member bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="aspect-w-1 aspect-h-1">
                                    <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-1"><?php the_title(); ?></h3>
                                <?php if ($position) : ?>
                                    <p class="text-primary-400 mb-3"><?php echo $position; ?></p>
                                <?php endif; ?>
                                
                                <div class="text-gray-300 mb-4">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <?php if ($linkedin) : ?>
                                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-primary-400 transition-colors">
                                            <i class="fab fa-linkedin text-lg"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ($twitter) : ?>
                                        <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-primary-400 transition-colors">
                                            <i class="fab fa-twitter text-lg"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ($github) : ?>
                                        <a href="<?php echo esc_url($github); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-primary-400 transition-colors">
                                            <i class="fab fa-github text-lg"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                        <!-- Default Team Members -->
                        <div class="team-member bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl overflow-hidden">
                            <div class="aspect-w-1 aspect-h-1 bg-dark-900">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-team.jpg" alt="CEO" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-1">John Doe</h3>
                                <p class="text-primary-400 mb-3">CEO & Founder</p>
                                <div class="text-gray-300 mb-4">
                                    <p>Passionate about creating tools that empower developers to build better software.</p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-linkedin text-lg"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-twitter text-lg"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-github text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl overflow-hidden">
                            <div class="aspect-w-1 aspect-h-1 bg-dark-900">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-team.jpg" alt="CTO" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-1">Jane Smith</h3>
                                <p class="text-primary-400 mb-3">CTO</p>
                                <div class="text-gray-300 mb-4">
                                    <p>Leading our technical vision and building scalable infrastructure for the next generation of developers.</p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-linkedin text-lg"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-twitter text-lg"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-github text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl overflow-hidden">
                            <div class="aspect-w-1 aspect-h-1 bg-dark-900">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-team.jpg" alt="Head of Product" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-1">Alex Johnson</h3>
                                <p class="text-primary-400 mb-3">Head of Product</p>
                                <div class="text-gray-300 mb-4">
                                    <p>Focused on creating intuitive and powerful products that solve real developer problems.</p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-linkedin text-lg"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-twitter text-lg"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                                        <i class="fab fa-github text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="mb-16">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold mb-8 text-center">Our Journey</h2>
                
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8">
                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-0 md:left-1/2 top-0 bottom-0 w-px bg-gray-700 transform md:translate-x-0 translate-x-4"></div>
                        
                        <!-- Timeline Items -->
                        <div class="space-y-12">
                            <!-- Item 1 -->
                            <div class="relative flex flex-col md:flex-row items-start">
                                <div class="flex-1 md:text-right md:pr-8 pb-8 md:pb-0">
                                    <div class="bg-dark-900/80 p-4 rounded-lg inline-block">
                                        <h3 class="text-xl font-bold mb-2">2023</h3>
                                        <h4 class="text-primary-400 mb-2">Company Founded</h4>
                                        <p class="text-gray-300">Xequence was founded with a vision to revolutionize developer communication.</p>
                                    </div>
                                </div>
                                <div class="absolute left-0 md:left-1/2 top-0 w-8 h-8 rounded-full bg-primary-500 border-4 border-dark-800 transform md:translate-x-[-50%] translate-x-0"></div>
                                <div class="flex-1 md:pl-8 pl-12"></div>
                            </div>
                            
                            <!-- Item 2 -->
                            <div class="relative flex flex-col md:flex-row items-start">
                                <div class="flex-1 md:text-right md:pr-8 md:block hidden"></div>
                                <div class="absolute left-0 md:left-1/2 top-0 w-8 h-8 rounded-full bg-primary-500 border-4 border-dark-800 transform md:translate-x-[-50%] translate-x-0"></div>
                                <div class="flex-1 md:pl-8 pl-12 pb-8 md:pb-0">
                                    <div class="bg-dark-900/80 p-4 rounded-lg inline-block">
                                        <h3 class="text-xl font-bold mb-2">2024</h3>
                                        <h4 class="text-primary-400 mb-2">Seed Funding</h4>
                                        <p class="text-gray-300">Secured seed funding to accelerate product development and team growth.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Item 3 -->
                            <div class="relative flex flex-col md:flex-row items-start">
                                <div class="flex-1 md:text-right md:pr-8 pb-8 md:pb-0">
                                    <div class="bg-dark-900/80 p-4 rounded-lg inline-block">
                                        <h3 class="text-xl font-bold mb-2">2024</h3>
                                        <h4 class="text-primary-400 mb-2">Beta Launch</h4>
                                        <p class="text-gray-300">Launched our beta product to early adopters and gathered valuable feedback.</p>
                                    </div>
                                </div>
                                <div class="absolute left-0 md:left-1/2 top-0 w-8 h-8 rounded-full bg-primary-500 border-4 border-dark-800 transform md:translate-x-[-50%] translate-x-0"></div>
                                <div class="flex-1 md:pl-8 pl-12"></div>
                            </div>
                            
                            <!-- Item 4 -->
                            <div class="relative flex flex-col md:flex-row items-start">
                                <div class="flex-1 md:text-right md:pr-8 md:block hidden"></div>
                                <div class="absolute left-0 md:left-1/2 top-0 w-8 h-8 rounded-full bg-primary-500 border-4 border-dark-800 transform md:translate-x-[-50%] translate-x-0"></div>
                                <div class="flex-1 md:pl-8 pl-12">
                                    <div class="bg-dark-900/80 p-4 rounded-lg inline-block">
                                        <h3 class="text-xl font-bold mb-2">2025</h3>
                                        <h4 class="text-primary-400 mb-2">Official Launch</h4>
                                        <p class="text-gray-300">Officially launched our platform to the public with a full suite of features.</p>
                                    </div>
                                </div>
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
                    <h2 class="text-3xl font-bold mb-4">Join Our Journey</h2>
                    <p class="text-xl text-gray-300 mb-8">We're building something special and we'd love for you to be a part of it.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="/careers" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-8 py-3 rounded-lg inline-flex items-center justify-center">
                            <i class="fas fa-briefcase mr-2"></i>
                            Join Our Team
                        </a>
                        <a href="/contact" class="btn-hover bg-dark-900 border border-primary-500 text-primary-400 font-medium px-8 py-3 rounded-lg inline-flex items-center justify-center">
                            <i class="fas fa-envelope mr-2"></i>
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
