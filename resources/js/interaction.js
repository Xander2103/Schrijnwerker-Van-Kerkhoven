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
  // Hammer Cursor — cursorhammer.png
  //
  // Architecture:
  //   outer .custom-cursor  — JS writes translate3d only
  //   inner .custom-cursor-inner — all visual state lives here
  //     (hover scale/tilt, click animation classes)
  //   Keeping translate and rotate on separate elements prevents
  //   transform property conflicts during animations.
  //
  // Click classes (on inner, not outer):
  //   is-clicking-strike  → interactive targets (links, buttons…)
  //   is-clicking-spin    → non-interactive areas
  //
  // No animation-fill-mode:forwards — avoids the post-animation
  // transition from the held final-frame back to the CSS base
  // state, which caused the visible position shift.
  //
  // Early hide: CSS hides native cursor via body.custom-cursor-enabled
  // (set by Blade at render time) so no flash before JS runs.
  //
  // Lightbox fix: cursor appended to <html> element, not <body>,
  // so it sits outside the <dialog> top-layer stacking context.
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

    // Start invisible — shown after image load is confirmed
    cursor.style.opacity = '0';

    // Append to <html>, not <body>, so the cursor lives outside
    // the stacking context that <dialog> top-layer creates.
    document.documentElement.appendChild(cursor);

    // Hotspot at hammer head — upper-right of the 48×48 element.
    // The hammer PNG is diagonal (head upper-right, handle lower-left).
    // Setting hotX=34,hotY=4 aligns the mouse coordinate with the
    // flat striking face of the hammer head (~70% from left, ~8% from top).
    var hotX = 34, hotY = 4;
    var mouseX = 0, mouseY = 0;
    var curX   = 0, curY   = 0;
    var ready  = false;
    var clicking = false; // guard against hover-state churn during animation

    var INTERACTIVE_SEL = 'a, button, input, select, textarea, label, summary, ' +
      '[role="button"], .btn, .wood-swatch, .realisatie-btn, ' +
      '.review-nav-btn, .review-dot, .lightbox-nav-btn, .lightbox-close, ' +
      '.nav-toggle, [tabindex]:not([tabindex="-1"])';

    function lerp(a, b, t) { return a + (b - a) * t; }

    function tick() {
      curX = lerp(curX, mouseX, 0.18);
      curY = lerp(curY, mouseY, 0.18);
      // translate3d promotes to GPU compositor layer — smooth 60fps
      cursor.style.transform = 'translate3d(' + (curX - hotX) + 'px,' + (curY - hotY) + 'px,0)';
      requestAnimationFrame(tick);
    }

    document.addEventListener('mousemove', function (e) {
      mouseX = e.clientX;
      mouseY = e.clientY;
      if (prefersReduced) {
        cursor.style.transform = 'translate3d(' + (mouseX - hotX) + 'px,' + (mouseY - hotY) + 'px,0)';
      }
      if (ready) cursor.style.opacity = '1';
    });

    document.addEventListener('mouseleave', function () {
      cursor.style.opacity = '0';
    });

    if (!prefersReduced) tick();

    document.addEventListener('mousedown', function (e) {
      if (!ready || prefersReduced) return;

      clicking = true;

      // Remove hover state + any in-progress animation — clean slate.
      // Removing is-hovering before the animation prevents a 1-frame
      // snap from the hover transform to the animation's 0% keyframe.
      inner.classList.remove('is-hovering', 'is-clicking-strike', 'is-clicking-spin');
      void inner.offsetWidth; // force reflow so the new animation restarts

      var isInteractive = !!e.target.closest(INTERACTIVE_SEL);
      inner.classList.add(isInteractive ? 'is-clicking-strike' : 'is-clicking-spin');
    });

    inner.addEventListener('animationend', function () {
      clicking = false;
      inner.classList.remove('is-clicking-strike', 'is-clicking-spin');

      // Re-evaluate hover state immediately at the current pointer position
      // rather than waiting for the next mouseover event.
      var el = document.elementFromPoint(mouseX, mouseY);
      inner.classList.toggle('is-hovering', !!(el && el.closest(INTERACTIVE_SEL)));
    });

    // Hover — skip state change while a click animation is running
    document.addEventListener('mouseover', function (e) {
      if (clicking) return;
      var isInteractive = !!e.target.closest(INTERACTIVE_SEL);
      inner.classList.toggle('is-hovering', isInteractive);
    });

    // ── Image load gate ──────────────────────────────────────────────
    // body.custom-cursor-enabled (from Blade) already hides the native
    // cursor. Here we make the hammer visible and add the secondary class.
    cursorImg.onload = function () {
      ready = true;
      document.body.classList.add('custom-cursor-ready');
      if (mouseX !== 0 || mouseY !== 0) cursor.style.opacity = '1';
    };

    cursorImg.onerror = function () {
      // Image failed — restore native cursor everywhere and clean up
      document.body.classList.remove('custom-cursor-enabled');
      if (cursor.parentNode) cursor.parentNode.removeChild(cursor);
    };

    cursorImg.src = '/assets/client/images/cursorhammer.png';
  }

  // ─────────────────────────────────────────────
  // Atelier photo cycling — Ons bedrijf section.
  //
  // Swaps ALL 3 frames simultaneously every ~4.5 s:
  //   1. Fade out all 3 frames together (0.65 s).
  //   2. Swap all 3 background-images at once.
  //   3. Fade back in (0.65 s).
  //
  // Set-selection rule: the next set of 3 must share
  // NO images with the current set — no direct repetition.
  //
  // Respects prefers-reduced-motion (static images if reduced).
  // ─────────────────────────────────────────────
  function initAtelierCycle() {
    if (prefersReduced) return;

    var stack = document.querySelector('[data-atelier-images]');
    if (!stack) return;

    var allImages;
    try { allImages = JSON.parse(stack.dataset.atelierImages); } catch (e) { return; }
    if (!allImages || allImages.length < 3) return;

    var frames = Array.from(stack.querySelectorAll('.bedrijf-photo'));
    if (frames.length < 3) return;

    // Enable opacity fade on each photo frame (CSS class handles transition duration)
    frames.forEach(function (f) { f.style.transition = 'opacity 0.65s ease, transform 0.3s ease, box-shadow 0.3s ease'; });

    // Fisher-Yates shuffle — returns a NEW shuffled array, does not mutate input
    function shuffle(arr) {
      var a = arr.slice();
      for (var i = a.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var t = a[i]; a[i] = a[j]; a[j] = t;
      }
      return a;
    }

    // Preload a single URL into the browser cache
    function preload(url) { var img = new Image(); img.src = url; }

    // Preload every image at startup so transitions are smooth from the first swap
    allImages.forEach(preload);

    // currentSet: the 3 URLs that are currently visible on screen.
    // Seeded from allImages[0..2] which matches Blade's initial render.
    var currentSet = allImages.slice(0, 3);

    // Return 3 URLs that share NO entries with currentSet.
    // Edge-case guard: if total pool < 6, pad with shuffled currentSet items.
    function getNextSet() {
      var pool = allImages.filter(function (url) {
        return currentSet.indexOf(url) === -1;
      });

      if (pool.length < 3) {
        // Not enough images outside currentSet — append shuffled currentSet as padding
        pool = pool.concat(shuffle(currentSet));
      }

      return shuffle(pool).slice(0, 3);
    }

    // Speculatively preload the first upcoming set right after init
    getNextSet().forEach(preload);

    // FADE: CSS transition duration (ms). Must match the transition set on frames above.
    // CYCLE: total time between cycle starts (ms).
    //   Visible time per set ≈ CYCLE − FADE (fade-out) − FADE (fade-in) ≈ 4.5 s.
    var FADE  = 650;
    var CYCLE = 5800;

    function cycle() {
      var nextSet = getNextSet();

      // Phase 1 — fade all frames out simultaneously
      frames.forEach(function (f) { f.style.opacity = '0'; });

      // Phase 2 — after fade-out: swap all backgrounds and fade back in
      setTimeout(function () {
        nextSet.forEach(function (url, i) {
          frames[i].style.backgroundImage = "url('" + url + "')";
        });

        currentSet = nextSet;

        // Preload the set after this one while the current one is fading in
        getNextSet().forEach(preload);

        // Phase 3 — fade all frames back in simultaneously
        frames.forEach(function (f) { f.style.opacity = '1'; });

      }, FADE + 50); // 50 ms buffer so fade-out is fully complete before swap
    }

    // Start cycling; pause when the browser tab is hidden to save resources
    var timer = setInterval(cycle, CYCLE);

    document.addEventListener('visibilitychange', function () {
      if (document.hidden) {
        clearInterval(timer);
      } else {
        timer = setInterval(cycle, CYCLE);
      }
    });
  }

  // ─────────────────────────────────────────────
  // Contact form — disable the submit button and show a loading
  // label on submit, so double-clicks / repeated Enter presses
  // cannot fire a second request while the first is in flight.
  // ─────────────────────────────────────────────
  function initContactFormGuard() {
    document.querySelectorAll('.contact-form').forEach(function (form) {
      form.addEventListener('submit', function (e) {
        if (form.dataset.submitting === 'true') {
          e.preventDefault();
          return;
        }
        form.dataset.submitting = 'true';

        var btn = form.querySelector('button[type="submit"]');
        if (btn) {
          btn.disabled = true;
          var loadingLabel = btn.dataset.loadingLabel;
          if (loadingLabel) btn.textContent = loadingLabel;
        }
      });
    });
  }

  // ─────────────────────────────────────────────
  // Transparent hero nav — homepage only.
  // Adds body.nav-scrolled once user scrolls 70 %
  // of viewport height; CSS handles the visual switch.
  // ─────────────────────────────────────────────
  function initHeroNav() {
    if (!document.body.classList.contains('page-home')) return;
    var hero = document.querySelector('.hero');
    if (!hero) return;

    var threshold = window.innerHeight * 0.70;

    function update() {
      document.body.classList.toggle('nav-scrolled', window.pageYOffset > threshold);
    }

    window.addEventListener('scroll', update, { passive: true });
    update();
  }

  // ─────────────────────────────────────────────
  // Boot
  // ─────────────────────────────────────────────
  function boot() {
    initScrollReveal();
    initCarousels();
    initCustomCursor();
    initHeroNav();
    initAtelierCycle();
    initContactFormGuard();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }

}());
