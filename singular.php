<?php get_header(); ?>

<div class="content">

	<?php

	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single post' ); ?>>

				<?php

				$post_format = get_post_format();

				if ( $post_format == 'gallery' ) : ?>

					<figure class="featured-media">
						<?php rams_flexslider(); ?>
					</figure><!-- .featured-media -->

				<?php elseif ( has_post_thumbnail() ) : ?>

					<figure class="featured-media">
						<?php the_post_thumbnail(); ?>
					</figure><!-- .featured-media -->

				<?php endif; ?>

				<div class="post-inner">

					<div class="post-header">

						<?php if ( is_single() ) : ?>

							<time class="post-date"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></time>

						<?php endif; ?>

						<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>

					</div><!-- .post-header -->

					<div class="post-content">
						<?php the_content(); ?>
					</div><!-- .post-content -->

					<div class="clear"></div>

				</div><!-- .post-inner -->

				<?php
				wp_link_pages( array(
					'before'           => '<p class="page-links"><span class="title">' . __( 'Pages:','rams' ) . '</span>',
					'after'            => '</p>',
					'link_before'      => '<span>',
					'link_after'       => '</span>',
					'separator'        => '',
					'pagelink'         => '%',
					'echo'             => 1
				) );
				?>

				<?php if ( is_single() ) : ?>

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

							</div>

						</a><!-- .post-meta-toggle -->

						<div class="post-meta-inner">

							<p><strong><?php _e( 'Author', 'rams' ); ?></strong><?php the_author_posts_link(); ?></p>

							<p class="post-meta-date"><strong><?php _e( 'Posted', 'rams' ); ?></strong><a href="<?php the_permalink(); ?>"><?php the_date( get_option( 'date_format' ) ); ?><span> &mdash; <?php the_time( get_option( 'time_format' ) ); ?></span></a></p>

							<?php if ( has_category() ) : ?>

								<p><strong><?php _e( 'Categories', 'rams' ); ?></strong><?php the_category( ', ' ); ?></p>

							<?php endif; ?>

							<?php if ( has_tag() ) : ?>

								<p><strong><?php _e( 'Tags', 'rams' ); ?></strong><?php the_tags( '', ', ' ); ?></p>

							<?php endif;

							$prev_post = get_previous_post();
							$next_post = get_next_post();

							if ( ! $next_post || ! $prev_post ) : ?>

								<div class="post-nav">

									<?php if ( ! $next_post ) : ?>
										<p>
											<strong><?php _e( 'Next', 'rams' ); ?></strong>
											<a class="post-nav-newer" href="<?php echo get_permalink( $next_post->ID ); ?>">
												<?php echo get_the_title( $next_post ); ?>
											</a>
										</p>
									<?php endif; ?>

									<?php if ( ! $prev_post ) : ?>
										<p>
											<strong><?php _e( 'Previous', 'rams' ); ?></strong>
											<a class="post-nav-older" href="<?php echo get_permalink( $prev_post->ID ); ?>">
												<?php echo get_the_title( $prev_post ); ?>
											</a>
										</p>
									<?php endif; ?>

									<div class="clear"></div>

								</div><!-- .post-nav -->

							<?php endif; ?>

						</div><!-- .post-meta-inner -->

					</div><!-- .post-meta -->

				<?php endif; ?>

			</article><!-- .post -->

			<?php

			// Output comments wrapper if it's a post, or if comments are open, or if there's a comment number – and check for password
			if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) : ?>

				<div class="comments-container">
					<?php comments_template( '', true ); ?>
				</div><!-- .comments-container -->

				<?php
			endif;

		endwhile;

	endif; 
	
	?>

</div><!-- .content -->

<?php get_footer(); ?>