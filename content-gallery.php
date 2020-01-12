<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="featured-media">	
		
		<?php rams_flexslider( 'post-image' ); ?>
		
	</div><!-- .featured-media -->
	
	<div class="post-inner">
		
		<div class="post-header">

			<?php if ( get_post_type() == 'post' ) : ?>
			
				<p class="post-date">
				
					<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
					
					<?php if ( is_sticky() ) : ?>
					
						<span class="sep">/</span> <?php _e( 'Sticky', 'rams' ); ?>
					
					<?php endif; ?>
					
				</p>

			<?php endif; ?>
			
		    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		    	    
		</div><!-- .post-header -->
		
		<?php if ( get_the_content() ) : ?>
		
			<div class="post-content">
			
				<?php the_content(); ?>
			
			</div><!-- .post-content -->
			
		<?php endif; ?>
	
	</div><!-- .post-inner -->

</div><!-- .post -->