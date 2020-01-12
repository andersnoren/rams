<?php get_header(); ?>

<div class="content">

	<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$archive_title = '';
	$archive_subtitle = '';

	if ( 1 < $paged || is_archive() || is_search() ) {
		
		if ( is_archive() ) {
			$archive_title = get_the_archive_title();
		} elseif ( is_search() ) {
			$archive_title = sprintf( __( 'Search results: "%s"', 'rams' ), get_search_query() );
		} else {
			$archive_title = sprintf( __( 'Page %1$s of %2$s', 'rams' ), $paged, $wp_query->max_num_pages );
		}

		if ( $wp_query->max_num_pages > 1 && ( is_archive() || is_search() ) ) {
			$archive_subtitle = sprintf( __( '(page %1$s of %2$s)', 'rams' ), $paged, $wp_query->max_num_pages );
		}

	}
	
	if ( $archive_title ) : ?>
	
		<div class="page-title">
		
			<h4>
			
				<?php 
				
				echo $archive_title;
				
				if ( $archive_subtitle ) : ?>
					<span><?php echo $archive_subtitle; ?></span>
				<?php endif; ?>
				
			</h4>

			<?php
			if ( term_description() ) {
				echo apply_filters( 'tag_archive_meta', '<div class="tag-meta">' . term_description() . '</div>' );
			}
			?>
			
		</div><!-- .page-title -->
		
		<div class="clear"></div>
	
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>

		<div class="posts" id="posts">

			<?php
		
			while ( have_posts() ) : the_post();
			
				get_template_part( 'content', get_post_format() );
												
			endwhile;

			?>
		
		</div><!-- .posts -->

		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	
			<div class="archive-nav">
					
				<?php echo get_next_posts_link( __( 'Older posts', 'rams' ) . ' &rarr;' ); ?>
					
				<?php echo get_previous_posts_link( '&larr; ' . __( 'Newer posts', 'rams' ) ); ?>
				
				<div class="clear"></div>
							
			</div><!-- .archive-nav -->
							
		<?php endif; ?>

	<?php elseif ( is_search() ) : ?>

		<div class="post section medium-padding">
				
			<div class="post-content section-inner thin">
			
				<p><?php _e( 'No results. Try again, would you kindly?', 'rams' ); ?></p>
				
				<?php get_search_form(); ?>
			
			</div><!-- .post-content -->
			
			<div class="clear"></div>
		
		</div><!-- .post -->

	<?php endif; ?>
		
</div><!-- .content -->
	              	        
<?php get_footer(); ?>