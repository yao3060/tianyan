<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tianyan
 */

get_header();
?>
<div class="container" data-class="inside-wrap">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <a href="/" border="0">
                        <img class="top-logo" src="<?php echo get_stylesheet_directory_uri() ?>/images/logo.png" style="width: 200px; height: auto;">
                    </a>

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
    </div>

	<div class="inside-logo hide">
        <a href="/" border="0">
			<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false ) ?>
        </a>
	</div>



</div>
<?php
get_footer();
