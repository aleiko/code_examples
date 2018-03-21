<?php
/*
* Template name: Members page
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

                <?php if($rows = get_field('members_blocks')) : // Blocks start ?>
                <!--        Repeated Blocks            -->
                    <?php foreach($rows as $row) : ?>

                    <div id="<?=$row['block_id']?>" class="row about_blocks">

                       <?php if($row['title']) : ?>
                        <div class="columns small-12 medium-12">
                            <h2 class="section-title"><?=$row['title'];?></h2>
                        </div>
                       <?php endif; ?>
                     <div class="columns small-12">
                        <div class="row about_blocks_content">

                            <?php if($row['content']) : ?>

                            <div class="entry-content columns small-12 <?=$class;?>"><?=$row['content'];?></div>

                            <?php endif;?>

                            <?php if($row['image']) : ?>

                            <div class="columns small-12 medium-10 large-8 collapse-padding-small">
                                <div class="wp-caption">
                                    <img src="<?=$row['image']['sizes']['main-img']?>" alt="<?=$row['image']['alt']?>">
                                    <p class="wp-caption-text"><?=$row['image']['caption']?></p>
                                </div>
                            </div>

                            <?php endif;?>
                        </div>
                     </div>
                    </div>

                    <?php endforeach;?>

			    <?php endif;  // end Blocks?>
			     <?php if($rows = get_field('download_docks_block')) : // Blocks start ?>
                <!--        Download documents           -->
                    <?php foreach($rows as $row) : ?>

                    <div id="<?=$row['block_id']?>" class="row download_block file_row">
                        <div class="columns small-12">
                          <div class="download_block_title">
                              <?=$row['title']?>
                          </div>
                           <?php if($row['documents']) : ?>
                               <?php foreach($row['documents'] as $document):?>
                                <div class="file_item">
                                    <a href="<?=$document['file']?>" target="_blank" class="download_file">
                                        <img src="<?=$document['icon']?>" alt="">
                                        <?=$document['file_title']?>
                                    </a>
                                </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </div>

                    <?php endforeach;?>

			    <?php endif;?>
			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</section> <!-- end #content -->

<?php //get_sidebar(); ?>
<?php get_footer();?>
