<?php
/**
 * The template for displaying posts in the Audio post format
 *
 * @package Smartshop
 * @since Smartshop 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_single() ) { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php }
		else { ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'smartshop' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		<?php } // is_single() ?>
		<?php smartshop_posted_on(); ?>
	</header> <!-- /.entry-header -->
	<div class="entry-content">
		<div class="audio-content">
			<?php the_content( wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'smartshop' ), array( 
				'span' => array( 
					'class' => array() ) 
				) ) ); ?>
			<?php wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'smartshop' ),
				'after' => '</div>',
				'link_before' => '<span class="page-numbers">',
				'link_after' => '</span>'
			) ); ?>
		</div><!-- /.audio-content -->
	</div> <!-- /.entry-content -->

	<footer class="entry-meta">
		<?php if ( is_singular() ) {
			// Only show the tags on the Single Post page
			smartshop_entry_meta();
		} ?>
		<?php edit_post_link( esc_html__( 'Edit', 'smartshop' ) . ' <i class="fa fa-angle-right"></i>', '<div class="edit-link">', '</div>' ); ?>
		<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) {
			// If a user has filled out their description and this is a multi-author blog, show their bio
			get_template_part( 'author-bio' );
		} ?>
	</footer> <!-- /.entry-meta -->
</article> <!-- /#post -->
