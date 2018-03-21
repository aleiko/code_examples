<?php
/*
* Template name: Past events page
*/
get_header(); ?>

    <section id="content">

		<div id="inner-content">

		    <main id="main" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="row large-uncollapse medium-uncollapse small-collapse">
                    <div class="columns small-12">

                    <div class="page_title"><?php the_title();?></div>
                    <?php // Page menu start
                        if( $rows = get_field('custom_page_menu')) : ?>

                                <ul class="custom_page_menu">
                                    <?php foreach($rows as $row) : ?>
                                        <?php if($row['text'] && $row['link']) : ?>
                                        <li class="custom_page_menu_item">
                                            <a href="<?php echo $row['link']; echo $row['anchor'] ? '#' . $row['anchor'] : '';?>"><?=$row['text'];?></a>
                                        </li>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </ul>

                    <?php endif; // Page menu END ?>

                    </div>
                </div>

			     <?php if(get_the_content()) : ?>
                 <!--		Page Content	     -->
			     <div class="row">
                    <div class="columns small-12">
                        <div class="entry-content">
                            <?php the_content();?>
                        </div>
                    </div>
                </div>
			     <?php endif;?>

			    <?php endwhile; endif;
                wp_reset_postdata();?>

                <?php
                // Custom Post query
                $today = date('Ymd');
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array (
                    'post_type' => 'events',
                    'posts_per_page'=> 30,
                    'meta_key' => 'event_start_date',
                    'orderby' => 'meta_value_num',
                    'paged' => $paged,
                    'order' => 'asc',
                    'meta_query' => array(
                         array(
                            'key'		=> 'event_start_date',
                            'compare'	=> '<=',
                            'value'		=> $today,
                        ),
                    ),
                );
                $query = new WP_Query($args);

                $temp_query = $wp_query;
                $wp_query   = NULL;
                $wp_query   = $query;

                ?>
                <?php if($query->have_posts()) :
                        while($query->have_posts()) : $query->the_post();?>

                        <div class="row events_item event_row">
                            <div class="columns small-12">
                                <h1 class="posts-title">
                                    <a href="<?php the_permalink();?>">
                                        <?php if($day_start = get_field('event_start_date')) :
                                            $date = new DateTime($day_start);?>
                                        <!--               Event Day start               -->
                                        <span><?=$date->format('F d');?> : </span>
                                        <?php endif;?>
                                        <?php the_title();?>
                                    </a>
                                </h1>
                            </div>
                        </div>

                    <?php endwhile;?>
                <?php wp_reset_postdata();?>
                <?php joints_page_navi(); ?>
                <?php endif;?>
                <?php $wp_query = NULL;
                      $wp_query = $temp_query;
                ?>

			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</section> <!-- end #content -->

<?php //get_sidebar(); ?>
<?php get_footer();?>
