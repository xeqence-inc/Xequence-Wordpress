<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Xequence
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <div class="sticky top-24 space-y-8">
        <!-- Search Widget -->
        <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Search</h2>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="relative">
                    <input type="search" class="w-full bg-dark-900 border border-gray-700 rounded-lg px-4 py-3 pl-10 text-white focus:outline-none focus:border-primary-500" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Recent Posts Widget -->
        <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Recent Posts</h2>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 5,
                'post_status' => 'publish'
            ));
            
            if (!empty($recent_posts)) {
                echo '<ul class="space-y-4">';
                foreach ($recent_posts as $post) {
                    echo '<li class="flex items-start">';
                    if (has_post_thumbnail($post['ID'])) {
                        echo '<a href="' . get_permalink($post['ID']) . '" class="flex-shrink-0 mr-3">';
                        echo '<div class="w-16 h-16 rounded-md overflow-hidden">';
                        echo get_the_post_thumbnail($post['ID'], 'thumbnail', array('class' => 'w-full h-full object-cover'));
                        echo '</div>';
                        echo '</a>';
                    } else {
                        echo '<a href="' . get_permalink($post['ID']) . '" class="flex-shrink-0 mr-3">';
                        echo '<div class="w-16 h-16 rounded-md overflow-hidden bg-dark-900 flex items-center justify-center">';
                        echo '<i class="fas fa-file-alt text-primary-400"></i>';
                        echo '</div>';
                        echo '</a>';
                    }
                    echo '<div>';
                    echo '<h3 class="font-medium"><a href="' . get_permalink($post['ID']) . '" class="hover:text-primary-400 transition-colors">' . $post['post_title'] . '</a></h3>';
                    echo '<span class="text-sm text-gray-400">' . get_the_date('', $post['ID']) . '</span>';
                    echo '</div>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p class="text-gray-400">No recent posts found.</p>';
            }
            ?>
        </div>

        <!-- Categories Widget -->
        <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Categories</h2>
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC'
            ));
            
            if (!empty($categories)) {
                echo '<ul class="space-y-2">';
                foreach ($categories as $category) {
                    echo '<li class="flex items-center justify-between">';
                    echo '<a href="' . get_category_link($category->term_id) . '" class="text-gray-300 hover:text-primary-400 transition-colors">' . $category->name . '</a>';
                    echo '<span class="bg-dark-900 text-gray-400 text-xs px-2 py-1 rounded-full">' . $category->count . '</span>';
                    echo '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p class="text-gray-400">No categories found.</p>';
            }
            ?>
        </div>

        <!-- Tags Widget -->
        <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Tags</h2>
            <?php
            $tags = get_tags(array(
                'orderby' => 'count',
                'order'   => 'DESC',
                'number'  => 20
            ));
            
            if (!empty($tags)) {
                echo '<div class="flex flex-wrap gap-2">';
                foreach ($tags as $tag) {
                    echo '<a href="' . get_tag_link($tag->term_id) . '" class="bg-dark-900 text-gray-300 hover:text-primary-400 hover:border-primary-400 transition-colors text-sm px-3 py-1 rounded-full border border-gray-700">';
                    echo $tag->name;
                    echo '</a>';
                }
                echo '</div>';
            } else {
                echo '<p class="text-gray-400">No tags found.</p>';
            }
            ?>
        </div>

        <!-- Call to Action Widget -->
        <div class="bg-gradient-to-br from-primary-900/50 to-primary-800/50 backdrop-blur-sm border border-primary-700/30 rounded-xl p-6 text-center">
            <h2 class="text-xl font-bold mb-2">Ready to Get Started?</h2>
            <p class="text-gray-300 mb-4">Join thousands of developers already using Xequence.</p>
            <a href="/signup" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-6 py-3 rounded-lg inline-block w-full">
                Sign Up for Free
            </a>
        </div>

        <!-- Social Media Widget -->
        <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Follow Us</h2>
            <div class="flex justify-between">
                <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                    <i class="fab fa-twitter text-2xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                    <i class="fab fa-github text-2xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                    <i class="fab fa-linkedin text-2xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                    <i class="fab fa-discord text-2xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                    <i class="fab fa-youtube text-2xl"></i>
                </a>
            </div>
        </div>

        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside><!-- #secondary -->
