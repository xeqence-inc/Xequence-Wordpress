<?php
/**
 * Plugin Name: Xequence Page Generator
 * Plugin URI: https://xequence.com/plugins/page-generator
 * Description: Automatically generates all necessary pages for the Xequence WordPress theme.
 * Version: 1.0.0
 * Author: Xequence Team
 * Author URI: https://xequence.com
 * License: GPL v2 or later
 * Text Domain: xequence-page-generator
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Xequence_Page_Generator {
    
    /**
     * Constructor
     */
    public function __construct() {
        // Add admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Register activation hook
        register_activation_hook(__FILE__, array($this, 'plugin_activation'));
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_submenu_page(
            'themes.php',
            __('Xequence Page Generator', 'xequence-page-generator'),
            __('Generate Pages', 'xequence-page-generator'),
            'manage_options',
            'xequence-page-generator',
            array($this, 'admin_page')
        );
    }
    
    /**
     * Admin page
     */
    public function admin_page() {
        // Check if form is submitted
        if (isset($_POST['xequence_generate_pages']) && check_admin_referer('xequence_generate_pages_nonce')) {
            $this->generate_pages();
            echo '<div class="notice notice-success is-dismissible"><p>' . __('Pages generated successfully!', 'xequence-page-generator') . '</p></div>';
        }
        
        // Display the form
        ?>
        <div class="wrap">
            <h1><?php _e('Xequence Page Generator', 'xequence-page-generator'); ?></h1>
            <p><?php _e('This tool will automatically generate all the necessary pages for your Xequence WordPress theme.', 'xequence-page-generator'); ?></p>
            <p><?php _e('The following pages will be created:', 'xequence-page-generator'); ?></p>
            <ul style="list-style-type: disc; margin-left: 20px;">
                <li><?php _e('Features', 'xequence-page-generator'); ?></li>
                <li><?php _e('Pricing', 'xequence-page-generator'); ?></li>
                <li><?php _e('Roadmap', 'xequence-page-generator'); ?></li>
                <li><?php _e('Beta Program', 'xequence-page-generator'); ?></li>
                <li><?php _e('Documentation', 'xequence-page-generator'); ?></li>
                <li><?php _e('API Reference', 'xequence-page-generator'); ?></li>
                <li><?php _e('Community', 'xequence-page-generator'); ?></li>
                <li><?php _e('About', 'xequence-page-generator'); ?></li>
                <li><?php _e('Careers', 'xequence-page-generator'); ?></li>
                <li><?php _e('Contact', 'xequence-page-generator'); ?></li>
                <li><?php _e('Press', 'xequence-page-generator'); ?></li>
                <li><?php _e('Privacy Policy', 'xequence-page-generator'); ?></li>
                <li><?php _e('Terms of Service', 'xequence-page-generator'); ?></li>
                <li><?php _e('Cookie Policy', 'xequence-page-generator'); ?></li>
                <li><?php _e('GDPR', 'xequence-page-generator'); ?></li>
            </ul>
            <p><?php _e('Note: If any of these pages already exist, they will not be overwritten.', 'xequence-page-generator'); ?></p>
            
            <form method="post" action="">
                <?php wp_nonce_field('xequence_generate_pages_nonce'); ?>
                <p>
                    <input type="submit" name="xequence_generate_pages" class="button button-primary" value="<?php _e('Generate Pages', 'xequence-page-generator'); ?>">
                </p>
            </form>
        </div>
        <?php
    }
    
    /**
     * Generate pages
     */
    public function generate_pages() {
        // Define pages to create
        $pages = $this->get_pages_to_create();
        
        // Create each page
        foreach ($pages as $page) {
            $this->create_page($page['title'], $page['content'], $page['template'], $page['parent']);
        }
    }
    
    /**
     * Create a page
     */
    private function create_page($title, $content, $template = '', $parent = 0) {
        // Check if page already exists
        $existing_page = get_page_by_title($title);
        
        if (!$existing_page) {
            // Create post object
            $page = array(
                'post_title'    => $title,
                'post_content'  => $content,
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_parent'   => $parent,
            );
            
            // Insert the page into the database
            $page_id = wp_insert_post($page);
            
            // Set page template if specified
            if (!empty($template)) {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
            
            return $page_id;
        }
        
        return false;
    }
    
    /**
     * Get pages to create
     */
    private function get_pages_to_create() {
        $pages = array(
            // Product pages
            array(
                'title' => 'Features',
                'content' => $this->get_features_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'Pricing',
                'content' => $this->get_pricing_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'Roadmap',
                'content' => $this->get_roadmap_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'Beta Program',
                'content' => $this->get_beta_program_content(),
                'template' => '',
                'parent' => 0
            ),
            
            // Resources pages
            array(
                'title' => 'Documentation',
                'content' => $this->get_documentation_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'API Reference',
                'content' => $this->get_api_reference_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'Community',
                'content' => $this->get_community_content(),
                'template' => '',
                'parent' => 0
            ),
            
            // Company pages
            array(
                'title' => 'About',
                'content' => $this->get_about_content(),
                'template' => 'template-about.php',
                'parent' => 0
            ),
            array(
                'title' => 'Careers',
                'content' => $this->get_careers_content(),
                'template' => 'template-jobs.php',
                'parent' => 0
            ),
            array(
                'title' => 'Contact',
                'content' => $this->get_contact_content(),
                'template' => 'template-contact.php',
                'parent' => 0
            ),
            array(
                'title' => 'Press',
                'content' => $this->get_press_content(),
                'template' => '',
                'parent' => 0
            ),
            
            // Legal pages
            array(
                'title' => 'Privacy Policy',
                'content' => $this->get_privacy_policy_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'Terms of Service',
                'content' => $this->get_terms_of_service_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'Cookie Policy',
                'content' => $this->get_cookie_policy_content(),
                'template' => '',
                'parent' => 0
            ),
            array(
                'title' => 'GDPR',
                'content' => $this->get_gdpr_content(),
                'template' => '',
                'parent' => 0
            ),
            
            // Services page
            array(
                'title' => 'Services',
                'content' => $this->get_services_content(),
                'template' => 'template-services.php',
                'parent' => 0
            ),
        );
        
        return $pages;
    }
    
    /**
     * Plugin activation
     */
    public function plugin_activation() {
        // Add option to show admin notice
        add_option('xequence_page_generator_activation', true);
        
        // Add action to show admin notice
        add_action('admin_notices', array($this, 'activation_admin_notice'));
    }
    
    /**
     * Show admin notice on activation
     */
    public function activation_admin_notice() {
        // Check if we should show the notice
        if (get_option('xequence_page_generator_activation', false)) {
            ?>
            <div class="notice notice-info is-dismissible">
                <p><?php _e('Xequence Page Generator has been activated. <a href="themes.php?page=xequence-page-generator">Click here</a> to generate pages for your Xequence theme.', 'xequence-page-generator'); ?></p>
            </div>
            <?php
            
            // Delete the option so the notice is only shown once
            delete_option('xequence_page_generator_activation');
        }
    }
    
    /**
     * Page content templates
     */
    private function get_features_content() {
        return '&lt;!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Powerful Features for Developers</h1>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Discover the tools and capabilities that make Xequence the ultimate platform for developer collaboration.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading -->
<h2>Interactive Code Sharing</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Share, run, and modify code snippets directly within discussions. With support for over 150 programming languages and frameworks, you can demonstrate concepts, test solutions, and collaborate on code without leaving the conversation.</p>
&lt;!-- /wp:paragraph --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/600x400" alt="Interactive Code Sharing"/></figure>
&lt;!-- /wp:image --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/600x400" alt="Version Control Integration"/></figure>
&lt;!-- /wp:image --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading -->
<h2>Version Control Integration</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Seamlessly reference GitHub, GitLab, or Bitbucket repositories, specific files, or even line ranges. Changes to the referenced code are tracked and reflected in discussions, ensuring conversations remain relevant even as codebases evolve.</p>
&lt;!-- /wp:paragraph --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading -->
<h2>AI-Powered Discovery</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Our intelligent tagging system automatically categorizes discussions and connects related topics, making knowledge discovery intuitive. The more you use Xequence, the better it becomes at surfacing relevant content tailored to your interests and needs.</p>
&lt;!-- /wp:paragraph --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/600x400" alt="AI-Powered Discovery"/></figure>
&lt;!-- /wp:image --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/600x400" alt="Developer Community"/></figure>
&lt;!-- /wp:image --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading -->
<h2>Developer Community</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Built-in mentorship frameworks, structured learning pathways, and recognition systems that incentivize knowledge sharing. Connect with like-minded developers and grow your skills together.</p>
&lt;!-- /wp:paragraph --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"60px"} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Ready to experience these features?</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Join thousands of developers already using Xequence to collaborate more effectively.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Get Started</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons -->';
    }
    
    private function get_pricing_content() {
        return '&lt;!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Simple, Transparent Pricing</h1>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Choose the plan that\'s right for you or your team.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Free</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><strong>$0</strong> / month</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Perfect for individual developers</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
&lt;!-- /wp:separator -->

&lt;!-- wp:list -->
<ul><li>Interactive code sharing</li><li>Public discussions</li><li>Basic version control integration</li><li>Community access</li><li>Limited API access</li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Sign Up Free</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Pro</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><strong>$12</strong> / month</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">For professional developers</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
&lt;!-- /wp:separator -->

&lt;!-- wp:list -->
<ul><li>Everything in Free</li><li>Private discussions</li><li>Advanced code sharing</li><li>Full version control integration</li><li>AI-powered discovery</li><li>Priority support</li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Get Pro</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Team</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><strong>$49</strong> / month</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">For teams up to 10 developers</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
&lt;!-- /wp:separator -->

&lt;!-- wp:list -->
<ul><li>Everything in Pro</li><li>Team workspaces</li><li>Advanced permissions</li><li>Team analytics</li><li>Custom integrations</li><li>Dedicated support</li><li>SSO authentication</li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Start Team Trial</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"60px"} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Enterprise</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Custom solutions for large organizations with advanced needs.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:list -->
<ul><li>Custom user limits</li><li>Enterprise-grade security</li><li>Dedicated account manager</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:list -->
<ul><li>Custom integrations</li><li>On-premise deployment options</li><li>Advanced analytics</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:list -->
<ul><li>SLA guarantees</li><li>Custom training</li><li>24/7 premium support</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Contact Sales</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons -->

