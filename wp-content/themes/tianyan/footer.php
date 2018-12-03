<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tianyan
 */

?>

	</div><!-- #content -->
</div><!-- #page -->

<div class="navbar  navbar-inverse navbar-fixed-bottom" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">&copy; 2018 <?php bloginfo('name') ?>.  All rights reserved.</a>
		</div>
     
        <div class="collapse navbar-collapse">
			<?php
			$primary_menu = wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container'		 => 'ul',
				'menu_class'	 => 'nav navbar-nav navbar-right',
                'echo'           => false,
			) );

            $primary_menu = str_replace('menu-item-has-children', 'menu-item-has-children dropdown', $primary_menu);
            $primary_menu = str_replace('sub-menu', 'sub-menu dropdown-menu', $primary_menu);
            $primary_menu = str_replace('#dropdown-toggle"', '#dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown" ', $primary_menu);

			echo $primary_menu;
			?>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</div><!-- /.navbar -->


<?php wp_footer(); ?>

</body>
</html>
