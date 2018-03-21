<?php
/*
* Template name: Contacts page
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
                    <div class="columns small-12 medium-6">
                        <div class="contacts-info">
                            <?php if(get_field('address', 'option')) : ?>
                            <p class="address"><?php the_field('address', 'option');?></p>
                            <?php endif;?>

                            <?php if($rows = get_field('get_directions', 'option')) : // Direction link ?>
                            <?php foreach($rows as $row) : ?>

                                <a href="<?=$row['link'];?>" class="contacts-link get-directions" target="_blank"><?=$row['text']?></a>

                            <?php endforeach;?>
                            <?php endif; ?>

                            <?php if($rows = get_field('phones', 'option')) : // Phone link ?>
                            <?php foreach($rows as $row) : ?>

                                <a href="tel:<?=$row['number'];?>" class="contacts-link"><?=$row['label']?></a>

                            <?php endforeach;?>
                            <?php endif; ?>

                            <?php if(get_field('phone_text', 'option')) : ?>
                            <p><?php the_field('phone_text', 'option');?></p>
                            <?php endif;?>

                            <?php if($rows = get_field('emails', 'option')) : // Email link ?>
                            <?php foreach($rows as $row) : ?>

                                <a href="mailto:<?=$row['email'];?>" class="contacts-link"><?=$row['label']?></a>

                            <?php endforeach;?>
                            <?php endif; ?>

                        </div>
                        <?php //Map ?>
                        <?php $location = get_field('google_map', 'option')?>
                        <?php if(!empty($location)) : ?>
                        <div class="maps-holder">
                            <div class="acf-map">
                                <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">

                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="columns small-12 medium-6 lagre-5">
                        <?php if($form = get_field('contact_form', 'option')):?>

                        <?php echo do_shortcode('[gravityform id="'. $form['id'] .'"  ajax="true" title="false"]');?>

                        <?php endif;?>
                    </div>
                </div>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</section> <!-- end #content -->

<?php //get_sidebar(); ?>
<?php get_footer();?>
