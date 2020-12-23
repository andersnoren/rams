<?php


/* ---------------------------------------------------------------------------------------------
   CUSTOMIZER OPTIONS
   --------------------------------------------------------------------------------------------- */


if ( ! class_exists( 'Rams_Customize' ) ) : 
	class Rams_Customize {

		public static function register( $wp_customize ) {
			
			$wp_customize->add_setting( 'accent_color', array(
				'default' 			=> '#6aa897', 
				'type' 				=> 'theme_mod', 
				'sanitize_callback' => 'sanitize_hex_color'
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rams_accent_color', array(
				'label' 		=> __( 'Accent Color', 'rams' ), 
				'section' 		=> 'colors', 
				'settings' 		=> 'accent_color', 
			) ) );

		}

		public static function custom_css() {

			$accent_color = get_theme_mod( 'accent_color', '#6aa897' );

			// Only return the custom CSS if the color is not the default
			if ( $accent_color == '#6aa897' ) return;

			$css = '';

			$css .= self::generate_css( 'a', 'color', $accent_color );
			$css .= self::generate_css( '.sidebar', 'background-color', $accent_color );

			$css .= self::generate_css( '.flex-direction-nav a:hover', 'background-color', $accent_color );
			$css .= self::generate_css( 'a.post-quote:hover', 'background-color', $accent_color );
			$css .= self::generate_css( '.post-title a:hover', 'color', $accent_color );

			$css .= self::generate_css( 'button:hover, .button:hover, .faux-button:hover, .wp-block-button__link:hover, :root .wp-block-file__button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:focus, .button:focus, .faux-button:focus, .wp-block-button__link:focus, :root .wp-block-file__button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus', 'background-color', $accent_color );
			$css .= self::generate_css( '.wp-block-button.is-style-outline .wp-block-button__link:hover, .wp-block-button__link.is-style-outline:hover', 'color', $accent_color );

			$css .= self::generate_css( ':root .has-accent-color', 'color', $accent_color );
			$css .= self::generate_css( ':root .has-accent-background-color', 'background-color', $accent_color );

			$css .= self::generate_css( '#infinite-handle span:hover', 'background-color', $accent_color );
			$css .= self::generate_css( '.page-links a:hover', 'background-color', $accent_color );
			$css .= self::generate_css( '.post-meta-inner a:hover', 'color', $accent_color );
			$css .= self::generate_css( '.add-comment-title a', 'color', $accent_color );
			$css .= self::generate_css( '.add-comment-title a:hover', 'color', $accent_color );
			$css .= self::generate_css( '.bypostauthor > .comment .avatar', 'border-color', $accent_color );
			$css .= self::generate_css( '.comment-actions a:hover', 'color', $accent_color );
			$css .= self::generate_css( '.comment-header h4 a:hover', 'color', $accent_color );
			$css .= self::generate_css( '#cancel-comment-reply-link', 'color', $accent_color );
			$css .= self::generate_css( '.comments-nav a:hover', 'color', $accent_color );
			$css .= self::generate_css( '.comment-form input[type="submit"]:hover', 'background-color', $accent_color );
			$css .= self::generate_css( '.logged-in-as a:hover', 'color', $accent_color );
			$css .= self::generate_css( '.archive-nav a:hover', 'color', $accent_color );

			return $css;
			
		}

		public static function generate_css( $selector, $style, $value, $prefix = '', $postfix = '' ) {
			return sprintf( '%s { %s: %s; }', $selector, $style, $prefix . $value . $postfix );
		}

	}
endif;

add_action( 'customize_register', array( 'Rams_Customize', 'register' ) );