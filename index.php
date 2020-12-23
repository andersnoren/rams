<?php get_header(); ?>

<div class="content">

	<?php
	
	$archive_title 			= get_the_archive_title();
	$archive_description 	= get_the_archive_description();

	if ( $archive_title ) : ?>

		<header class="archive-header">

			<h1 class="archive-title"><?php echo $archive_title; ?></h1>

			<?php if ( $archive_description ) : ?>
				<div class="archive-description">
					<?php echo wpautop( $archive_description ); ?>
				</div><!-- .archive-description -->
			<?php endif; ?>

		</header><!-- .archive-header -->

	<?php endif; ?>

	<?php if ( have_posts() ) : ?>

		<div class="posts" id="posts">

			<?php
			while ( have_posts() ) : 
				the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			?>

		</div><!-- .posts -->

		<?php get_template_part( 'pagination' ); ?>

	<?php elseif ( is_search() ) : ?>

		<div class="post section medium-padding post-inner">

			<div class="post-content section-inner thin">

				<p><?php _e( 'Try again, would you kindly?', 'rams' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .post-content -->

		</div><!-- .post -->

	<?php endif; ?>

</div><!-- .content -->

<?php get_footer(); ?>