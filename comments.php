<?php

if ( post_password_required() ) {
	return;
}

if ( have_comments() ) : ?>

	<a name="comments"></a>

	<div class="comments-title-container">

		<h2 class="comments-title">

			<?php
			$comments_number = absint( get_comments_number() );
			printf( _nx( '%s Comment', '%s Comments', $comments_number, 'Translators: %s = the number of comments', 'rams' ), $comments_number );
			?>

		</h2>

		<h4 class="comments-subtitle"><a href="#respond"><?php _e( 'Add yours', 'rams' ); ?></a></h4>

	</div><!-- .comments-title-container -->

	<div class="comments">

		<ol class="commentlist reset-list-style">
		    <?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'rams_comment' ) ); ?>
		</ol>

		<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>

			<div class="pingbacks">

				<div class="pingbacks-inner">

					<h3 class="pingbacks-title">

						<?php
						$pingback_count = count( $wp_query->comments_by_type['pings'] );
						echo $pingback_count . ' ' . _n( 'Pingback', 'Pingbacks', $pingback_count, 'rams' ); ?>

					</h3>

					<ol class="pingbacklist">
					    <?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'rams_comment' ) ); ?>
					</ol>

				</div>

			</div>

		<?php endif; ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<div class="comments-nav" role="navigation">
				<?php previous_comments_link( __( 'Older Comments', 'rams' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments', 'rams' ) ); ?>
			</div><!-- .comment-nav-below -->

		<?php endif; ?>

	</div><!-- .comments -->

	<?php
endif;

comment_form();