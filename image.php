<?php get_header(); ?>

<div class="content">
											        
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
			<div class="featured-media">

				<?php echo wp_get_attachment_image( $post->ID, 'post-image' ); ?>
				
			</div>
			
			<div class="post-inner section-inner thin">
			
				<div class="post-header">
				
					<div class="post-date">
					
						<?php the_time( get_option( 'date_format' ) ); ?>
					
					</div>
				
					<h2 class="post-title"><?php echo basename( get_attached_file( $post->ID ) ); ?></h2>
				
				</div><!-- .post-header -->
				
				<?php 

				$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
				
				if ( $image_caption ) : ?>
													
					<div class="post-content section-inner thin">
					
						<p><?php echo $image_caption; ?></p>
						
					</div>
					
				<?php endif; ?>
				
			</div><!-- .post-inner -->
																			
		<?php endwhile; 

		else: ?>
	
			<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "rams" ); ?></p>
		
		<?php endif; ?>    
		
		<div class="post-meta">
		
			<a class="post-meta-toggle" href="#" title="<?php _e( 'Show information about the post', 'rams' ); ?>">
			
				<div class="post-meta-toggle-inner">
			
					<div class="bars">
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
					</div>
				
					<p><?php _e( 'Post meta', 'rams' ); ?></p>
					
					<div class="clear"></div>
				
				</div>
				
			</a><!-- .post-meta-toggle -->
			
			<div class="post-meta-inner">
			
				<p><strong><?php _e( 'Author', 'rams' ); ?></strong><?php the_author_posts_link(); ?></p>
				
				<p class="post-meta-date"><strong><?php _e( 'Posted', 'rams' ); ?></strong><a href="<?php the_permalink(); ?>"><?php the_date( get_option( 'date_format' ) ); ?><span> &mdash; <?php the_time( get_option( 'time_format' ) ); ?></span></a></p>
				
				<?php $image_array = wp_get_attachment_image_src( $post->ID, 'full', false ); $url = $image_array['0']; ?>
				
				<p><strong><?php _e( 'Resolution', 'rams' ); ?></strong><?php echo $image_array['1'] . 'x' . $image_array['2'] . ' px'; ?></p>
							
			</div><!-- .post-meta-inner -->
		
		</div><!-- .post-meta -->
			
	</div><!-- .post -->
	
	<div class="comments-container">
	
		<div class="comments-inner section-inner thin">
	
			<?php comments_template( '', true ); ?>
		
		</div>
	
	</div>

</div><!-- .content -->
		
<?php get_footer(); ?>