&lt;!-- wp:spacer {"height":"60px"} -->
<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Frequently Asked Questions</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"level":3} -->
<h3>Can I upgrade or downgrade my plan at any time?</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Yes, you can upgrade or downgrade your plan at any time. When upgrading, you\'ll be charged the prorated amount for the remainder of your billing cycle. When downgrading, the new rate will apply at the start of your next billing cycle.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading {"level":3} -->
<h3>Do you offer discounts for annual billing?</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Yes, we offer a 20% discount when you choose annual billing on any of our paid plans.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading {"level":3} -->
<h3>Is there a free trial for paid plans?</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Yes, we offer a 14-day free trial for our Pro plan and a 30-day free trial for our Team plan. No credit card required.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading {"level":3} -->
<h3>What payment methods do you accept?</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>We accept all major credit cards, PayPal, and bank transfers for annual Enterprise plans.</p>
&lt;!-- /wp:paragraph -->';
    }
    
    private function get_roadmap_content() {
        return '&lt;!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Product Roadmap</h1>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Our vision for the future of Xequence and what we\'re working on next.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Current Quarter (Q3 2025)</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%">&lt;!-- wp:heading {"level":3} -->
<h3>In Progress</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li>Enhanced code editor with multi-language support</li><li>Improved search functionality</li><li>Mobile app beta for iOS</li><li>Team collaboration features</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%">&lt;!-- wp:heading {"level":3} -->
<h3>Planned</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li>Advanced AI code suggestions</li><li>GitHub Actions integration</li><li>Custom themes and branding</li><li>API rate limit increases</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%">&lt;!-- wp:heading {"level":3} -->
<h3>Completed</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li>Real-time collaboration</li><li>Dark mode improvements</li><li>Performance optimizations</li><li>SSO for Enterprise customers</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Next Quarter (Q4 2025)</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%">&lt;!-- wp:heading {"level":3} -->
<h3>Planned Features</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li>Mobile app for Android</li><li>Advanced analytics dashboard</li><li>IDE plugins for VS Code and JetBrains</li><li>Custom workflow automations</li><li>Enhanced notification system</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%">&lt;!-- wp:heading {"level":3} -->
<h3>Under Consideration</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li>AI-powered code review assistant</li><li>Advanced team permissions</li><li>Custom integration builder</li><li>On-premise deployment options</li><li>Enhanced security features</li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Long-term Vision (2026)</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Our long-term vision for Xequence includes:</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:list -->
<ul><li>Comprehensive AI-powered development assistant</li><li>Advanced code generation capabilities</li><li>Seamless integration with all major development tools</li><li>Enhanced learning paths and mentorship features</li><li>Expanded community features and developer networking</li><li>Enterprise-grade security and compliance</li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Have a Feature Request?</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">We love hearing from our community! If you have ideas for new features or improvements, please share them with us.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Submit Feature Request</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons -->';
    }
    
    private function get_beta_program_content() {
        return '&lt;!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Xequence Beta Program</h1>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Be among the first to experience new features and help shape the future of Xequence.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>About the Beta Program</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>The Xequence Beta Program gives you early access to new features, allowing you to test and provide feedback before they\'re released to the general public. As a beta tester, you\'ll play a crucial role in shaping the future of our platform.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>We\'re looking for developers who are passionate about collaboration tools and willing to provide thoughtful feedback on new features and improvements.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Current Beta Features</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>AI Code Assistant</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Our new AI-powered code assistant helps you write better code faster with intelligent suggestions and automated refactoring.</p>
&lt;!-- /wp:paragraph --></div>

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>Mobile Applications</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Access Xequence on the go with our new mobile applications for iOS and Android, currently in beta testing.</p>
&lt;!-- /wp:paragraph --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>Advanced Analytics</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Gain deeper insights into your team\'s collaboration patterns and code quality with our new analytics dashboard.</p>
&lt;!-- /wp:paragraph --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Benefits of Joining</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li>Early access to new features</li><li>Direct line to our product team</li><li>Influence the direction of Xequence</li><li>Exclusive beta tester community</li><li>Special recognition in our community</li><li>Occasional swag and perks</li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>How It Works</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Once accepted into the beta program, you\'ll:</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:list {"ordered":true} -->
<ol><li>Receive access to beta features in your Xequence account</li><li>Get regular updates on new beta features to test</li><li>Provide feedback through dedicated channels</li><li>Participate in occasional user research sessions</li><li>Help us identify and fix issues before public release</li></ol>
&lt;!-- /wp:list -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Join the Beta Program</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Ready to help shape the future of developer collaboration? Apply to join our beta program today!</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Apply Now</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons -->

&lt;!-- wp:paragraph -->
<p><em>Note: Beta features may contain bugs or undergo significant changes before final release. We recommend not using beta features in production environments.</em></p>
&lt;!-- /wp:paragraph -->';
    }
    
    private function get_documentation_content() {
        return '&lt;!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Documentation</h1>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Comprehensive guides and resources to help you get the most out of Xequence.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%">&lt;!-- wp:heading {"level":3} -->
<h3>Documentation Categories</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li><a href="#getting-started">Getting Started</a></li><li><a href="#user-guides">User Guides</a></li><li><a href="#api-reference">API Reference</a></li><li><a href="#integrations">Integrations</a></li><li><a href="#troubleshooting">Troubleshooting</a></li><li><a href="#faq">FAQ</a></li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading {"level":3} -->
<h3>Popular Articles</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li><a href="#">Quick Start Guide</a></li><li><a href="#">Setting Up Your Profile</a></li><li><a href="#">Code Sharing Best Practices</a></li><li><a href="#">Team Collaboration</a></li><li><a href="#">API Authentication</a></li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%">&lt;!-- wp:heading {"level":2,"anchor":"getting-started"} -->
<h2 class="wp-block-heading" id="getting-started">Getting Started</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Welcome to Xequence! This section will help you get up and running quickly with our platform.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:list -->
<ul><li><a href="#">Creating Your Account</a></li><li><a href="#">Setting Up Your Profile</a></li><li><a href="#">Navigating the Interface</a></li><li><a href="#">Your First Code Share</a></li><li><a href="#">Joining Communities</a></li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading {"level":2,"anchor":"user-guides"} -->
<h2 class="wp-block-heading" id="user-guides">User Guides</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Detailed guides for using all features of Xequence.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading {"level":3} -->
<h3>Code Sharing</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li><a href="#">Interactive Code Editor</a></li><li><a href="#">Supported Languages</a></li><li><a href="#">Code Execution</a></li><li><a href="#">Version History</a></li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading {"level":3} -->
<h3>Collaboration</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li><a href="#">Creating Discussions</a></li><li><a href="#">Commenting on Code</a></li><li><a href="#">Mentioning Users</a></li><li><a href="#">Notifications</a></li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading {"level":3} -->
<h3>Teams</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li><a href="#">Creating a Team</a></li><li><a href="#">Team Permissions</a></li><li><a href="#">Team Workspaces</a></li><li><a href="#">Team Analytics</a></li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading {"level":2,"anchor":"integrations"} -->
<h2 class="wp-block-heading" id="integrations">Integrations</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Learn how to connect Xequence with your favorite tools.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:list -->
<ul><li><a href="#">GitHub Integration</a></li><li><a href="#">GitLab Integration</a></li><li><a href="#">Bitbucket Integration</a></li><li><a href="#">VS Code Extension</a></li><li><a href="#">JetBrains Plugin</a></li><li><a href="#">Slack Integration</a></li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading {"level":2,"anchor":"troubleshooting"} -->
<h2 class="wp-block-heading" id="troubleshooting">Troubleshooting</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Solutions for common issues you might encounter.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:list -->
<ul><li><a href="#">Login Issues</a></li><li><a href="#">Code Editor Problems</a></li><li><a href="#">Integration Troubleshooting</a></li><li><a href="#">Performance Optimization</a></li><li><a href="#">Error Messages</a></li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Need More Help?</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Our support team is here to help you with any questions or issues.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Contact Support</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons -->';
    }
    
    private function get_api_reference_content() {
        return '&lt;!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">API Reference</h1>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Comprehensive documentation for the Xequence API.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%">&lt;!-- wp:heading {"level":3} -->
<h3>API Sections</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li><a href="#introduction">Introduction</a></li><li><a href="#authentication">Authentication</a></li><li><a href="#rate-limits">Rate Limits</a></li><li><a href="#users">Users</a></li><li><a href="#code-snippets">Code Snippets</a></li><li><a href="#discussions">Discussions</a></li><li><a href="#teams">Teams</a></li><li><a href="#integrations">Integrations</a></li><li><a href="#webhooks">Webhooks</a></li><li><a href="#errors">Errors</a></li></ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading {"level":3} -->
<h3>Resources</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul><li><a href="#">API Changelog</a></li><li><a href="#">SDKs & Libraries</a></li><li><a href="#">API Status</a></li><li><a href="#">Example Projects</a></li></ul>
&lt;!-- /wp:list --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%">&lt;!-- wp:heading {"level":2,"anchor":"introduction"} -->
<h2 class="wp-block-heading" id="introduction">Introduction</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>The Xequence API is organized around REST. Our API has predictable resource-oriented URLs, accepts form-encoded request bodies, returns JSON-encoded responses, and uses standard HTTP response codes, authentication, and verbs.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>The base URL for all API requests is:</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:code -->
<pre class="wp-block-code"><code>https://api.xequence.com/v1</code></pre>
&lt;!-- /wp:code -->

&lt;!-- wp:heading {"level":2,"anchor":"authentication"} -->
<h2 class="wp-block-heading" id="authentication">Authentication</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>The Xequence API uses API keys to authenticate requests. You can view and manage your API keys in the Xequence Dashboard.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>Authentication to the API is performed via HTTP Bearer Auth. Provide your API key as the bearer token value.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:code -->
<pre class="wp-block-code"><code>curl -X GET "https://api.xequence.com/v1/users/me" \
  -H "Authorization: Bearer YOUR_API_KEY"</code></pre>
&lt;!-- /wp:code -->

&lt;!-- wp:heading {"level":2,"anchor":"rate-limits"} -->
<h2 class="wp-block-heading" id="rate-limits">Rate Limits</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>The Xequence API implements rate limiting to protect our service from excessive requests. Rate limits vary based on your plan:</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Plan</th><th>Rate Limit</th></tr></thead><tbody><tr><td>Free</td><td>60 requests per minute</td></tr><tr><td>Pro</td><td>120 requests per minute</td></tr><tr><td>Team</td><td>300 requests per minute</td></tr><tr><td>Enterprise</td><td>Custom</td></tr></tbody></table></figure>
&lt;!-- /wp:table -->

&lt;!-- wp:heading {"level":2,"anchor":"users"} -->
<h2 class="wp-block-heading" id="users">Users</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:heading {"level":3} -->
<h3>Get Current User</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Returns information about the authenticated user.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:code -->
<pre class="wp-block-code"><code>GET /users/me</code></pre>
&lt;!-- /wp:code -->

&lt;!-- wp:heading {"level":3} -->
<h3>Get User</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Returns information about a specific user.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:code -->
<pre class="wp-block-code"><code>GET /users/:id</code></pre>
&lt;!-- /wp:code -->

&lt;!-- wp:heading {"level":2,"anchor":"code-snippets"} -->
<h2 class="wp-block-heading" id="code-snippets">Code Snippets</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:heading {"level":3} -->
<h3>List Code Snippets</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Returns a list of code snippets for the authenticated user.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:code -->
<pre class="wp-block-code"><code>GET /snippets</code></pre>
&lt;!-- /wp:code -->

&lt;!-- wp:heading {"level":3} -->
<h3>Create Code Snippet</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Creates a new code snippet.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:code -->
<pre class="wp-block-code"><code>POST /snippets</code></pre>
&lt;!-- /wp:code --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Need Help with the API?</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Our developer support team is here to help you integrate with Xequence.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Contact Developer Support</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons -->';
    }
    
    private function get_community_content() {
        return '&lt;!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Xequence Community</h1>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Connect, learn, and grow with fellow developers in the Xequence community.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading -->
<h2>Join the Conversation</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>The Xequence community is a vibrant network of developers from around the world, sharing knowledge, collaborating on projects, and helping each other grow. Whether you\'re a seasoned professional or just starting your coding journey, there\'s a place for you here.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>Our community spans multiple platforms, making it easy for you to connect in the way that works best for you.</p>
&lt;!-- /wp:paragraph --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/600x400" alt="Xequence Community"/></figure>
&lt;!-- /wp:image --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Community Platforms</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>Discord Server</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Join our Discord server for real-time discussions, help with coding challenges, and community events.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Join Discord</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>Community Forum</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Our forum is the perfect place for in-depth discussions, sharing projects, and getting help with more complex questions.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Visit Forum</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>GitHub Discussions</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Contribute to our open-source projects, report issues, and participate in discussions about the Xequence platform.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">GitHub</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Community Programs</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:columns -->
<div class="wp-block-columns">&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>Mentorship Program</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Connect with experienced developers who can guide you on your coding journey. Our mentorship program pairs beginners with seasoned professionals for personalized guidance.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Learn More</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>Community Challenges</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Participate in our monthly coding challenges to test your skills, learn new technologies, and win prizes. Challenges range from beginner to advanced levels.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View Challenges</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column -->

&lt;!-- wp:column -->
<div class="wp-block-column">&lt;!-- wp:heading {"level":3} -->
<h3>Community Ambassadors</h3>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Our ambassadors are passionate community members who help organize events, create content, and support other members. Apply to become an ambassador today!</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Apply Now</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons --></div>
&lt;!-- /wp:column --></div>
&lt;!-- /wp:columns -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading -->
<h2>Upcoming Events</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Join us for virtual and in-person events to learn, network, and have fun with fellow developers.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:table -->
<figure class="wp-block-table"><table><thead><tr><th>Event</th><th>Date</th><th>Location</th><th>Registration</th></tr></thead><tbody><tr><td>Xequence Developer Conference</td><td>October 15-17, 2025</td><td>San Francisco, CA</td><td><a href="#">Register</a></td></tr><tr><td>Getting Started with Xequence Webinar</td><td>August 5, 2025</td><td>Online</td><td><a href="#">Register</a></td></tr><tr><td>Community Meetup - New York</td><td>September 10, 2025</td><td>New York, NY</td><td><a href="#">Register</a></td></tr><tr><td>Advanced API Workshop</td><td>August 20, 2025</td><td>Online</td><td><a href="#">Register</a></td></tr></tbody></table></figure>
&lt;!-- /wp:table -->

&lt;!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
&lt;!-- /wp:spacer -->

&lt;!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Community Guidelines</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Our community is built on respect, inclusivity, and a shared passion for coding. Please review our community guidelines before participating.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">&lt;!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Read Guidelines</a></div>
&lt;!-- /wp:button --></div>
&lt;!-- /wp:buttons -->';
    }
    
    private function get_about_content() {
        return '&lt;!-- wp:paragraph -->
<p>Xequence is a revolutionary platform designed to transform how developers collaborate, share knowledge, and build together. Founded in 2023, we\'re on a mission to create the ultimate developer community where code meets communication.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>Our team of passionate engineers, designers, and community builders is working to solve the fragmentation in the current developer ecosystem. We believe that by bringing together the best aspects of existing tools and introducing innovative features designed specifically for developers, we can create a more seamless, contextual, and enriching collaboration experience.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading -->
<h2>Our Mission</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>To revolutionize how developers communicate, share knowledge, and collaborate by creating a platform that seamlessly integrates with their workflow.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading -->
<h2>Our Vision</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>A world where every developer has access to the collective knowledge and expertise of the global developer community, right at their fingertips.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading -->
<h2>Our Core Values</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:list -->
<ul>
<li><strong>Innovation:</strong> We constantly push the boundaries of what's possible, embracing new technologies and ideas.</li>
<li><strong>Community:</strong> We believe in the power of community and strive to create an inclusive environment for all developers.</li>
<li><strong>Trust:</strong> We build trust through transparency, reliability, and a commitment to privacy and security.</li>
<li><strong>Knowledge Sharing:</strong> We believe that knowledge should be accessible to all and encourage sharing and learning.</li>
<li><strong>Excellence:</strong> We strive for excellence in everything we do, from code quality to customer service.</li>
<li><strong>Integrity:</strong> We act with integrity in all our dealings, being honest, ethical, and fair.</li>
</ul>
&lt;!-- /wp:list -->

&lt;!-- wp:heading -->
<h2>Our Team</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>Xequence was founded by a team of experienced developers and entrepreneurs who have worked at leading tech companies and understand the challenges of modern software development. Our diverse team brings together expertise in software engineering, product design, community building, and business development.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>We're headquartered in San Francisco with team members distributed around the world, embracing remote work and global collaboration—just like the community we're building.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading -->
<h2>Our Story</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>The idea for Xequence was born out of frustration with the fragmented nature of developer tools and communities. Our founders were tired of jumping between Stack Overflow for questions, GitHub for code, Discord for real-time chat, and countless other platforms to stay connected with peers and up-to-date with the latest developments.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>After months of research and conversations with hundreds of developers, we identified a clear need for a unified platform that brings together code, communication, and community. We secured seed funding in early 2024 and have been building Xequence ever since, with a focus on creating a platform that truly understands and serves the needs of developers.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>We're currently in beta, working closely with our early adopters to refine and improve the platform before our public launch in August 2025.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:heading -->
<h2>Join Us</h2>
&lt;!-- /wp:heading -->

&lt;!-- wp:paragraph -->
<p>We're always looking for talented individuals who are passionate about developer tools and communities to join our team. Check out our <a href="/careers">careers page</a> for current openings.</p>
&lt;!-- /wp:paragraph -->

&lt;!-- wp:paragraph -->
<p>If you're interested in being among the first to experience Xequence, sign up for our waitlist to get early access to our platform.</p>
&lt;!-- /wp:paragraph -->';
    }

    /**
     * Get content for Careers page
     */
    public function get_careers_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Join Our Team</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Help us build the future of developer collaboration.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":2} -->
