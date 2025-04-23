<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Xequence
 */

get_header();
?>

<div class="min-h-screen bg-dark-900 text-gray-100">
    <!-- Blog Header -->
    <section class="py-16 bg-dark-900 border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">
                    <?php
                    if (is_category()) {
                        echo single_cat_title('', false);
                    } elseif (is_tag()) {
                        echo single_tag_title('', false);
                    } elseif (is_author()) {
                        echo get_the_author();
                    } elseif (is_date()) {
                        if (is_day()) {
                            echo get_the_date();
                        } elseif (is_month()) {
                            echo get_the_date('F Y');
                        } elseif (is_year()) {
                            echo get_the_date('Y');
                        } else {
                            echo 'Archives';
                        }
                    } else {
                        echo 'Blog';
                    }
                    ?>
                </h1>
                <p class="text-gray-400 mb-8">
                    <?php
                    if (is_category()) {
                        echo category_description();
                    } elseif (is_tag()) {
                        echo tag_description();
                    } elseif (is_author()) {
                        echo get_the_author_meta('description');
                    } else {
                        echo get_theme_mod('blog_description', 'Insights, updates, and stories from the Xequence team');
                    }
                    ?>
                </p>
                <div class="relative max-w-md mx-auto">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-search text-gray-500"></i>
                        </div>
                        <input type="search" class="pl-10 w-full bg-dark-800 border border-gray-700 text-gray-300 focus:border-primary-500 rounded-md py-2 px-4" placeholder="Search articles..." value="<?php echo get_search_query(); ?>" name="s" />
                        <input type="hidden" name="post_type" value="post" />
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-2/3">
                    <?php if (have_posts()) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php while (have_posts()) : the_post(); ?>
                        <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 hover:border-primary-500/50 transition-all duration-300 rounded-xl overflow-hidden">
                            <div class="relative h-48 w-full">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover')); ?>
                                <?php else : ?>
                                    <div class="w-full h-full bg-dark-700 flex items-center justify-center">
                                        <i class="fa-regular fa-image text-gray-600 text-4xl"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-xs text-gray-400 mb-2">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<span class="bg-primary-900/50 text-primary-400 px-2 py-1 rounded text-xs">';
                                        echo esc_html($categories[0]->name);
                                        echo '</span>';
                                    }
                                    ?>
                                    <span class="mx-2">•</span>
                                    <div class="flex items-center">
                                        <i class="fa-regular fa-calendar text-xs mr-1"></i>
                                        <?php echo get_the_date(); ?>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="text-xl font-semibold hover:text-primary-400 transition-colors">
                                    <?php the_title(); ?>
                                </a>
                                <p class="text-gray-400 text-sm mt-2"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-700/50">
                                    <div class="flex items-center text-xs text-gray-400">
                                        <i class="fa-regular fa-user text-xs mr-1"></i>
                                        <?php the_author(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="text-primary-400 text-sm hover:text-primary-300 transition-colors flex items-center">
                                        Read more <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-12">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => '<i class="fa-solid fa-chevron-left mr-1"></i> Previous',
                            'next_text' => 'Next <i class="fa-solid fa-chevron-right ml-1"></i>',
                            'type' => 'list',
                            'before_page_number' => '',
                            'after_page_number' => '',
                        ));
                        ?>
                    </div>
                    <?php else : ?>
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-8 text-center">
                        <h2 class="text-2xl font-semibold mb-4">No posts found</h2>
                        <p class="text-gray-400 mb-6">Sorry, but no posts match your criteria. Try a different search or browse our categories.</p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center bg-primary-600 hover:bg-primary-500 text-white px-4 py-2 rounded-lg transition-colors">
                            Back to Home
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <!-- Categories -->
                    <div class="mb-8 bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <h3 class="text-xl font-semibold mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <?php
                            $categories = get_categories(array(
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'hide_empty' => 1,
                            ));
                            
                            foreach ($categories as $category) {
                                echo '<li>';
                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="flex justify-between items-center text-gray-400 hover:text-primary-400 transition-colors">';
                                echo '<span>' . esc_html($category->name) . '</span>';
                                echo '<span class="bg-dark-900/70 px-2 py-0.5 rounded-full text-xs">' . esc_html($category->count) . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Popular Tags -->
                    <div class="mb-8 bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <h3 class="text-xl font-semibold mb-4">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php
                            $tags = get_tags(array(
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'number' => 10,
                                'hide_empty' => 1,
                            ));
                            
                            foreach ($tags as $tag) {
                                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="bg-dark-900/70 text-gray-400 hover:text-primary-400 hover:border-primary-500/50 px-3 py-1 rounded-full text-sm border border-gray-700/50 transition-colors">';
                                echo esc_html($tag->name);
                                echo '</a>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <h3 class="text-xl font-semibold mb-2"><?php echo get_theme_mod('newsletter_title', 'Subscribe to our newsletter'); ?></h3>
                        <p class="text-gray-400 text-sm mb-4"><?php echo get_theme_mod('newsletter_description', 'Get the latest updates and articles delivered straight to your inbox.'); ?></p>
                        <?php echo do_shortcode('[newsletter_form]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
