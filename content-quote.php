<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<a class="post-quote" href="<?php the_permalink(); ?>">
		
		<div class="post-inner">
		
			<?php
				
			// Fetch post content
			$content = get_post_field( 'post_content', get_the_ID() );
			
			// Get content parts
			$content_parts = get_extended( $content );
			
			// Output part before <!--more--> tag
			echo $content_parts['main'];
			
			?>
		
		</div>
	
	</a><!-- .post-quote -->

</div>