<h2>Why Work at Xequence?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>At Xequence, we\'re building the next generation social platform for developers. We\'re a team of passionate engineers, designers, and community builders who are dedicated to creating a better way for developers to connect, share knowledge, and collaborate.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Remote-First Culture</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>Work from anywhere in the world. We believe in hiring the best talent regardless of location.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Growth Opportunities</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>We\'re growing fast, which means plenty of -->
        
        <!-- wp:paragraph -->
        <p>We're growing fast, which means plenty of opportunities to take on new challenges and advance your career.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Work-Life Balance</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>We value your time and understand the importance of balancing work with personal life.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:columns -->
<div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Competitive Compensation</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>We offer competitive salaries, equity, and comprehensive benefits to ensure you\'re well taken care of.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Cutting-Edge Technology</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>Work with the latest technologies and tools to solve challenging problems in developer collaboration.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Inclusive Environment</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>We\'re committed to creating a diverse and inclusive workplace where everyone feels welcome.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:heading {"level":2} -->
<h2>Open Positions</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We\'re always looking for talented individuals to join our team. Check out our current openings below.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Engineering</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
    <li><a href="#">Senior Frontend Engineer (React)</a></li>
    <li><a href="#">Senior Backend Engineer (Node.js)</a></li>
    <li><a href="#">Full Stack Engineer</a></li>
    <li><a href="#">DevOps Engineer</a></li>
    <li><a href="#">Mobile Engineer (React Native)</a></li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Product & Design</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
    <li><a href="#">Product Manager</a></li>
    <li><a href="#">UX/UI Designer</a></li>
    <li><a href="#">Product Designer</a></li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Marketing & Community</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
    <li><a href="#">Community Manager</a></li>
    <li><a href="#">Content Marketing Manager</a></li>
    <li><a href="#">Developer Advocate</a></li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Operations & Support</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
    <li><a href="#">Customer Success Manager</a></li>
    <li><a href="#">Technical Support Engineer</a></li>
    <li><a href="#">HR & Operations Manager</a></li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Our Hiring Process</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol>
    <li><strong>Application Review</strong> - We review your application and resume.</li>
    <li><strong>Initial Interview</strong> - A 30-minute call with a member of our team to discuss your background and experience.</li>
    <li><strong>Technical Assessment</strong> - A take-home assignment or live coding session, depending on the role.</li>
    <li><strong>Team Interview</strong> - Meet with several members of the team you\'ll be working with.</li>
    <li><strong>Final Interview</strong> - A conversation with a founder or executive team member.</li>
    <li><strong>Offer</strong> - If all goes well, we\'ll extend an offer to join our team!</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Don\'t See a Position That Fits?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We\'re always interested in connecting with talented individuals. Send us your resume and let us know how you can contribute to our mission.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
    <!-- wp:button -->
    <div class="wp-block-button"><a class="wp-block-button__link" href="/contact">Contact Us</a></div>
    <!-- /wp:button -->
