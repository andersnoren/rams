<?php 

get_header();

if ( have_posts() ) : 
	while ( have_posts() ) : 
		the_post(); 
		?>

		<div class="content">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<figure class="featured-media">
					<?php echo wp_get_attachment_image( $post->ID, 'post-thumbnail' ); ?>
				</figure>

				<div class="post-inner section-inner thin">

					<div class="post-header">

						<time class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></time>

						<h2 class="post-title"><?php echo basename( get_attached_file( $post->ID ) ); ?></h2>

					</div><!-- .post-header -->

					<?php

					$image_caption = get_the_post_thumbnail_caption();

					if ( $image_caption ) : ?>

						<div class="post-content section-inner thin">

							<div><?php echo wpautop( $image_caption ); ?></div>

						</div>

					<?php endif; ?>

				</div><!-- .post-inner -->

				<div class="post-meta">

					<a class="post-meta-toggle" href="#">

						<div class="post-meta-toggle-inner">

							<div class="bars">
								<div class="bar"></div>
								<div class="bar"></div>
								<div class="bar"></div>
							</div>

							<p><?php _e( 'Post meta', 'rams' ); ?></p>

							<div class="clear"></div>

						</div><!-- .post-meta-toggle-inner -->

					</a><!-- .post-meta-toggle -->

					<div class="post-meta-inner">

						<p><strong><?php _e( 'Author', 'rams' ); ?></strong><?php the_author_posts_link(); ?></p>

						<p class="post-meta-date"><strong><?php _e( 'Posted', 'rams' ); ?></strong><a href="<?php the_permalink(); ?>"><?php the_date( get_option( 'date_format' ) ); ?><span> &mdash; <?php the_time( get_option( 'time_format' ) ); ?></span></a></p>

						<?php $image_array = wp_get_attachment_image_src( $post->ID, 'full', false ); $url = $image_array['0']; ?>

						<p><strong><?php _e( 'Resolution', 'rams' ); ?></strong><?php echo $image_array['1'] . 'x' . $image_array['2'] . ' px'; ?></p>

					</div><!-- .post-meta-inner -->

				</div><!-- .post-meta -->

			</article><!-- .post -->
			
			<?php

			// Output comments wrapper if comments are open or if there are comments, and check for password
			if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) : 
				?>

				<div class="comments-container">
					<div class="comments-inner section-inner thin">
						<?php comments_template( '', true ); ?>
					</div><!-- .comments-inner -->
				</div><!-- .comments-container -->

				<?php
			endif;
			?>

		</div><!-- .content -->

		<?php 
	endwhile;
endif;

get_footer(); 

?>