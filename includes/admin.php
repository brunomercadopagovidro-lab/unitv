<?php
/**
 * UniTV Recargas VIP — Admin Panel
 *
 * Registers menus, settings pages, and handles save/reset logic.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load shared helpers (unitv_defaults / unitv_opt)
require_once UNITV_PLUGIN_PATH . 'includes/helpers.php';

/* ---------------------------------------------------------------
 * Admin menu registration
 * ------------------------------------------------------------- */
add_action( 'admin_menu', 'unitv_register_admin_menus' );

function unitv_register_admin_menus() {
	add_menu_page(
		__( 'UniTV Recargas', 'unitv-recargas' ),
		__( 'UniTV Recargas', 'unitv-recargas' ),
		'manage_options',
		'unitv-geral',
		'unitv_page_geral',
		'dashicons-video-alt',
		56
	);

	$submenus = array(
		array( 'unitv-geral',      __( 'Configurações Gerais', 'unitv-recargas' ), 'unitv_page_geral'      ),
		array( 'unitv-hero',       __( 'Hero / Topo',          'unitv-recargas' ), 'unitv_page_hero'       ),
		array( 'unitv-planos',     __( 'Planos / Recargas',    'unitv-recargas' ), 'unitv_page_planos'     ),
		array( 'unitv-features',   __( 'Features',             'unitv-recargas' ), 'unitv_page_features'   ),
		array( 'unitv-downloads',  __( 'Downloads',            'unitv-recargas' ), 'unitv_page_downloads'  ),
		array( 'unitv-depoimentos',__( 'Depoimentos',          'unitv-recargas' ), 'unitv_page_depoimentos'),
		array( 'unitv-footer',     __( 'Footer / Rodapé',      'unitv-recargas' ), 'unitv_page_footer'     ),
		array( 'unitv-whatsapp',   __( 'WhatsApp / Contato',   'unitv-recargas' ), 'unitv_page_whatsapp'   ),
		array( 'unitv-politicas',  __( 'Páginas de Política',  'unitv-recargas' ), 'unitv_page_politicas'  ),
	);

	foreach ( $submenus as $sm ) {
		add_submenu_page( 'unitv-geral', $sm[1], $sm[1], 'manage_options', $sm[0], $sm[2] );
	}
}

/* ---------------------------------------------------------------
 * Enqueue admin assets
 * ------------------------------------------------------------- */
add_action( 'admin_enqueue_scripts', 'unitv_admin_assets' );

