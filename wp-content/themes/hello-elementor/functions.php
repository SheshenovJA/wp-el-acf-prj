<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WEBX_THEME_VERSION', '1.0.0' );

if ( ! isset( $content_width ) ) {
	$content_width = 1920; // Pixels.
}


//theme setup + menu;

if ( ! function_exists( 'webx_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function webx_elementor_setup() {


		$hook_result = apply_filters_deprecated( 'elementor_webx_theme_register_menus', [ true ], '2.0', 'webx_elementor_register_menus' );
		if ( apply_filters( 'webx_elementor_register_menus', $hook_result ) ) {
			register_nav_menus( array( 'menu-main' =>  'Main menu', 'footer-menu'=> 'Footer menu') );
		}


		$hook_result = apply_filters_deprecated( 'elementor_webx_theme_add_theme_support', [ true ], '2.0', 'webx_elementor_add_theme_support' );
		if ( apply_filters( 'webx_elementor_add_theme_support', $hook_result ) ) {
			add_theme_support(
				'html5',
				array(
					'caption',
				)
			);
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 46,
					'width'       => 175,
					'flex-height' => true,
					'flex-width'  => true,
				)
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'editor-style.css' );

		}
	}
}


function remove_admin_bar() {

    show_admin_bar(true);

}

add_action( 'after_setup_theme', 'webx_elementor_setup' );
add_action('after_setup_theme', 'remove_admin_bar');
//styles+scripts

if ( ! function_exists( 'webx_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function webx_elementor_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_webx_theme_enqueue_style', [ true ], '2.0', 'webx_elementor_enqueue_style' );
		//todo generate .min
//		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';



		if ( apply_filters( 'webx_elementor_enqueue_script', $enqueue_basic_style ) ) {
			wp_enqueue_script(
				'webx-elementor',
				get_template_directory_uri() . '/assets/js/main.js',
				array('jquery'),
                WEBX_THEME_VERSION,
                true
			);
		}

        if ( apply_filters( 'webx_elementor_enqueue_script_flick', $enqueue_basic_style ) ) {
            wp_enqueue_script(
                'webx-flick',
                get_template_directory_uri() . '/assets/js/flickity.pkgd.min.js',
                array('jquery'),
                WEBX_THEME_VERSION,
                true
            );
        }


        if ( apply_filters( 'webx_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'webx-elementor-theme-style',
				get_template_directory_uri() . '/assets/css/theme.css',
				[],
                WEBX_THEME_VERSION
			);
		}

        if ( apply_filters( 'webx_elementor_enqueue_flick_style', true ) ) {
            wp_enqueue_style(
                'webx-elementor-flick-style',
                get_template_directory_uri() . '/assets/css/flickity.min.css',
                [],
                WEBX_THEME_VERSION
            );
        }

        if ( apply_filters( 'webx_elementor_enqueue_font_google', true ) ) {
            wp_enqueue_style(
                'webx-elementor-font-style',
                'https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300,400,500,600,700&display=swap',
                [],
                WEBX_THEME_VERSION
            );
        }
	}
}
add_action( 'wp_enqueue_scripts', 'webx_elementor_scripts_styles' );





if ( ! function_exists( 'webx_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function webx_elementor_register_elementor_locations( $elementor_theme_manager ) {

		$hook_result = apply_filters_deprecated( 'elementor_webx_theme_register_elementor_locations', [ true ], '2.0', 'webx_elementor_register_elementor_locations' );
		if ( apply_filters( 'webx_elementor_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}

add_action( 'elementor/theme/register_locations', 'webx_elementor_register_elementor_locations' );

if ( ! function_exists( 'webx_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function webx_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'webx_elementor_content_width', 1920 );
	}
}

add_action( 'after_setup_theme', 'webx_elementor_content_width', 0 );

if ( is_admin() ) {

	require get_template_directory() . '/includes/admin-functions.php';
}

if ( ! function_exists( 'webx_elementor_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function webx_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'webx_elementor_page_title', 'webx_elementor_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'webx_elementor_body_open' ) ) {
	function webx_elementor_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}
//todo move this to separated file

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'General Settings',
        'menu_title'	=> 'Webx Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}
//field_563931bfe4a0b

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'field_563931bfe4a0b',
        'title' => 'Contacts',
        'fields' => array (
            array (
                'key' => 'field_563931bfe4a01',
                'label' => 'Phone number:',
                'name' => 'phone_number',
                'type' => 'text',
                'prefix' => '',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array('key' => 'field_5633ea2521cf2',
                'label' => 'Phone Icon',
                'name' => 'share_image',
                'type' => 'image',
                'instructions' => 'Use images that are at least 64 x 64 pixels',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array('width' => '', 'class' => '', 'id' => ''),
                'return_format' => 'array',
                'preview_size' => 'medium', '
                library' => 'uploadedTo',
                'min_width' => '64',
                'min_height' => '64',
                'min_size' => '130',
                'max_width' => '130',
                'max_height' => '130',
                'max_size' => '130',
                'mime_types' => 'png'),
            array('key' => 'field_5633ea2521cf3',
                'label' => 'Footer Logo',
                'name' => 'footer_image',
                'type' => 'image',
                'instructions' => 'Use images that are at least 64 x 64 pixels',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array('width' => '', 'class' => '', 'id' => ''),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'uploadedTo',
                'mime_types' => 'png'),
            array (
                'key' => 'field_563931bfe4a05',
                'label' => 'Facebook url:',
                'name' => 'fb_url',
                'type' => 'text',
                'prefix' => '',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_563931bfe4a06',
                'label' => 'Instagram url:',
                'name' => 'inst_url',
                'type' => 'text',
                'prefix' => '',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-general-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));

endif;

function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }

    return $classes;
}

function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'add_a_class')) {
        $atts['class'] = $args->add_a_class;
    }
    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


