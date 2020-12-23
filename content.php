<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<figure class="featured-media">

			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>

		</figure><!-- .featured-media -->

	<?php endif; ?>

	<div class="post-inner">

		<div class="post-header">

			<?php if ( get_post_type() == 'post' ) : ?>

				<time class="post-date">

					<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>

					<?php if ( is_sticky() ) : ?>

						<span class="sep">/</span> <span class="is-sticky"><?php _e( 'Sticky', 'rams' ); ?></span>

					<?php endif; ?>

				</time>

			<?php endif; ?>

		    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		</div><!-- .post-header -->

		<div class="post-content">

			<?php 
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content();
			}
			?>

		</div><!-- .post-content -->

	</div><!-- .post-inner -->

</div><!-- .post -->