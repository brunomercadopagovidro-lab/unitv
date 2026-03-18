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

$policy_title   = unitv_opt( 'unitv_policy_termos_title' );
$policy_content = unitv_opt( 'unitv_policy_termos_content' );
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
      <p>Ao acessar e utilizar o site <strong>controleunitv.shop</strong> e seus serviços, você concorda com os presentes Termos de Uso. Caso não concorde com alguma disposição, não utilize nosso site ou serviços.</p>
      <p><em>Última atualização: <?php echo esc_html( date( 'd/m/Y' ) ); ?></em></p>

      <h2>1. Aceitação dos Termos</h2>
      <p>O uso deste site e dos serviços da UniTV implica na leitura e aceitação integral destes Termos de Uso. Reservamo-nos o direito de atualizar estes termos a qualquer momento, sendo sua responsabilidade verificá-los periodicamente.</p>

      <h2>2. Descrição do Serviço</h2>
      <p>A UniTV comercializa recargas digitais de ativação para o aplicativo UniTV, nos planos Mensal (30 dias), Trimestral (90 dias) e Anual (365 dias). Trata-se de um produto exclusivamente digital, entregue por e-mail e WhatsApp.</p>

      <h2>3. Preços e Pagamento</h2>
      <ul>
        <li>Todos os preços são expressos em Reais (BRL) e incluem impostos aplicáveis.</li>
        <li>O pagamento é realizado exclusivamente via <strong>PIX</strong>.</li>
        <li>A confirmação do pedido ocorre após a identificação do pagamento, geralmente em instantes.</li>
        <li>A UniTV reserva-se o direito de alterar preços a qualquer momento, sem aviso prévio, porém sem afetar pedidos já confirmados.</li>
      </ul>

      <h2>4. Entrega Digital</h2>
      <p>Após a confirmação do pagamento, o código de ativação é enviado de forma imediata por e-mail e/ou WhatsApp informados no ato da compra. O prazo máximo de entrega é de 24 horas em casos excepcionais.</p>

      <h2>5. Responsabilidades do Usuário</h2>
      <ul>
        <li>Fornecer informações verídicas e atualizadas no momento da compra;</li>
        <li>Não compartilhar, revender ou usar o código de ativação para fins ilícitos;</li>
        <li>Utilizar o serviço de acordo com a legislação brasileira vigente;</li>
        <li>Não tentar reverter, descompilar ou modificar o aplicativo UniTV.</li>
      </ul>

      <h2>6. Propriedade Intelectual</h2>
      <p>Todo o conteúdo disponível no site (logotipos, textos, imagens, layout) é de propriedade exclusiva da UniTV ou de seus licenciadores e é protegido pelas leis de propriedade intelectual. É proibida a reprodução sem autorização expressa.</p>

      <h2>7. Limitação de Responsabilidade</h2>
      <p>A UniTV não se responsabiliza por:</p>
      <ul>
        <li>Danos causados pelo uso indevido do código de ativação pelo usuário;</li>
        <li>Interrupções no serviço decorrentes de manutenção ou força maior;</li>
        <li>Problemas de compatibilidade do aplicativo com dispositivos específicos do usuário.</li>
      </ul>

      <h2>8. Cancelamento e Reembolso</h2>
      <p>Consulte nossa <a href="<?php echo esc_url( $url_reembolso ); ?>">Política de Reembolso</a> para informações sobre cancelamentos e devoluções.</p>

      <h2>9. Privacidade</h2>
      <p>O tratamento de dados pessoais é regido por nossa <a href="<?php echo esc_url( $url_privacidade ); ?>">Política de Privacidade</a>.</p>

      <h2>10. Alterações nos Termos</h2>
      <p>Estes Termos podem ser alterados a qualquer momento. A versão atualizada será publicada nesta página com nova data. O uso continuado do site após as alterações implica na aceitação dos novos termos.</p>

      <h2>11. Legislação Aplicável</h2>
      <p>Estes Termos de Uso são regidos pelas leis da República Federativa do Brasil. Para resolução de conflitos, fica eleito o foro da comarca de Curitiba/PR, com renúncia de qualquer outro, por mais privilegiado que seja.</p>

      <h2>12. Contato</h2>
      <ul>
        <li><strong>Site:</strong> <a href="https://controleunitv.shop" target="_blank" rel="noopener noreferrer">controleunitv.shop</a></li>
        <li><strong>WhatsApp:</strong> <a href="<?php echo esc_url( $wa_url ); ?>"><?php echo esc_html( $wa_number ); ?></a></li>
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
