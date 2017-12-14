<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	
		<div class="featured-media">	
			
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			
				<?php the_post_thumbnail( 'post-image' ); ?>
			
			</a>
			
		</div><!-- .featured-media -->
			
	<?php endif; ?>
	
	<div class="post-inner">
		
		<div class="post-header">
			
			<p class="post-date">
			
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
				
				<?php if ( is_sticky() ) : ?>
				
					<span class="sep">/</span> <span class="is-sticky"><?php _e( 'Sticky', 'rams' ); ?></span>
				
				<?php endif; ?>
				
			</p>
			
		    <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		    	    
		</div><!-- .post-header -->
		
		<div class="post-content">
		
			<?php the_content(); ?>
		
		</div>
	
	</div><!-- .post-inner -->

</div><!-- .post -->