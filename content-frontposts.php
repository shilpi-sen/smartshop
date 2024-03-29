<?php
/**
 * The template for displaying featured posts on Front Page 
 *
 * @package smartshop
 * @since smartshop 1.0
 */
?>

<?php
// Start a new query for displaying featured posts on Front Page

if (get_theme_mod('smartshop_front_featured_posts_check')) {
    $featured_count = intval(get_theme_mod('smartshop_front_featured_posts_count'));
    $var = get_theme_mod('smartshop_front_featured_posts_cat');

    // if no category is selected then return 0 
    $featured_cat_id = max((int) $var, 0);

    $featured_post_args = array(
        'post_type' => 'post',
        'posts_per_page' => $featured_count,
        'cat' => $featured_cat_id,
        'post__not_in' => get_option('sticky_posts'),
    );
    $featuredposts = new WP_Query($featured_post_args);
    ?>
    <div id="front-featured-posts">

        <div id="featured-posts-container" class="row">
                <?php if (get_theme_mod('smartshop_front_featured_posts_title')) : ?>
                    <h3 class="featured-section-title">
                        <?php echo get_theme_mod('smartshop_front_featured_posts_title'); ?>
                    </h3>
                <?php endif; ?>
				<div id="featured-posts" class="grid_8_of_12">
                <?php if ($featuredposts->have_posts()) : $i = 1; ?>

                    <?php while ($featuredposts->have_posts()) : $featuredposts->the_post(); ?>

                        <div <?php post_class('clearfix home-featured');  ?>  id="post-<?php the_ID(); ?>">
                            <div class="front-post-image">
                            <?php if(has_post_thumbnail()) { ?>
                            <a href="<?php the_permalink() ?>" class="post-link" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('post-thumb'); ?>
								
                            </a>
                            <?php } ?>
                            </div>
                            <div class="front-post-content">
                            <h3 class="title">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                             <span class="post-meta"><small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small></span>
                            <?php $content = get_the_content();
					echo wp_trim_words( $content , '50' ); ?>
                           
			</div>						
                        </div><!--end .entry-->

                        <?php $i+=1; ?>

                    <?php endwhile; ?>

                <?php else : ?>


                    <h2 class="title"><?php _e('Not Found','smartshop'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','smartshop'); ?></p>
                    <?php get_search_form(); ?>

                <?php endif; ?>

            </div> <!-- /#featured-posts -->
            <?php get_sidebar(); ?>
        </div> <!-- /#featured-posts-container -->
        <?php get_sidebar(); ?>
    </div> <!-- /#front-featured-posts -->

<?php
} // end Featured post query ?>