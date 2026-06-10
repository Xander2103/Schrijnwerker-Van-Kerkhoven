/**
 * Interaction layer
 * - Scroll reveal via IntersectionObserver
 * - Review carousel (auto-advance, dots, prev/next, keyboard, pause on hover/focus)
 * - Optional wooden cursor (fine-pointer desktop only, respects prefers-reduced-motion)
 */
(function () {
  'use strict';

  var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ─────────────────────────────────────────────
  // Scroll Reveal
  // ─────────────────────────────────────────────
  function initScrollReveal() {
    if (prefersReduced) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        var delay = parseInt(el.dataset.revealDelay || '0', 10);
        if (delay > 0) {
          setTimeout(function () { el.classList.add('is-revealed'); }, delay);
        } else {
          el.classList.add('is-revealed');
        }
        observer.unobserve(el);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -48px 0px' });

    // Assign stagger delays to children of .reveal-stagger before observing
    document.querySelectorAll('.reveal-stagger').forEach(function (container) {
      container.querySelectorAll('.reveal').forEach(function (child, i) {
        if (!child.dataset.revealDelay) {
          child.dataset.revealDelay = String(i * 90);
        }
      });
    });

    document.querySelectorAll('.reveal').forEach(function (el) {
      observer.observe(el);
    });
  }

  // ─────────────────────────────────────────────
  // Review Carousel
  // ─────────────────────────────────────────────
  function ReviewCarousel(el) {
    this.el      = el;
    this.cards   = Array.prototype.slice.call(el.querySelectorAll('.review-card'));
    this.dots    = Array.prototype.slice.call(el.querySelectorAll('.review-dot'));
    this.prevBtn = el.querySelector('.review-prev');
    this.nextBtn = el.querySelector('.review-next');
    this.current = 0;
    this.total   = this.cards.length;
    this.timer   = null;
    this._init();
  }

  ReviewCarousel.prototype._init = function () {
    if (this.total < 2) return;
    this._bind();
    this.el.setAttribute('tabindex', '0');
    if (!prefersReduced) this._start();
  };

  ReviewCarousel.prototype.go = function (index) {
    var prev = this.current;
    this.current = ((index % this.total) + this.total) % this.total;
    if (prev === this.current) return;

    var prevCard = this.cards[prev];
    var nextCard = this.cards[this.current];
    var prevDot  = this.dots[prev];
    var nextDot  = this.dots[this.current];

    if (prevCard) { prevCard.classList.remove('is-active'); prevCard.setAttribute('aria-hidden', 'true'); }
    if (prevDot)  { prevDot.classList.remove('is-active'); prevDot.setAttribute('aria-selected', 'false'); }

    if (nextCard) { nextCard.classList.add('is-active'); nextCard.setAttribute('aria-hidden', 'false'); }
    if (nextDot)  { nextDot.classList.add('is-active'); nextDot.setAttribute('aria-selected', 'true'); }
  };

  ReviewCarousel.prototype.next = function () { this.go(this.current + 1); };
  ReviewCarousel.prototype.prev = function () { this.go(this.current - 1); };

  ReviewCarousel.prototype._start = function () {
    var self = this;
    if (self.timer) return;
    self.timer = setInterval(function () { self.next(); }, 5000);
  };

  ReviewCarousel.prototype._pause = function () {
    clearInterval(this.timer);
    this.timer = null;
  };

  ReviewCarousel.prototype._resume = function () {
    if (!prefersReduced) this._start();
  };

  ReviewCarousel.prototype._bind = function () {
    var self = this;

    if (self.prevBtn) {
      self.prevBtn.addEventListener('click', function () {
        self._pause(); self.prev(); self._resume();
      });
    }
    if (self.nextBtn) {
      self.nextBtn.addEventListener('click', function () {
        self._pause(); self.next(); self._resume();
      });
    }

    self.dots.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        self._pause(); self.go(i); self._resume();
      });
    });

    self.el.addEventListener('mouseenter', function () { self._pause(); });
    self.el.addEventListener('mouseleave', function () { self._resume(); });
    self.el.addEventListener('focusin',    function () { self._pause(); });
    self.el.addEventListener('focusout',   function () { self._resume(); });

    self.el.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft')  { self._pause(); self.prev(); self._resume(); }
      if (e.key === 'ArrowRight') { self._pause(); self.next(); self._resume(); }
    });
  };

  function initCarousels() {
    document.querySelectorAll('[data-carousel]').forEach(function (el) {
      new ReviewCarousel(el);
    });
  }

  // ─────────────────────────────────────────────
  // Custom Wooden Cursor — cursor3.png
  // Two-phase activation: build the cursor DOM immediately, but only
  // add body.custom-cursor-ready (which hides the native cursor via CSS)
  // after Image.onload confirms the image is available. On error the
  // native cursor is left untouched and the custom element is removed.
  // ─────────────────────────────────────────────
  function initCustomCursor() {
    if (!document.body.classList.contains('custom-cursor-enabled')) return;
    if (!window.matchMedia('(pointer: fine)').matches) return;

    var cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.setAttribute('aria-hidden', 'true');

    var inner = document.createElement('div');
    inner.className = 'custom-cursor-inner';

    var cursorImg = document.createElement('img');
    cursorImg.alt = '';
    cursorImg.setAttribute('aria-hidden', 'true');
    inner.appendChild(cursorImg);

    cursor.appendChild(inner);
    // Keep invisible until image load confirmed — native cursor stays
    // visible in the meantime
    cursor.style.opacity = '0';
    document.body.appendChild(cursor);

    // Hotspot: arrow tip is ~8 px from left, ~5 px from top of the
    // 48×48 element
    var hotX = 8, hotY = 5;
    var mouseX = 0, mouseY = 0;
    var curX   = 0, curY   = 0;
    var ready  = false;

    function lerp(a, b, t) { return a + (b - a) * t; }

    function animateSmooth() {
      curX = lerp(curX, mouseX, 0.18);
      curY = lerp(curY, mouseY, 0.18);
      cursor.style.transform = 'translate(' + (curX - hotX) + 'px,' + (curY - hotY) + 'px)';
      requestAnimationFrame(animateSmooth);
    }

    document.addEventListener('mousemove', function (e) {
      mouseX = e.clientX;
      mouseY = e.clientY;
      if (prefersReduced) {
        cursor.style.transform = 'translate(' + (mouseX - hotX) + 'px,' + (mouseY - hotY) + 'px)';
      }
      // Only reveal the custom cursor once the image is confirmed
      if (ready) cursor.style.opacity = '1';
    });

    document.addEventListener('mouseleave', function () {
      cursor.style.opacity = '0';
    });

    if (!prefersReduced) {
      animateSmooth();
    }

    // Click: mousedown fires before mouseup so no native-cursor gap
    document.addEventListener('mousedown', function () {
      if (!ready || prefersReduced) return;
      cursor.classList.remove('is-clicking');
      void cursor.offsetWidth; // force reflow so animation can restart
      cursor.classList.add('is-clicking');
    });

    inner.addEventListener('animationend', function () {
      cursor.classList.remove('is-clicking');
    });

    // Hover feedback: scale up over interactive elements
    document.addEventListener('mouseover', function (e) {
      var isInteractive = !!e.target.closest('a, button, label, [role="button"], .btn, summary');
      inner.classList.toggle('is-hovering', isInteractive);
    });

    // ── Image load gate ─────────────────────────────────────────────
    // Use the actual cursor <img> as the load gate so we know the same
    // element the browser will paint has loaded successfully. Only then
    // hide the native cursor and reveal the custom one.
    cursorImg.onload = function () {
      ready = true;
      document.body.classList.add('custom-cursor-ready');
      if (mouseX !== 0 || mouseY !== 0) cursor.style.opacity = '1';
    };

    cursorImg.onerror = function () {
      // Image unavailable — remove the invisible element and leave the
      // native cursor fully intact.
      if (cursor.parentNode) cursor.parentNode.removeChild(cursor);
    };

    cursorImg.src = '/assets/client/images/cursor3.png';
  }

  // ─────────────────────────────────────────────
  // Boot
  // ─────────────────────────────────────────────
  function boot() {
    initScrollReveal();
    initCarousels();
    initCustomCursor();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }

}());
