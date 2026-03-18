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

$policy_title   = unitv_opt( 'unitv_policy_privacy_title' );
$policy_content = unitv_opt( 'unitv_policy_privacy_content' );
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
      <p>A UniTV (<strong>controleunitv.shop</strong>) se compromete a proteger a privacidade de seus usuários. Esta Política de Privacidade descreve como coletamos, usamos e protegemos suas informações pessoais em conformidade com a Lei Geral de Proteção de Dados (LGPD — Lei nº 13.709/2018).</p>
      <p><em>Última atualização: <?php echo esc_html( date( 'd/m/Y' ) ); ?></em></p>

      <h2>1. Informações que Coletamos</h2>
      <p>Podemos coletar as seguintes categorias de dados pessoais:</p>
      <ul>
        <li><strong>Dados pessoais:</strong> nome completo, endereço de e-mail e número de telefone/WhatsApp fornecidos durante a compra.</li>
        <li><strong>Dados de pagamento:</strong> informações necessárias para processamento do PIX (chave PIX, CNPJ/CPF). Não armazenamos dados de cartão de crédito.</li>
        <li><strong>Dados de navegação:</strong> endereço IP, tipo de navegador, páginas visitadas e tempo de permanência, coletados por ferramentas de análise como Google Analytics.</li>
        <li><strong>Cookies:</strong> conforme descrito em nossa Política de Cookies.</li>
      </ul>

      <h2>2. Como Usamos as Informações</h2>
      <p>Utilizamos seus dados para:</p>
      <ul>
        <li>Processar e confirmar pedidos de recarga digital;</li>
        <li>Enviar o código de ativação por e-mail e WhatsApp;</li>
        <li>Prestar suporte ao cliente;</li>
        <li>Cumprir obrigações legais e fiscais;</li>
        <li>Melhorar nossos serviços e experiência do usuário;</li>
        <li>Enviar comunicações sobre promoções, desde que o usuário tenha consentido.</li>
      </ul>

      <h2>3. Compartilhamento de Dados</h2>
      <p>Não vendemos nem alugamos seus dados pessoais. Podemos compartilhar informações com:</p>
      <ul>
        <li><strong>Processadores de pagamento:</strong> para finalizar transações via PIX;</li>
        <li><strong>Ferramentas de análise:</strong> Google Analytics, em forma anonimizada;</li>
        <li><strong>Autoridades competentes:</strong> quando exigido por lei ou ordem judicial.</li>
      </ul>

      <h2>4. Segurança dos Dados</h2>
      <p>Adotamos medidas técnicas e organizacionais para proteger seus dados contra acesso não autorizado, alteração, divulgação ou destruição, incluindo criptografia SSL, controle de acesso restrito e monitoramento de sistemas.</p>

      <h2>5. Cookies</h2>
      <p>Utilizamos cookies para melhorar sua experiência. Consulte nossa <a href="<?php echo esc_url( $url_cookies ); ?>">Política de Cookies</a> para mais detalhes.</p>

      <h2>6. Seus Direitos (LGPD)</h2>
      <p>Nos termos da LGPD, você tem os seguintes direitos:</p>
      <ul>
        <li>Confirmação da existência de tratamento de dados;</li>
        <li>Acesso aos seus dados pessoais;</li>
        <li>Correção de dados incompletos ou desatualizados;</li>
        <li>Anonimização, bloqueio ou eliminação de dados desnecessários;</li>
        <li>Portabilidade dos dados;</li>
        <li>Revogação do consentimento a qualquer momento;</li>
        <li>Oposição ao tratamento de dados.</li>
      </ul>
      <p>Para exercer qualquer um desses direitos, entre em contato conosco.</p>

      <h2>7. Retenção de Dados</h2>
      <p>Mantemos seus dados pelo período necessário para cumprir as finalidades para as quais foram coletados ou por obrigação legal. Após esse período, os dados são excluídos de forma segura.</p>

      <h2>8. Menores de Idade</h2>
      <p>Nossos serviços são destinados a maiores de 18 anos. Não coletamos conscientemente dados pessoais de menores de idade.</p>

      <h2>9. Alterações nesta Política</h2>
      <p>Reservamo-nos o direito de atualizar esta Política a qualquer momento. A versão mais recente estará sempre disponível nesta página com a data de atualização.</p>

      <h2>10. Contato</h2>
      <p>Para dúvidas, solicitações ou exercício de direitos relacionados à privacidade, entre em contato:</p>
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
