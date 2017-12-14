<?php
/*
Template Name: Search Template
*/
?>

<?php get_header(); ?>

<div class="content">						

	<?php if ( have_posts() ) : 
			
			while ( have_posts() ) : the_post(); ?>

			<div <?php post_class( 'post single' ); ?>>
			
				<div class="post-inner section-inner thin">
		
					<div class="post-header">
																											
						<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
															
					</div><!-- .post-header -->
																					
					<div class="post-content">
		
						<?php the_content(); ?>
						
						<div class="clear"></div>
						
						<?php get_search_form(); ?>

					</div>
				
				</div><!-- .post-inner -->

			</div><!-- .post -->
			
			<?php if ( comments_open() ) : ?>
				
				<div class="comments-container">
					
					<div class="comments-inner section-inner thin">
					
						<?php comments_template( '', true ); ?>
					
					</div>
				
				</div><!-- .comments-container -->
			
			<?php endif;
		
		endwhile; 

	else: ?>

		<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "rams" ); ?></p>

	<?php endif; ?>
	
</div><!-- .content -->
								
<?php get_footer(); ?>