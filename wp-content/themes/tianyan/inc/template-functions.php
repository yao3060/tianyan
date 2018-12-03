<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package tianyan
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tianyan_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'tianyan_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function tianyan_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'tianyan_pingback_header' );


function tianyan_posts() {

    if ( get_query_var( 'paged' ) ) {
        $paged = get_query_var( 'paged' );
    } elseif ( get_query_var( 'page' ) ) {
        $paged = get_query_var( 'page' );
    } else {
        $paged = 1;
    }

    $posts_per_page = 10;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'offset'        => ($paged - 1) * $posts_per_page,
        'page' => $paged
    );
    // The Query
    $the_query = new WP_Query( $args );

    $output = '';

    // The Loop
    if ( $the_query->have_posts() ) {


        add_filter( 'excerpt_length', function ($length){ return 99; }, 999 );

        $output .= '<div class="section-news">';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $output .= '<article class="list-article clearfix post status-publish format-standard hentry">
                            <div class="list-article-content">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a target="_blank" href="'. get_the_permalink() .'">' . get_the_title() . '</a> </h2>
                                </header>
                                <div class="entry-excerpt"><p>'. get_the_excerpt() .'</p></div>
                            </div>
                        </article>';
        }
        $output .= '</div>';


        $total = ceil($the_query->found_posts/$posts_per_page ); // need an unlikely integer
        $base = str_replace( $total, '%#%', esc_url( get_pagenum_link( $total ) ) ); //trailingslashit(get_pagenum_link(1)) . '%_%'

        $pagination = paginate_links( array(
            'base'      => $base,
            'format'    => '?paged=%#%',
            'total'     => $total,
            'current'   => max( 1, get_query_var('paged') ),
            'end_size'  => 1,
            'mid_size'  => 3,
            'type'      => 'list'
        ));

        $pagination = str_replace("<ul class='page-numbers'>", "<ul class='pagination'>", $pagination);
        $pagination = str_replace("<li>", "<li class=\"page-item\">", $pagination);
        $pagination = str_replace("page-numbers", "page-link", $pagination);
        $output .= '<nav id="cdp_pagination"  class="text-center clearfix" aria-label="Page navigation">' .$pagination. '</nav>';

    } else {
        // no posts found
    }


    /* Restore original Post Data */
    wp_reset_postdata();

    return $output;
}

add_action('init', function(){

    add_shortcode('posts', 'tianyan_posts');

} );