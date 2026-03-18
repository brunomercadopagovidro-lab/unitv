<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
// unitv_opt() is always available via helpers.php (loaded in unitv-recargas.php)
$brand_name   = unitv_opt( 'unitv_brand_name' );
$wa_number    = unitv_opt( 'unitv_whatsapp_number' );
$wa_msg       = unitv_opt( 'unitv_whatsapp_message' );
$wa_url       = 'https://wa.me/' . rawurlencode( $wa_number ) . ( $wa_msg ? '?text=' . rawurlencode( $wa_msg ) : '' );
$show_fab     = (bool) unitv_opt( 'unitv_whatsapp_fab' );
$show_wa_hdr  = (bool) unitv_opt( 'unitv_whatsapp_header' );
$footer_brand = unitv_opt( 'unitv_footer_brand' );
$footer_sub   = unitv_opt( 'unitv_footer_subtitle' );
$footer_phone = unitv_opt( 'unitv_footer_phone' );
$footer_copy  = unitv_opt( 'unitv_footer_copyright' );

$slugs           = get_option( 'unitv_pages_slugs', array() );
$url_privacidade = ! empty( $slugs['privacidade'] ) ? home_url( '/' . $slugs['privacidade'] . '/' ) : '#';
$url_termos      = ! empty( $slugs['termos'] )      ? home_url( '/' . $slugs['termos']      . '/' ) : '#';
$url_reembolso   = ! empty( $slugs['reembolso'] )   ? home_url( '/' . $slugs['reembolso']   . '/' ) : '#';
$url_cookies     = ! empty( $slugs['cookies'] )     ? home_url( '/' . $slugs['cookies']     . '/' ) : '#';

