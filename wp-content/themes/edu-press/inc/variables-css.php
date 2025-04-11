<?php

namespace Edu_Press\ThemeOptions;

class Variables_Options {
	public function __construct() {
		add_filter( 'thim_get_var_css_customizer', array( $this, 'get_options' ) );
	}

	public function get_options() {
		$css           = '';
		$theme_options = array(
			//logo
			'width_logo'            => '200px',
			//styling
			'body_primary_color'  	=> '#FF782D',
			'background_main_color' =>  '#fff',
			'body_container'        => '1320px',
			'border_color'			=> '#e8e8e8',
			//typograhy
			'font_body'     => array(
				'font-family'    => 'Jost',
				'variant'        => 'regular',
				'font-size'      => '16px',
				'line-height'    => '1.6em',
				'letter-spacing' => '0',
				'color'          => '#555',
				'text-transform' => 'none',
			),
			'font_title'    => array(
				'font-family' => 'Jost',
				'color'       => '#000000',
				'variant'     => '600',
			),
			'font_h1'     => array(
				'font-size'      => '1.75rem',
				'line-height'    => '1.2',
				'text-transform' => 'none',
			),
			'font_h2'     => array(
				'font-size'      => '1.5rem',
				'line-height'    => '1.4',
				'text-transform' => 'none',
			),
			'font_h3'       => array(
				'font-size'      => '1.35rem',
				'line-height'    => '1.4',
				'text-transform' => 'none',
			),
			'font_h4'      => array(
				'font-size'      => '1.25rem',
				'line-height'    => '1.4',
				'text-transform' => 'none',
			),
			'font_h5'      => array(
				'font-size'      => '1.05rem',
				'line-height'    => '1.6',
				'text-transform' => 'none',
				'variant'        => get_theme_mod( 'thim_font_title_variant', 600 ) 
			),
			'font_h6'      => array(
				'font-size'      => '1rem',
				'line-height'    => '1.6',
				'text-transform' => 'none',
				'variant'        => get_theme_mod( 'thim_font_title_variant', 600 ) 
			),
			// main menu
			'main_menu'   => array(
				'font-size'      => '16px',
				'line-height'    => '17px',
				'color'          => '#000000',
				'text-transform' => 'capitalize',
				'font-weight' => 'normal',
				'text-align' =>'left'
			),
			'main_menu_color' => array(
				'background_color' => '#fff',
				'border_color'     => '#E8E8E8',
				'text_color_hover' => '#FF782D',
			),
			'sub_menu'                => array(
				'background_color' => '#fff',
				'text_color'       => '#333',
				'text_color_hover' => '#FF782D',
			),
			'mobile_menu'             => array(
				'background_color' => '#333',
				'text_color'       => '#fff',
				'text_color_hover' => '#FF782D',
			),
			'sticky_menu'             	=> array(
				'background_color' 		=> '#fff',
				'text_color'       		=> '#333',
				'text_color_hover' 		=> '#FF782D',
			),
			'border_radius_content' => false,
			'border_radius'         => array(
				'item'     => '10px',
				'item-big' => '20px',
				'button'   => '60px',
			),
			//breadcrumbs
			'breadcrumb_font_size' 		=> '1em',
			'breadcrumb_bg_color' 		=> '#ffffff',
			'breadcrumb_color'			=> '#666666',
			'breadcrumb_border_color' 	=> '#eeeeee',

			'course_price_color' 		=> '#f24c0a',
			// footer options
			'footer_color'  => array(
				'bg'    => '#F5F5F5',
				'title' => '#000',
				'text'  => '#555',
				'link'  => '#555',
				'hover' => '#FF782D',
			),
			'footer_font_title' => array(
				'font-size'      => '1.3em',
				'line-height'    => '1.3em',
				'text-transform' => 'normal',
			),
			'footer_font_text' => array(
				'font-size'   => '1em',
				'line-height' => '1.3em',
			),
			'copyright_bg_color' 	 => '#F5F5F5',
			'copyright_text_color'   => '#555',
			'copyright_border_color' => '#EAEAEA',
			'theme_feature_preloading_style'=> array(
				'background' => '#ffffff',
				'color'      => '#333333',
			),

		);
		foreach ( $theme_options as $key => $val ) {
			$val_opt = thim_get_theme_option( $key, $val );
			if ( is_array( $val_opt ) ) {
				foreach ( $val as $attr => $value ) {
					$val_ar = isset( $val_opt[$attr] ) ? $val_opt[$attr] : $value;
					$css .= '--thim-' . $key . '-' . $attr . ':' . $val_ar . ';';
				}
			} else {
				$css .= '--thim-' . $key . ':' . $val_opt . ';';
				// convert primary color to rga
				if ( $key == 'body_primary_color' ) {
					list( $r, $g, $b ) = sscanf( $val_opt, "#%02x%02x%02x" );
					$css .= '--thim-' . $key . '-rgb: ' . $r . ',' . $g . ',' . $b . ';';
				}
			}
		}

		return $css;
	}

}

new Variables_Options();
