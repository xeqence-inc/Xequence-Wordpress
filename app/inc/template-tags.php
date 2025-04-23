<?php
/**
 * Custom template tags for this theme
 *
 * @package Xequence
 */

if (!function_exists('xequence_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function xequence_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        echo '<span class="posted-on"><i class="fa-regular fa-calendar mr-1"></i>' . $time_string . '</span>';
    }
endif;

if (!function_exists('xequence_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function xequence_posted_by() {
        echo '<span class="byline"><i class="fa-regular fa-user mr-1"></i><span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span></span>';
    }
endif;

if (!function_exists('xequence_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function xequence_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'xequence'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links"><i class="fa-solid fa-folder mr-1"></i>' . esc_html__('Posted in %1$s', 'xequence') . '</span>', $categories_list);
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'xequence'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links"><i class="fa-solid fa-tag mr-1"></i>' . esc_html__('Tagged %1$s', 'xequence') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link"><i class="fa-regular fa-comment mr-1"></i>';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'xequence'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'xequence'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link"><i class="fa-solid fa-pencil mr-1"></i>',
            '</span>'
        );
    }
endif;

if (!function_exists('xequence_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function xequence_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail('full', array('class' => 'rounded-xl w-full h-auto')); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'class' => 'w-full h-full object-cover',
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>

            <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('xequence_reading_time')) :
    /**
     * Calculate and return the estimated reading time for a post.
     *
     * @return int Estimated reading time in minutes.
     */
    function xequence_reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // Assuming 200 words per minute reading speed
        
        return $reading_time < 1 ? 1 : $reading_time;
    }
endif;

/**
 * Custom Walker class for the primary navigation menu
 */
class Xequence_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Check if the item has children
        $has_children = in_array('menu-item-has-children', $classes);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';
        
        // Add classes for styling
        $atts['class'] = 'text-gray-300 hover:text-white transition-colors';
        
        if ($has_children) {
            $atts['class'] .= ' dropdown-toggle flex items-center';
        }
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        if ($has_children) {
            $item_output .= ' <i class="fa-solid fa-chevron-down ml-1 text-xs dropdown-icon"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        
        if ($has_children && $depth === 0) {
            $output .= '<div class="hidden absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-dark-800 ring-1 ring-black ring-opacity-5 py-1 dropdown-menu">';
        }
    }
    
    /**
     * Ends the element output.
     */
    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children && $depth === 0) {
            $output .= '</div>';
        }
        
        $output .= "</li>\n";
    }
}

/**
 * Custom Walker class for the mobile navigation menu
 */
class Xequence_Mobile_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Check if the item has children
        $has_children = in_array('menu-item-has-children', $classes);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';
        
        // Add classes for styling
        if ($depth === 0) {
            $atts['class'] = 'text-lg font-medium text-gray-300 hover:text-white transition-colors';
        } else {
            $atts['class'] = 'block text-gray-400 hover:text-white';
        }
        
        if ($has_children) {
            $atts['class'] .= ' dropdown-toggle flex items-center';
        }
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        
        if ($has_children) {
            $item_output .= '<button'. $attributes .'>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= ' <i class="fa-solid fa-chevron-down ml-1 text-xs dropdown-icon"></i>';
            $item_output .= '</button>';
        } else {
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
        }
        
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        
        if ($has_children) {
            $output .= '<div class="hidden mt-2 ml-4 space-y-2 dropdown-menu">';
        }
    }
    
    /**
     * Ends the element output.
     */
    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children) {
            $output .= '</div>';
        }
        
        $output .= "</li>\n";
    }
}
