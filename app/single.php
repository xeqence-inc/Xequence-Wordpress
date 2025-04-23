<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Xequence
 */

get_header();
?>

<div class="min-h-screen bg-dark-900 text-gray-100">
    <!-- Blog Post Header -->
    <section class="pt-16 pb-8 bg-dark-900 border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center text-sm text-gray-400 mb-4">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="text-primary-400 hover:text-primary-300">
                        Blog
                    </a>
                    <span class="mx-2">/</span>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="text-primary-400 hover:text-primary-300">';
                        echo esc_html($categories[0]->name);
                        echo '</a>';
                    }
                    ?>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-bold mb-6"><?php the_title(); ?></h1>
                
                <div class="flex flex-wrap items-center text-sm text-gray-400 mb-6 gap-4">
                    <div class="flex items-center">
                        <div class="relative w-10 h-10 rounded-full overflow-hidden mr-3">
                            <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'w-full h-full object-cover')); ?>
                        </div>
                        <div>
                            <div class="font-medium text-white"><?php the_author(); ?></div>
                            <div class="text-xs"><?php echo get_the_author_meta('description') ? esc_html(wp_trim_words(get_the_author_meta('description'), 3)) : 'Author'; ?></div>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <i class="fa-regular fa-calendar mr-1"></i>
                        <?php echo get_the_date(); ?>
                    </div>
                    
                    <div class="flex items-center">
                        <i class="fa-regular fa-user mr-1"></i>
                        <?php echo xequence_reading_time(); ?> min read
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (has_post_thumbnail()) : ?>
    <!-- Featured Image -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="relative h-[400px] w-full rounded-xl overflow-hidden">
                    <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Blog Content -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8 max-w-6xl mx-auto">
                <!-- Main Content -->
                <div class="lg:w-2/3">
                    <article class="prose prose-invert prose-lg max-w-none">
                        <?php the_content(); ?>
                    </article>
                    
                    <!-- Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ($tags) : ?>
                    <div class="mt-8 flex flex-wrap gap-2">
                        <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="bg-dark-800 text-gray-400 hover:text-primary-400 hover:border-primary-500/50 px-3 py-1 rounded-full text-sm border border-gray-700/50 transition-colors flex items-center">
                            <i class="fa-solid fa-tag text-xs mr-1"></i>
                            <?php echo esc_html($tag->name); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Share -->
                    <div class="mt-8 pt-8 border-t border-gray-800">
                        <div class="flex flex-wrap items-center justify-between">
                            <div class="text-gray-400 mb-4 md:mb-0">Share this article:</div>
                            <div class="flex space-x-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-gray-700 text-gray-400 hover:text-primary-400 hover:border-primary-500/50 transition-colors">
                                    <i class="fa-brands fa-facebook-f"></i>
                                    <span class="sr-only">Share on Facebook</span>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-gray-700 text-gray-400 hover:text-primary-400 hover:border-primary-500/50 transition-colors">
                                    <i class="fa-brands fa-twitter"></i>
                                    <span class="sr-only">Share on Twitter</span>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-gray-700 text-gray-400 hover:text-primary-400 hover:border-primary-500/50 transition-colors">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                    <span class="sr-only">Share on LinkedIn</span>
                                </a>
                                <button onclick="navigator.clipboard.writeText('<?php echo esc_url(get_permalink()); ?>'); alert('Link copied to clipboard!');" class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-gray-700 text-gray-400 hover:text-primary-400 hover:border-primary-500/50 transition-colors">
                                    <i class="fa-solid fa-share"></i>
                                    <span class="sr-only">Copy link</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Author Bio -->
                    <div class="mt-8 bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6">
                        <div class="flex items-start">
                            <div class="relative w-16 h-16 rounded-full overflow-hidden mr-4">
                                <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold"><?php the_author(); ?></h3>
                                <p class="text-gray-400 text-sm mb-2"><?php echo get_the_author_meta('job_title') ? esc_html(get_the_author_meta('job_title')) : 'Author'; ?></p>
                                <p class="text-gray-300">
                                    <?php echo get_the_author_meta('description') ? esc_html(get_the_author_meta('description')) : 'Author bio not available.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="mt-8 pt-8 border-t border-gray-800">
                        <?php comments_template(); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <!-- Related Posts -->
                    <div class="bg-dark-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 mb-8">
                        <h3 class="text-xl font-semibold mb-4">Related Articles</h3>
                        <div class="space-y-4">
                            <?php
                            $categories = get_the_category();
                            if ($categories) {
                                $category_ids = array();
                                foreach ($categories as $category) {
                                    $category_ids[] = $category->term_id;
                                }
                                
                                $related_args = array(
                                    'category__in' => $category_ids,
                                    'post__not_in' => array(get_the_ID()),
                                    'posts_per_page' => 3,
                                    'orderby' => 'rand',
                                );
                                
                                $related_query = new WP_Query($related_args);
                                
                                if ($related_query->have_posts()) :
                                    while ($related_query->have_posts()) : $related_query->the_post();
                            ?>
                            <div class="flex items-start">
                                <div class="relative w-20 h-20 rounded overflow-hidden flex-shrink-0">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                                    <?php else : ?>
                                        <div class="w-full h-full bg-dark-700 flex items-center justify-center">
                                            <i class="fa-regular fa-image text-gray-600"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4">
                                    <a href="<?php the_permalink(); ?>" class="font-medium hover:text-primary-400 transition-colors line-clamp-2">
                                        <?php the_title(); ?>
                                    </a>
                                    <div class="text-xs text-gray-500 mt-1"><?php echo get_the_date(); ?></div>
                                </div>
                            </div>
                            <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
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
