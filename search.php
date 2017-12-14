<?php get_header(); ?>

	<div class="content">

		<?php if ( have_posts() ) : ?>
		
			<div class="page-title">
			
				<h4>
			
					<?php 
					
					printf( __( 'Search results: "%s"', 'rams' ), get_search_query() );
					
					$paged = get_query_var( 'paged' ) ?: 1;
					
					if ( 1 < $wp_query->max_num_pages ) : ?>
					
						<span><?php printf( __( '(page %s of %s)', 'rams' ), $paged, $wp_query->max_num_pages ); ?></span>
					
					<?php endif; ?>
				
				</h4>
				
			</div>
					
			<div class="posts" id="posts">
				
				<?php while ( have_posts() ) : the_post(); ?>
		    	
		    		<?php get_template_part( 'content', get_post_format() ); ?>
		    			        		            
		        <?php endwhile; ?>
							
			</div><!-- .posts -->
			
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
			
				<div class="archive-nav">
				
					<?php echo get_next_posts_link( '&laquo; ' . __( 'Older posts', 'rams' ) ); ?>
						
					<?php echo get_previous_posts_link( __( 'Newer posts', 'rams' ) . ' &raquo;' ); ?>
					
					<div class="clear"></div>
					
				</div><!-- .post-nav archive-nav -->
								
			<?php endif; ?>
	
		<?php else : ?>
						
			<div class="page-title section small-padding">
		
				<h4>
			
					<?php 
					
					printf( __( 'Search results: "%s"', 'rams' ), get_search_query() );
					
					$paged = get_query_var( 'paged' ) ?: 1;
					
					if ( 1 < $wp_query->max_num_pages ) : ?>
					
						<span><?php printf( __('(page %s of %s)', 'rams'), $paged, $wp_query->max_num_pages ); ?></span>
					
					<?php endif; ?>
					
				</h4>
				
			</div>
						
			<div class="post section medium-padding">
			
				<div class="post-content section-inner thin">
				
					<p><?php _e( 'No results. Try again, would you kindly?', 'rams' ); ?></p>
					
					<?php get_search_form(); ?>
				
				</div><!-- .post-content -->
				
				<div class="clear"></div>
			
			</div><!-- .post -->
		
		<?php endif; ?>
		
	</div><!-- .content section-inner -->
		
<?php get_footer(); ?>