</div>
<!-- /wp:buttons -->';
    }

    /**
     * Get content for Contact page
     */
    public function get_contact_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Contact Us</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">We\'d love to hear from you. Get in touch with our team.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns -->
<div class="wp-block-columns">
    <!-- wp:column {"width":"33.33%"} -->
    <div class="wp-block-column" style="flex-basis:33.33%">
        <!-- wp:heading {"level":2} -->
        <h2>Get In Touch</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p><strong>Email:</strong><br><a href="mailto:info@xequence.com">info@xequence.com</a></p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><strong>Phone:</strong><br>+1 (555) 123-4567</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p><strong>Address:</strong><br>123 Tech Street
San Francisco, CA 94107<br>United States</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:heading {"level":3} -->
        <h3>Connect With Us</h3>
        <!-- /wp:heading -->
        
        <!-- wp:social-links -->
        <ul class="wp-block-social-links">
            <!-- wp:social-link {"url":"https://twitter.com/xequence","service":"twitter"} /-->
            <!-- wp:social-link {"url":"https://github.com/xequence","service":"github"} /-->
            <!-- wp:social-link {"url":"https://linkedin.com/company/xequence","service":"linkedin"} /-->
        </ul>
        <!-- /wp:social-links -->
        
        <!-- wp:heading {"level":3} -->
        <h3>Office Hours</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>Monday - Friday: 9am - 6pm PST<br>Saturday - Sunday: Closed</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column {"width":"66.66%"} -->
    <div class="wp-block-column" style="flex-basis:66.66%">
        <!-- wp:heading {"level":2} -->
        <h2>Send Us a Message</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>Have a question, feedback, or just want to say hello? Fill out the form below and we'll get back to you as soon as possible.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:shortcode -->
        [contact-form-7 id="123" title="Contact Form"]
        <!-- /wp:shortcode -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":2} -->
