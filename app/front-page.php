<?php
/**
 * The front page template file
 *
 * This is the template for the front/home page of the site.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Xequence
 */

get_header();
?>

<div class="min-h-screen bg-dark-900 text-gray-100">
    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_25%_25%,rgba(30,58,138,0.1)_0%,transparent_50%),radial-gradient(circle_at_75%_75%,rgba(14,165,233,0.1)_0%,transparent_50%)]"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex justify-center items-center mb-6">
                <div class="flex items-center bg-dark-900 border border-primary-700/30 rounded-xl p-2 shadow-[0_0_20px_rgba(20,184,166,0.2)]">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="' . get_bloginfo('name') . '" class="w-8 h-8">';
                    }
                    ?>
                    <span class="ml-2 font-mono font-bold text-xl text-white"><?php bloginfo('name'); ?></span>
                </div>
            </div>
            
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold mt-8 mb-4">
                    Where <span class="bg-gradient-to-r from-primary-500 to-blue-500 bg-clip-text text-transparent">Code</span> Meets <span class="bg-gradient-to-r from-primary-500 to-blue-500 bg-clip-text text-transparent">Community</span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                    <?php echo get_theme_mod('hero_subtitle', 'The next generation social platform for developers, launching August 2025.'); ?>
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php echo get_theme_mod('hero_button_primary_url', '#'); ?>" class="inline-flex items-center bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white px-8 py-3 rounded-lg transition-all duration-300 hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(20,184,166,0.3)]">
                        <?php echo get_theme_mod('hero_button_primary_text', 'Get Started'); ?>
                        <i class="fas fa-chevron-right ml-2"></i>
                    </a>
                    <a href="<?php echo get_theme_mod('hero_button_secondary_url', '#'); ?>" class="inline-flex items-center border border-primary-500/50 text-primary-400 hover:bg-primary-500/10 px-8 py-3 rounded-lg transition-colors">
                        <?php echo get_theme_mod('hero_button_secondary_text', 'Learn More'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-dark-900/80">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo get_theme_mod('features_title', 'Powerful Features for Developers'); ?></h2>
                <p class="text-gray-400 max-w-2xl mx-auto"><?php echo get_theme_mod('features_subtitle', 'Everything you need to connect, share, and grow with the developer community.'); ?></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                <?php
                // Feature boxes - these would typically come from a custom post type or repeater field in a real WordPress theme
                $features = array(
                    array(
                        'icon' => 'fa-code',
                        'title' => 'Interactive Code Sharing',
                        'description' => 'Run, test, and modify shared code snippets directly within the platform with support for over 150 programming languages.'
                    ),
                    array(
                        'icon' => 'fa-code-branch',
                        'title' => 'Version Control Integration',
                        'description' => 'Seamless integration with GitHub, GitLab, and Bitbucket to reference repositories and specific commits within conversations.'
                    ),
                    array(
                        'icon' => 'fa-users',
                        'title' => 'Developer Community',
                        'description' => 'Built-in mentorship frameworks, structured learning pathways, and recognition systems that incentivize knowledge sharing.'
                    ),
                    array(
                        'icon' => 'fa-lightbulb',
                        'title' => 'AI-Powered Discovery',
                        'description' => 'Intelligent tagging system automatically categorizes discussions and connects related topics, making knowledge discovery seamless.'
                    ),
                    array(
                        'icon' => 'fa-puzzle-piece',
                        'title' => 'Workflow Integration',
                        'description' => 'API access and integrations with popular developer tools including VS Code, JetBrains IDEs, and project management systems.'
                    ),
                    array(
                        'icon' => 'fa-shield-halved',
                        'title' => 'Developer-First Business Model',
                        'description' => 'Free for individual developers with premium features for enterprise teams, completely ad-free experience.'
                    )
                );

                foreach ($features as $feature) :
                ?>
                <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
                    <div class="text-primary-400 mb-4">
                        <i class="fa-solid <?php echo $feature['icon']; ?> fa-2x"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3"><?php echo $feature['title']; ?></h3>
                    <p class="text-gray-400"><?php echo $feature['description']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Code Preview Section -->
    <section class="py-20 bg-dark-900">
        <div class="container mx-auto px-4">
            <div class="w-full max-w-4xl mx-auto bg-dark-900/70 backdrop-blur-md rounded-xl border border-gray-800 overflow-hidden mb-16">
                <div class="flex items-center justify-between p-3 bg-dark-900 border-b border-gray-800">
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                    <div class="text-xs font-mono text-gray-400">sequence.js</div>
                    <div></div>
                </div>
                <div class="p-4 font-mono text-sm text-gray-300 overflow-x-auto">
                    <pre class="whitespace-pre"><span class="text-blue-400">const</span> <span class="text-green-400">xequence</span> = {
  <span class="text-yellow-300">name</span>: <span class="text-orange-300">'Xequence'</span>,
  <span class="text-yellow-300">description</span>: <span class="text-orange-300">'Where code meets community'</span>,
  <span class="text-yellow-300">launchDate</span>: <span class="text-orange-300">'August 2025'</span>,
  <span class="text-yellow-300">features</span>: [
    <span class="text-orange-300">'Interactive Code Sharing'</span>,
    <span class="text-orange-300">'Version Control Integration'</span>,
    <span class="text-orange-300">'Domain-Specific Reputation System'</span>,
    <span class="text-orange-300">'AI-Powered Discovery'</span>,
    <span class="text-orange-300">'Developer Tool Integrations'</span>,
    <span class="text-orange-300">'Community Governance Model'</span>
  ],
  <span class="text-yellow-300">mission</span>: <span class="text-purple-400">function</span>() {
    <span class="text-purple-400">return</span> <span class="text-orange-300">'Building the future of developer communication, one code block at a time.'</span>;
  }
};</pre>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-dark-900/80">
        <div class="container mx-auto px-4 text-center">
            <div class="inline-block mb-6 px-4 py-2 bg-primary-900/30 text-primary-300 rounded-full border border-primary-700/30 font-mono text-sm tracking-wider">
                <?php echo get_theme_mod('cta_badge', 'LAUNCHING AUGUST 2025'); ?>
            </div>
            
            <h2 class="text-3xl md:text-4xl font-bold mb-6"><?php echo get_theme_mod('cta_title', 'Ready to join the revolution?'); ?></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mb-8">
                <?php echo get_theme_mod('cta_description', 'Be among the first to experience the future of developer collaboration.'); ?>
            </p>
            
            <div class="mt-8">
                <a href="<?php echo get_theme_mod('cta_button_url', '#'); ?>" class="inline-flex items-center bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white px-8 py-3 rounded-lg transition-all duration-300 hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(20,184,166,0.3)]">
                    <?php echo get_theme_mod('cta_button_text', 'Join the Waitlist'); ?>
                    <i class="fas fa-chevron-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
