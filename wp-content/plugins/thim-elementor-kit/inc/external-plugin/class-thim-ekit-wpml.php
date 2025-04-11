<?php 
namespace Thim_EL_Kit\ExternalPlugin;
use Thim_EL_Kit\SingletonTrait;

class Thim_EL_Kit_Wpml {
	use SingletonTrait;
	public function __construct() {
		// check wpml is active
		if ( ! defined( 'ICL_SITEPRESS_VERSION' ) ) {
			return;
		}
		$this->init_hooks();
	}
	public function init_hooks() {
		// set option_coditions when use multilple languages
		add_filter( 'thim_ekit/cache/thim_ekits_option_conditions', array( $this, 'thim_ekits_option_conditions' ), 10, 1 );
	}
	/**
	 * add thim_ekits_option_conditions key foreach language which is different default language
	 * @param  string $option_key thim_ekits_option_conditions (Thim_EL_Kit\Modules\Cache::OPTION_NAME)
	 * @return string             thim_ekits_option_conditions
	 */
	public function thim_ekits_option_conditions( $option_key ) {
		$wpml_default_lang = apply_filters( 'wpml_default_language', null );
		$wpml_current_lang = apply_filters( 'wpml_current_language', null ) ?? $wpml_default_lang;
		if ( $wpml_current_lang != $wpml_default_lang ) {
			$option_key = $option_key . '_' . $wpml_current_lang;
		}
		return $option_key;
	}
}
Thim_EL_Kit_Wpml::instance();
 ?>