<h2>Frequently Asked Questions</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":4} -->
<h4>How can I get started with Xequence?</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You can sign up for a free account on our website and start using our platform immediately. We also offer guided onboarding for teams.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>Do you offer enterprise plans?</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Yes, we offer custom enterprise plans with additional features, dedicated support, and custom integrations. Contact our sales team for more information.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>What kind of support do you offer?</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We offer email support for all users, with priority support and dedicated account managers for our premium and enterprise customers.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>Can I integrate Xequence with my existing tools?</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Yes, Xequence integrates with popular developer tools including GitHub, GitLab, Jira, Slack, and more. We also offer an API for custom integrations.</p>
<!-- /wp:paragraph -->';
    }

    /**
     * Get content for Press page
     */
    public function get_press_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Press & Media</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Latest news, press releases, and media resources for Xequence.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":2} -->
<h2>Press Releases</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Xequence Raises $10M Series A to Revolutionize Developer Collaboration</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>April 15, 2025</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p>Xequence, the next generation social platform for developers, today announced it has raised $10 million in Series A funding led by Acme Ventures with participation from existing investors...</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons -->
        <div class="wp-block-buttons">
            <!-- wp:button -->
            <div class="wp-block-button"><a class="wp-block-button__link">Read More</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Xequence Launches Beta Program for Developer Collaboration Platform</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>March 1, 2025</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p>Xequence today announced the launch of its beta program for its developer collaboration platform. The platform aims to revolutionize how developers communicate, share knowledge, and collaborate...</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons -->
        <div class="wp-block-buttons">
            <!-- wp:button -->
            <div class="wp-block-button"><a class="wp-block-button__link">Read More</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3} -->
        <h3>Xequence Announces Partnership with GitHub to Enhance Developer Workflow</h3>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>February 15, 2025</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:paragraph -->
        <p>Xequence today announced a strategic partnership with GitHub to enhance the developer workflow. The integration will allow developers to seamlessly connect their GitHub repositories with Xequence...</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons -->
        <div class="wp-block-buttons">
            <!-- wp:button -->
            <div class="wp-block-button"><a class="wp-block-button__link">Read More</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:heading {"level":2} -->