function unitv_admin_assets( $hook ) {
	if ( strpos( $hook, 'unitv' ) === false ) {
		return;
	}
	wp_enqueue_style( 'unitv-admin-css', UNITV_PLUGIN_URL . 'assets/css/admin.css', array(), '1.0.0' );
	wp_enqueue_script( 'unitv-admin-js', UNITV_PLUGIN_URL . 'assets/js/admin.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_editor();
}

/* ---------------------------------------------------------------
 * Save handler (shared nonce)
 * ------------------------------------------------------------- */
add_action( 'admin_post_unitv_save_settings', 'unitv_save_settings' );

function unitv_save_settings() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Acesso negado.', 'unitv-recargas' ) );
	}

	check_admin_referer( 'unitv_save_settings', 'unitv_nonce' );

	$section  = isset( $_POST['unitv_section'] ) ? sanitize_key( $_POST['unitv_section'] ) : '';
	$redirect = admin_url( 'admin.php?page=unitv-' . $section . '&updated=1' );

	switch ( $section ) {
		case 'geral':
			update_option( 'unitv_brand_name',     sanitize_text_field( wp_unslash( $_POST['unitv_brand_name']     ?? '' ) ) );
			update_option( 'unitv_logo_url',        esc_url_raw( wp_unslash( $_POST['unitv_logo_url']        ?? '' ) ) );
			update_option( 'unitv_brand_color',     sanitize_hex_color( wp_unslash( $_POST['unitv_brand_color']    ?? '#c71b3a' ) ) );
			update_option( 'unitv_brand_color2',    sanitize_hex_color( wp_unslash( $_POST['unitv_brand_color2']   ?? '#6a11cb' ) ) );
			update_option( 'unitv_toast_enabled',   isset( $_POST['unitv_toast_enabled'] ) ? '1' : '0' );
			update_option( 'unitv_toast_interval',  absint( $_POST['unitv_toast_interval'] ?? 12 ) );
			update_option( 'unitv_toast_names',     sanitize_textarea_field( wp_unslash( $_POST['unitv_toast_names'] ?? '' ) ) );
			break;

		case 'hero':
			update_option( 'unitv_hero_badge',         sanitize_text_field( wp_unslash( $_POST['unitv_hero_badge']         ?? '' ) ) );
			update_option( 'unitv_hero_title',         sanitize_text_field( wp_unslash( $_POST['unitv_hero_title']         ?? '' ) ) );
			update_option( 'unitv_hero_gradient_word', sanitize_text_field( wp_unslash( $_POST['unitv_hero_gradient_word'] ?? '' ) ) );
			update_option( 'unitv_hero_desc',          sanitize_textarea_field( wp_unslash( $_POST['unitv_hero_desc']          ?? '' ) ) );
			update_option( 'unitv_hero_cta_text',      sanitize_text_field( wp_unslash( $_POST['unitv_hero_cta_text']      ?? '' ) ) );
			update_option( 'unitv_hero_cta_link',      esc_url_raw( wp_unslash( $_POST['unitv_hero_cta_link']      ?? '' ) ) );
			update_option( 'unitv_hero_stat_number',   sanitize_text_field( wp_unslash( $_POST['unitv_hero_stat_number']   ?? '' ) ) );
			update_option( 'unitv_hero_stat_label',    sanitize_text_field( wp_unslash( $_POST['unitv_hero_stat_label']    ?? '' ) ) );
			$trust = array();
			$ti    = isset( $_POST['trust_icon'] ) ? (array) $_POST['trust_icon'] : array();
			$tt    = isset( $_POST['trust_text'] ) ? (array) $_POST['trust_text'] : array();
			for ( $i = 0; $i < 3; $i++ ) {
				$trust[] = array(
					'icon' => sanitize_text_field( wp_unslash( $ti[ $i ] ?? '' ) ),
					'text' => sanitize_text_field( wp_unslash( $tt[ $i ] ?? '' ) ),
				);
			}
			update_option( 'unitv_hero_trust', $trust );
			break;

		case 'planos':
			update_option( 'unitv_plans_title',    sanitize_text_field( wp_unslash( $_POST['unitv_plans_title']    ?? '' ) ) );
			update_option( 'unitv_plans_subtitle', sanitize_text_field( wp_unslash( $_POST['unitv_plans_subtitle'] ?? '' ) ) );
			$plans     = array();
			$raw_plans = isset( $_POST['plans'] ) ? (array) $_POST['plans'] : array();
			foreach ( $raw_plans as $p ) {
				$plans[] = array(
					'name'      => sanitize_text_field( wp_unslash( $p['name']      ?? '' ) ),
					'img'       => esc_url_raw( wp_unslash( $p['img']       ?? '' ) ),
					'rating'    => sanitize_text_field( wp_unslash( $p['rating']    ?? '' ) ),
					'reviews'   => sanitize_text_field( wp_unslash( $p['reviews']   ?? '' ) ),
					'price_old' => sanitize_text_field( wp_unslash( $p['price_old'] ?? '' ) ),
					'discount'  => sanitize_text_field( wp_unslash( $p['discount']  ?? '' ) ),
					'price'     => sanitize_text_field( wp_unslash( $p['price']     ?? '' ) ),
					'url'       => esc_url_raw( wp_unslash( $p['url']       ?? '' ) ),
					'featured'  => isset( $p['featured'] ) ? '1' : '0',
					'active'    => isset( $p['active'] )   ? '1' : '0',
				);
			}
			update_option( 'unitv_plans', $plans );
			break;

		case 'features':
			update_option( 'unitv_features_title',    sanitize_text_field( wp_unslash( $_POST['unitv_features_title']    ?? '' ) ) );
			update_option( 'unitv_features_subtitle', sanitize_text_field( wp_unslash( $_POST['unitv_features_subtitle'] ?? '' ) ) );
			$features     = array();
			$raw_features = isset( $_POST['features'] ) ? (array) $_POST['features'] : array();
			foreach ( $raw_features as $f ) {
				$features[] = array(
					'icon'   => sanitize_text_field( wp_unslash( $f['icon']   ?? '' ) ),
					'title'  => sanitize_text_field( wp_unslash( $f['title']  ?? '' ) ),
					'desc'   => sanitize_textarea_field( wp_unslash( $f['desc']   ?? '' ) ),
					'active' => isset( $f['active'] ) ? '1' : '0',
				);
			}
			update_option( 'unitv_features', $features );
			break;

		case 'downloads':
			update_option( 'unitv_downloads_title',    sanitize_text_field( wp_unslash( $_POST['unitv_downloads_title']    ?? '' ) ) );
			update_option( 'unitv_downloads_subtitle', sanitize_text_field( wp_unslash( $_POST['unitv_downloads_subtitle'] ?? '' ) ) );
			$downloads     = array();
			$raw_downloads = isset( $_POST['downloads'] ) ? (array) $_POST['downloads'] : array();
			foreach ( $raw_downloads as $d ) {
				$downloads[] = array(
					'name'   => sanitize_text_field( wp_unslash( $d['name']   ?? '' ) ),
					'img'    => esc_url_raw( wp_unslash( $d['img']    ?? '' ) ),
					'url'    => esc_url_raw( wp_unslash( $d['url']    ?? '' ) ),
					'active' => isset( $d['active'] ) ? '1' : '0',
				);
			}
			update_option( 'unitv_downloads', $downloads );
			break;

		case 'depoimentos':
			update_option( 'unitv_reviews_title',    sanitize_text_field( wp_unslash( $_POST['unitv_reviews_title']    ?? '' ) ) );
			update_option( 'unitv_reviews_subtitle', sanitize_text_field( wp_unslash( $_POST['unitv_reviews_subtitle'] ?? '' ) ) );
			$reviews     = array();
			$raw_reviews = isset( $_POST['reviews'] ) ? (array) $_POST['reviews'] : array();
			foreach ( $raw_reviews as $r ) {
				$reviews[] = array(
					'name'   => sanitize_text_field( wp_unslash( $r['name']   ?? '' ) ),
					'avatar' => esc_url_raw( wp_unslash( $r['avatar'] ?? '' ) ),
					'text'   => sanitize_textarea_field( wp_unslash( $r['text']   ?? '' ) ),
					'stars'  => absint( $r['stars'] ?? 5 ),
					'active' => isset( $r['active'] ) ? '1' : '0',
				);
			}
			update_option( 'unitv_reviews', $reviews );
			break;

		case 'footer':
			update_option( 'unitv_footer_brand',     sanitize_text_field( wp_unslash( $_POST['unitv_footer_brand']     ?? '' ) ) );
			update_option( 'unitv_footer_subtitle',  sanitize_text_field( wp_unslash( $_POST['unitv_footer_subtitle']  ?? '' ) ) );
			update_option( 'unitv_footer_phone',     sanitize_text_field( wp_unslash( $_POST['unitv_footer_phone']     ?? '' ) ) );
			update_option( 'unitv_footer_show_buy',  isset( $_POST['unitv_footer_show_buy'] ) ? '1' : '0' );
			update_option( 'unitv_footer_show_wa',   isset( $_POST['unitv_footer_show_wa']  ) ? '1' : '0' );
			update_option( 'unitv_footer_copyright', sanitize_text_field( wp_unslash( $_POST['unitv_footer_copyright'] ?? '' ) ) );
			$flinks     = array();
			$fl_labels  = isset( $_POST['footer_link_label'] ) ? (array) $_POST['footer_link_label'] : array();
			$fl_urls    = isset( $_POST['footer_link_url']   ) ? (array) $_POST['footer_link_url']   : array();
			foreach ( $fl_labels as $idx => $lbl ) {
				$lbl = sanitize_text_field( wp_unslash( $lbl ) );
				$url = esc_url_raw( wp_unslash( $fl_urls[ $idx ] ?? '' ) );
				if ( $lbl || $url ) {
					$flinks[] = array( 'label' => $lbl, 'url' => $url );
				}
			}
			update_option( 'unitv_footer_links', $flinks );
			break;

		case 'whatsapp':
			update_option( 'unitv_whatsapp_number',  sanitize_text_field( wp_unslash( $_POST['unitv_whatsapp_number']  ?? '' ) ) );
			update_option( 'unitv_whatsapp_fab',     isset( $_POST['unitv_whatsapp_fab']    ) ? '1' : '0' );
			update_option( 'unitv_whatsapp_header',  isset( $_POST['unitv_whatsapp_header'] ) ? '1' : '0' );
			update_option( 'unitv_whatsapp_message', sanitize_textarea_field( wp_unslash( $_POST['unitv_whatsapp_message'] ?? '' ) ) );
			break;

		case 'politicas':
			foreach ( array( 'privacy', 'termos', 'reembolso', 'cookies' ) as $slug ) {
				update_option( 'unitv_policy_' . $slug . '_title',   sanitize_text_field( wp_unslash( $_POST[ 'unitv_policy_' . $slug . '_title' ]   ?? '' ) ) );
				update_option( 'unitv_policy_' . $slug . '_content', wp_kses_post( wp_unslash( $_POST[ 'unitv_policy_' . $slug . '_content' ] ?? '' ) ) );
				update_option( 'unitv_policy_' . $slug . '_active',  isset( $_POST[ 'unitv_policy_' . $slug . '_active' ] ) ? '1' : '0' );
			}
			break;
	}

	wp_safe_redirect( $redirect );
	exit;
}

