<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tianyan
 */

get_header();
?>
<div class="inside-wrap">

	<div class="inside-logo">
        <a href="/" border="0">
			<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false ) ?>
        </a>
	</div>


	<div id="primary" class="content-area right-column">
		<main id="main" class="site-main">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php the_content();?>		
				</div>				
				
			</article>
			<?php endwhile; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_footer();