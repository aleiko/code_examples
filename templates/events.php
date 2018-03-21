<?php
/*
* Template name: Events page
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

                <?php if($label = get_field('upcoming_events_label')) : ?>
                <div class="row">
                     <div class="columns small-12">
                        <div class="block_label single-label"><?=$label;?></div>
                     </div>
                </div>
                <?php endif;?>

			    <?php if(get_field('manage_event_by_hand')) : // START manage event by hand?>
                    <?php if($event_id = get_field('promoted_event')) : ?>
                    <div class="row">
                        <div class="columns small-12 medium-6">
                           <div class="row">
                               <div class="columns small-12">
                                   <!--           Title  Start            -->
                                    <h1 class="posts-title">
                                    <a href="<?php the_permalink($event_id);?>">
                                        <?php if($day_start = get_field('event_start_date', $event_id)) :
                                            $date = new DateTime($day_start);?>
                                        <!--               Event Day start               -->
                                        <span><?=$date->format('F d');?> : </span>
                                        <?php endif;?>
                                        <?=get_the_title($event_id);?>
                                    </a>
                                    </h1>
                                    <!--           Title  End            -->

                                    <?php if($time = get_field('event_start_time', $event_id)) : ?>
                                    <!--           Event time             -->
                                   <div class="block_label"><?php _e('Event time :','jointswp');?>
                                       <span><?=$time;?></span>
                                   </div>
                                    <?php endif;?>

                                    <?php if($location = get_field('events_location', $event_id)) : ?>
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
                           </div>
                            <!--           Show image for small devices                -->
                           <?php if($img = get_the_post_thumbnail($event_id, 'main-img')) : ?>
                            <div class="columns small-12 show-for-small-only collapse-padding-small">
                                <div class="wp-caption">
                                    <a href="<?php the_permalink($event_id);?>" class="image_link">
                                    <?=$img;?>
                                    </a>
                                    <?php if($caption = get_the_post_thumbnail_caption($event_id) ):?>
                                    <p class="wp-caption-text collapse-padding-small"><?=$caption;?></p>
                                    <?php endif;?>
                                </div>
                            </div>
                            <?php endif;?>

                           <?php $content = apply_filters('the_content', get_post_field('post_content', $event_id));?>
                           <?php if($content) : ?>

                           <div class="row">
                              <div class="columns small-12">
                               <div class="entry-content event-content">
                                <?=$content;?>
                               </div>
                              </div>
                           </div>

                            <?php endif;?>

                        </div>

                        <?php if($img = get_the_post_thumbnail($event_id, 'main-img')) : ?>

                        <div class="columns small-12 medium-6 hide-for-small-only">
                            <div class="wp-caption">
                                <a href="<?php the_permalink($event_id);?>" class="image_link">
                                <?=$img;?>
                                </a>
                                <?php if($caption = get_the_post_thumbnail_caption($event_id) ):?>
                                <p class="wp-caption-text"><?=$caption;?></p>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    <?php endif;
                            wp_reset_postdata(); //RESET post data ?>

                <?php else : // ELSE manage event by hand?>

                    <?php
                    // Custom Post query
                    $today = date('Ymd');

                    $args = array (
                        'post_type' => 'events',
                        'posts_per_page'=> 1,
                        'meta_key' => 'event_start_date',
                        'orderby' => 'meta_value_num',
                        'order' => 'asc',
                        'meta_query' => array(
                             array(
                                'key'		=> 'event_start_date',
                                'compare'	=> '>=',
                                'value'		=> $today,
                            ),
                        ),
                    );
                    $query = new WP_Query($args);
                    ?>
                    <?php if($query->have_posts()) :
                            while($query->have_posts()) : $query->the_post();?>
                            <div class="row">
                                <div class="columns small-12 medium-6">
                                        <div class="row">
                                            <div class="columns small-12">
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
                                              <div class="row">
                                                  <div class="columns small-12">
                                                       <div class="entry-content event-content">
                                                        <?php the_content();?>
                                                       </div>
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
                    <?php endif;?>
                    <?php wp_reset_postdata();?>

                <?php endif; // END manage event by hand ?>
			    <?php endwhile; endif;?>

			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</section> <!-- end #content -->

<?php //get_sidebar(); ?>
<?php get_footer();?>
