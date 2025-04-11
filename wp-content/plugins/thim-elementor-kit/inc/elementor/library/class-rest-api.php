<?php

namespace Thim_EL_Kit\Elementor\Library;

use Thim_EL_Kit\SingletonTrait;

class Rest_API {
	use SingletonTrait;

	const NAMESPACE = 'thim-ekit';

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
	}

	public function register_endpoints() {
		register_rest_route(
			self::NAMESPACE,
			'/get-templates',
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_templates' ),
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_rest_route(
			self::NAMESPACE,
			'/import',
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'import' ),
				'permission_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}

	public function get_templates( $request ) {
		$theme = wp_get_theme();

		if ( is_child_theme() ) {
			$theme = wp_get_theme( $theme->parent()->template );
		}

		$response = wp_remote_get( 'https://updates.thimpress.com/wp-json/thim_em/v1/thim-kit/get-library?theme=' . $theme->get( 'TextDomain' ) );

		$raw = ! is_wp_error( $response ) ? json_decode( wp_remote_retrieve_body( $response ), true ) : array();

		return $raw;
	}

	public function import( $request ) {
		$id      = $request->get_param( 'id' );
		$type    = $request->get_param( 'type' );
		$post_id = $request->get_param( 'postID' );
		$theme   = $request->get_param( 'theme' );

		try {
			if ( empty( $post_id ) ) {
				throw new \Exception( 'Post ID is required.' );
			}

			if ( empty( $id ) ) {
				throw new \Exception( 'Template ID is required.' );
			}

			if ( empty( $type ) ) {
				throw new \Exception( 'Template type is required.' );
			}

			$body = array(
				'id'    => $id,
				'type'  => $type === 'pages' ? 'page' : 'templates',
				'theme' => $theme,
			);

			// check with theme premium
			$library_config = apply_filters(
				'thim-el-kit/create-template/product-registration',
				[
					'class' => '\Thim_Product_Registration'
				]
			);

			// check site_key on sever thimpress - old data
			if ( class_exists( '\Thim_Product_Registration' ) ) {
				$site_key = \Thim_Product_Registration::get_site_key();
				$code     = thim_core_generate_code_by_site_key( $site_key );
				if ( ! empty( $site_key ) ) {
					$body['code'] = $code;
				}
			}
			// Check active purchase code in theme premium

			if ( is_callable( [ $library_config['class'], 'get_data_theme_register' ] ) ) {
				$purchase_token         = call_user_func(
					[ $library_config['class'], 'get_data_theme_register' ],
					'purchase_token'
				);
				$body['purchase_token'] = $purchase_token ? $purchase_token : '';
			}

			// Get Url fetch
			$fetch_url = 'https://updates.thimpress.com/wp-json/thim_em/v1/thim-kit/import-library';
			if ( is_callable( [ $library_config['class'], 'get_url_fetch' ] ) ) {
				$fetch_url = $library_config['class']::get_url_fetch();
			}
			$menu_admin = 'thim-license';
			if ( is_callable( [ $library_config['class'], 'menu_admin_active_license' ] ) ) {
				$menu_admin = $library_config['class']::menu_admin_active_license();
			}

			$fetch = wp_remote_post(
				$fetch_url,
				array(
					'body' => $body,
				)
			);

			if ( ! is_wp_error( $fetch ) ) {
				$api_body = json_decode( wp_remote_retrieve_body( $fetch ), true );

				if ( isset( $api_body['code'] ) && $api_body['code'] === 'no_code' ) {
					$mess_error = 'Please <a href="' . admin_url( '/admin.php?page=' . $menu_admin ) . '" target="_blank" rel="noopener">Active theme</a> to continue';
				}

				// go to thim license page.
				if ( isset( $api_body['code'] ) && ( $api_body['code'] === 'no_purchase_code' || $api_body['code'] === 'invalid_purchase_code' ) ) {
					$mess_error = 'Please <a href="' . admin_url( '/admin.php?page=' . $menu_admin ) . '" target="_blank" rel="noopener">add purchase code</a> to continue.';
				}

				// if is error.
				if ( ! empty( $api_body['code'] ) ) {
					$mess_error = $api_body['message'] ?? 'Something went wrong.';
				}

				if ( ! empty( $mess_error ) ) {
					apply_filters( 'thim-el-kit/create-template/error', $mess_error, $api_body );
					if ( $mess_error == 'Invalid purchase code' && class_exists( $library_config['class'] ) ) {
						$library_config['class']::destroy_active();
					}
					if ( $mess_error != 'Something went wrong.' ) {
						$mess_error .= ' Please <a href="' . admin_url( '/admin.php?page=' . $menu_admin ) . '" target="_blank" rel="noopener">add purchase code</a> to use this feature';
					}
					throw new \Exception( $mess_error );
				}
				if ( ! empty( $api_body['content'] ) ) {
					$import = new Import();

					$import_data = $import->import( $post_id, $api_body['content'] );
				}
			} else {
				throw new \Exception( $fetch->get_error_message() );
			}

			return rest_ensure_response(
				array(
					'success' => true,
					'data'    => $import_data,
				)
			);
		}
		catch ( \Throwable $th ) {
			return array(
				'success' => false,
				'message' => $th->getMessage(),
			);
		}
	}
}

Rest_API::instance();
