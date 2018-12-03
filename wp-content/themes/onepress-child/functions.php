<?php
/**
 * Created by PhpStorm.
 * User: YAO
 * Date: 2018/8/26
 * Time: 21:52
 */

/**
 * Disable responsive image support (test!)
 */

function onepress_footer_site_info()
{
    ?>
    <?php printf(esc_html__('Copyright %1$s %2$s %3$s', 'onepress'), '&copy;', esc_attr(date('Y')), esc_attr(get_bloginfo())); ?>
<!--    <span class="sep"> &ndash; </span>-->
    <?php
}


// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

}, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_empty_array',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_empty_array', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );


function my_theme_enqueue_styles() {

    $parent_style = 'onepress-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    //wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

    if(1==1 && is_page_template('product-echart.php')):
        wp_enqueue_script( 'echarts', get_stylesheet_directory_uri() . '/assets/js/echarts.common.min.js');
    endif;
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

add_filter( 'user_contactmethods', function ($methods, $user){
    $methods = array(
        'gender'    => "性别",
        'nation'    => "国籍",
        'job'    => "职业",
        'birthday'    => "出生日期",
    );
    return $methods;
}, 10, 2 );


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
        $output .= '<nav id="cdp_pagination" style="padding-top: 30px;" class="text-center clearfix" aria-label="Page navigation">' .$pagination. '</nav>';

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

//add_filter( 'wppb_login_widget_title', function ($title){} );

add_filter( 'wppb_login_message', function ( $logged_in_message, $user_id, $display_name ){

    $investor_type = get_user_meta( $user_id, 'investor_type', true );
    $user_risk_type =  get_user_meta( $user_id, '_rist_type', true);

    if("" !== $investor_type && "" == $user_risk_type) {

        $link = '';
        if ( $investor_type == 'personal_investor' ){
            $link = 'personal-investor-test';
        }
        if ( $investor_type == 'institutional_investor' ){
            $link = 'institutional-investor-test';
        }

        $warning = '<div class="alert alert-danger" role="alert">你还没有接受风险测试，<br>赶快<a href="/'. $link .'" class="alert-link">测试一下</a>吧。</div>';
        return $warning . $logged_in_message;

    }

    if("" !== $investor_type && "" !== $user_risk_type) {

        return $logged_in_message .
            '<div class="alert alert-info" role="alert">您是 【' .$user_risk_type. '】 的投资者</div>';
    }


    return $logged_in_message;
}, 10, 3 );


/**
 * 得分说明：
 * A选项为1分；B选项为2分；C选项为3分；D选项为4分，E选项为5分。
 * 9-13分，保守型，该类型投资者对投资比较谨慎，希望能够尽量回避风险，并且在保证本金安全的基础上能有一定的增值收入。
 * 14-35分，稳健型，该类型投资者清楚自己的风险收益，对投资风险有所了解，愿意在承担一定风险的前提下获取较高的收益，希望投资收益能够长期稳步增长。
 * 36-60分，积极型，该类型投资者不排斥冒险，并期望能够获得资金的长期增值，接受收益的正常波动，常常会为提高收益而采取主动投资，并且愿意为此承受较大的风险。
 */
add_filter('mlw_qmn_template_variable_results_page', function ($content, $mlw_quiz_array){

    $points = $mlw_quiz_array["total_points"];

    if ( $points <= 13 ) {
        $type = '保守型';
    }

    if ( $points > 13 && $points <=35 ){
        $type = '稳健型';
    }

    if( $points > 35 ) {
        $type = '积极型';
    }

    $user = wp_get_current_user();
    $user_id = $user->ID;

    update_user_meta($user_id, '_rist_type', $type);
    update_user_meta($user_id, '_rist_score', $points);

    $content = str_replace( "%TIANYAN_SCORE%" , $type, $content);
    return $content;

},99,2);


add_action('wp_footer', function (){
    ?>
    <script>

        jQuery(document).ready(function () {

            var $body_height = jQuery("body").height(),
                $page_height = jQuery("#page").height();

            if($page_height < $body_height ){

                jQuery(".site-footer").css({
                    position: "fixed",
                    width: "100%",
                    bottom: 0
                });
            }
        });

    </script>


<?php
});



