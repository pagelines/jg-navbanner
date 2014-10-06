<?php
/*
	Plugin Name: NavBanner
	Author: James Giroux
	Author URI: http://groundwork.cc
	Description: NavBanner is a two-tier navigation system for PageLines. Add a full width image/logo on top and your navigation will appear underneath.
	PageLines: true
    Version: 1.0.1
    Section: true
	Class Name: gwNavBanner
	Filter: component, dual-width
	Loading: active
*/

/**
 * IMPORTANT
 * This tells wordpress to not load the class as DMS will do it later when the main sections API is available.
 * If you want to include PHP earlier like a normal plugin just add it above here.
*/

if( ! class_exists( 'PageLinesSectionFactory' ) )
  return;


class gwNavBanner extends PageLinesSection {

	function section_styles(){

	}

	function section_persistent() {
		register_nav_menus( array( 'main_nav' => __( 'Nav Banner Section', 'groundwork' ) ) );
	}
	

	function section_opts(){
		$options = array(
			array(
				'type'	=> 'multi',
				'key'	=> 'navbanner_multi',
				'title'	=> 'Navigation',
				'opts'	=> array(
					array(
						'type'	=> 'image_upload',
						'key'	=> 'logo',
						'label'	=> __( 'Logo', 'groundwork' ),
						'default'	=> $this->base_url.'/logo.png',
						'has_alt'	=> true,
					),
					array(
						'key'	=> 'menu',
						'type'	=> 'select_menu',
						'label'	=> __( 'Select Menu', 'groundwork' ),
					),
				)
			),
			
		);

		
		

		return $options;
	}
	


	// Logo in center
	// Menu underneath
	// Fun type

   function section_template( ) {
	
		$menu = $this->opt('menu');

		$logo = $this->opt('logo');
		$logo_alt = $this->opt('logo_alt');
		
	 ?>
		<div class="navbanner-wrap">
			<div class="pl-content">
				<div class="pl-content-pad fix">
					<div class="navbanner-top">
						
						<?php
							if( $logo )
								printf('<div class="navbanner-logo"><a href="%s"><img src="%s" alt="%s"/></a></div>', home_url('/'), $logo, $logo_alt);
						?>
					</div>
					<div class="navbanner-bottom">
						<?php 
						$menu_args = array(
								'theme_location' => 'navbanner_nav',
								'menu' 			=> $menu,
								'menu_class'	=> 'inline-list pl-nav sf-menu',
							);
							echo pl_navigation( $menu_args );
						
						 ?>
					</div>
				</div>
			</div>
		</div>
<?php }


}