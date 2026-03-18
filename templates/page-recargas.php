<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
// unitv_opt() and unitv_defaults() are always available via helpers.php (loaded in unitv-recargas.php)
$defaults = unitv_defaults();

// Build policy page URLs
$slugs           = get_option( 'unitv_pages_slugs', array() );
$url_privacidade = ! empty( $slugs['privacidade'] ) ? home_url( '/' . $slugs['privacidade'] . '/' ) : '#';
$url_termos      = ! empty( $slugs['termos'] )      ? home_url( '/' . $slugs['termos']      . '/' ) : '#';
$url_reembolso   = ! empty( $slugs['reembolso'] )   ? home_url( '/' . $slugs['reembolso']   . '/' ) : '#';
$url_cookies     = ! empty( $slugs['cookies'] )     ? home_url( '/' . $slugs['cookies']     . '/' ) : '#';

// General
$brand_name = unitv_opt( 'unitv_brand_name' );
$wa_number  = unitv_opt( 'unitv_whatsapp_number' );
$wa_msg     = unitv_opt( 'unitv_whatsapp_message' );
$wa_url     = 'https://wa.me/' . rawurlencode( $wa_number ) . ( $wa_msg ? '?text=' . rawurlencode( $wa_msg ) : '' );
$show_fab   = (bool) unitv_opt( 'unitv_whatsapp_fab' );
$show_wa_hdr= (bool) unitv_opt( 'unitv_whatsapp_header' );

// Hero
$hero_badge    = unitv_opt( 'unitv_hero_badge' );
$hero_title    = unitv_opt( 'unitv_hero_title' );
$hero_grad     = unitv_opt( 'unitv_hero_gradient_word' );
$hero_desc     = unitv_opt( 'unitv_hero_desc' );
$hero_cta_text = unitv_opt( 'unitv_hero_cta_text' );
$hero_cta_link = unitv_opt( 'unitv_hero_cta_link' );
$hero_stat_num = unitv_opt( 'unitv_hero_stat_number' );
$hero_stat_lbl = unitv_opt( 'unitv_hero_stat_label' );
$hero_trust    = unitv_opt( 'unitv_hero_trust' );
if ( ! is_array( $hero_trust ) ) {
	$hero_trust = $defaults['unitv_hero_trust'];
}

// Plans
$plans_title    = unitv_opt( 'unitv_plans_title' );
$plans_subtitle = unitv_opt( 'unitv_plans_subtitle' );
$plans          = unitv_opt( 'unitv_plans' );
if ( ! is_array( $plans ) ) {
	$plans = $defaults['unitv_plans'];
}
$plans = array_filter( $plans, function( $p ) { return ! empty( $p['active'] ) && $p['active'] === '1'; } );

// Features
$features_title    = unitv_opt( 'unitv_features_title' );
$features_subtitle = unitv_opt( 'unitv_features_subtitle' );
$features          = unitv_opt( 'unitv_features' );
if ( ! is_array( $features ) ) {
	$features = $defaults['unitv_features'];
}
$features = array_filter( $features, function( $f ) { return ! empty( $f['active'] ) && $f['active'] === '1'; } );

// Downloads
$downloads_title    = unitv_opt( 'unitv_downloads_title' );
$downloads_subtitle = unitv_opt( 'unitv_downloads_subtitle' );
$downloads          = unitv_opt( 'unitv_downloads' );
if ( ! is_array( $downloads ) ) {
	$downloads = $defaults['unitv_downloads'];
}
$downloads = array_filter( $downloads, function( $d ) { return ! empty( $d['active'] ) && $d['active'] === '1'; } );

// Reviews
$reviews_title    = unitv_opt( 'unitv_reviews_title' );
$reviews_subtitle = unitv_opt( 'unitv_reviews_subtitle' );
$reviews          = unitv_opt( 'unitv_reviews' );
if ( ! is_array( $reviews ) ) {
	$reviews = $defaults['unitv_reviews'];
}
$reviews = array_filter( $reviews, function( $r ) { return ! empty( $r['active'] ) && $r['active'] === '1'; } );

// Footer
$footer_brand     = unitv_opt( 'unitv_footer_brand' );
$footer_subtitle  = unitv_opt( 'unitv_footer_subtitle' );
$footer_phone     = unitv_opt( 'unitv_footer_phone' );
$footer_show_buy  = (bool) unitv_opt( 'unitv_footer_show_buy' );
$footer_show_wa   = (bool) unitv_opt( 'unitv_footer_show_wa' );
$footer_copyright = unitv_opt( 'unitv_footer_copyright' );
$footer_links     = unitv_opt( 'unitv_footer_links' );
if ( ! is_array( $footer_links ) ) {
	$footer_links = array();
}

