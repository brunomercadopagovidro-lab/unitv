/* =============================================================
   UniTV Recargas VIP — scripts.js
   ============================================================= */

(function () {
  'use strict';

  /* -----------------------------------------------------------
     Header scroll effect
     --------------------------------------------------------- */
  var header = document.querySelector('.unitv-header');

  function onScroll() {
    if (!header) return;
    if (window.scrollY > 10) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* -----------------------------------------------------------
     Toast social proof
     --------------------------------------------------------- */
  var names = [
    'Rafael', 'Paula', 'Edson', 'Camila', 'Thiago',
    'Mariana', 'João', 'Bruna', 'Carlos', 'Letícia'
  ];

  var products = [
    'UNITV RECARGA MENSAL',
    'UNITV RECARGA TRIMESTRAL',
    'UNITV RECARGA ANUAL'
  ];

  function rand(arr) {
    return arr[Math.floor(Math.random() * arr.length)];
  }

  var activeToast = null;

  function showToast() {
    if (activeToast) {
      activeToast.classList.remove('show');
      setTimeout(function () {
        if (activeToast && activeToast.parentNode) {
          activeToast.parentNode.removeChild(activeToast);
        }
        activeToast = null;
      }, 450);
    }

    var name    = rand(names);
    var product = rand(products);

    var toast = document.createElement('div');
    toast.className = 'unitv-toast';
    toast.innerHTML =
      '<div class="toast-icon"><i class="bi bi-bag-check-fill"></i></div>' +
      '<div class="toast-text">' +
        '<strong>' + name + ' acabou de comprar!</strong>' +
        '<span>' + product + '</span>' +
      '</div>';

    document.body.appendChild(toast);
    activeToast = toast;

    // Trigger reflow before adding class so transition plays
    toast.getBoundingClientRect();
    toast.classList.add('show');

    setTimeout(function () {
      toast.classList.remove('show');
      setTimeout(function () {
        if (toast.parentNode) {
          toast.parentNode.removeChild(toast);
        }
        if (activeToast === toast) activeToast = null;
      }, 450);
    }, 5000);
  }

  // First toast after 2.5s, then every 12s
  setTimeout(function () {
    showToast();
    setInterval(showToast, 12000);
  }, 2500);

})();
