<?php
/**
 *Template Name: Home Page
 *
 * @package OnePress
 */

get_header();
?>

	<div class="wrapper">
		<div class="page-wrap">
			<?php the_custom_logo(); ?>

    		<div id="headline"><?php echo html_entity_decode(get_bloginfo('description'))  ?></div>

		</div>
     </div>

<?php
get_footer();