/* ---------------------------------------------------------------
 * Reset handler
 * ------------------------------------------------------------- */
add_action( 'admin_post_unitv_reset_settings', 'unitv_reset_settings' );

function unitv_reset_settings() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Acesso negado.', 'unitv-recargas' ) );
	}

	check_admin_referer( 'unitv_reset_settings', 'unitv_nonce' );

	$section  = isset( $_POST['unitv_section'] ) ? sanitize_key( $_POST['unitv_section'] ) : '';
	$defaults = unitv_defaults();

	// Delete all keys so they revert to defaults on next read
	foreach ( array_keys( $defaults ) as $key ) {
		delete_option( $key );
	}

	wp_safe_redirect( admin_url( 'admin.php?page=unitv-' . $section . '&reset=1' ) );
	exit;
}

/* ---------------------------------------------------------------
 * Shared page header/footer helpers
 * ------------------------------------------------------------- */
function unitv_admin_header( $title ) {
	$updated = isset( $_GET['updated'] );
	$reset   = isset( $_GET['reset'] );
	?>
	<div class="wrap unitv-admin-wrap">
	  <h1 class="unitv-admin-title">
	    <span class="unitv-admin-logo">📺</span> UniTV Recargas
	    <span class="unitv-admin-subtitle">— <?php echo esc_html( $title ); ?></span>
	  </h1>
	  <?php if ( $updated ) : ?>
	    <div class="unitv-notice unitv-notice-success">✅ <?php esc_html_e( 'Configurações salvas com sucesso!', 'unitv-recargas' ); ?></div>
	  <?php elseif ( $reset ) : ?>
	    <div class="unitv-notice unitv-notice-info">🔄 <?php esc_html_e( 'Configurações restauradas para os valores padrão.', 'unitv-recargas' ); ?></div>
	  <?php endif; ?>
	<?php
}

