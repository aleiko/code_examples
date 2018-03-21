<?php
/*
* Template name: Volunteers page
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

                <div class="row align-justify">
                    <div class="columns small-12 medium-6 large-5 hide-for-small-only">
                        <?php if(get_the_post_thumbnail()){
                                the_post_thumbnail('full');
                        }?>
                    </div>
                    <div class="columns small-12 medium-6 lagre-5">
                        <?php if($form = get_field('contact_form')):?>

                        <?php echo do_shortcode('[gravityform id="'. $form['id'] .'"  ajax="true"]');?>

                        <?php endif;?>
                    </div>
                </div>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</section> <!-- end #content -->

<?php //get_sidebar(); ?>
<?php get_footer();?>
