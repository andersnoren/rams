<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		}
		?>

		<div class="sidebar">

			<div class="sidebar-inner">

				<div class="sidebar-top">

					<?php $title_element = is_front_page() ? 'h1' : 'div'; ?>

					<<?php echo $title_element; ?> class="blog-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo get_bloginfo( 'title' ); ?></a>
					</<?php echo $title_element; ?>>

					<button class="nav-toggle hidden">

						<div class="bars">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>

						<p>
							<span class="menu"><?php _e( 'Menu', 'rams' ); ?></span>
							<span class="close"><?php _e( 'Close', 'rams' ); ?></span>
						</p>

					</button>

					<ul class="main-menu reset-list-style">

						<?php 
						
						if ( has_nav_menu( 'primary' ) ) {

							$nav_menu_args = array(
								'container' 		=> '',
								'items_wrap' 		=> '%3$s',
								'theme_location' 	=> 'primary'
							);

							wp_nav_menu( $nav_menu_args );

						} else {

							$list_pages_args = array(
								'container' 	=> '',
								'title_li' 		=> ''
							);

							wp_list_pages( $list_pages_args );

						}
						
						?>

					</ul><!-- .main-menu -->

				</div><!-- .sidebar-top -->

				<div class="sidebar-bottom">

				 	<p class="credits"><?php _e( 'Theme by', 'rams' ); ?> <a href="https://andersnoren.se">Anders Nor&eacute;n</a></p>

				 </div><!-- .sidebar-bottom -->

			</div><!-- .sidebar-inner -->

		</div><!-- .sidebar -->

		<ul class="mobile-menu bg-dark hidden reset-list-style">

			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( $nav_menu_args );
			} else {
				wp_list_pages( $list_pages_args );
			}
			?>

		 </ul>

		<div class="wrapper" id="wrapper">

			<div class="section-inner wrapper-inner">