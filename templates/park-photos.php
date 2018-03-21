<?php
/*
* Template name: Park photos page
*/
get_header(); ?>

    <section id="content">

		<div id="inner-content">

		    <main id="main" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="row large-uncollapse medium-uncollapse small-collapse">
                    <div class="columns small-12">

                    <h1 class="page_title"><?php the_title();?></h1>
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
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array (
                    'post_type' => 'photos',
                    'photo_cats' => 'park-photos',
                    'order'=>'DESC',
                    'posts_per_page'=> 12,
                    'paged' => $paged,
                );
                $query = new WP_Query($args);

                $temp_query = $wp_query;
                $wp_query   = NULL;
                $wp_query   = $query;

                ?>
                <?php if($query->have_posts()) :?>
                      <div class="row events_item event_row">

                       <?php while($query->have_posts()) : $query->the_post();
                          $post_id = get_the_ID();?>

                            <?php if($img = get_the_post_thumbnail($post_id, 'photo-galerysize')) : ?>

                            <div class="columns small-12 medium-6 large-3 photo_item">
                               <div class="wp-caption">
                                    <a href="<?php the_permalink();?>" class="image_link">
                                    <?=$img;?>
                                    </a>
                                   <p class="wp-caption-text collapse-padding-small">
                                       <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                   </p>
                                    <?php if($caption = get_the_post_thumbnail_caption() ):?>
                                    <p class="after-caption-text collapse-padding-small"><?=$caption;?></p>
                                    <?php endif;?>
                                </div>
                            </div>

                            <?php endif;?>

                        <?php endwhile;?>

                      </div>
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