function unitv_admin_footer( $section ) {
	?>
	  <div class="unitv-admin-actions">
	    <button type="submit" form="unitv-form" class="unitv-btn-save">
	      💾 <?php esc_html_e( 'Salvar Alterações', 'unitv-recargas' ); ?>
	    </button>
	    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline;">
	      <?php wp_nonce_field( 'unitv_reset_settings', 'unitv_nonce' ); ?>
	      <input type="hidden" name="action"       value="unitv_reset_settings">
	      <input type="hidden" name="unitv_section" value="<?php echo esc_attr( $section ); ?>">
	      <button type="submit" class="unitv-btn-reset" onclick="return confirm('<?php esc_attr_e( 'Restaurar todos os valores padrão?', 'unitv-recargas' ); ?>')">
	        🔄 <?php esc_html_e( 'Restaurar Padrões', 'unitv-recargas' ); ?>
	      </button>
	    </form>
	  </div>
	</div><!-- .unitv-admin-wrap -->
	<?php
}

function unitv_form_open( $section ) {
	?>
	<form method="post" id="unitv-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	  <?php wp_nonce_field( 'unitv_save_settings', 'unitv_nonce' ); ?>
	  <input type="hidden" name="action"       value="unitv_save_settings">
	  <input type="hidden" name="unitv_section" value="<?php echo esc_attr( $section ); ?>">
	<?php
}

/* ---------------------------------------------------------------
 * Page: Configurações Gerais
 * ------------------------------------------------------------- */
function unitv_page_geral() {
	unitv_admin_header( 'Configurações Gerais' );
	unitv_form_open( 'geral' );
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">🏷️ Marca</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Nome da Marca', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_brand_name" value="<?php echo esc_attr( unitv_opt( 'unitv_brand_name' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'URL do Logo', 'unitv-recargas' ); ?></th>
	      <td><input type="url" name="unitv_logo_url" value="<?php echo esc_attr( unitv_opt( 'unitv_logo_url' ) ); ?>" class="unitv-input" placeholder="https://..."></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Cor Principal', 'unitv-recargas' ); ?></th>
	      <td><input type="color" name="unitv_brand_color" value="<?php echo esc_attr( unitv_opt( 'unitv_brand_color' ) ); ?>"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Cor Secundária (Gradiente)', 'unitv-recargas' ); ?></th>
	      <td><input type="color" name="unitv_brand_color2" value="<?php echo esc_attr( unitv_opt( 'unitv_brand_color2' ) ); ?>"></td>
	    </tr>
	  </table>
	</div>

	<div class="unitv-card">
	  <h2 class="unitv-card-title">🔔 Toast / Social Proof</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Habilitar Toast', 'unitv-recargas' ); ?></th>
	      <td><label><input type="checkbox" name="unitv_toast_enabled" value="1" <?php checked( unitv_opt( 'unitv_toast_enabled' ), '1' ); ?>> <?php esc_html_e( 'Sim', 'unitv-recargas' ); ?></label></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Intervalo (segundos)', 'unitv-recargas' ); ?></th>
	      <td><input type="number" name="unitv_toast_interval" value="<?php echo esc_attr( unitv_opt( 'unitv_toast_interval' ) ); ?>" min="5" max="120" class="unitv-input-sm"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Nomes do Toast', 'unitv-recargas' ); ?><br><small><?php esc_html_e( 'Um por linha', 'unitv-recargas' ); ?></small></th>
	      <td><textarea name="unitv_toast_names" rows="8" class="unitv-input"><?php echo esc_textarea( unitv_opt( 'unitv_toast_names' ) ); ?></textarea></td>
	    </tr>
	  </table>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'geral' );
}

/* ---------------------------------------------------------------
 * Page: Hero / Topo
 * ------------------------------------------------------------- */
