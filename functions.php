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
		add_image_size( 'post-image', 800, 9999 );
		
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
		
		$locale = get_locale();
		$locale_file = get_template_directory() . '/languages/$locale.php';

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		
	}
	add_action( 'after_setup_theme', 'rams_setup' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_load_javascript_files' ) ) {

	function rams_load_javascript_files() {

		if ( !is_admin() ) {
			wp_register_script( 'rams_global', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), '', true );
			wp_register_script( 'rams_flexslider', get_template_directory_uri() . '/js/flexslider.min.js', array( 'jquery' ), '', true );
			
			wp_enqueue_script( 'rams_flexslider' );
			wp_enqueue_script( 'rams_global' );
			
			if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
			
		}
	}
	add_action( 'wp_enqueue_scripts', 'rams_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_load_style' ) ) {

	function rams_load_style() {

		if ( ! is_admin() ) {

			$dependencies = array();

			/**
			 * Translators: If there are characters in your language that are not
			 * supported by the theme fonts, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$google_fonts = _x( 'on', 'Google Fonts: on or off', 'rams' );

			if ( 'off' !== $google_fonts ) {

				// Register Google Fonts
				wp_register_style( 'rams_googleFonts', '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Crimson+Text:400,700,400italic,700italic', false, 1.0, 'all' );
				$dependencies[] = 'rams_googleFonts';

			}
			
			wp_enqueue_style( 'rams_style', get_stylesheet_uri(), $dependencies );

		}
	}
	add_action( 'wp_print_styles', 'rams_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_add_editor_styles' ) ) {

	function rams_add_editor_styles() {

		add_editor_style( 'rams-editor-styles.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'rams' );

		if ( 'off' !== $google_fonts ) {

			$font_url = '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Crimson+Text:400,700,400italic,700italic';
			add_editor_style( str_replace( ',', '%2C', $font_url ) );

		}

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
   CUSTOM MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_custom_more_link' ) ) {

	function rams_custom_more_link( $more_link, $more_link_text ) {
		return str_replace( $more_link_text, __( 'Read more', 'rams' ) . ' &rarr;', $more_link );
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

	function rams_flexslider( $size ) {

		$attachment_parent = is_page() ? $post->ID : get_the_ID();

		if ( $images = get_posts( array(
			'post_parent'    => $attachment_parent,
			'post_type'      => 'attachment',
			'numberposts'    => -1, // show all
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_status'    => null,
			'post_mime_type' => 'image',
		) ) ) { ?>
		
			<div class="flexslider">
			
				<ul class="slides">
		
					<?php foreach( $images as $image ) :
						
						global $attachment_id;
						
						$default_attr = array(
							'alt'   => trim(strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ),
						);
					
						$attimg = wp_get_attachment_image( $image->ID, $size, $default_attr ); ?>
						
						<li>
							<?php echo $attimg; ?>
						</li>
						
					<?php endforeach; ?>
			
				</ul>
				
			</div><?php
			
		}
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
						
						<p class="comment-date"><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date() . '<span> &mdash; ' . get_comment_time() . '</span>'; ?></a></p>
					
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


/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER OPTIONS
   --------------------------------------------------------------------------------------------- */


class Rams_Customize {

	public static function rams_register ( $wp_customize ) {

		$wp_customize->add_section( 'rams_options', array(
			'title' 		=> __( 'Options for Rams', 'rams' ),
			'priority' 		=> 35, 
			'capability' 	=> 'edit_theme_options', 
			'description' 	=> __('Allows you to customize theme settings for Rams.', 'rams'), 
		) );
		
		$wp_customize->add_setting( 'accent_color', array(
			'default' 			=> '#6AA897', 
			'type' 				=> 'theme_mod', 
			'transport' 		=> 'postMessage', 
			'sanitize_callback' => 'sanitize_hex_color'
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rams_accent_color', array(
			'label' 		=> __( 'Accent Color', 'rams' ), 
			'section' 		=> 'colors', 
			'settings' 		=> 'accent_color', 
			'priority' 		=> 10, 
		) ) );

		//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	public static function rams_header_output() {
      
		echo '<!-- Customizer CSS -->';
		echo '<style type="text/css">';

			self::rams_generate_css( 'body a', 'color', 'accent_color' );
			self::rams_generate_css( 'body a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.sidebar', 'background', 'accent_color' );

			self::rams_generate_css( '.flex-direction-nav a:hover', 'background-color', 'accent_color' );
			self::rams_generate_css( 'a.post-quote:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-title a:hover', 'color', 'accent_color' );

			self::rams_generate_css( '.post-content a', 'color', 'accent_color' );
			self::rams_generate_css( '.post-content a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.post-content a:hover', 'border-bottom-color', 'accent_color' );
			self::rams_generate_css( '.post-content a.more-link:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-content input[type="submit"]:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-content input[type="button"]:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-content input[type="reset"]:hover', 'background', 'accent_color' );

			self::rams_generate_css( '.post-content .has-accent-color', 'color', 'accent_color' );
			self::rams_generate_css( '.post-content .has-accent-background-color', 'background-color', 'accent_color' );

			self::rams_generate_css( '#infinite-handle span:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.page-links a:hover', 'background', 'accent_color' );
			self::rams_generate_css( '.post-meta-inner a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.add-comment-title a', 'color', 'accent_color' );
			self::rams_generate_css( '.add-comment-title a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.bypostauthor .avatar', 'border-color', 'accent_color' );
			self::rams_generate_css( '.comment-actions a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.comment-header h4 a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '#cancel-comment-reply-link', 'color', 'accent_color' );
			self::rams_generate_css( '.comments-nav a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.comment-form input[type="submit"]:hover', 'background-color', 'accent_color' );
			self::rams_generate_css( '.logged-in-as a:hover', 'color', 'accent_color' );
			self::rams_generate_css( '.archive-nav a:hover', 'color', 'accent_color' );

		echo '</style>';
		echo '<!--/Customizer CSS-->';
	      
	}
   
	public static function rams_live_preview() {
		wp_enqueue_script( 'rams-themecustomizer', get_template_directory_uri() . '/js/theme-customizer.js', array(  'jquery', 'customize-preview' ), '', true );
	}

	public static function rams_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf( '%s { %s: %s; }', $selector, $style, $prefix.$mod.$postfix );
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Rams_Customize', 'rams_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'Rams_Customize', 'rams_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Rams_Customize', 'rams_live_preview' ) );


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */


if ( ! function_exists( 'rams_add_gutenberg_features' ) ) :

	function rams_add_gutenberg_features() {

		/* Gutenberg Palette --------------------------------------- */

		$accent_color = get_theme_mod( 'accent_color' ) ? get_theme_mod( 'accent_color' ) : '#6AA897';

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
   GUTENBERG EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'rams_block_editor_styles' ) ) :

	function rams_block_editor_styles() {

		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'rams' );

		if ( 'off' !== $google_fonts ) {

			// Register Google Fonts
			wp_register_style( 'rams-block-editor-styles-font', '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Crimson+Text:400,700,400italic,700italic', false, 1.0, 'all' );
			$dependencies[] = 'rams-block-editor-styles-font';

		}

		// Enqueue the editor styles
		wp_enqueue_style( 'rams-block-editor-styles', get_theme_file_uri( '/rams-gutenberg-editor-style.css' ), $dependencies, '1.0', 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'rams_block_editor_styles', 1 );

endif;


?>