/* =============================================================
   UniTV Recargas VIP — admin.js
   ============================================================= */

(function ($) {
  'use strict';

  /* -----------------------------------------------------------
     Repeater: Add row
     --------------------------------------------------------- */
  function makeNewRow(template, idx) {
    if (template === 'plan') {
      return '<div class="unitv-repeater-row">' +
        '<div class="unitv-row-handle">☰</div>' +
        '<div class="unitv-row-body">' +
          '<div class="unitv-row-grid">' +
            '<div><label>Nome do Plano</label><input type="text" name="plans[' + idx + '][name]" class="unitv-input" value=""></div>' +
            '<div><label>URL da Imagem</label><input type="url" name="plans[' + idx + '][img]" class="unitv-input" placeholder="https://..."></div>' +
            '<div><label>Rating</label><input type="text" name="plans[' + idx + '][rating]" class="unitv-input-sm" value="4.99"></div>' +
            '<div><label>Avaliações</label><input type="text" name="plans[' + idx + '][reviews]" class="unitv-input-sm" value=""></div>' +
            '<div><label>Preço Antigo</label><input type="text" name="plans[' + idx + '][price_old]" class="unitv-input-sm" value=""></div>' +
            '<div><label>Desconto</label><input type="text" name="plans[' + idx + '][discount]" class="unitv-input-sm" value=""></div>' +
            '<div><label>Preço Atual</label><input type="text" name="plans[' + idx + '][price]" class="unitv-input-sm" value=""></div>' +
            '<div><label>URL de Compra</label><input type="url" name="plans[' + idx + '][url]" class="unitv-input" placeholder="https://..."></div>' +
          '</div>' +
          '<div class="unitv-row-checks">' +
            '<label><input type="checkbox" name="plans[' + idx + '][featured]" value="1"> Mais Vendido</label>' +
            '<label><input type="checkbox" name="plans[' + idx + '][active]" value="1" checked> Ativo</label>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="unitv-row-remove">✕</button>' +
      '</div>';
    }

    if (template === 'feature') {
      return '<div class="unitv-repeater-row">' +
        '<div class="unitv-row-handle">☰</div>' +
        '<div class="unitv-row-body">' +
          '<div class="unitv-row-grid">' +
            '<div><label>Emoji / Ícone</label><input type="text" name="features[' + idx + '][icon]" class="unitv-input-sm" value=""></div>' +
            '<div><label>Título</label><input type="text" name="features[' + idx + '][title]" class="unitv-input" value=""></div>' +
            '<div class="unitv-col-full"><label>Descrição</label><textarea name="features[' + idx + '][desc]" rows="2" class="unitv-input"></textarea></div>' +
          '</div>' +
          '<div class="unitv-row-checks">' +
            '<label><input type="checkbox" name="features[' + idx + '][active]" value="1" checked> Ativo</label>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="unitv-row-remove">✕</button>' +
      '</div>';
    }

    if (template === 'download') {
      return '<div class="unitv-repeater-row">' +
        '<div class="unitv-row-handle">☰</div>' +
        '<div class="unitv-row-body">' +
          '<div class="unitv-row-grid">' +
            '<div><label>Nome do Dispositivo</label><input type="text" name="downloads[' + idx + '][name]" class="unitv-input" value=""></div>' +
            '<div><label>URL da Imagem</label><input type="url" name="downloads[' + idx + '][img]" class="unitv-input" placeholder="https://..."></div>' +
            '<div><label>URL do Download (APK)</label><input type="url" name="downloads[' + idx + '][url]" class="unitv-input" placeholder="https://..."></div>' +
          '</div>' +
          '<div class="unitv-row-checks">' +
            '<label><input type="checkbox" name="downloads[' + idx + '][active]" value="1" checked> Ativo</label>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="unitv-row-remove">✕</button>' +
      '</div>';
    }

    if (template === 'review') {
      return '<div class="unitv-repeater-row">' +
        '<div class="unitv-row-handle">☰</div>' +
        '<div class="unitv-row-body">' +
          '<div class="unitv-row-grid">' +
            '<div><label>Nome do Cliente</label><input type="text" name="reviews[' + idx + '][name]" class="unitv-input" value=""></div>' +
            '<div><label>URL do Avatar</label><input type="url" name="reviews[' + idx + '][avatar]" class="unitv-input" placeholder="https://..."></div>' +
            '<div><label>Estrelas</label>' +
              '<select name="reviews[' + idx + '][stars]" class="unitv-input-sm">' +
                '<option value="5" selected>5</option>' +
                '<option value="4">4</option>' +
                '<option value="3">3</option>' +
                '<option value="2">2</option>' +
                '<option value="1">1</option>' +
              '</select></div>' +
            '<div class="unitv-col-full"><label>Depoimento</label><textarea name="reviews[' + idx + '][text]" rows="2" class="unitv-input"></textarea></div>' +
          '</div>' +
          '<div class="unitv-row-checks">' +
            '<label><input type="checkbox" name="reviews[' + idx + '][active]" value="1" checked> Ativo</label>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="unitv-row-remove">✕</button>' +
      '</div>';
    }

    return '';
  }

  $(document).on('click', '.unitv-btn-add', function () {
    var target   = $(this).data('target');
    var template = $(this).data('template');
    var $list    = $('#' + target);
    var idx      = $list.children('.unitv-repeater-row').length;
    $list.append(makeNewRow(template, idx));
    reindex($list, template);
  });

  /* -----------------------------------------------------------
     Repeater: Remove row
     --------------------------------------------------------- */
  $(document).on('click', '.unitv-row-remove', function () {
    var $row  = $(this).closest('.unitv-repeater-row');
    var $list = $row.parent();
    var key   = $list.attr('id').replace('-list', '').replace(/s$/, '');
    $row.remove();
    reindex($list, key);
  });

  /* -----------------------------------------------------------
     Re-index all rows after add/remove
     --------------------------------------------------------- */
  function reindex($list, template) {
    $list.children('.unitv-repeater-row').each(function (newIdx) {
      $(this).find('[name]').each(function () {
        var name = $(this).attr('name');
        // Replace [0], [1] … with newIdx
        $(this).attr('name', name.replace(/\[\d+\]/, '[' + newIdx + ']'));
      });
    });
  }

})(jQuery);
