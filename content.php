<?php
/**
 * @package
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="inside-article">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		</header><!-- .entry-header -->
		<div class="entry-content" itemprop="text">
				<?php the_content(); ?>
				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', OMNI_TXT_DOMAIN ),
					'after'  => '</div>',
				) );
				?>
		</div><!-- .entry-content -->

	</div><!-- .inside-article -->
</article><!-- #post-## -->