<?php
/**
 * Template Name: Full-width Page Template
 *
 * Description: Displays a full-width page, with no sidebar. This template is great for pages
 * containing large amounts of content.
 *
 * @package Smartshop
 * @since Smartshop 1.0
 */

get_header(); ?>
<div id="page-header-container" class="container">
    <div class="headsection row">
        <h2 class="title"><?php the_title(); ?></h2>
        
    </div>
</div>

	<div id="primary" class="site-content row" role="main">
		<div class="col grid_12_of_12">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>

			<?php endif; // end have_posts() check ?>

		</div> <!-- /.col.grid_12_of_12 -->
	</div><!-- /#primary.site-content.row -->

<?php get_footer(); ?>
