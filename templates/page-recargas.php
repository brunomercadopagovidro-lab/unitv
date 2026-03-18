<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
// Build policy page URLs
$slugs       = get_option( 'unitv_pages_slugs', array() );
$url_privacidade = ! empty( $slugs['privacidade'] ) ? home_url( '/' . $slugs['privacidade'] . '/' ) : '#';
$url_termos      = ! empty( $slugs['termos'] )      ? home_url( '/' . $slugs['termos']      . '/' ) : '#';
$url_reembolso   = ! empty( $slugs['reembolso'] )   ? home_url( '/' . $slugs['reembolso']   . '/' ) : '#';
$url_cookies     = ! empty( $slugs['cookies'] )     ? home_url( '/' . $slugs['cookies']     . '/' ) : '#';
?>
<div class="unitv-wrap">

  <!-- HEADER -->
  <header class="unitv-header">
    <div class="container">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-name">UniTV</a>
      <div class="header-actions">
        <a href="#recargas" class="btn btn-primary">Comprar</a>
        <a href="https://wa.me/5541984613998" target="_blank" rel="noopener noreferrer" class="header-wa" aria-label="WhatsApp">
          <i class="bi bi-whatsapp"></i>
        </a>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <span class="badge badge-brand fade-up"><i class="bi bi-lightning-charge-fill"></i> Envio Imediato — 24 Horas</span>
      <h1 class="hero-title fade-up delay-1">
        Recargas <span class="gradient-text">UniTV</span>
      </h1>
      <p class="hero-desc fade-up delay-2">
        Planos de 30, 60, 90 e 365 dias com pagamento via PIX. Receba seu código de ativação de forma imediata por e-mail e WhatsApp após a confirmação do pagamento.
      </p>
      <div class="hero-cta fade-up delay-2">
        <a href="#recargas" class="btn btn-primary"><i class="bi bi-bag-heart-fill"></i> Comprar Recarga</a>
      </div>
      <p class="hero-stat fade-up delay-3">
        <span class="dot"></span>
        <strong>30.770+</strong>&nbsp;Recargas Realizadas
      </p>
      <div class="trust-row fade-up delay-3">
        <span class="trust-item"><i class="bi bi-shield-lock-fill"></i> Pagamento Seguro</span>
        <span class="trust-item"><i class="bi bi-send-fill"></i> Envio Imediato</span>
        <span class="trust-item"><i class="bi bi-headset"></i> Suporte 24h</span>
      </div>
    </div>
  </section>

  <!-- RECARGAS -->
  <section class="recargas-section" id="recargas">
    <div class="container">
      <div class="section-header">
        <h2>Escolha o seu Plano</h2>
        <p>Sem taxas ocultas. Ativação imediata via WhatsApp e e-mail.</p>
      </div>

      <div class="plans-grid">

        <!-- Card Mensal -->
        <div class="plan-card fade-up delay-1">
          <div class="plan-img-wrap">
            <img src="https://controleunitv.shop/wp-content/uploads/2026/03/card.30.png" alt="UNITV Recarga Mensal" loading="lazy">
          </div>
          <div class="plan-body">
            <div class="plan-rating">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              <span>4.99 (12.196)</span>
            </div>
            <p class="plan-name">UNITV Recarga Mensal</p>
            <div class="plan-price-old">
              R$ 50,00 <span class="plan-discount">-50%</span>
            </div>
            <div class="plan-price"><small>R$</small>24,90</div>
            <a href="https://loja.controleunitv.shop/checkout?plano=mensal" class="plan-btn plan-btn-outline" target="_blank" rel="noopener noreferrer">
              <i class="bi bi-bag-fill"></i> Comprar Agora
            </a>
          </div>
        </div>

        <!-- Card Trimestral (FEATURED) -->
        <div class="plan-card featured fade-up delay-2">
          <div class="plan-img-wrap">
            <img src="https://controleunitv.shop/wp-content/uploads/2026/03/card-90-1.png" alt="UNITV Recarga Trimestral" loading="lazy">
          </div>
          <div class="plan-body">
            <div class="plan-rating">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              <span>4.99 (12.196)</span>
            </div>
            <p class="plan-name">UNITV Recarga Trimestral</p>
            <div class="plan-price-old">
              R$ 150,00 <span class="plan-discount">-53%</span>
            </div>
            <div class="plan-price"><small>R$</small>69,90</div>
            <a href="https://loja.controleunitv.shop/checkout?plano=trimestral" class="plan-btn plan-btn-primary" target="_blank" rel="noopener noreferrer">
              <i class="bi bi-bag-heart-fill"></i> Comprar Agora
            </a>
          </div>
        </div>

        <!-- Card Anual -->
        <div class="plan-card fade-up delay-3">
          <div class="plan-img-wrap">
            <img src="https://controleunitv.shop/wp-content/uploads/2026/03/card-365-1.png" alt="UNITV Recarga Anual" loading="lazy">
          </div>
          <div class="plan-body">
            <div class="plan-rating">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              <span>4.99 (12.196)</span>
            </div>
            <p class="plan-name">UNITV Recarga Anual</p>
            <div class="plan-price-old">
              R$ 400,00 <span class="plan-discount">-57%</span>
            </div>
            <div class="plan-price"><small>R$</small>169,90</div>
            <a href="https://loja.controleunitv.shop/checkout?plano=anual" class="plan-btn plan-btn-outline" target="_blank" rel="noopener noreferrer">
              <i class="bi bi-bag-fill"></i> Comprar Agora
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="features-section">
    <div class="container">
      <div class="section-header">
        <h2>Por que escolher a UniTV?</h2>
        <p>Qualidade e praticidade em um único serviço.</p>
      </div>
      <div class="features-grid">
        <div class="feature-card fade-up delay-1">
          <span class="feature-icon">🖥️</span>
          <h3>+500 Canais</h3>
          <p>Desfrute de uma incrível variedade de entretenimento com mais de 500 canais disponíveis.</p>
        </div>
        <div class="feature-card fade-up delay-2">
          <span class="feature-icon">▶️</span>
          <h3>+5 Mil Filmes e Séries</h3>
          <p>Biblioteca impressionante com mais de 5 mil filmes e séries à sua disposição.</p>
        </div>
        <div class="feature-card fade-up delay-3">
          <span class="feature-icon">💬</span>
          <h3>Envio Imediato</h3>
          <p>Envio imediato do código via e-mail e WhatsApp após a confirmação do pagamento.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- DOWNLOADS -->
  <section class="downloads-section">
    <div class="container">
      <div class="section-header">
        <h2>Disponível em Todos os Dispositivos</h2>
        <p>Baixe o aplicativo para o seu dispositivo e aproveite em qualquer lugar.</p>
      </div>
      <div class="downloads-grid">
        <div class="download-card fade-up delay-1">
          <img src="https://controleunitv.shop/wp-content/uploads/2026/03/nokia_C5_endi-angled-blue.png" alt="UniTV para Celular" loading="lazy">
          <h3>Celular</h3>
          <a href="https://www.unitvbrasil.app/unitv-celular.apk" class="btn btn-primary" download>
            <i class="bi bi-download"></i> Baixar APK
          </a>
        </div>
        <div class="download-card fade-up delay-2">
          <img src="https://controleunitv.shop/wp-content/uploads/2026/03/stick_br-300x300-1.png" alt="UniTV para Fire Stick" loading="lazy">
          <h3>Fire Stick</h3>
          <a href="https://www.unitvbrasil.app/unitv-tv.apk" class="btn btn-primary" download>
            <i class="bi bi-download"></i> Baixar APK
          </a>
        </div>
        <div class="download-card fade-up delay-3">
          <img src="https://controleunitv.shop/wp-content/uploads/2026/03/box_br-300x300-1.png" alt="UniTV para TV Box" loading="lazy">
          <h3>TV Box</h3>
          <a href="https://www.unitvbrasil.app/unitv-tv.apk" class="btn btn-primary" download>
            <i class="bi bi-download"></i> Baixar APK
          </a>
        </div>
        <div class="download-card fade-up delay-4">
          <img src="https://controleunitv.shop/wp-content/uploads/2026/03/tv_br-300x300-1.png" alt="UniTV para Smart TV" loading="lazy">
          <h3>Smart TV</h3>
          <a href="https://www.unitvbrasil.app/unitv-tv.apk" class="btn btn-primary" download>
            <i class="bi bi-download"></i> Baixar APK
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- REVIEWS -->
  <section class="reviews-section">
    <div class="container">
      <div class="section-header">
        <h2>O que nossos clientes dizem</h2>
        <p>Mais de 30 mil recargas realizadas e clientes satisfeitos.</p>
      </div>
      <div class="reviews-grid">
        <div class="review-card fade-up delay-1">
          <div class="review-stars">★★★★★</div>
          <p class="review-text">"Experiência incrível! Atendimento ágil e eficiente. Recomendo!"</p>
          <div class="review-author">
            <img src="https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-3.jpg" alt="Jonas Jose" loading="lazy">
            <span class="review-author-name">Jonas Jose</span>
          </div>
        </div>
        <div class="review-card fade-up delay-2">
          <div class="review-stars">★★★★★</div>
          <p class="review-text">"Compra rápida, sem enrolação. Ótimo atendimento!"</p>
          <div class="review-author">
            <img src="https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-4.jpg" alt="Ygor Brito" loading="lazy">
            <span class="review-author-name">Ygor Brito</span>
          </div>
        </div>
        <div class="review-card fade-up delay-3">
          <div class="review-stars">★★★★★</div>
          <p class="review-text">"Recebi no e-mail/WhatsApp em minutos. Muito prático."</p>
          <div class="review-author">
            <img src="https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-5.jpg" alt="Selma Novacek" loading="lazy">
            <span class="review-author-name">Selma Novacek</span>
          </div>
        </div>
        <div class="review-card fade-up delay-4">
          <div class="review-stars">★★★★★</div>
          <p class="review-text">"Serviço confiável, preço justo e suporte excelente."</p>
          <div class="review-author">
            <img src="https://controleunitv.shop/wp-content/uploads/2026/03/unnamed-6.jpg" alt="Eziel José Tiano" loading="lazy">
            <span class="review-author-name">Eziel José Tiano</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="unitv-footer">
    <div class="container">
      <div class="footer-inner">
        <div>
          <div class="footer-brand-label">UniTV</div>
          <div class="footer-sub">Recargas Digitais — Venda de cartões de recarga digitais</div>
        </div>
        <p class="footer-phone"><i class="bi bi-telephone-fill"></i> (41) 98461‑3998</p>
        <div class="footer-actions">
          <a href="#recargas" class="btn btn-primary"><i class="bi bi-bag-heart-fill"></i> Comprar Recarga</a>
          <a href="https://wa.me/5541984613998" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
            <i class="bi bi-whatsapp"></i> WhatsApp
          </a>
        </div>
        <nav class="footer-links">
          <a href="<?php echo esc_url( $url_privacidade ); ?>">Política de Privacidade</a>
          <a href="<?php echo esc_url( $url_termos ); ?>">Termos de Uso</a>
          <a href="<?php echo esc_url( $url_reembolso ); ?>">Política de Reembolso</a>
          <a href="<?php echo esc_url( $url_cookies ); ?>">Política de Cookies</a>
        </nav>
        <p class="footer-copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> UniTV. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- FAB WhatsApp -->
  <a href="https://wa.me/5541984613998" class="fab-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Falar no WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

</div><!-- .unitv-wrap -->