<h2>In the News</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
    <li><strong>TechCrunch</strong> - <a href="#">"Xequence: The Future of Developer Collaboration"</a> - April 20, 2025</li>
    <li><strong>The Verge</strong> - <a href="#">"How Xequence is Changing the Way Developers Work Together"</a> - April 18, 2025</li>
    <li><strong>Wired</strong> - <a href="#">"Meet the Startup That's Building a Better Way for Developers to Collaborate"</a> - April 16, 2025</li>
    <li><strong>Forbes</strong> - <a href="#">"Xequence Raises $10M to Build the Future of Developer Communication"</a> - April 15, 2025</li>
    <li><strong>VentureBeat</strong> - <a href="#">"Xequence Launches Beta Program for Its Developer Collaboration Platform"</a> - March 2, 2025</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Media Resources</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>Brand Assets</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Download our logo, brand guidelines, and other assets for media use.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
    <!-- wp:button -->
    <div class="wp-block-button"><a class="wp-block-button__link">Download Press Kit</a></div>
    <!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:heading {"level":3} -->
<h3>Executive Bios</h3>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:image {"align":"center","width":150,"height":150,"sizeSlug":"large","className":"is-style-rounded"} -->
        <figure class="wp-block-image aligncenter size-large is-resized is-style-rounded"><img src="https://via.placeholder.com/150" alt="CEO" width="150" height="150"/></figure>
        <!-- /wp:image -->
        
        <!-- wp:heading {"level":4,"align":"center"} -->
        <h4 class="has-text-align-center">Sarah Johnson</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Co-founder & CEO</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons {"contentJustification":"center"} -->
        <div class="wp-block-buttons is-content-justification-center">
            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline"><a class="wp-block-button__link">Full Bio</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:image {"align":"center","width":150,"height":150,"sizeSlug":"large","className":"is-style-rounded"} -->
        <figure class="wp-block-image aligncenter size-large is-resized is-style-rounded"><img src="https://via.placeholder.com/150" alt="CTO" width="150" height="150"/></figure>
        <!-- /wp:image -->
        
        <!-- wp:heading {"level":4,"align":"center"} -->
        <h4 class="has-text-align-center">Michael Chen</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Co-founder & CTO</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons {"contentJustification":"center"} -->
        <div class="wp-block-buttons is-content-justification-center">
            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline"><a class="wp-block-button__link">Full Bio</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:image {"align":"center","width":150,"height":150,"sizeSlug":"large","className":"is-style-rounded"} -->
        <figure class="wp-block-image aligncenter size-large is-resized is-style-rounded"><img src="https://via.placeholder.com/150" alt="CPO" width="150" height="150"/></figure>
        <!-- /wp:image -->
        
        <!-- wp:heading {"level":4,"align":"center"} -->
        <h4 class="has-text-align-center">Alex Rodriguez</h4>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Chief Product Officer</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons {"contentJustification":"center"} -->
        <div class="wp-block-buttons is-content-justification-center">
            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline"><a class="wp-block-button__link">Full Bio</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:heading {"level":2} -->
<h2>Media Inquiries</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>For press inquiries, please contact our PR team at <a href="mailto:press@xequence.com">press@xequence.com</a> or fill out the form below.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[contact-form-7 id="124" title="Media Inquiry Form"]
<!-- /wp:shortcode -->';
    }

    /**
     * Get content for Privacy Policy page
     */
    public function get_privacy_policy_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Privacy Policy</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Last updated: April 15, 2025</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>This Privacy Policy describes how Xequence Inc. ("Xequence," "we," "us," or "our") collects, uses, and discloses your personal information when you visit our website at xequence.com (the "Website") or use our developer collaboration platform (the "Service"). By accessing or using the Website or Service, you agree to this Privacy Policy.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Information We Collect</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We collect several types of information from and about users of our Website and Service, including:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li><strong>Personal Information:</strong> This includes information that can be used to identify you, such as your name, email address, and profile information.</li>
    <li><strong>Usage Data:</strong> We collect information about how you use our Website and Service, including your IP address, browser type, pages visited, and time spent on the Website.</li>
    <li><strong>Content:</strong> We collect and store the content you create, upload, or receive from others when using our Service, such as code snippets, comments, and messages.</li>
    <li><strong>Cookies and Similar Technologies:</strong> We use cookies and similar tracking technologies to track activity on our Website and Service and to hold certain information.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>How We Use Your Information</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We use the information we collect for various purposes, including:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li>To provide, maintain, and improve our Website and Service</li>
    <li>To process and complete transactions</li>
    <li>To send you technical notices, updates, security alerts, and support messages</li>
    <li>To respond to your comments, questions, and requests</li>
    <li>To personalize your experience on our Website and Service</li>
    <li>To monitor and analyze trends, usage, and activities in connection with our Website and Service</li>
    <li>To detect, prevent, and address technical issues</li>
    <li>To comply with legal obligations</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>How We Share Your Information</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We may share your personal information in the following situations:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li><strong>With Service Providers:</strong> We may share your information with third-party vendors, service providers, contractors, or agents who perform services for us.</li>
    <li><strong>With Other Users:</strong> When you share information or interact with other users on our Service, the information you share may be visible to other users.</li>
    <li><strong>With Your Consent:</strong> We may share your information with third parties when you have given us your consent to do so.</li>
    <li><strong>For Legal Reasons:</strong> We may share your information to comply with legal obligations, protect our rights, or respond to legal requests.</li>
    <li><strong>Business Transfers:</strong> We may share or transfer your information in connection with a merger, acquisition, reorganization, or sale of assets.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Your Rights and Choices</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Depending on your location, you may have certain rights regarding your personal information, including:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li>The right to access and receive a copy of your personal information</li>
    <li>The right to correct or update your personal information</li>
    <li>The right to delete your personal information</li>
    <li>The right to restrict or object to the processing of your personal information</li>
    <li>The right to data portability</li>
    <li>The right to withdraw your consent</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>To exercise these rights, please contact us at privacy@xequence.com.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Data Security</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We have implemented appropriate technical and organizational measures to protect the security of your personal information. However, please note that no method of transmission over the Internet or method of electronic storage is 100% secure.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>International Transfers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your personal information may be transferred to and processed in countries other than the country in which you reside. These countries may have data protection laws that are different from the laws of your country.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Children\'s Privacy</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our Website and Service are not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Changes to This Privacy Policy</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date at the top of this Privacy Policy.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you have any questions about this Privacy Policy, please contact us at:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Xequence Inc.<br>123 Tech Street<br>San Francisco, CA 94107<br>United States</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Email: privacy@xequence.com</p>