function unitv_page_hero() {
	unitv_admin_header( 'Hero / Topo' );
	unitv_form_open( 'hero' );
	$trust = unitv_opt( 'unitv_hero_trust' );
	if ( ! is_array( $trust ) || count( $trust ) < 3 ) {
		$defaults = unitv_defaults();
		$trust     = $defaults['unitv_hero_trust'];
	}
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">🦸 Hero Principal</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Texto do Badge', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_hero_badge" value="<?php echo esc_attr( unitv_opt( 'unitv_hero_badge' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Título Principal', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_hero_title" value="<?php echo esc_attr( unitv_opt( 'unitv_hero_title' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Palavra com Gradiente', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_hero_gradient_word" value="<?php echo esc_attr( unitv_opt( 'unitv_hero_gradient_word' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Descrição', 'unitv-recargas' ); ?></th>
	      <td><textarea name="unitv_hero_desc" rows="3" class="unitv-input"><?php echo esc_textarea( unitv_opt( 'unitv_hero_desc' ) ); ?></textarea></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Texto do Botão CTA', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_hero_cta_text" value="<?php echo esc_attr( unitv_opt( 'unitv_hero_cta_text' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Link do Botão CTA', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_hero_cta_link" value="<?php echo esc_attr( unitv_opt( 'unitv_hero_cta_link' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Número da Estatística', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_hero_stat_number" value="<?php echo esc_attr( unitv_opt( 'unitv_hero_stat_number' ) ); ?>" class="unitv-input-sm"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Label da Estatística', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_hero_stat_label" value="<?php echo esc_attr( unitv_opt( 'unitv_hero_stat_label' ) ); ?>" class="unitv-input"></td>
	    </tr>
	  </table>
	</div>

	<div class="unitv-card">
	  <h2 class="unitv-card-title">✅ Trust Items (3 fixos)</h2>
	  <?php for ( $i = 0; $i < 3; $i++ ) : ?>
	  <div class="unitv-row">
	    <div class="unitv-row-num"><?php echo esc_html( $i + 1 ); ?></div>
	    <div class="unitv-row-body">
	      <label><?php esc_html_e( 'Classe do Ícone (Bootstrap Icons)', 'unitv-recargas' ); ?></label>
	      <input type="text" name="trust_icon[]" value="<?php echo esc_attr( $trust[ $i ]['icon'] ?? '' ); ?>" class="unitv-input" placeholder="ex: bi-shield-lock-fill">
	      <label><?php esc_html_e( 'Texto', 'unitv-recargas' ); ?></label>
	      <input type="text" name="trust_text[]" value="<?php echo esc_attr( $trust[ $i ]['text'] ?? '' ); ?>" class="unitv-input">
	    </div>
	  </div>
	  <?php endfor; ?>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'hero' );
}

/* ---------------------------------------------------------------
 * Page: Planos / Recargas
 * ------------------------------------------------------------- */
function unitv_page_planos() {
	unitv_admin_header( 'Planos / Recargas' );
	unitv_form_open( 'planos' );
	$plans    = unitv_opt( 'unitv_plans' );
	$defaults = unitv_defaults();
	if ( ! is_array( $plans ) ) {
		$plans = $defaults['unitv_plans'];
	}
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">📋 Títulos da Seção</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Título', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_plans_title" value="<?php echo esc_attr( unitv_opt( 'unitv_plans_title' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Subtítulo', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_plans_subtitle" value="<?php echo esc_attr( unitv_opt( 'unitv_plans_subtitle' ) ); ?>" class="unitv-input"></td>
	    </tr>
	  </table>
	</div>

	<div class="unitv-card">
	  <h2 class="unitv-card-title">🛒 Planos <button type="button" class="unitv-btn-add" data-target="plans-list" data-template="plan">+ Adicionar Plano</button></h2>
	  <div id="plans-list">
	    <?php foreach ( $plans as $idx => $plan ) : ?>
	    <div class="unitv-repeater-row">
	      <div class="unitv-row-handle">☰</div>
	      <div class="unitv-row-body">
	        <div class="unitv-row-grid">
	          <div>
	            <label><?php esc_html_e( 'Nome do Plano', 'unitv-recargas' ); ?></label>
	            <input type="text" name="plans[<?php echo esc_attr( $idx ); ?>][name]" value="<?php echo esc_attr( $plan['name'] ); ?>" class="unitv-input">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'URL da Imagem', 'unitv-recargas' ); ?></label>
	            <input type="url" name="plans[<?php echo esc_attr( $idx ); ?>][img]" value="<?php echo esc_attr( $plan['img'] ); ?>" class="unitv-input" placeholder="https://...">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'Rating', 'unitv-recargas' ); ?></label>
	            <input type="text" name="plans[<?php echo esc_attr( $idx ); ?>][rating]" value="<?php echo esc_attr( $plan['rating'] ); ?>" class="unitv-input-sm">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'Avaliações', 'unitv-recargas' ); ?></label>
	            <input type="text" name="plans[<?php echo esc_attr( $idx ); ?>][reviews]" value="<?php echo esc_attr( $plan['reviews'] ); ?>" class="unitv-input-sm">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'Preço Antigo', 'unitv-recargas' ); ?></label>
	            <input type="text" name="plans[<?php echo esc_attr( $idx ); ?>][price_old]" value="<?php echo esc_attr( $plan['price_old'] ); ?>" class="unitv-input-sm">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'Desconto', 'unitv-recargas' ); ?></label>
	            <input type="text" name="plans[<?php echo esc_attr( $idx ); ?>][discount]" value="<?php echo esc_attr( $plan['discount'] ); ?>" class="unitv-input-sm">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'Preço Atual', 'unitv-recargas' ); ?></label>
	            <input type="text" name="plans[<?php echo esc_attr( $idx ); ?>][price]" value="<?php echo esc_attr( $plan['price'] ); ?>" class="unitv-input-sm">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'URL de Compra', 'unitv-recargas' ); ?></label>
	            <input type="url" name="plans[<?php echo esc_attr( $idx ); ?>][url]" value="<?php echo esc_attr( $plan['url'] ); ?>" class="unitv-input" placeholder="https://...">
	          </div>
	        </div>
	        <div class="unitv-row-checks">
	          <label><input type="checkbox" name="plans[<?php echo esc_attr( $idx ); ?>][featured]" value="1" <?php checked( $plan['featured'], '1' ); ?>> <?php esc_html_e( 'Mais Vendido (Featured)', 'unitv-recargas' ); ?></label>
	          <label><input type="checkbox" name="plans[<?php echo esc_attr( $idx ); ?>][active]" value="1" <?php checked( $plan['active'], '1' ); ?>> <?php esc_html_e( 'Ativo', 'unitv-recargas' ); ?></label>
	        </div>
	      </div>
	      <button type="button" class="unitv-row-remove">✕</button>
	    </div>
	    <?php endforeach; ?>
	  </div>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'planos' );
}

