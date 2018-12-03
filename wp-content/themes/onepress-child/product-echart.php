<?php
/**
 *Template Name: Product (echarts)
 *
 * @package OnePress
 */
get_header();

/**
 * @since 2.0.0
 * @see onepress_display_page_title
 */
//do_action( 'onepress_page_before_content' );
?>
	<div id="content" class="site-content">
        <?php
        onepress_breadcrumb();
        ?>

        <main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

                        <section id="features0" class="hide section-features section-padding onepage-section">
                            <div class="container">

                                <div class="section-title-area">
                                    <h2 class="section-title"><?php the_title(); ?></h2>
                                </div>

                                <div class="section-content">

                                    <?php the_content();?>

                                </div>

                            </div>
                        </section>

                    <?php endwhile; // End of the loop. ?>


                    <?php

                    if(is_user_logged_in()):



                    // The Query
                    $the_query = new WP_Query( array( 'post_type' => 'fund' ) );

                    // The Loop
                    if ( $the_query->have_posts() ) {

                        $account_date = '';
                        $product_info = '';
                        $latest_account = $IDs = $titles = [];

                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();

                            $id = get_the_ID();
                            $title = get_the_title();
                            $IDs[$id] = $id;
                            $legend[] = $title;

                            $fund_data = get_field('fund_data');

                            $fund_datas[$id] = $fund_data;
                            $tmp_fund_data = $latest_account[$id] = array_column($fund_data, 'net_value');

                            $titles[$id] = $title;

                            $tmp_account_date   = array_column($fund_data, 'account_date');

                            if( '' == $account_date ) {
                                $account_date = array_column($fund_data, 'account_date');
                            } else {
                                $account_date = array_merge($account_date, $tmp_account_date);
                            }

                            $product_info .= '
                                                <script>
                                                var account_date_'.$id.' = '. json_encode($tmp_account_date) .';
                                                var fund_data_'.$id.' = '. json_encode($tmp_fund_data) .';
                                                </script>
                                                <tr>
                                                    <th scope="row">'. $title .'</th>
                                                    <td title="净值日期">' . end($account_date) . '</td>
                                                    <td title="最新净值">' . end($latest_account[$id]) . '</td>
                                                    <td title="今年收益">' . get_field('current_year_revenue'). '</td>
                                                </tr>';

                        }

                        $account_date = array_unique($account_date);
                        asort ($account_date);

                        $account_date = array_values($account_date);

//                        print_r($account_date);
//                        print_r($fund_datas);

                        $series = [];

                        foreach ($IDs as $id ){

                            $data = [];
                            foreach ($account_date as $adate) {

//                                foreach ($fund_datas[$id] as $value) {
//                                    if($value['account_date'] == $adate) {
//                                        $data[$adate] = $value['net_value'];
//                                    }
//                                }

                                $key = array_search($adate, array_column($fund_datas[$id], 'account_date'));
                                if ($key){
                                    $data[] = isset($fund_datas[$id][$key]['account_date']) ? $fund_datas[$id][$key]['net_value'] : 0;
                                }else{
                                    $data[] = 0;
                                }


                            }

                            $serie = array(
                                'name' => $titles[$id],
                                'type' => 'line',
                                'data' => $data
                            );

                            $series[] =  $serie;
                        }

                        //print_r($series);die;

                        ?>


                        <section id="features1" class="section-features section-padding section-meta onepage-section">
                        <div class="container">
                            <div class="section-title-area">
                                <h2 class="section-title">产品概况</h2>
                            </div>

                            <div class="section-content">
                                <div class="">
                                    <table class="table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" width="40%">产品名称</th>
                                            <th scope="col">净值日期</th>
                                            <th scope="col">最新净值</th>
                                            <th scope="col">今年收益</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php echo $product_info; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </section>

                        <section id="features2" class="section-features section-padding onepage-section">
                            <div class="container">
                                <div class="section-title-area">
                                    <h2 class="section-title">产品历史</h2>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <div id="products-chart" style="width: 100%;height:<?php echo wp_is_mobile()? 400 : 600 ?>px;"></div>
                                    </div>
                                </div>

                            </div>
                        </section>


                        <section id="features3" class="section-features section-padding section-meta onepage-section">
                            <div class="container">
                                <div class="section-title-area">
                                    <h2 class="section-title">产品详情</h2>
                                </div>

                                <div class="section-content">

                                        <div id="carouselExampleControls" class="carousel slide" data-interval="false" data-ride="carousel" style="width: 100%">

                                            <div class="carousel-inner">

                                                <?php $first_id = array_values($IDs)[0]; foreach ($IDs as $id):?>


                                                    <div class="carousel-item <?php if($first_id == $id) echo 'active'; ?>">
                                                        <table class="table" style="width: 100%">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">产品名称</th>
                                                                <th scope="col">净值日期</th>
                                                                <th scope="col">最新净值</th>
                                                                <th scope="col">一周超额</th>
                                                                <th scope="col">累计超额</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row"><?php echo $titles[$id] ?></th>
                                                                <td><?php echo end($account_date) ?></td>
                                                                <td><?php echo end($latest_account[$id]); ?></td>
                                                                <td><?php echo get_field('week_overfulfil', $id ); ?></td>
                                                                <td><?php echo get_field('total_overfulfil', $id ); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5" style="">
                                                                    <div class="product-chart" data-id="<?php echo $id ?>" id="chart-<?php echo $id ?>" style="width: 100%;height:<?php echo wp_is_mobile()? 400 : 600 ?>px;"></div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                <?php endforeach; ?>

                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>

                                </div>

                            </div>
                        </section>



                    <?php

                        /* Restore original Post Data */
                        wp_reset_postdata();
                    }
                    endif;
                    ?>




				</main><!-- #main -->

	</div><!-- #content -->


<script type="text/javascript">

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('products-chart'));

    var option = {
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: <?php echo json_encode($legend); ?>
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: <?php echo json_encode($account_date); ?>
        },
        yAxis: {
            type: 'value'
        },
        series: <?php echo json_encode($series); ?>
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

    var $chart_id = jQuery('.carousel-item.active').find('.product-chart').data('id');
    var single_myChart = echarts.init(document.getElementById('chart-' + $chart_id));
    var single_option = {
        xAxis: {
            type: 'category',
            data: eval('account_date_' + $chart_id)
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: eval('fund_data_' + $chart_id),
            type: 'line'
        }]
    };
    single_myChart.setOption(single_option);

    jQuery('#carouselExampleControls').on('slid.bs.carousel', function () {
        // do something…
        var $product_chart = jQuery(this).find('.active').find('.product-chart');
        var $chart_id = $product_chart.data('id');
        var single_myChart2 = echarts.init(document.getElementById('chart-' + $chart_id));
        var single_option2 = {
            xAxis: {
                type: 'category',
                data: eval('account_date_' + $chart_id)
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: eval('fund_data_' + $chart_id),
                type: 'line'
            }]
        };

        single_myChart2.setOption(single_option2);
    })

</script>

<?php get_footer(); ?>
