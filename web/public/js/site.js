/* aii.ae — site interactions and animations. Plain JS, no build step. */
(function () {
  'use strict';
  document.documentElement.classList.remove('no-js');
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var sleep = function (ms) { return new Promise(function (r) { setTimeout(r, ms); }); };

  /* Header shadow on scroll */
  var header = document.querySelector('.site-header');
  var onScroll = function () { if (header) header.classList.toggle('is-scrolled', window.scrollY > 8); };
  window.addEventListener('scroll', onScroll, { passive: true }); onScroll();

  /* Mobile menu */
  var toggle = document.querySelector('.menu-toggle');
  if (toggle) toggle.addEventListener('click', function () {
    var open = document.body.classList.toggle('menu-open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  });

  /* Scroll reveal */
  var revealEls = document.querySelectorAll('[data-reveal], .steps, [data-animate]');
  if ('IntersectionObserver' in window && !reduced) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  }

  /* Run a looping animation only while it is on screen */
  function whenVisible(el, start) {
    var started = false;
    if (!('IntersectionObserver' in window)) { start(); return; }
    new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        el.dataset.visible = e.isIntersecting ? '1' : '0';
        if (e.isIntersecting && !started) { started = true; start(); }
      });
    }, { threshold: 0.2 }).observe(el);
  }
  function waitVisible(el) {
    return new Promise(function (resolve) {
      (function check() { if (el.dataset.visible !== '0' && !document.hidden) resolve(); else setTimeout(check, 400); })();
    });
  }

  async function typeInto(node, text, speed) {
    node.classList.add('caret');
    for (var i = 1; i <= text.length; i++) { node.textContent = text.slice(0, i); await sleep(speed); }
    node.classList.remove('caret');
  }

  /* ---------- Hero phone: auto-answered call simulation ---------- */
  var phone = document.querySelector('[data-phone-sim]');
  if (phone) {
    var scenes = phone.querySelectorAll('.scene');
    var transcript = phone.querySelector('.transcript');
    var wave = phone.querySelector('.wave');
    var speaker = phone.querySelector('.speaker');
    var timer = phone.querySelector('.timer');
    var stage = phone.closest('.phone-stage');
    var cards = stage ? stage.querySelectorAll('.float-card') : [];
    var script = JSON.parse(phone.getAttribute('data-script'));
    var timerId = null;

    var show = function (i) { scenes.forEach(function (s, n) { s.classList.toggle('is-active', n === i); }); };
    var card = function (i, on) { if (cards[i]) cards[i].classList.toggle('is-on', on); };
    var bubble = function (line) {
      var b = document.createElement('div');
      b.className = 'bubble ' + (line.from === 'ai' ? 'ai' : 'caller');
      if (line.rtl) { b.setAttribute('dir', 'rtl'); b.setAttribute('lang', 'ar'); }
      var label = document.createElement('small');
      label.textContent = line.from === 'ai' ? 'aii' : 'Caller';
      var t = document.createElement('span');
      b.appendChild(label); b.appendChild(t); transcript.appendChild(b);
      while (transcript.children.length > 5) transcript.removeChild(transcript.firstElementChild);
      return t;
    };
    var startTimer = function () {
      var s = 0; timer.textContent = '00:00';
      timerId = setInterval(function () { s++; timer.textContent = ('0' + Math.floor(s / 60)).slice(-2) + ':' + ('0' + (s % 60)).slice(-2); }, 1000);
    };

    if (reduced) {
      show(1);
      script.forEach(function (l) { bubble(l).textContent = l.text; });
      card(0, true); card(1, true); card(2, true);
    } else {
      whenVisible(phone, async function loop() {
        for (;;) {
          await waitVisible(phone);
          transcript.innerHTML = ''; cards.forEach(function (c) { c.classList.remove('is-on'); });
          show(0); await sleep(2600);                     // ringing
          show(1); startTimer(); await sleep(500);          // auto-answered
          for (var i = 0; i < script.length; i++) {
            var line = script[i];
            wave.classList.add('is-speaking');
            wave.classList.toggle('is-caller', line.from !== 'ai');
            speaker.textContent = line.from === 'ai' ? 'aii is speaking' : 'Caller is speaking';
            await typeInto(bubble(line), line.text, line.from === 'ai' ? 26 : 20);
            wave.classList.remove('is-speaking'); speaker.textContent = '';
            if (line.card !== undefined) card(line.card, true);
            await sleep(650);
          }
          clearInterval(timerId); await sleep(500);
          show(2); card(2, true); await sleep(5200);       // summary
          await sleep(400);
        }
      });
    }
  }

  /* ---------- Generic chat simulation (service pages) ---------- */
  document.querySelectorAll('[data-chat-sim]').forEach(function (box) {
    var lines = JSON.parse(box.getAttribute('data-chat-sim'));
    var render = function (line) {
      var m = document.createElement('div');
      m.className = 'msg ' + line.from;
      if (line.rtl) { m.setAttribute('dir', 'rtl'); m.setAttribute('lang', 'ar'); }
      box.appendChild(m);
      while (box.children.length > 6) box.removeChild(box.firstElementChild);
      return m;
    };
    if (reduced) { lines.forEach(function (l) { render(l).textContent = l.text; }); return; }
    whenVisible(box, async function () {
      for (;;) {
        await waitVisible(box);
        box.innerHTML = ''; await sleep(500);
        for (var i = 0; i < lines.length; i++) {
          var dots = document.createElement('div');
          dots.className = 'typing ' + (lines[i].from === 'in' ? 'in' : '');
          dots.innerHTML = '<i></i><i></i><i></i>';
          box.appendChild(dots); await sleep(lines[i].from === 'in' ? 900 : 1300);
          box.removeChild(dots);
          render(lines[i]).textContent = lines[i].text;
          await sleep(1100);
        }
        await sleep(3500);
      }
    });
  });

  /* ---------- Step-by-step flow lighting ---------- */
  document.querySelectorAll('[data-flow]').forEach(function (flow) {
    var nodes = flow.querySelectorAll('.flow-node');
    if (reduced) { nodes.forEach(function (n) { n.classList.add('is-on'); }); return; }
    whenVisible(flow, async function () {
      for (;;) {
        await waitVisible(flow);
        nodes.forEach(function (n) { n.classList.remove('is-on'); });
        for (var i = 0; i < nodes.length; i++) { await sleep(700); nodes[i].classList.add('is-on'); }
        await sleep(3000);
      }
    });
  });

  /* ---------- Pricing monthly / yearly ---------- */
  var billing = document.querySelector('[data-billing]');
  if (billing) {
    billing.querySelectorAll('button').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var yearly = btn.dataset.period === 'yearly';
        billing.querySelectorAll('button').forEach(function (b) { b.setAttribute('aria-pressed', b === btn ? 'true' : 'false'); });
        document.querySelectorAll('[data-monthly]').forEach(function (el) {
          var to = parseInt(yearly ? el.dataset.yearly : el.dataset.monthly, 10);
          var from = parseInt(el.textContent.replace(/,/g, ''), 10) || to;
          if (reduced) { el.textContent = to.toLocaleString('en-US'); return; }
          var t0 = performance.now();
          (function step(t) {
            var p = Math.min(1, (t - t0) / 500), e = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(from + (to - from) * e).toLocaleString('en-US');
            if (p < 1) requestAnimationFrame(step);
          })(t0);
        });
        document.querySelectorAll('[data-period-note]').forEach(function (n) {
          n.textContent = yearly ? 'AED / month, billed yearly' : 'AED / month';
        });
      });
    });
  }
})();