<!-- /wp:paragraph -->';
    }

    /**
     * Get content for Terms of Service page
     */
    public function get_terms_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Terms of Service</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Last updated: April 15, 2025</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>Please read these Terms of Service ("Terms") carefully before using the xequence.com website (the "Website") or the Xequence developer collaboration platform (the "Service") operated by Xequence Inc. ("Xequence," "we," "us," or "our").</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>By accessing or using the Website or Service, you agree to be bound by these Terms. If you disagree with any part of the Terms, you may not access the Website or use the Service.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>1. Accounts</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>When you create an account with us, you must provide accurate, complete, and up-to-date information. You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>2. User Content</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our Service allows you to post, link, store, share, and otherwise make available certain information, text, graphics, videos, or other material ("User Content"). You are responsible for the User Content that you post on or through the Service, including its legality, reliability, and appropriateness.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>By posting User Content on or through the Service, you represent and warrant that:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li>The User Content is yours (you own it) or you have the right to use it and grant us the rights and license as provided in these Terms.</li>
    <li>The posting of your User Content on or through the Service does not violate the privacy rights, publicity rights, copyrights, contract rights, or any other rights of any person.</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>We reserve the right to terminate the account of any user who infringes copyrights or other intellectual property rights.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>3. Intellectual Property</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The Website and Service, including all content, features, and functionality, are owned by Xequence, its licensors, or other providers and are protected by copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>You agree not to reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or transmit any of the material on our Website or Service, except as follows:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li>Your computer may temporarily store copies of such materials in RAM incidental to your accessing and viewing those materials.</li>
    <li>You may store files that are automatically cached by your Web browser for display enhancement purposes.</li>
    <li>You may print or download one copy of a reasonable number of pages of the Website for your own personal, non-commercial use and not for further reproduction, publication, or distribution.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>4. Prohibited Uses</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You may use the Website and Service only for lawful purposes and in accordance with these Terms. You agree not to use the Website or Service:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li>In any way that violates any applicable federal, state, local, or international law or regulation.</li>
    <li>To transmit, or procure the sending of, any advertising or promotional material, including any "junk mail," "chain letter," "spam," or any other similar solicitation.</li>
    <li>To impersonate or attempt to impersonate Xequence, a Xequence employee, another user, or any other person or entity.</li>
    <li>To engage in any other conduct that restricts or inhibits anyone\'s use or enjoyment of the Website or Service, or which may harm Xequence or users of the Website or Service.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>5. Termination</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service or contact us to request account deletion.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>6. Limitation of Liability</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In no event shall Xequence, its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li>Your access to or use of or inability to access or use the Service;</li>
    <li>Any conduct or content of any third party on the Service;</li>
    <li>Any content obtained from the Service; and</li>
    <li>Unauthorized access, use, or alteration of your transmissions or content.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>7. Disclaimer</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your use of the Website and Service is at your sole risk. The Website and Service are provided on an "AS IS" and "AS AVAILABLE" basis. The Website and Service are provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement, or course of performance.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>8. Governing Law</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>These Terms shall be governed and construed in accordance with the laws of the State of California, United States, without regard to its conflict of law provisions.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>9. Changes to Terms</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days\' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>By continuing to access or use our Website or Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Website and Service.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>10. Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you have any questions about these Terms, please contact us at:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Xequence Inc.<br>123 Tech Street<br>San Francisco, CA 94107<br>United States</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Email: legal@xequence.com</p>