$policy_title   = unitv_opt( 'unitv_policy_cookies_title' );
$policy_content = unitv_opt( 'unitv_policy_cookies_content' );
?>
<div class="unitv-wrap">

  <header class="unitv-header">
    <div class="container">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-name"><?php echo esc_html( $brand_name ); ?></a>
      <div class="header-actions">
        <a href="<?php echo esc_url( home_url( '/recargas-vip/#recargas' ) ); ?>" class="btn btn-primary">Comprar</a>
        <?php if ( $show_wa_hdr ) : ?>
        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="header-wa" aria-label="WhatsApp">
          <i class="bi bi-whatsapp"></i>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <section class="policy-section">
    <div class="container">
      <h1><?php echo esc_html( $policy_title ); ?></h1>

      <?php if ( ! empty( $policy_content ) ) : ?>
        <?php echo wp_kses_post( $policy_content ); ?>
      <?php else : ?>
      <p>Esta Política de Cookies explica o que são cookies, quais tipos utilizamos em <strong>controleunitv.shop</strong> e como você pode gerenciá-los. Estamos em conformidade com a Lei Geral de Proteção de Dados (LGPD — Lei nº 13.709/2018).</p>
      <p><em>Última atualização: <?php echo esc_html( date( 'd/m/Y' ) ); ?></em></p>

      <h2>1. O que são Cookies?</h2>
      <p>Cookies são pequenos arquivos de texto armazenados no seu dispositivo (computador, tablet ou smartphone) quando você visita um site. Eles permitem que o site reconheça seu dispositivo e lembre de informações sobre sua visita, como preferências de idioma e configurações.</p>

      <h2>2. Tipos de Cookies que Utilizamos</h2>

      <h2>2.1 Cookies Estritamente Necessários</h2>
      <p>Esses cookies são indispensáveis para o funcionamento do site. Sem eles, serviços como carrinho de compras e autenticação não funcionarão. Não é possível desativá-los.</p>
      <ul>
        <li><code>wordpress_logged_in_*</code> — identifica sessão de usuário logado no WordPress;</li>
        <li><code>wordpress_sec_*</code> — segurança de sessão WordPress.</li>
      </ul>

      <h2>2.2 Cookies Funcionais</h2>
      <p>Permitem que o site lembre de escolhas feitas (como idioma ou região) para oferecer recursos aprimorados e personalizados. São opcionais.</p>

      <h2>2.3 Cookies Analíticos</h2>
      <p>Usados para coletar informações sobre como os visitantes usam o site, de forma anonimizada. Esses dados nos ajudam a melhorar o desempenho e a experiência do usuário.</p>
      <ul>
        <li><code>_ga</code>, <code>_gid</code> — Google Analytics (expiração: 2 anos e 24 horas respectivamente);</li>
        <li><code>_gat</code> — limita taxa de requisições ao Google Analytics.</li>
      </ul>

      <h2>3. Cookies de Terceiros</h2>
      <p>Algumas funcionalidades do nosso site utilizam serviços de terceiros que podem definir seus próprios cookies:</p>
      <ul>
        <li><strong>Google Analytics</strong> — análise de tráfego e comportamento de navegação;</li>
        <li><strong>Google Fonts</strong> — carregamento de fontes web;</li>
        <li><strong>Bootstrap Icons CDN</strong> — ícones via CDN.</li>
      </ul>
      <p>Não temos controle sobre os cookies definidos por terceiros. Consulte as políticas de privacidade de cada serviço para mais informações.</p>

      <h2>4. Como Gerenciar Cookies</h2>
      <p>Você pode controlar e/ou excluir cookies de acordo com sua preferência. A maioria dos navegadores permite recusar todos ou apenas alguns cookies. Veja como fazê-lo nos principais navegadores:</p>
      <ul>
        <li><strong>Google Chrome:</strong> Configurações → Privacidade e segurança → Cookies;</li>
        <li><strong>Mozilla Firefox:</strong> Opções → Privacidade e Segurança → Cookies;</li>
        <li><strong>Microsoft Edge:</strong> Configurações → Privacidade, pesquisa e serviços → Cookies;</li>
        <li><strong>Safari:</strong> Preferências → Privacidade → Cookies.</li>
      </ul>
      <p>Observe que a desativação de cookies pode afetar a funcionalidade do site.</p>

      <h2>5. Consentimento</h2>
      <p>Ao continuar navegando em nosso site, você concorda com o uso de cookies conforme descrito nesta política. Você pode retirar seu consentimento a qualquer momento, ajustando as configurações do seu navegador.</p>

      <h2>6. Alterações nesta Política</h2>
      <p>Podemos atualizar esta Política de Cookies periodicamente. Qualquer alteração será publicada nesta página com a data de atualização. Recomendamos que você revise esta política regularmente.</p>

      <h2>7. Contato</h2>
      <p>Dúvidas sobre nossa Política de Cookies? Entre em contato:</p>
      <ul>
        <li><strong>WhatsApp:</strong> <a href="<?php echo esc_url( $wa_url ); ?>"><?php echo esc_html( $wa_number ); ?></a></li>
        <li><strong>Site:</strong> <a href="https://controleunitv.shop" target="_blank" rel="noopener noreferrer">controleunitv.shop</a></li>
      </ul>
      <?php endif; ?>
    </div>
  </section>

  <footer class="unitv-footer">
    <div class="container">
      <div class="footer-inner">
        <div>
          <div class="footer-brand-label"><?php echo esc_html( $footer_brand ); ?></div>
          <div class="footer-sub"><?php echo esc_html( $footer_sub ); ?></div>
        </div>
        <?php if ( $footer_phone ) : ?>
        <p class="footer-phone"><i class="bi bi-telephone-fill"></i> <?php echo esc_html( $footer_phone ); ?></p>
        <?php endif; ?>
        <div class="footer-actions">
          <a href="<?php echo esc_url( home_url( '/recargas-vip/#recargas' ) ); ?>" class="btn btn-primary"><i class="bi bi-bag-heart-fill"></i> Comprar Recarga</a>
          <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
            <i class="bi bi-whatsapp"></i> WhatsApp
          </a>
        </div>
        <nav class="footer-links">
          <a href="<?php echo esc_url( $url_privacidade ); ?>">Política de Privacidade</a>
          <a href="<?php echo esc_url( $url_termos ); ?>">Termos de Uso</a>
          <a href="<?php echo esc_url( $url_reembolso ); ?>">Política de Reembolso</a>
          <a href="<?php echo esc_url( $url_cookies ); ?>">Política de Cookies</a>
        </nav>
        <p class="footer-copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $footer_copy ); ?></p>
      </div>
    </div>
  </footer>

  <?php if ( $show_fab ) : ?>
  <a href="<?php echo esc_url( $wa_url ); ?>" class="fab-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Falar no WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>
  <?php endif; ?>

</div><!-- .unitv-wrap -->