// Helper: render stars (5 filled icons always)
function unitv_plan_stars() {
	$html = '';
	for ( $i = 0; $i < 5; $i++ ) {
		$html .= '<i class="bi bi-star-fill"></i>';
	}
	return $html;
}

// Delay classes for animation
$delays = array( 'delay-1', 'delay-2', 'delay-3', 'delay-4', 'delay-5', 'delay-6' );
?>
<div class="unitv-wrap">

  <!-- HEADER -->
  <header class="unitv-header">
    <div class="container">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-name"><?php echo esc_html( $brand_name ); ?></a>
      <div class="header-actions">
        <a href="<?php echo esc_attr( $hero_cta_link ); ?>" class="btn btn-primary">Comprar</a>
        <?php if ( $show_wa_hdr ) : ?>
        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="header-wa" aria-label="WhatsApp">
          <i class="bi bi-whatsapp"></i>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <span class="badge badge-brand fade-up"><i class="bi bi-lightning-charge-fill"></i> <?php echo esc_html( $hero_badge ); ?></span>
      <h1 class="hero-title fade-up delay-1">
        <?php echo esc_html( $hero_title ); ?> <span class="gradient-text"><?php echo esc_html( $hero_grad ); ?></span>
      </h1>
      <p class="hero-desc fade-up delay-2"><?php echo esc_html( $hero_desc ); ?></p>
      <div class="hero-cta fade-up delay-2">
        <a href="<?php echo esc_attr( $hero_cta_link ); ?>" class="btn btn-primary"><i class="bi bi-bag-heart-fill"></i> <?php echo esc_html( $hero_cta_text ); ?></a>
      </div>
      <p class="hero-stat fade-up delay-3">
        <span class="dot"></span>
        <strong><?php echo esc_html( $hero_stat_num ); ?></strong>&nbsp;<?php echo esc_html( $hero_stat_lbl ); ?>
      </p>
      <div class="trust-row fade-up delay-3">
        <?php foreach ( $hero_trust as $item ) : ?>
        <span class="trust-item"><i class="bi <?php echo esc_attr( $item['icon'] ); ?>"></i> <?php echo esc_html( $item['text'] ); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- RECARGAS -->
  <section class="recargas-section" id="recargas">
    <div class="container">
      <div class="section-header">
        <h2><?php echo esc_html( $plans_title ); ?></h2>
        <p><?php echo esc_html( $plans_subtitle ); ?></p>
      </div>

      <div class="plans-grid">
        <?php $pi = 0; foreach ( $plans as $plan ) :
          $is_featured = ! empty( $plan['featured'] ) && $plan['featured'] === '1';
          $delay       = $delays[ $pi % count( $delays ) ];
          $pi++;
        ?>
        <div class="plan-card <?php echo $is_featured ? 'featured' : ''; ?> fade-up <?php echo esc_attr( $delay ); ?>">
          <div class="plan-img-wrap">
            <img src="<?php echo esc_url( $plan['img'] ); ?>" alt="<?php echo esc_attr( $plan['name'] ); ?>" loading="lazy">
          </div>
          <div class="plan-body">
            <div class="plan-rating">
              <?php echo wp_kses( unitv_plan_stars(), array( 'i' => array( 'class' => array() ) ) ); ?>
              <span><?php echo esc_html( $plan['rating'] ); ?> (<?php echo esc_html( $plan['reviews'] ); ?>)</span>
            </div>
            <p class="plan-name"><?php echo esc_html( $plan['name'] ); ?></p>
            <div class="plan-price-old">
              <?php echo esc_html( $plan['price_old'] ); ?> <span class="plan-discount"><?php echo esc_html( $plan['discount'] ); ?></span>
            </div>
            <div class="plan-price"><small>R$</small><?php echo esc_html( $plan['price'] ); ?></div>
            <a href="<?php echo esc_url( $plan['url'] ); ?>" class="plan-btn <?php echo $is_featured ? 'plan-btn-primary' : 'plan-btn-outline'; ?>" target="_blank" rel="noopener noreferrer">
              <i class="bi <?php echo $is_featured ? 'bi-bag-heart-fill' : 'bi-bag-fill'; ?>"></i> Comprar Agora
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="features-section">
    <div class="container">
      <div class="section-header">
        <h2><?php echo esc_html( $features_title ); ?></h2>
        <p><?php echo esc_html( $features_subtitle ); ?></p>
      </div>
      <div class="features-grid">
        <?php $fi = 0; foreach ( $features as $feat ) :
          $delay = $delays[ $fi % count( $delays ) ];
          $fi++;
        ?>
        <div class="feature-card fade-up <?php echo esc_attr( $delay ); ?>">
          <span class="feature-icon"><?php echo esc_html( $feat['icon'] ); ?></span>
          <h3><?php echo esc_html( $feat['title'] ); ?></h3>
          <p><?php echo esc_html( $feat['desc'] ); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- DOWNLOADS -->
  <section class="downloads-section">
    <div class="container">
      <div class="section-header">
        <h2><?php echo esc_html( $downloads_title ); ?></h2>
        <p><?php echo esc_html( $downloads_subtitle ); ?></p>
      </div>
      <div class="downloads-grid">
        <?php $di = 0; foreach ( $downloads as $dl ) :
          $delay = $delays[ $di % count( $delays ) ];
          $di++;
        ?>
        <div class="download-card fade-up <?php echo esc_attr( $delay ); ?>">
          <img src="<?php echo esc_url( $dl['img'] ); ?>" alt="UniTV para <?php echo esc_attr( $dl['name'] ); ?>" loading="lazy">
          <h3><?php echo esc_html( $dl['name'] ); ?></h3>
          <a href="<?php echo esc_url( $dl['url'] ); ?>" class="btn btn-primary" download>
            <i class="bi bi-download"></i> Baixar APK
          </a>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- REVIEWS -->
  <section class="reviews-section">
    <div class="container">
      <div class="section-header">
        <h2><?php echo esc_html( $reviews_title ); ?></h2>
        <p><?php echo esc_html( $reviews_subtitle ); ?></p>
      </div>
      <div class="reviews-grid">
        <?php $ri = 0; foreach ( $reviews as $rev ) :
          $delay = $delays[ $ri % count( $delays ) ];
          $stars = max( 1, min( 5, (int) ( $rev['stars'] ?? 5 ) ) );
          $ri++;
        ?>
        <div class="review-card fade-up <?php echo esc_attr( $delay ); ?>">
          <div class="review-stars"><?php echo esc_html( str_repeat( '★', $stars ) ); ?></div>
          <p class="review-text"><?php echo esc_html( $rev['text'] ); ?></p>
          <div class="review-author">
            <img src="<?php echo esc_url( $rev['avatar'] ); ?>" alt="<?php echo esc_attr( $rev['name'] ); ?>" loading="lazy">
            <span class="review-author-name"><?php echo esc_html( $rev['name'] ); ?></span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="unitv-footer">
    <div class="container">
      <div class="footer-inner">
        <div>
          <div class="footer-brand-label"><?php echo esc_html( $footer_brand ); ?></div>
          <div class="footer-sub"><?php echo esc_html( $footer_subtitle ); ?></div>
        </div>
        <?php if ( $footer_phone ) : ?>
        <p class="footer-phone"><i class="bi bi-telephone-fill"></i> <?php echo esc_html( $footer_phone ); ?></p>
        <?php endif; ?>
        <div class="footer-actions">
          <?php if ( $footer_show_buy ) : ?>
          <a href="<?php echo esc_attr( $hero_cta_link ); ?>" class="btn btn-primary"><i class="bi bi-bag-heart-fill"></i> Comprar Recarga</a>
          <?php endif; ?>
          <?php if ( $footer_show_wa ) : ?>
          <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
            <i class="bi bi-whatsapp"></i> WhatsApp
          </a>
          <?php endif; ?>
        </div>
        <nav class="footer-links">
          <a href="<?php echo esc_url( $url_privacidade ); ?>">Política de Privacidade</a>
          <a href="<?php echo esc_url( $url_termos ); ?>">Termos de Uso</a>
          <a href="<?php echo esc_url( $url_reembolso ); ?>">Política de Reembolso</a>
          <a href="<?php echo esc_url( $url_cookies ); ?>">Política de Cookies</a>
          <?php foreach ( $footer_links as $fl ) : if ( empty( $fl['label'] ) ) continue; ?>
          <a href="<?php echo esc_url( $fl['url'] ); ?>"><?php echo esc_html( $fl['label'] ); ?></a>
          <?php endforeach; ?>
        </nav>
        <p class="footer-copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $footer_copyright ); ?></p>
      </div>
    </div>
  </footer>

  <!-- FAB WhatsApp -->
  <?php if ( $show_fab ) : ?>
  <a href="<?php echo esc_url( $wa_url ); ?>" class="fab-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Falar no WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>
  <?php endif; ?>

</div><!-- .unitv-wrap -->
