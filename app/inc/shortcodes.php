<?php
/**
 * Custom shortcodes for the Xequence theme
 *
 * @package Xequence
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Newsletter form shortcode
 */
function xequence_newsletter_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'placeholder' => 'Your email address',
        'button_text' => 'Subscribe',
    ), $atts, 'newsletter_form');
    
    ob_start();
    ?>
    <div class="space-y-3">
        <form action="#" method="post" class="newsletter-form">
            <div class="flex gap-2">
                <input 
                    type="email" 
                    name="email" 
                    placeholder="<?php echo esc_attr($atts['placeholder']); ?>" 
                    required
                    class="w-full px-4 py-2 bg-dark-900 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:border-primary-500"
                />
                <button 
                    type="submit" 
                    class="bg-primary-600 hover:bg-primary-500 text-white px-4 py-2 rounded-md transition-colors"
                >
                    <?php echo esc_html($atts['button_text']); ?>
                </button>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('newsletter_form', 'xequence_newsletter_form_shortcode');

/**
 * Feature box shortcode
 */
function xequence_feature_box_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'icon' => 'fa-star',
        'title' => 'Feature Title',
    ), $atts, 'feature_box');
    
    ob_start();
    ?>
    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 hover:border-primary-500/50 transition-all duration-300">
        <div class="text-primary-400 mb-4">
            <i class="fa-solid <?php echo esc_attr($atts['icon']); ?> fa-2x"></i>
        </div>
        <h3 class="text-xl font-semibold mb-3"><?php echo esc_html($atts['title']); ?></h3>
        <p class="text-gray-400"><?php echo do_shortcode($content); ?></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('feature_box', 'xequence_feature_box_shortcode');

/**
 * Button shortcode
 */
function xequence_button_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'url' => '#',
        'style' => 'primary', // primary, secondary, outline
        'icon' => '',
        'size' => 'medium', // small, medium, large
        'class' => '',
    ), $atts, 'button');
    
    $classes = 'inline-flex items-center transition-all duration-300 rounded-lg ';
    
    // Button style
    if ($atts['style'] === 'primary') {
        $classes .= 'bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(20,184,166,0.3)] ';
    } elseif ($atts['style'] === 'secondary') {
        $classes .= 'bg-dark-800 hover:bg-dark-700 text-white ';
    } elseif ($atts['style'] === 'outline') {
        $classes .= 'border border-primary-500/50 text-primary-400 hover:bg-primary-500/10 ';
    }
    
    // Button size
    if ($atts['size'] === 'small') {
        $classes .= 'px-3 py-1 text-sm ';
    } elseif ($atts['size'] === 'medium') {
        $classes .= 'px-4 py-2 ';
    } elseif ($atts['size'] === 'large') {
        $classes .= 'px-6 py-3 text-lg ';
    }
    
    // Additional classes
    if ($atts['class']) {
        $classes .= $atts['class'];
    }
    
    $icon_html = '';
    if ($atts['icon']) {
        $icon_html = '<i class="fa-solid ' . esc_attr($atts['icon']) . ' ml-2"></i>';
    }
    
    return '<a href="' . esc_url($atts['url']) . '" class="' . esc_attr($classes) . '">' . do_shortcode($content) . $icon_html . '</a>';
}
add_shortcode('button', 'xequence_button_shortcode');

/**
 * Code block shortcode
 */
function xequence_code_block_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'language' => 'javascript',
        'title' => 'code.js',
    ), $atts, 'code_block');
    
    ob_start();
    ?>
    <div class="w-full bg-dark-900/70 backdrop-blur-md rounded-xl border border-gray-800 overflow-hidden mb-6">
        <div class="flex items-center justify-between p-3 bg-dark-900 border-b border-gray-800">
            <div class="flex space-x-2">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
            </div>
            <div class="text-xs font-mono text-gray-400"><?php echo esc_html($atts['title']); ?></div>
            <div></div>
        </div>
        <div class="p-4 font-mono text-sm text-gray-300 overflow-x-auto">
            <pre class="whitespace-pre"><code class="language-<?php echo esc_attr($atts['language']); ?>"><?php echo esc_html($content); ?></code></pre>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('code_block', 'xequence_code_block_shortcode');

/**
 * CTA box shortcode
 */
function xequence_cta_box_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => 'Ready to get started?',
        'button_text' => 'Get Started',
        'button_url' => '#',
        'badge' => '',
    ), $atts, 'cta_box');
    
    ob_start();
    ?>
    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8 text-center">
        <?php if ($atts['badge']) : ?>
        <div class="inline-block mb-6 px-4 py-2 bg-primary-900/30 text-primary-300 rounded-full border border-primary-700/30 font-mono text-sm tracking-wider">
            <?php echo esc_html($atts['badge']); ?>
        </div>
        <?php endif; ?>
        
        <h3 class="text-2xl md:text-3xl font-bold mb-4"><?php echo esc_html($atts['title']); ?></h3>
        <p class="text-gray-400 max-w-2xl mx-auto mb-6"><?php echo do_shortcode($content); ?></p>
        
        <a href="<?php echo esc_url($atts['button_url']); ?>" class="inline-flex items-center bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white px-6 py-3 rounded-lg transition-all duration-300 hover:translate-y-[-2px] hover:shadow-[0_4px_12px_rgba(20,184,166,0.3)]">
            <?php echo esc_html($atts['button_text']); ?>
            <i class="fa-solid fa-chevron-right ml-2"></i>
        </a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('cta_box', 'xequence_cta_box_shortcode');
