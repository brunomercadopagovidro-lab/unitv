<?php
/**
 * UniTV Recargas VIP — Helper functions (always loaded)
 *
 * Provides unitv_defaults() and unitv_opt() for use in templates and admin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'unitv_defaults' ) ) {
	return; // Already loaded — prevent double-include.
}

/**
 * Return all option defaults.
 *
 * @return array
 */
function unitv_defaults() {
	return array(
		// General
		'unitv_brand_name'      => 'UniTV',
		'unitv_logo_url'        => '',
		'unitv_brand_color'     => '#c71b3a',
		'unitv_brand_color2'    => '#6a11cb',
		'unitv_toast_enabled'   => '1',
		'unitv_toast_interval'  => '12',
		'unitv_toast_names'     => "Rafael\nPaula\nEdson\nCamila\nThiago\nMariana\nJoão\nBruna\nCarlos\nLetícia",

		// Hero
		'unitv_hero_badge'          => 'ENVIO IMEDIATO — 24 HORAS',
		'unitv_hero_title'          => 'Recargas',
		'unitv_hero_gradient_word'  => 'UniTV',
		'unitv_hero_desc'           => 'Planos de 30, 60, 90 e 365 dias com pagamento via PIX. Receba seu código de ativação de forma imediata por e-mail e WhatsApp após a confirmação do pagamento.',
		'unitv_hero_cta_text'       => 'COMPRAR RECARGA',
		'unitv_hero_cta_link'       => '#recargas',
		'unitv_hero_stat_number'    => '30.770+',
		'unitv_hero_stat_label'     => 'Recargas Realizadas',
		'unitv_hero_trust'          => array(
			array( 'icon' => 'bi-shield-lock-fill', 'text' => 'Pagamento Seguro' ),
			array( 'icon' => 'bi-send-fill',        'text' => 'Envio Imediato'   ),
			array( 'icon' => 'bi-headset',          'text' => 'Suporte 24h'      ),
		),

		// Plans
		'unitv_plans_title'    => 'Escolha o seu Plano',
		'unitv_plans_subtitle' => 'Sem taxas ocultas. Ativação imediata via WhatsApp e e-mail.',
		'unitv_plans'          => array(
			array(
				'name'      => 'UNITV Recarga Mensal',
				'img'       => 'https://controleunitv.shop/wp-content/uploads/2026/03/card.30.png',
				'rating'    => '4.99',
				'reviews'   => '12.196',
				'price_old' => 'R$ 50,00',
				'discount'  => '-50%',
				'price'     => '24,90',
				'url'       => 'https://loja.controleunitv.shop/checkout?plano=mensal',
				'featured'  => '0',
				'active'    => '1',
			),
			array(
				'name'      => 'UNITV Recarga Trimestral',
				'img'       => 'https://controleunitv.shop/wp-content/uploads/2026/03/card-90-1.png',
				'rating'    => '4.99',
				'reviews'   => '12.196',
				'price_old' => 'R$ 150,00',
				'discount'  => '-53%',
				'price'     => '69,90',
				'url'       => 'https://loja.controleunitv.shop/checkout?plano=trimestral',
				'featured'  => '1',
				'active'    => '1',
			),
			array(
				'name'      => 'UNITV Recarga Anual',
				'img'       => 'https://controleunitv.shop/wp-content/uploads/2026/03/card-365-1.png',
				'rating'    => '4.99',
				'reviews'   => '12.196',
				'price_old' => 'R$ 400,00',
				'discount'  => '-57%',
				'price'     => '169,90',
				'url'       => 'https://loja.controleunitv.shop/checkout?plano=anual',
				'featured'  => '0',
				'active'    => '1',
			),
		),

		// Features
		'unitv_features_title'    => 'Por que escolher a UniTV?',
		'unitv_features_subtitle' => 'Qualidade e praticidade em um único serviço.',
		'unitv_features'          => array(
			array( 'icon' => '🖥️', 'title' => '+500 Canais',           'desc' => 'Desfrute de uma incrível variedade de entretenimento com mais de 500 canais disponíveis.', 'active' => '1' ),
			array( 'icon' => '▶️', 'title' => '+5 Mil Filmes e Séries', 'desc' => 'Biblioteca impressionante com mais de 5 mil filmes e séries à sua disposição.',           'active' => '1' ),
			array( 'icon' => '💬', 'title' => 'Envio Imediato',         'desc' => 'Envio imediato do código via e-mail e WhatsApp após a confirmação do pagamento.',           'active' => '1' ),
		),

		// Downloads
		'unitv_downloads_title'    => 'Disponível em Todos os Dispositivos',
		'unitv_downloads_subtitle' => 'Baixe o aplicativo para o seu dispositivo e aproveite em qualquer lugar.',
		'unitv_downloads'          => array(
			array( 'name' => 'Celular',    'img' => 'https://controleunitv.shop/wp-content/uploads/2026/03/nokia_C5_endi-angled-blue.png', 'url' => 'https://www.unitvbrasil.app/unitv-celular.apk', 'active' => '1' ),
			array( 'name' => 'Fire Stick', 'img' => 'https://controleunitv.shop/wp-content/uploads/2026/03/stick_br-300x300-1.png',         'url' => 'https://www.unitvbrasil.app/unitv-tv.apk',     'active' => '1' ),
			array( 'name' => 'TV Box',     'img' => 'https://controleunitv.shop/wp-content/uploads/2026/03/box_br-300x300-1.png',            'url' => 'https://www.unitvbrasil.app/unitv-tv.apk',     'active' => '1' ),
			array( 'name' => 'Smart TV',   'img' => 'https://controleunitv.shop/wp-content/uploads/2026/03/tv_br-300x300-1.png',             'url' => 'https://www.unitvbrasil.app/unitv-tv.apk',     'active' => '1' ),
		),

		// Reviews
		'unitv_reviews_title'    => 'O que nossos clientes dizem',
		'unitv_reviews_subtitle' => 'Mais de 30 mil recargas realizadas e clientes satisfeitos.',
		'unitv_reviews'          => array(
			array( 'name' => 'Jonas Jose',       'avatar' => 'https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-3.jpg', 'text' => '"Experiência incrível! Atendimento ágil e eficiente. Recomendo!"', 'stars' => '5', 'active' => '1' ),
			array( 'name' => 'Ygor Brito',       'avatar' => 'https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-4.jpg', 'text' => '"Compra rápida, sem enrolação. Ótimo atendimento!"',                  'stars' => '5', 'active' => '1' ),
			array( 'name' => 'Selma Novacek',    'avatar' => 'https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-5.jpg', 'text' => '"Recebi no e-mail/WhatsApp em minutos. Muito prático."',             'stars' => '5', 'active' => '1' ),
			array( 'name' => 'Eziel José Tiano', 'avatar' => 'https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-6.jpg', 'text' => '"Serviço confiável, preço justo e suporte excelente."',              'stars' => '5', 'active' => '1' ),
		),

		// Footer
		'unitv_footer_brand'     => 'UniTV',
		'unitv_footer_subtitle'  => 'Recargas Digitais — Venda de cartões de recarga digitais',
		'unitv_footer_phone'     => '(41) 98461‑3998',
		'unitv_footer_show_buy'  => '1',
		'unitv_footer_show_wa'   => '1',
		'unitv_footer_copyright' => 'UniTV. Todos os direitos reservados.',
		'unitv_footer_links'     => array(),

		// WhatsApp
		'unitv_whatsapp_number'  => '5541984613998',
		'unitv_whatsapp_fab'     => '1',
		'unitv_whatsapp_header'  => '1',
		'unitv_whatsapp_message' => '',

		// Policy pages
		'unitv_policy_privacy_title'      => 'Política de Privacidade',
		'unitv_policy_privacy_content'    => '',
		'unitv_policy_privacy_active'     => '1',
		'unitv_policy_termos_title'       => 'Termos de Uso',
		'unitv_policy_termos_content'     => '',
		'unitv_policy_termos_active'      => '1',
		'unitv_policy_reembolso_title'    => 'Política de Reembolso',
		'unitv_policy_reembolso_content'  => '',
		'unitv_policy_reembolso_active'   => '1',
		'unitv_policy_cookies_title'      => 'Política de Cookies',
		'unitv_policy_cookies_content'    => '',
		'unitv_policy_cookies_active'     => '1',
	);
}

/**
 * Get a plugin option with fallback to defaults.
 *
 * @param string $key Option key.
 * @return mixed
 */
function unitv_opt( $key ) {
	$defaults = unitv_defaults();
	$val      = get_option( $key, null );
	if ( $val === null && isset( $defaults[ $key ] ) ) {
		return $defaults[ $key ];
	}
	return $val;
}
