<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
$slugs       = get_option( 'unitv_pages_slugs', array() );
$url_privacidade = ! empty( $slugs['privacidade'] ) ? home_url( '/' . $slugs['privacidade'] . '/' ) : '#';
$url_termos      = ! empty( $slugs['termos'] )      ? home_url( '/' . $slugs['termos']      . '/' ) : '#';
$url_reembolso   = ! empty( $slugs['reembolso'] )   ? home_url( '/' . $slugs['reembolso']   . '/' ) : '#';
$url_cookies     = ! empty( $slugs['cookies'] )     ? home_url( '/' . $slugs['cookies']     . '/' ) : '#';
?>
<div class="unitv-wrap">

  <header class="unitv-header">
    <div class="container">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-name">UniTV</a>
      <div class="header-actions">
        <a href="<?php echo esc_url( home_url( '/recargas-vip/' ) ); ?>#recargas" class="btn btn-primary">Comprar</a>
        <a href="https://wa.me/5541984613998" target="_blank" rel="noopener noreferrer" class="header-wa" aria-label="WhatsApp">
          <i class="bi bi-whatsapp"></i>
        </a>
      </div>
    </div>
  </header>

  <section class="policy-section">
    <div class="container">
      <h1>Política de Reembolso</h1>

      <p>Na UniTV, nos comprometemos com a satisfação do nosso cliente. Esta Política de Reembolso estabelece as condições para solicitação de devolução de valores pagos por recargas digitais.</p>
      <p><em>Última atualização: <?php echo esc_html( date( 'd/m/Y' ) ); ?></em></p>

      <h2>1. Natureza do Produto Digital</h2>
      <p>As recargas UniTV são produtos exclusivamente digitais. Após o envio do código de ativação, o produto é considerado entregue e utilizado. Em conformidade com o Art. 49 do Código de Defesa do Consumidor (CDC), o direito de arrependimento de 7 dias <strong>não se aplica</strong> a conteúdos digitais já disponibilizados ao consumidor com seu consentimento prévio expresso, conforme parágrafo único do mesmo artigo.</p>

      <h2>2. Condições para Reembolso</h2>
      <p>Analisaremos o pedido de reembolso nos seguintes casos:</p>
      <ul>
        <li>O código de ativação não foi enviado dentro do prazo de 24 horas após confirmação do pagamento;</li>
        <li>O código enviado está inválido ou não funcional e a equipe técnica não conseguiu resolver o problema;</li>
        <li>Cobrança duplicada comprovada por erro do nosso sistema.</li>
      </ul>

      <h2>3. Situações sem Direito a Reembolso</h2>
      <ul>
        <li>Código de ativação já utilizado ou ativado no aplicativo;</li>
        <li>Compra realizada por engano após o código ter sido entregue;</li>
        <li>Problemas de compatibilidade com o dispositivo do cliente não informados antes da compra;</li>
        <li>Mudança de opinião após o uso do serviço.</li>
      </ul>

      <h2>4. Prazo para Solicitação</h2>
      <p>O pedido de reembolso deve ser solicitado em até <strong>7 dias corridos</strong> a partir da data de compra, desde que o código não tenha sido ativado.</p>

      <h2>5. Como Solicitar</h2>
      <p>Para solicitar o reembolso, entre em contato via WhatsApp informando:</p>
      <ul>
        <li>Nome completo utilizado na compra;</li>
        <li>Data e valor da compra;</li>
        <li>Motivo da solicitação;</li>
        <li>Comprovante do pagamento (PIX).</li>
      </ul>
      <p><a href="https://wa.me/5541984613998" target="_blank" rel="noopener noreferrer">👉 Clique aqui para abrir o WhatsApp</a></p>

      <h2>6. Prazo de Análise e Devolução</h2>
      <p>Após o recebimento da solicitação, a análise é realizada em até <strong>3 dias úteis</strong>. Em caso de aprovação, o reembolso é efetuado via PIX para a chave informada pelo cliente em até <strong>5 dias úteis</strong>.</p>

      <h2>7. Direitos do Consumidor</h2>
      <p>Esta política não limita os direitos do consumidor previstos no Código de Defesa do Consumidor (Lei nº 8.078/1990) e na Lei Geral de Proteção de Dados (Lei nº 13.709/2018). Em caso de dúvidas, você pode contatar o Procon de sua cidade.</p>

      <h2>8. Contato</h2>
      <ul>
        <li><strong>WhatsApp:</strong> <a href="https://wa.me/5541984613998">(41) 98461‑3998</a></li>
        <li><strong>Site:</strong> <a href="https://controleunitv.shop" target="_blank" rel="noopener noreferrer">controleunitv.shop</a></li>
      </ul>
    </div>
  </section>

  <footer class="unitv-footer">
    <div class="container">
      <div class="footer-inner">
        <div>
          <div class="footer-brand-label">UniTV</div>
          <div class="footer-sub">Recargas Digitais — Venda de cartões de recarga digitais</div>
        </div>
        <p class="footer-phone"><i class="bi bi-telephone-fill"></i> (41) 98461‑3998</p>
        <div class="footer-actions">
          <a href="<?php echo esc_url( home_url( '/recargas-vip/' ) ); ?>#recargas" class="btn btn-primary"><i class="bi bi-bag-heart-fill"></i> Comprar Recarga</a>
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

  <a href="https://wa.me/5541984613998" class="fab-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Falar no WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

</div><!-- .unitv-wrap -->
