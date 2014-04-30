<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Smartshop
 * @since Smartshop 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( !is_front_page() ) { ?>
		<header class="entry-header">
			
			<?php if ( has_post_thumbnail() && !is_search() && !post_password_required() ) { ?>
				<?php the_post_thumbnail( 'post_feature_full_width' ); ?>
			<?php } ?>
		</header>
	<?php } ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'smartshop' ),
			'after' => '</div>',
			'link_before' => '<span class="page-numbers">',
			'link_after' => '</span>'
		) ); ?>
	</div><!-- /.entry-content -->
	<footer class="entry-meta">
		<?php edit_post_link( esc_html__( 'Edit', 'smartshop' ) . ' <i class="fa fa-angle-right"></i>', '<div class="edit-link">', '</div>' ); ?>
	</footer><!-- /.entry-meta -->
</article><!-- /#post -->