<!-- /wp:paragraph -->';
    }

    /**
     * Get content for Cookie Policy page
     */
    public function get_cookie_policy_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Cookie Policy</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Last updated: April 15, 2025</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>This Cookie Policy explains how Xequence Inc. ("Xequence," "we," "us," or "our") uses cookies and similar technologies on our website at xequence.com (the "Website") and our developer collaboration platform (the "Service").</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>What Are Cookies?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Cookies are small text files that are stored on your computer or mobile device when you visit a website. They are widely used to make websites work more efficiently and provide information to the owners of the site.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Cookies can be "persistent" or "session" cookies. Persistent cookies remain on your device when you go offline, while session cookies are deleted as soon as you close your web browser.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>How We Use Cookies</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We use cookies for the following purposes:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li><strong>Essential Cookies:</strong> These cookies are necessary for the Website and Service to function properly. They enable core functionality such as security, network management, and account access. You may disable these by changing your browser settings, but this may affect how the Website and Service function.</li>
    <li><strong>Analytics Cookies:</strong> We use analytics cookies to collect information about how visitors use our Website and Service, including which pages visitors go to most often and if they receive error messages. These cookies don\'t collect information that identifies individual visitors. We use this information to improve our Website and Service.</li>
    <li><strong>Functionality Cookies:</strong> These cookies allow the Website and Service to remember choices you make (such as your username, language, or region) and provide enhanced, personalized features. They may also be used to provide services you have requested, such as commenting on a blog post.</li>
    <li><strong>Advertising Cookies:</strong> These cookies are used to deliver advertisements that are more relevant to you and your interests. They are also used to limit the number of times you see an advertisement and to help measure the effectiveness of advertising campaigns.</li>
    <li><strong>Social Media Cookies:</strong> These cookies allow you to share our pages and content through third-party social media websites.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Third-Party Cookies</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>In addition to our own cookies, we may also use various third-party cookies to report usage statistics of the Website and Service, deliver advertisements, and so on. These cookies may include:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li><strong>Google Analytics:</strong> We use Google Analytics to help us understand how visitors use our Website and Service.</li>
    <li><strong>Google Ads:</strong> We use Google Ads to deliver relevant advertisements to you.</li>
    <li><strong>Facebook Pixel:</strong> We use Facebook Pixel to measure the effectiveness of our Facebook advertising campaigns.</li>
    <li><strong>LinkedIn Insight Tag:</strong> We use LinkedIn Insight Tag to track conversions, retarget website visitors, and unlock additional insights about members interacting with our ads on LinkedIn.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Your Choices Regarding Cookies</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you prefer to avoid the use of cookies on the Website or Service, you can first disable cookies in your web browser and then delete the cookies saved in your browser associated with this website. You may use the option to prevent your web browser from accepting new cookies or to have the browser notify you when you receive a new cookie.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Please note that if you delete cookies or refuse to accept them, you might not be able to use all of the features we offer, you may not be able to store your preferences, and some of our pages might not display properly.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>How to Manage Cookies</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>You can manage cookies through your web browser settings. Below are links to instructions on how to manage cookies in popular web browsers:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li><a href="https://support.google.com/chrome/answer/95647">Google Chrome</a></li>
    <li><a href="https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences">Mozilla Firefox</a></li>
    <li><a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac">Safari</a></li>
    <li><a href="https://support.microsoft.com/en-us/windows/delete-and-manage-cookies-168dab11-0753-043d-7c16-ede5947fc64d">Microsoft Edge</a></li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Changes to This Cookie Policy</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We may update our Cookie Policy from time to time. We will notify you of any changes by posting the new Cookie Policy on this page and updating the "Last updated" date at the top of this Cookie Policy.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you have any questions about our Cookie Policy, please contact us at:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Xequence Inc.<br>123 Tech Street<br>San Francisco, CA 94107<br>United States</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Email: privacy@xequence.com</p>
<!-- /wp:paragraph -->';
    }

    /**
     * Get content for GDPR page
     */
    public function get_gdpr_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">GDPR Compliance</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">How Xequence complies with the General Data Protection Regulation (GDPR).</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p>The General Data Protection Regulation (GDPR) is a regulation in EU law on data protection and privacy for all individuals within the European Economic Area (EEA). It also addresses the export of personal data outside the EEA. The GDPR aims primarily to give control to individuals over their personal data and to simplify the regulatory environment for international business by unifying the regulation within the EU.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Our Commitment to GDPR</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Xequence is committed to protecting the privacy and security of your personal data. We have implemented various measures to ensure that we comply with the GDPR, including:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li><strong>Data Minimization:</strong> We only collect personal data that is necessary for the purposes for which it is processed.</li>
    <li><strong>Purpose Limitation:</strong> We only use your personal data for the purposes for which it was collected.</li>
    <li><strong>Accuracy:</strong> We take steps to ensure that your personal data is accurate and up-to-date.</li>
    <li><strong>Storage Limitation:</strong> We only retain your personal data for as long as necessary.</li>
    <li><strong>Integrity and Confidentiality:</strong> We have implemented appropriate technical and organizational measures to protect your personal data against unauthorized access, use, or disclosure.</li>
    <li><strong>Transparency:</strong> We provide you with clear and concise information about how we process your personal data.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Your Rights Under GDPR</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Under the GDPR, you have certain rights regarding your personal data, including:</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
    <li><strong>The right to access:</strong> You have the right to request access to your personal data.</li>
    <li><strong>The right to rectification:</strong> You have the right to request that we correct any inaccurate or incomplete personal data.</li>
    <li><strong>The right to erasure:</strong> You have the right to request that we erase your personal data.</li>
    <li><strong>The right to restriction of processing:</strong> You have the right to request that we restrict the processing of your personal data.</li>
    <li><strong>The right to data portability:</strong> You have the right to receive your personal data in a structured, commonly used and machine-readable format and have the right to transmit those data to another controller.</li>
    <li><strong>The right to object:</strong> You have the right to object to the processing of your personal data.</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>To exercise these rights, please contact us at privacy@xequence.com.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Data Processing Agreement</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We offer a Data Processing Agreement (DPA) to our customers who process personal data of individuals within the EEA. The DPA outlines our obligations as a data processor and ensures that we comply with the GDPR.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>To request a DPA, please contact us at legal@xequence.com.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If you have any questions about our GDPR compliance, please contact us at:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Xequence Inc.<br>123 Tech Street<br>San Francisco, CA 94107<br>United States</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Email: privacy@xequence.com</p>
<!-- /wp:paragraph -->';
    }

    /**
     * Get content for Services page
     */
    public function get_services_content() {
        return '<!-- wp:heading {"level":1,"align":"center"} -->
<h1 class="has-text-align-center">Our Services</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Explore the range of services we offer to help you build and grow your business.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns -->
<div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":2} -->
        <h2>Web Development</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>We offer custom web development services to create responsive, user-friendly websites that meet your specific needs.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:list -->
        <ul>
            <li>Custom Website Design</li>
            <li>E-commerce Development</li>
            <li>Content Management Systems (CMS)</li>
            <li>Responsive Design</li>
        </ul>
        <!-- /wp:list -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":2} -->
        <h2>Mobile App Development</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>We develop native and cross-platform mobile applications for iOS and Android devices.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:list -->
        <ul>
            <li>iOS App Development</li>
            <li>Android App Development</li>
            <li>Cross-Platform App Development</li>
            <li>UI/UX Design</li>
        </ul>
        <!-- /wp:list -->
    </div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":2} -->
        <h2>Digital Marketing</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph -->
        <p>We provide digital marketing services to help you reach your target audience and grow your online presence.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:list -->
        <ul>
            <li>Search Engine Optimization (SEO)</li>
            <li>Pay-Per-Click (PPC) Advertising</li>
            <li>Social Media Marketing</li>
            <li>Content Marketing</li>
        </ul>
        <!-- /wp:list -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"40px"} -->
<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":2} -->
<h2>Other Services</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
    <li>Cloud Solutions</li>
    <li>Data Analytics</li>
    <li>IT Consulting</li>
    <li>Cybersecurity</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ready to discuss your project? Contact us today to learn more about our services.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
    <!-- wp:button -->
    <div class="wp-block-button"><a class="wp-block-button__link" href="/contact">Contact Us</a></div>
    <!-- /wp:button -->
</div>
<!-- /wp:buttons -->';
    }
}
