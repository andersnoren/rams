<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rams_setup' ) ) {
	function rams_setup() {

		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 800, 9999 );

		// Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'quote' ) );

		add_theme_support( 'title-tag' );

		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'container' => 'posts',
			'footer'    => 'wrapper',
			'type'      => 'click'
		) );

		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'rams' ) );

		// Make the theme translation ready
		load_theme_textdomain( 'rams', get_template_directory() . '/languages' );

	}
	add_action( 'after_setup_theme', 'rams_setup' );
}


/*	-----------------------------------------------------------------------------------------------
	REQUIRED FILES
	Include required files
--------------------------------------------------------------------------------------------------- */

// Handle Customizer settings
require get_template_directory() . '/inc/classes/class-rams-customize.php';


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rams_load_javascript_files' ) ) {
	function rams_load_javascript_files() {

		$theme_version = wp_get_theme( 'rams' )->get( 'Version' );

		wp_register_script( 'rams_flexslider', get_template_directory_uri() . '/assets/js/flexslider.min.js', array(), '2.7.0' );

		wp_enqueue_script( 'rams_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'rams_flexslider' ), $theme_version, true );

		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'rams_load_javascript_files' );
}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rams_load_style' ) ) {
	function rams_load_style() {

		if ( is_admin() ) return;

		$dependencies = array();
		$theme_version = wp_get_theme( 'rams' )->get( 'Version' );

		wp_register_style( 'rams_googleFonts', get_theme_file_uri( '/assets/css/fonts.css' ) );
		$dependencies[] = 'rams_googleFonts';

		wp_enqueue_style( 'rams_style', get_stylesheet_uri(), $dependencies, $theme_version );

		// Add output of Customizer settings as inline style
		wp_add_inline_style( 'rams_style', Rams_Customize::custom_css() );

	}
	add_action( 'wp_print_styles', 'rams_load_style' );
}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_add_editor_styles' ) ) {
	function rams_add_editor_styles() {

		add_editor_style( array( 'assets/css/rams-classic-editor-styles.css', 'assets/css/fonts.css' ) );

	}
	add_action( 'init', 'rams_add_editor_styles' );
}


/* ---------------------------------------------------------------------------------------------
   SET CONTENT WIDTH
   --------------------------------------------------------------------------------------------- */


if ( ! isset( $content_width ) ) $content_width = 672;