/* ---------------------------------------------------------------
 * Page: Features
 * ------------------------------------------------------------- */
function unitv_page_features() {
	unitv_admin_header( 'Features' );
	unitv_form_open( 'features' );
	$features = unitv_opt( 'unitv_features' );
	$defaults  = unitv_defaults();
	if ( ! is_array( $features ) ) {
		$features = $defaults['unitv_features'];
	}
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">📋 Títulos da Seção</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Título', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_features_title" value="<?php echo esc_attr( unitv_opt( 'unitv_features_title' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Subtítulo', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_features_subtitle" value="<?php echo esc_attr( unitv_opt( 'unitv_features_subtitle' ) ); ?>" class="unitv-input"></td>
	    </tr>
	  </table>
	</div>

	<div class="unitv-card">
	  <h2 class="unitv-card-title">⭐ Features <button type="button" class="unitv-btn-add" data-target="features-list" data-template="feature">+ Adicionar</button></h2>
	  <div id="features-list">
	    <?php foreach ( $features as $idx => $feat ) : ?>
	    <div class="unitv-repeater-row">
	      <div class="unitv-row-handle">☰</div>
	      <div class="unitv-row-body">
	        <div class="unitv-row-grid">
	          <div>
	            <label><?php esc_html_e( 'Emoji / Ícone', 'unitv-recargas' ); ?></label>
	            <input type="text" name="features[<?php echo esc_attr( $idx ); ?>][icon]" value="<?php echo esc_attr( $feat['icon'] ); ?>" class="unitv-input-sm">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'Título', 'unitv-recargas' ); ?></label>
	            <input type="text" name="features[<?php echo esc_attr( $idx ); ?>][title]" value="<?php echo esc_attr( $feat['title'] ); ?>" class="unitv-input">
	          </div>
	          <div class="unitv-col-full">
	            <label><?php esc_html_e( 'Descrição', 'unitv-recargas' ); ?></label>
	            <textarea name="features[<?php echo esc_attr( $idx ); ?>][desc]" rows="2" class="unitv-input"><?php echo esc_textarea( $feat['desc'] ); ?></textarea>
	          </div>
	        </div>
	        <div class="unitv-row-checks">
	          <label><input type="checkbox" name="features[<?php echo esc_attr( $idx ); ?>][active]" value="1" <?php checked( $feat['active'], '1' ); ?>> <?php esc_html_e( 'Ativo', 'unitv-recargas' ); ?></label>
	        </div>
	      </div>
	      <button type="button" class="unitv-row-remove">✕</button>
	    </div>
	    <?php endforeach; ?>
	  </div>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'features' );
}

/* ---------------------------------------------------------------
 * Page: Downloads
 * ------------------------------------------------------------- */
function unitv_page_downloads() {
	unitv_admin_header( 'Downloads' );
	unitv_form_open( 'downloads' );
	$downloads = unitv_opt( 'unitv_downloads' );
	$defaults   = unitv_defaults();
	if ( ! is_array( $downloads ) ) {
		$downloads = $defaults['unitv_downloads'];
	}
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">📋 Títulos da Seção</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Título', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_downloads_title" value="<?php echo esc_attr( unitv_opt( 'unitv_downloads_title' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Subtítulo', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_downloads_subtitle" value="<?php echo esc_attr( unitv_opt( 'unitv_downloads_subtitle' ) ); ?>" class="unitv-input"></td>
	    </tr>
	  </table>
	</div>

	<div class="unitv-card">
	  <h2 class="unitv-card-title">📱 Downloads <button type="button" class="unitv-btn-add" data-target="downloads-list" data-template="download">+ Adicionar</button></h2>
	  <div id="downloads-list">
	    <?php foreach ( $downloads as $idx => $dl ) : ?>
	    <div class="unitv-repeater-row">
	      <div class="unitv-row-handle">☰</div>
	      <div class="unitv-row-body">
	        <div class="unitv-row-grid">
	          <div>
	            <label><?php esc_html_e( 'Nome do Dispositivo', 'unitv-recargas' ); ?></label>
	            <input type="text" name="downloads[<?php echo esc_attr( $idx ); ?>][name]" value="<?php echo esc_attr( $dl['name'] ); ?>" class="unitv-input">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'URL da Imagem', 'unitv-recargas' ); ?></label>
	            <input type="url" name="downloads[<?php echo esc_attr( $idx ); ?>][img]" value="<?php echo esc_attr( $dl['img'] ); ?>" class="unitv-input" placeholder="https://...">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'URL do Download (APK)', 'unitv-recargas' ); ?></label>
	            <input type="url" name="downloads[<?php echo esc_attr( $idx ); ?>][url]" value="<?php echo esc_attr( $dl['url'] ); ?>" class="unitv-input" placeholder="https://...">
	          </div>
	        </div>
	        <div class="unitv-row-checks">
	          <label><input type="checkbox" name="downloads[<?php echo esc_attr( $idx ); ?>][active]" value="1" <?php checked( $dl['active'], '1' ); ?>> <?php esc_html_e( 'Ativo', 'unitv-recargas' ); ?></label>
	        </div>
	      </div>
	      <button type="button" class="unitv-row-remove">✕</button>
	    </div>
	    <?php endforeach; ?>
	  </div>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'downloads' );
}

