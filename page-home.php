<?php
/**
Template Name: Home Page
 *
 * @package gridsby
 */

get_header(); ?>

	<div class="container"> 
			<!-- Top Navigation -->
			
            <section class="grid3d horizontal" id="grid3d">
				<div class="grid-wrap">
					
                    <div id="gallery-container" class="grid infinite-scroll">
                    	<?php
							global $post;
							$args = array( 'post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC' );
							$myposts = get_posts( $args );
							foreach( $myposts as $post ) :	setup_postdata($post); ?>
				
                			<figure class="gallery-image">
							<?php the_post_thumbnail('gallery-thumb'); ?>
                            </figure><!-- gallery-image --> 
                	
						<?php endforeach; ?>
					</div><!-- gallery-container --> 
				
                </div><!-- /grid-wrap -->
				
                <div class="content">
                        <?php
							global $post;
							$args = array( 'post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC' );
							$myposts = get_posts( $args );
							foreach( $myposts as $post ) :	setup_postdata($post); ?>
                            <div>
								<div class="dummy-img"><?php the_post_thumbnail('gallery-full'); ?></div>
                            	<h2 class="dummy-title"><?php the_title(); ?><div class='share-button share-button-left'></div></h2>
								<p class="dummy-text"><?php the_content(); ?></p>
							</div>
						<?php endforeach; ?>
					<span class="loading"></span>
					<span class="icon close-content"><i class="fa fa-close"></i></span>
				</div><!-- content -->
			</section><!-- grid3d -->
	</div><!-- /container -->

<?php get_footer(); ?>
