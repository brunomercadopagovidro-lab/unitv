<?php
/**
 * Plugin Name: UniTV Recargas VIP
 * Plugin URI:  https://controleunitv.shop
 * Description: Plugin de recargas digitais UniTV com páginas de planos, políticas e downloads.
 * Version:     1.1.0
 * Author:      UniTV
 * Author URI:  https://controleunitv.shop
 * License:     GPL-2.0+
 * Text Domain: unitv-recargas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'UNITV_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'UNITV_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/* ---------------------------------------------------------------
 * Load shared helpers (always — needed by templates + admin)
 * ------------------------------------------------------------- */
require_once UNITV_PLUGIN_PATH . 'includes/helpers.php';

/* ---------------------------------------------------------------
 * Load admin panel (admin context only)
 * ------------------------------------------------------------- */
if ( is_admin() ) {
	require_once UNITV_PLUGIN_PATH . 'includes/admin.php';
}

/* ---------------------------------------------------------------
 * Shortcode registration
 * ------------------------------------------------------------- */

function unitv_render_template( $template ) {
	$allowed = array(
		'page-recargas',
		'page-privacidade',
		'page-termos',
		'page-reembolso',
		'page-cookies',
	);

	if ( ! in_array( $template, $allowed, true ) ) {
		return '';
	}

	$file = UNITV_PLUGIN_PATH . 'templates/' . $template . '.php';

	if ( ! file_exists( $file ) ) {
		return '';
	}

	ob_start();
	include $file;
	return ob_get_clean();
}

add_shortcode( 'unitv_recargas',    function() { return unitv_render_template( 'page-recargas' ); } );
add_shortcode( 'unitv_privacidade', function() { return unitv_render_template( 'page-privacidade' ); } );
add_shortcode( 'unitv_termos',      function() { return unitv_render_template( 'page-termos' ); } );
add_shortcode( 'unitv_reembolso',   function() { return unitv_render_template( 'page-reembolso' ); } );
add_shortcode( 'unitv_cookies',     function() { return unitv_render_template( 'page-cookies' ); } );

/* ---------------------------------------------------------------
 * Asset enqueueing (only on pages that contain a plugin shortcode)
 * ------------------------------------------------------------- */

function unitv_maybe_enqueue_assets() {
	global $post;
	if ( ! is_a( $post, 'WP_Post' ) ) {
		return;
	}

	$shortcodes = array(
		'unitv_recargas',
		'unitv_privacidade',
		'unitv_termos',
		'unitv_reembolso',
		'unitv_cookies',
	);

	$has_shortcode = false;
	foreach ( $shortcodes as $sc ) {
		if ( has_shortcode( $post->post_content, $sc ) ) {
			$has_shortcode = true;
			break;
		}
	}

	if ( ! $has_shortcode ) {
		return;
	}

	// Google Fonts
	wp_enqueue_style(
		'unitv-google-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap',
		array(),
		null
	);

	// Bootstrap Icons
	wp_enqueue_style(
		'unitv-bootstrap-icons',
		'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
		array(),
		null
	);

	// Plugin stylesheet
	wp_enqueue_style(
		'unitv-recargas-style',
		UNITV_PLUGIN_URL . 'assets/css/style.css',
		array( 'unitv-google-fonts', 'unitv-bootstrap-icons' ),
		'1.1.0'
	);

	// Plugin scripts
	wp_enqueue_script(
		'unitv-recargas-scripts',
		UNITV_PLUGIN_URL . 'assets/js/scripts.js',
		array(),
		'1.1.0',
		true
	);

	// Pass dynamic settings to JS (loaded from DB with defaults)
	$toast_names_raw = unitv_opt( 'unitv_toast_names' );
	$names_array     = array_filter( array_map( 'trim', explode( "\n", $toast_names_raw ) ) );

	wp_localize_script(
		'unitv-recargas-scripts',
		'unitvSettings',
		array(
			'toastEnabled'  => (bool) unitv_opt( 'unitv_toast_enabled' ),
			'toastInterval' => (int) unitv_opt( 'unitv_toast_interval' ),
			'toastNames'    => array_values( $names_array ),
			'toastProducts' => array(
				'UNITV RECARGA MENSAL',
				'UNITV RECARGA TRIMESTRAL',
				'UNITV RECARGA ANUAL',
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'unitv_maybe_enqueue_assets' );

/* ---------------------------------------------------------------
 * Activation hook – create WordPress pages automatically
 * ------------------------------------------------------------- */

register_activation_hook( __FILE__, 'unitv_create_pages' );

function unitv_create_pages() {
	$pages = array(
		array(
			'title'     => 'Recargas VIP',
			'slug'      => 'recargas-vip',
			'shortcode' => '[unitv_recargas]',
		),
		array(
			'title'     => 'Política de Privacidade UniTV',
			'slug'      => 'privacidade-unitv',
			'shortcode' => '[unitv_privacidade]',
		),
		array(
			'title'     => 'Termos de Uso UniTV',
			'slug'      => 'termos-unitv',
			'shortcode' => '[unitv_termos]',
		),
		array(
			'title'     => 'Política de Reembolso UniTV',
			'slug'      => 'reembolso-unitv',
			'shortcode' => '[unitv_reembolso]',
		),
		array(
			'title'     => 'Política de Cookies UniTV',
			'slug'      => 'cookies-unitv',
			'shortcode' => '[unitv_cookies]',
		),
	);

	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );
		if ( $existing ) {
			continue;
		}
		wp_insert_post( array(
			'post_title'   => $page['title'],
			'post_name'    => $page['slug'],
			'post_content' => $page['shortcode'],
			'post_status'  => 'publish',
			'post_type'    => 'page',
		) );
	}

	// Store page slugs in options for footer link generation
	update_option( 'unitv_pages_slugs', array(
		'privacidade' => 'privacidade-unitv',
		'termos'      => 'termos-unitv',
		'reembolso'   => 'reembolso-unitv',
		'cookies'     => 'cookies-unitv',
	) );
}