/* ---------------------------------------------------------------
 * Page: Depoimentos
 * ------------------------------------------------------------- */
function unitv_page_depoimentos() {
	unitv_admin_header( 'Depoimentos' );
	unitv_form_open( 'depoimentos' );
	$reviews  = unitv_opt( 'unitv_reviews' );
	$defaults = unitv_defaults();
	if ( ! is_array( $reviews ) ) {
		$reviews = $defaults['unitv_reviews'];
	}
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">📋 Títulos da Seção</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Título', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_reviews_title" value="<?php echo esc_attr( unitv_opt( 'unitv_reviews_title' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Subtítulo', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_reviews_subtitle" value="<?php echo esc_attr( unitv_opt( 'unitv_reviews_subtitle' ) ); ?>" class="unitv-input"></td>
	    </tr>
	  </table>
	</div>

	<div class="unitv-card">
	  <h2 class="unitv-card-title">💬 Depoimentos <button type="button" class="unitv-btn-add" data-target="reviews-list" data-template="review">+ Adicionar</button></h2>
	  <div id="reviews-list">
	    <?php foreach ( $reviews as $idx => $rev ) : ?>
	    <div class="unitv-repeater-row">
	      <div class="unitv-row-handle">☰</div>
	      <div class="unitv-row-body">
	        <div class="unitv-row-grid">
	          <div>
	            <label><?php esc_html_e( 'Nome do Cliente', 'unitv-recargas' ); ?></label>
	            <input type="text" name="reviews[<?php echo esc_attr( $idx ); ?>][name]" value="<?php echo esc_attr( $rev['name'] ); ?>" class="unitv-input">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'URL do Avatar', 'unitv-recargas' ); ?></label>
	            <input type="url" name="reviews[<?php echo esc_attr( $idx ); ?>][avatar]" value="<?php echo esc_attr( $rev['avatar'] ); ?>" class="unitv-input" placeholder="https://...">
	          </div>
	          <div>
	            <label><?php esc_html_e( 'Estrelas (1-5)', 'unitv-recargas' ); ?></label>
	            <select name="reviews[<?php echo esc_attr( $idx ); ?>][stars]" class="unitv-input-sm">
	              <?php for ( $s = 1; $s <= 5; $s++ ) : ?>
	              <option value="<?php echo esc_attr( $s ); ?>" <?php selected( absint( $rev['stars'] ), $s ); ?>><?php echo esc_html( $s ); ?></option>
	              <?php endfor; ?>
	            </select>
	          </div>
	          <div class="unitv-col-full">
	            <label><?php esc_html_e( 'Depoimento', 'unitv-recargas' ); ?></label>
	            <textarea name="reviews[<?php echo esc_attr( $idx ); ?>][text]" rows="2" class="unitv-input"><?php echo esc_textarea( $rev['text'] ); ?></textarea>
	          </div>
	        </div>
	        <div class="unitv-row-checks">
	          <label><input type="checkbox" name="reviews[<?php echo esc_attr( $idx ); ?>][active]" value="1" <?php checked( $rev['active'], '1' ); ?>> <?php esc_html_e( 'Ativo', 'unitv-recargas' ); ?></label>
	        </div>
	      </div>
	      <button type="button" class="unitv-row-remove">✕</button>
	    </div>
	    <?php endforeach; ?>
	  </div>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'depoimentos' );
}

/* ---------------------------------------------------------------
 * Page: Footer / Rodapé
 * ------------------------------------------------------------- */
function unitv_page_footer() {
	unitv_admin_header( 'Footer / Rodapé' );
	unitv_form_open( 'footer' );
	$flinks = unitv_opt( 'unitv_footer_links' );
	if ( ! is_array( $flinks ) ) {
		$flinks = array();
	}
	// Pad to 5 slots
	while ( count( $flinks ) < 5 ) {
		$flinks[] = array( 'label' => '', 'url' => '' );
	}
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">🦶 Rodapé</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Nome da Marca', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_footer_brand" value="<?php echo esc_attr( unitv_opt( 'unitv_footer_brand' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Subtítulo', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_footer_subtitle" value="<?php echo esc_attr( unitv_opt( 'unitv_footer_subtitle' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Telefone', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_footer_phone" value="<?php echo esc_attr( unitv_opt( 'unitv_footer_phone' ) ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Mostrar Botão Comprar', 'unitv-recargas' ); ?></th>
	      <td><label><input type="checkbox" name="unitv_footer_show_buy" value="1" <?php checked( unitv_opt( 'unitv_footer_show_buy' ), '1' ); ?>> <?php esc_html_e( 'Sim', 'unitv-recargas' ); ?></label></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Mostrar Botão WhatsApp', 'unitv-recargas' ); ?></th>
	      <td><label><input type="checkbox" name="unitv_footer_show_wa" value="1" <?php checked( unitv_opt( 'unitv_footer_show_wa' ), '1' ); ?>> <?php esc_html_e( 'Sim', 'unitv-recargas' ); ?></label></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Copyright', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_footer_copyright" value="<?php echo esc_attr( unitv_opt( 'unitv_footer_copyright' ) ); ?>" class="unitv-input"></td>
	    </tr>
	  </table>
	</div>

	<div class="unitv-card">
	  <h2 class="unitv-card-title">🔗 Links Customizados (até 5)</h2>
	  <table class="unitv-table">
	    <?php foreach ( $flinks as $idx => $fl ) : ?>
	    <tr>
	      <th><?php echo esc_html( $idx + 1 ); ?></th>
	      <td>
	        <input type="text" name="footer_link_label[]" value="<?php echo esc_attr( $fl['label'] ); ?>" class="unitv-input-sm" placeholder="<?php esc_attr_e( 'Label', 'unitv-recargas' ); ?>">
	        <input type="url"  name="footer_link_url[]"   value="<?php echo esc_attr( $fl['url'] ); ?>"   class="unitv-input"    placeholder="https://...">
	      </td>
	    </tr>
	    <?php endforeach; ?>
	  </table>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'footer' );
}