/* ---------------------------------------------------------------------------------------------
   CHECK FOR JAVASCRIPT SUPPORT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_html_js_class' ) ) {

	function rams_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'rams_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   ADD CLASSES TO PAGINATION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_pagination_class_next' ) ) {

	function rams_pagination_class_next() {
		return 'class="archive-nav-older"';
	}
	add_filter( 'next_posts_link_attributes', 'rams_pagination_class_next' );

}

if ( ! function_exists( 'rams_pagination_class_prev' ) ) {

	function rams_pagination_class_prev() {
		return 'class="archive-nav-newer"';
	}
	add_filter( 'previous_posts_link_attributes', 'rams_pagination_class_prev' );

}


/* ---------------------------------------------------------------------------------------------
   MODIFY THE READ MORE LINK
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_custom_more_link' ) ) {
	function rams_custom_more_link( $markup, $text ) {

		// Change the text of the link, and add a button class
		return str_replace( 
			array( $text, 'more-link' ),
			array( __( 'Read More', 'rams' ), 'more-link faux-button' ),
			$markup 
		);
		
	}
	add_filter( 'the_content_more_link', 'rams_custom_more_link', 10, 2 );
}


/* ---------------------------------------------------------------------------------------------
   BODY & POST CLASSES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_body_post_class' ) ) {

	function rams_body_post_class( $classes ) {

		$classes[] = has_post_thumbnail() ? 'has-featured-image' : 'no-featured-image';

		return $classes;
	}
	add_filter( 'post_class', 'rams_body_post_class' );
	add_filter( 'body_class', 'rams_body_post_class' );

}


/* ---------------------------------------------------------------------------------------------
   STYLE ADMIN AREA
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_admin_css' ) ) {

	function rams_admin_css() {
	echo '<style type="text/css">

		#postimagediv #set-post-thumbnail img {
			max-width: 100%;
			height: auto;
		}

	</style>';
	}
	add_action( 'admin_head', 'rams_admin_css' );

}


/* ---------------------------------------------------------------------------------------------
   FLEXSLIDER OUTPUT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_flexslider' ) ) {
	function rams_flexslider( $size = 'post_thumbnail' ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		$images = get_posts( array(
			'post_parent'    => $attachment_parent,
			'post_type'      => 'attachment',
			'numberposts'    => -1, // show all
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_status'    => null,
			'post_mime_type' => 'image',
		) );

		if ( ! $images ) return;
		
		?>

		<div class="flexslider">

			<ul class="slides reset-list-style">

				<?php foreach( $images as $image ) :

					global $attachment_id;

					$attimg = wp_get_attachment_image( $image->ID, $size ); ?>

					<li>
						<?php echo $attimg; ?>
					</li>

				<?php endforeach; ?>

			</ul>

		</div>
		
		<?php

	}
}


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_comment' ) ) {

	function rams_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

				<?php __( 'Pingback:', 'rams' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'rams' ), '<span class="edit-link">', '</span>' ); ?>

			</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

			<div id="comment-<?php comment_ID(); ?>" class="comment">

				<div class="avatar-container">
					<?php echo get_avatar( $comment, 160 ); ?>
				</div>

				<div class="comment-inner">

					<div class="comment-header">

						<h4><?php echo get_comment_author_link(); ?></h4>

						<p class="comment-date"><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . '<span> &mdash; ' . get_comment_time() . '</span>'; ?></a></p>

					</div>

					<div class="comment-content post-content">

						<?php if ( '0' == $comment->comment_approved ) : ?>

							<p class="comment-awaiting-moderation"><?php __( 'Your comment is awaiting moderation.', 'rams' ); ?></p>

						<?php endif; ?>

						<?php comment_text(); ?>

					</div><!-- /comment-content -->

					<div class="comment-actions">

						<?php
							comment_reply_link( array_merge( $args,
							array(
								'reply_text' 	=>  	__( 'Reply', 'rams' ),
								'depth'			=> 		$depth,
								'max_depth' 	=> 		$args['max_depth'],
								'before'		=>		'<p class="comment-reply">',
								'after'			=>		'</p>'
								)
							) );
						?>

						<?php edit_comment_link( __( 'Edit', 'rams' ), '<p class="comment-edit">', '</p>' ); ?>

					</div><!-- .comment-actions -->

				</div><!-- .comment-inner -->

			</div><!-- /comment-## -->

		<?php
			break;
		endswitch;
	}

}




/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE TITLE
	Any changes to the archive title for different CPTs (like custom descriptions set in ACF)
	should be made in this function, since they then carry over to breadcrumbs, title/meta tag, etc.

	@param	$title string	The initial title
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rams_filter_archive_title' ) ) :
	function rams_filter_archive_title( $title ) {

		// Search: Show the search query
		if ( is_search() ) {
			/* Translators: %s = The search query */
			$title = sprintf( _x( 'Search Results: %s', '%s = The search query', 'rams' ), '&ldquo;' . get_search_query() . '&rdquo;' );
		}

		// No title on home
		else if ( is_home() ) {
			$title = '';
		}

		return $title;

	}
	add_filter( 'get_the_archive_title', 'rams_filter_archive_title' );
endif;


/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE DESCRIPTION
	Any changes to the archive description for different CPTs (like custom descriptions set in
	ACF) should be made in this function, since they then carry over to breadcrumbs, meta tags etc.

	@param	$description string		The initial description
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'rams_filter_archive_description' ) ) :
	function rams_filter_archive_description( $description ) {

		// Search: Show the search query
		if ( is_search() ) {
			global $wp_query;
			if ( $wp_query->found_posts ) {
				/* Translators: %s = Number of results */
				$description = sprintf( _x( 'We found %s results for your search.', $wp_query->found_posts, '%s = Number of results', 'rams' ), $wp_query->found_posts );
			} else {
				$description = __( 'We could not find any results for your search.', 'rams' );
			}
		}

		return $description;

	}
	add_filter( 'get_the_archive_description', 'rams_filter_archive_description' );
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY BLOCK EDITOR SUPPORT
------------------------------------------------------------------------------------------------ */


if ( ! function_exists( 'rams_add_gutenberg_features' ) ) :
	function rams_add_gutenberg_features() {

		/* Gutenberg Palette --------------------------------------- */

		$accent_color = get_theme_mod( 'accent_color', '#6AA897' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'black',
				'color' => '#222',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'dark-gray',
				'color' => '#444',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'medium-gray',
				'color' => '#666',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'light-gray',
				'color' => '#888',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'rams' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Gutenberg Font Sizes --------------------------------------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 18,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Regular', 'Name of the regular font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 22,
				'slug' 		=> 'regular',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 27,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Gutenberg', 'rams' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'rams' ),
				'size' 		=> 35,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'rams_add_gutenberg_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_block_editor_styles' ) ) :
	function rams_block_editor_styles() {

		$theme_version = wp_get_theme( 'rams' )->get( 'Version' );

		wp_register_style( 'rams-block-editor-styles-font', get_theme_file_uri( '/assets/css/fonts.css' ) );
		wp_enqueue_style( 'rams-block-editor-styles', get_theme_file_uri( '/assets/css/rams-block-editor-styles.css' ), array( 'rams-block-editor-styles-font' ), $theme_version, 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'rams_block_editor_styles', 1 );
endif;
