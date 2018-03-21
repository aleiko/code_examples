<?php
/*
* Template name: Home page
*/
get_header(); ?>
<div class="main_wrap home_page page">

<section class="sub_header" style="background-image:url('<?php the_field('section_image');?>')">
    <div class="row align-center">
        <div class="columns large-9 medium-10 small-12">
               <?php if( $sub_header_text = get_field('section_title') ) : ?>
                <h1 class="sub_header_title"><?=$sub_header_text;?></h1>
                <?php endif;?>
                    <?php if( $sub_header_btn = get_field('sub_header_button') ) : ?>
                        <?php if( $sub_header_btn[0]['link'] && $sub_header_btn[0]['text'] ) : ?>
                            <a href="<?=$sub_header_btn[0]['link'];?>" class="main_btn"><?=$sub_header_btn[0]['text'];?></a>
                        <?php endif;?>
                <?php endif;?>
        </div>
    </div>
</section>

<section id="content" class="main_text_section">
        <?php if($rows = get_field('home_body_blocks')) : ?>
           <div class="row">

            <?php foreach($rows as $row) : ?>

                <div class="columns medium-6 small-12">
                    <div class="home-item-wrap">

                       <?php if($row['title']):?>
                        <h2 class="item-title matchHeight"><?=$row['title'];?></h2>
                       <?php endif; ?>

                       <?php if($row['button_link'] && $row['button_text']):?>
                            <a href="<?=$row['button_link'];?>" class="main_btn"><?=$row['button_text'];?></a>
                       <?php endif; ?>

                       <?php if($row['show_posts']) :

                            $args = array(
                                'post_type'      => $row['show_posts'],
                                'posts_per_page' => 1,
                                'order'          => 'DESC',
                            );
                            $query = new WP_Query($args);

                        if($query->have_posts()) : // loop start
                        while( $query->have_posts() ) :
                            $query->the_post();
                        ?>
                        <div class="home-posts-wrap">
                            <a href="<?php the_permalink();?>" class="image_link">
                                <div class="posts-title-wrap matchHeight_title">
                                    <?php if($day_start = get_field('event_start_date')) :
                                    $date = new DateTime($day_start);

                                    ?>
                                    <!--               Event Day start               -->
                                       <span><?=$date->format('F d');?> :</span>
                                    <?php endif;?>
                                    <h3 class="home-posts-title">
                                       <?php if($row['photo_title']){
                                            echo $row['photo_title'];
                                        }else{
                                            the_title();
                                        }?>
                                    </h3>
                                </div>
                                <?php the_post_thumbnail('main-img');?>
                            </a>
                        </div>
                       <?php endwhile; ?>

                       <?php else : // loop else ?>
                            <?php if($chosen_page_id = $row['choose_post']) : ?>
                                <div class="home-posts-wrap">
                                    <a href="<?php the_permalink($chosen_page_id);?>" class="image_link">
                                        <div class="posts-title-wrap matchHeight_title">
                                            <h3 class="home-posts-title">
                                            <?php if($row['photo_title']){
                                                    echo $row['photo_title'];
                                                }else{
                                                    echo get_the_title($chosen_page_id);
                                                }?>
                                            </h3>
                                        </div>
                                        <?php $img_url = get_the_post_thumbnail_url($chosen_page_id, 'main-img');?>
                                        <img src="<?=$img_url;?>" alt="">
                                    </a>
                                </div>
                            <?php endif; ?>
                       <?php endif; // loop end ?>
                       <?php wp_reset_postdata();?>

                       <?php endif; // END if show posts == true ?>
                    </div>
                </div>

            <?php endforeach; // $rows?>

            </div>
		<?php endif; ?>
		<?php if(have_posts()) :
                while(have_posts()) : the_post();
        ?>
        <div class="row">
            <div class="columns small-12">
                <div class="entry-content">
                    <?php the_content();?>
                </div>
            </div>
        </div>
        <?php endwhile;
            endif;?>
</section>

</div>

<?php //get_sidebar(); ?>
<?php get_footer();?>