/* ---------------------------------------------------------------
 * Page: WhatsApp / Contato
 * ------------------------------------------------------------- */
function unitv_page_whatsapp() {
	unitv_admin_header( 'WhatsApp / Contato' );
	unitv_form_open( 'whatsapp' );
	?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title">💬 WhatsApp</h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Número (com código do país)', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_whatsapp_number" value="<?php echo esc_attr( unitv_opt( 'unitv_whatsapp_number' ) ); ?>" class="unitv-input" placeholder="5511999999999"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Mostrar FAB WhatsApp', 'unitv-recargas' ); ?></th>
	      <td><label><input type="checkbox" name="unitv_whatsapp_fab" value="1" <?php checked( unitv_opt( 'unitv_whatsapp_fab' ), '1' ); ?>> <?php esc_html_e( 'Sim', 'unitv-recargas' ); ?></label></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Mostrar Ícone no Header', 'unitv-recargas' ); ?></th>
	      <td><label><input type="checkbox" name="unitv_whatsapp_header" value="1" <?php checked( unitv_opt( 'unitv_whatsapp_header' ), '1' ); ?>> <?php esc_html_e( 'Sim', 'unitv-recargas' ); ?></label></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Mensagem Pré-definida', 'unitv-recargas' ); ?></th>
	      <td><textarea name="unitv_whatsapp_message" rows="3" class="unitv-input"><?php echo esc_textarea( unitv_opt( 'unitv_whatsapp_message' ) ); ?></textarea></td>
	    </tr>
	  </table>
	</div>
	</form>
	<?php
	unitv_admin_footer( 'whatsapp' );
}

/* ---------------------------------------------------------------
 * Page: Páginas de Política
 * ------------------------------------------------------------- */
function unitv_page_politicas() {
	unitv_admin_header( 'Páginas de Política' );
	unitv_form_open( 'politicas' );

	$policies = array(
		'privacy'  => __( '🔒 Política de Privacidade', 'unitv-recargas' ),
		'termos'   => __( '📋 Termos de Uso',            'unitv-recargas' ),
		'reembolso'=> __( '💰 Política de Reembolso',    'unitv-recargas' ),
		'cookies'  => __( '🍪 Política de Cookies',      'unitv-recargas' ),
	);

	foreach ( $policies as $slug => $label ) :
		$title   = unitv_opt( 'unitv_policy_' . $slug . '_title' );
		$content = unitv_opt( 'unitv_policy_' . $slug . '_content' );
		$active  = unitv_opt( 'unitv_policy_' . $slug . '_active' );
		if ( $content === '' ) {
			// Use stored default template content (blank means: use template default)
		}
		?>
	<div class="unitv-card">
	  <h2 class="unitv-card-title"><?php echo esc_html( $label ); ?></h2>
	  <table class="unitv-table">
	    <tr>
	      <th><?php esc_html_e( 'Título', 'unitv-recargas' ); ?></th>
	      <td><input type="text" name="unitv_policy_<?php echo esc_attr( $slug ); ?>_title" value="<?php echo esc_attr( $title ); ?>" class="unitv-input"></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Ativo', 'unitv-recargas' ); ?></th>
	      <td><label><input type="checkbox" name="unitv_policy_<?php echo esc_attr( $slug ); ?>_active" value="1" <?php checked( $active, '1' ); ?>> <?php esc_html_e( 'Sim', 'unitv-recargas' ); ?></label></td>
	    </tr>
	    <tr>
	      <th><?php esc_html_e( 'Conteúdo', 'unitv-recargas' ); ?><br><small><?php esc_html_e( 'Deixe vazio para usar o conteúdo padrão.', 'unitv-recargas' ); ?></small></th>
	      <td>
	        <?php
	        wp_editor(
	          $content,
	          'unitv_policy_' . $slug . '_content',
	          array(
	            'textarea_name' => 'unitv_policy_' . $slug . '_content',
	            'textarea_rows' => 15,
	            'teeny'         => false,
	          )
	        );
	        ?>
	      </td>
	    </tr>
	  </table>
	</div>
	<?php endforeach; ?>
	</form>
	<?php
	unitv_admin_footer( 'politicas' );
}
