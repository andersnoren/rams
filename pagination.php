<?php 

global $wp_query;

$next_posts_link = get_next_posts_link( __( 'Older Posts', 'rams' ) );
$prev_posts_link = get_previous_posts_link( __( 'Newer Posts', 'rams' ) );

if ( $next_posts_link || $prev_posts_link ) : 

	$nav_classes = '';
	if ( ! $prev_posts_link ) $nav_classes .= ' only-next'

	?>

	<div class="archive-nav<?php echo esc_attr( $nav_classes ); ?>">
		<?php echo $prev_posts_link; ?>
		<?php echo $next_posts_link; ?>
	</div><!-- .archive-nav -->

<?php endif; ?>