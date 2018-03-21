<?php
/*
* Template name: Past events full version page
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
                        while($query->have_posts()) : $query->the_post();
                    $event_id = get_the_ID();
                ?>

                        <div class="row events_item event_row">
                            <div class="columns small-12 medium-6">
                                    <div class="row">
                                        <div class="columns small-12 medium-6">
                                            <h1 class="posts-title">
                                                <a href="<?php the_permalink($event_id);?>">
                                                    <?php if($day_start = get_field('event_start_date')) :
                                                        $date = new DateTime($day_start);?>
                                                    <!--               Event Day start               -->
                                                    <span><?=$date->format('F d');?> : </span>
                                                    <?php endif;?>
                                                    <?php the_title();?>
                                                </a>
                                            </h1>
                                            <?php if($time = get_field('event_start_time')) : ?>
                                            <!--           Event time             -->
                                            <div class="block_label"><?php _e('Event time :','jointswp');?>
                                                <span><?=$time;?></span>
                                            </div>
                                            <?php endif;?>

                                            <?php if($location = get_field('events_location')) : ?>
                                            <!--           Event location             -->
                                            <div class="block_label"><?php _e('Event location :','jointswp');?>
                                                <span><?=$location;?></span>
                                            </div>
                                            <?php endif;?>
                                            <!--        Share buttons block       -->
                                            <div class="share_buttons_block">
                                                <?php echo do_shortcode('[ssba]'); ?>
                                            </div>

                                        </div>

                                         <!--           Show image for small devices                -->
                                         <?php if($img = get_the_post_thumbnail($event_id, 'main-img')) : ?>
                                         <div class="columns small-12 show-for-small-only collapse-padding-small">
                                            <div class="wp-caption">
                                                <a href="<?php the_permalink();?>" class="image_link">
                                                <?=$img;?>
                                                </a>
                                                <?php if($caption = get_the_post_thumbnail_caption() ):?>
                                                <p class="wp-caption-text"><?=$caption;?></p>
                                                <?php endif;?>
                                            </div>
                                         </div>
                                         <?php endif;?>

                                        <?php if(get_the_content()) : ?>
                                          <div class="columns small-12">
                                               <div class="entry-content event-content">
                                                <?php the_content();?>
                                               </div>
                                          </div>
                                        <?php endif;?>
                                    </div>
                                </div>

                                <?php if(get_the_post_thumbnail()) : ?>
                                            <!-- Image -->
                                <div class="columns small-12 medium-6 hide-for-small-only">
                                    <div class="wp-caption">
                                        <a href="<?php the_permalink();?>" class="image_link">
                                        <?=$img;?>
                                        </a>
                                        <?php if($caption = get_the_post_thumbnail_caption() ):?>
                                        <p class="wp-caption-text collapse-padding-small"><?=$caption;?></p>
                                        <?php endif;?>
                                    </div>
                                </div>

                                <?php endif;?>
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
