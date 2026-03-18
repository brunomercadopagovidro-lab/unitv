=== UniTV Recargas VIP ===
Contributors: unitv
Tags: iptv, recargas, streaming, shortcode, vendas digitais
Requires at least: 5.6
Tested up to: 6.5
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Plugin de recargas digitais UniTV com landing page de planos, downloads e páginas de políticas.

== Description ==

O **UniTV Recargas VIP** é um plugin WordPress completo para comercialização de recargas digitais do aplicativo UniTV. Inclui:

* Página de vendas com planos (Mensal, Trimestral e Anual)
* Seção de downloads para Celular, Fire Stick, TV Box e Smart TV
* Depoimentos de clientes
* Toast de compra (social proof)
* Páginas de políticas (Privacidade, Termos de Uso, Reembolso e Cookies) conforme LGPD
* Visual moderno com dark theme, gradientes e animações
* Totalmente responsivo

= Shortcodes Disponíveis =

* `[unitv_recargas]` — Página principal de recargas
* `[unitv_privacidade]` — Política de Privacidade
* `[unitv_termos]` — Termos de Uso
* `[unitv_reembolso]` — Política de Reembolso
* `[unitv_cookies]` — Política de Cookies

== Installation ==

1. Faça o upload do arquivo ZIP pelo menu **Plugins → Adicionar Novo → Enviar Plugin**.
2. Ative o plugin em **Plugins → Plugins Instalados**.
3. Ao ativar, o plugin criará automaticamente as seguintes páginas:
   * **Recargas VIP** (slug: `recargas-vip`)
   * **Política de Privacidade UniTV** (slug: `privacidade-unitv`)
   * **Termos de Uso UniTV** (slug: `termos-unitv`)
   * **Política de Reembolso UniTV** (slug: `reembolso-unitv`)
   * **Política de Cookies UniTV** (slug: `cookies-unitv`)
4. Acesse `/recargas-vip/` para visualizar a página principal.

== Frequently Asked Questions ==

= Preciso configurar algo após a ativação? =

Não. O plugin cria todas as páginas automaticamente na ativação. Basta acessar as páginas para verificar.

= Posso usar os shortcodes em qualquer página? =

Sim. Você pode adicionar qualquer um dos shortcodes em páginas ou posts existentes.

= Os assets (CSS/JS) são carregados em todo o site? =

Não. Os assets são enfileirados apenas nas páginas que contêm um dos shortcodes do plugin.

= Como alterar os links de compra? =

Edite diretamente o arquivo `templates/page-recargas.php` e atualize os atributos `href` dos botões de compra.

= O plugin depende de outros plugins? =

Não. O plugin funciona de forma independente, sem dependências além do WordPress.

== Screenshots ==

1. Página principal de recargas com hero, planos e depoimentos.
2. Cards de planos com destaque para o plano mais vendido.
3. Seção de downloads para diferentes dispositivos.
4. Páginas de políticas com visual consistente.

== Changelog ==

= 1.0.0 =
* Lançamento inicial do plugin.
* Página de vendas com 3 planos (Mensal, Trimestral, Anual).
* Seção de downloads para 4 dispositivos.
* 4 depoimentos de clientes.
* Toast de social proof com nomes e produtos aleatórios.
* Header sticky com blur e efeito scroll.
* FAB WhatsApp fixo.
* 4 páginas de política (Privacidade, Termos, Reembolso, Cookies) em conformidade com a LGPD.
* Criação automática de páginas WordPress na ativação.
* Assets enfileirados apenas nas páginas com shortcodes do plugin.

== Upgrade Notice ==

= 1.0.0 =
Versão inicial. Nenhuma atualização necessária.
