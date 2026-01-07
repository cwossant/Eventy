<?php
// test.php - Landing page inspired by a modern event platform
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Test — Eventy-inspired</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap&family=Simonetta:wght@400;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --accent1:#7A4ECB;
      --accent2:#824ED1;
      --white:#FFFFFF;
      --surface:#ffffff;
      --surface-opaque:rgba(255,255,255,0.96);
      --text-dark:#0b0b10;
      --accent3:#4E3C7F;
      --accent4:#6F42C7;
      --bg:#0f0b16;
      --muted:rgba(255,255,255,0.8);
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial;color:var(--white);}

    /* animated purple gradient background (underneath) */
    body::before{
      content:"";position:fixed;inset:0;z-index:-3;
      background:linear-gradient(120deg,var(--accent1),var(--accent2),var(--accent4));
      background-size:300% 300%;filter:blur(60px) saturate(120%);opacity:0.95;transform:scale(1.12);
      animation:slide 14s linear infinite;
    }
    /* top layer: white area covering top 40% of viewport, transparent below to reveal purple */
    body{background:linear-gradient(180deg,var(--surface-opaque) 0 40%, rgba(255,255,255,0) 40% 100%);}
    /* subtle dark overlay applied only to purple area (bottom 60%) */
    body::after{content:"";position:fixed;inset:0;z-index:-2;background:linear-gradient(180deg,rgba(6,4,10,0) 0 40%, rgba(6,4,10,0.45) 40% 100%);mix-blend-mode:multiply;pointer-events:none}
    @keyframes slide{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}

    header{display:flex;align-items:center;justify-content:space-between;padding:20px 4%;position:relative}
    .logo{font-weight:700;letter-spacing:0.6px;color:var(--white);display:flex;align-items:center;gap:10px}
    .logo .mark{width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,var(--accent1),var(--accent2));display:inline-block;box-shadow:0 6px 18px rgba(124,78,201,0.12)}
    nav{display:flex;gap:20px;align-items:center}
    nav a{color:var(--white);text-decoration:none;opacity:0.95;padding:8px 10px;border-radius:8px;font-weight:600;position:relative}
    nav a::after{content:"";position:absolute;left:12px;right:12px;bottom:-6px;height:2px;background:linear-gradient(90deg,var(--accent1),var(--accent2));transform:scaleX(0);transform-origin:left center;transition:transform .22s cubic-bezier(.2,.9,.2,1);border-radius:2px}
    nav a:hover::after{transform:scaleX(1)}
    .btn-cta{background:linear-gradient(90deg,var(--accent1),var(--accent2));padding:10px 16px;border-radius:8px;color:var(--white);border:none;cursor:pointer;font-weight:600;box-shadow:0 6px 18px rgba(124,78,201,0.18);transition:transform .18s ease}
    .btn-cta:active{transform:translateY(1px)}
    .btn-cta:focus{outline:2px solid rgba(255,255,255,0.12);outline-offset:3px}
    header.scrolled{backdrop-filter:blur(8px);background:linear-gradient(180deg,rgba(0,0,0,0.28),rgba(0,0,0,0.18));box-shadow:0 6px 30px rgba(0,0,0,0.45);position:fixed;left:0;right:0;top:0;z-index:40}
    header{transition:all .28s ease}

    /* hero */
    .hero{display:grid;grid-template-columns:1fr 480px;gap:40px;align-items:center;padding:60px 4%;min-height:68vh;position:relative}
    .hero .panel{background:var(--surface-opaque);color:var(--text-dark);padding:36px;border-radius:16px;box-shadow:0 18px 50px rgba(2,2,8,0.22);border:1px solid rgba(12,8,20,0.06)}
    .hero h1{font-family:'Playfair Display', 'Simonetta', serif;font-size:clamp(32px,6vw,64px);line-height:1.02;margin:0 0 18px;color:inherit}
    .hero p{color:rgba(6,6,10,0.76);max-width:52ch;margin:0 0 24px}
    .hero .actions{display:flex;gap:12px}

    /* hero decorative elements similar to original site */
    .hero::before{
      content:"";position:absolute;right:6%;top:6%;width:260px;height:260px;background-image:radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);background-size:10px 10px;border-radius:50%;opacity:0.7;pointer-events:none;mask-image:radial-gradient(circle at 60% 40%, black 55%, transparent 100%)}
    .hero::after{content:'';position:absolute;left:50%;top:0;bottom:0;width:1px;background:linear-gradient(180deg,rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.02) 50%, transparent 100%);transform:translateX(-50%);pointer-events:none;opacity:0.9}

    /* hero card/visual */
    .mock-device{background:linear-gradient(180deg,rgba(122,78,203,0.18), rgba(82,46,150,0.12));border-radius:20px;padding:22px;box-shadow:0 24px 80px rgba(6,4,20,0.6);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,0.04)}
    .mock-screen{width:100%;height:340px;border-radius:12px;background:linear-gradient(135deg,rgba(255,255,255,0.03),rgba(0,0,0,0.02));position:relative;overflow:hidden}
    .event-card{position:absolute;left:18px;top:18px;padding:18px;border-radius:10px;background:linear-gradient(90deg,var(--accent2),var(--accent4));color:var(--white);box-shadow:0 8px 28px rgba(75,42,150,0.28);transform:translateY(-6px);animation:float 6s ease-in-out infinite}
    .event-card small{opacity:0.92;font-size:13px;display:block;margin-top:8px}
    @keyframes float{0%,100%{transform:translateY(-6px)}50%{transform:translateY(6px)}}

    /* features */
    .features{padding:60px 4%;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px}
    .card{background:var(--surface-opaque);padding:18px;border-radius:12px;border-left:4px solid var(--accent1);transition:transform .28s ease,box-shadow .28s ease,background .18s;opacity:0;transform:translateY(18px);color:var(--text-dark)}
    .card.visible{opacity:1;transform:none}
    .card:hover{transform:translateY(-8px);box-shadow:0 22px 48px rgba(2,2,8,0.18)}

    .card h3{margin:0 0 8px;font-size:18px;color:var(--accent4)}
    .card p{margin:0;color:rgba(6,6,10,0.66)}
    .card .icon{width:44px;height:44px;border-radius:10px;background:linear-gradient(90deg,var(--accent1),var(--accent2));display:inline-flex;align-items:center;justify-content:center;color:var(--white);margin-bottom:12px;box-shadow:0 8px 18px rgba(124,78,201,0.12)}

    /* placeholder visuals */
    .module-visual, .os-visual{width:100%;height:140px;border-radius:10px;overflow:hidden;background:linear-gradient(135deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));display:flex;align-items:center;justify-content:center;margin-bottom:12px}
    .module-visual svg, .os-visual svg{width:100%;height:100%;object-fit:cover;display:block}
    .placeholder-img{width:100%;height:100%;display:block;background:linear-gradient(90deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));color:rgba(255,255,255,0.65);font-weight:700;display:flex;align-items:center;justify-content:center}

    footer{padding:36px 4%;color:var(--muted);font-size:14px}

    /* responsive */
    @media(max-width:900px){
      .hero{grid-template-columns:1fr;gap:28px}
      .mock-screen{height:260px}
      nav{display:none}
    }

    /* small decorative blobs */
    .blob{position:fixed;border-radius:50%;filter:blur(28px);opacity:0.55;pointer-events:none;z-index:-1}
    .blob.one{width:260px;height:260px;left:-60px;top:10%;background:linear-gradient(180deg,var(--accent1),var(--accent3));animation:blob-move 18s infinite}
    .blob.two{width:220px;height:220px;right:-40px;bottom:10%;background:linear-gradient(180deg,var(--accent4),var(--accent2));animation:blob-move 22s infinite reverse}
    @keyframes blob-move{0%{transform:translateY(0) scale(1)}50%{transform:translateY(30px) scale(1.06)}100%{transform:translateY(0) scale(1)}}
    /* logo carousel layout */
    .logo-track{position:relative}
    .logo-track .logo-row{display:flex;align-items:center;gap:28px;padding:6px 0}
    .logo-blob{font-weight:700;color:rgba(255,255,255,0.9)}
  </style>
</head>
<body>
  <div class="blob one" aria-hidden="true"></div>
  <div class="blob two" aria-hidden="true"></div>
  <header>
    <div class="logo"><span class="mark"></span><span>Eventy Test</span></div>
    <nav>
      <a href="#">Platform</a>
      <a href="#features">Features</a>
      <a href="#pricing">Pricing</a>
      <button class="btn-cta">Get started</button>
    </nav>
  </header>

  <main>
    <section class="hero">
      <div class="panel">
        <h1>Create memorable events that scale</h1>
        <p>Modern event platform for hybrid and live experiences. Build beautiful pages, manage registrations, and engage attendees with powerful tools.</p>
        <div class="actions">
          <button class="btn-cta">Start free</button>
          <button style="background:transparent;border:1px solid rgba(12,8,20,0.06);padding:10px 14px;border-radius:8px;color:var(--text-dark)">Watch demo</button>
        </div>
        <div style="margin-top:18px;display:flex;gap:8px;flex-wrap:wrap">
          <div style="background:linear-gradient(90deg,var(--accent1),var(--accent2));color:var(--white);padding:8px 10px;border-radius:8px;font-weight:600;box-shadow:0 10px 30px rgba(124,78,201,0.08)">Event Pages</div>
          <div style="background:rgba(0,0,0,0.04);color:var(--text-dark);padding:8px 10px;border-radius:8px;font-weight:600">Hybrid</div>
          <div style="background:rgba(0,0,0,0.04);color:var(--text-dark);padding:8px 10px;border-radius:8px;font-weight:600">Onsite</div>
        </div>
      </div>
      <div class="mock-device">
        <div class="mock-screen">
            <div class="event-card">
              <div style="font-weight:700;font-size:16px">Design Conference</div>
              <div style="font-size:13px;opacity:0.95;margin-top:6px">Oct 21 • New York • 1,200 attendees</div>
            </div>
            <!-- stacked placeholder screens to visualize product UI -->
            <div style="position:absolute;right:18px;bottom:18px;display:flex;flex-direction:column;gap:10px">
              <div style="width:130px;height:80px;border-radius:10px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.45);background:linear-gradient(135deg,var(--accent2),var(--accent4));display:flex;align-items:center;justify-content:center;font-weight:700">Schedule</div>
              <div style="width:110px;height:70px;border-radius:10px;overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.35);background:linear-gradient(135deg,var(--accent1),var(--accent3));display:flex;align-items:center;justify-content:center;font-weight:700">Attendees</div>
            </div>
        </div>
      </div>
    </section>

    <section id="features" class="features">
      <div class="card">
        <h3>Custom Pages</h3>
        <p>Build beautiful event pages without code. Flexible sections and modules.</p>
      </div>
      <div class="card">
        <h3>Registration</h3>
        <p>Powerful attendee flows with multi-ticket support and integrations.</p>
      </div>
      <div class="card">
        <h3>Engagement</h3>
        <p>Live polls, Q&A, and networking tools to keep attendees invested.</p>
      </div>
      <div class="card">
        <h3>Analytics</h3>
        <p>Track signups, conversions, and attendee behavior in real time.</p>
      </div>
    </section>
  </main>

  <!-- Product suite / modules similar to original site -->
  <section id="modules" style="padding:48px 4%;background:linear-gradient(180deg,rgba(255,255,255,0.01),transparent);">
    <div style="max-width:1200px;margin:0 auto;">
      <h2 style="font-family:'Playfair Display',serif;font-size:28px;margin-bottom:18px">The Event Experience OS — Product suite</h2>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px">
          <div class="card">
            <div class="icon" aria-hidden>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 8h18M3 12h12M3 16h18" stroke="rgba(255,255,255,0.95)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="module-visual">
              <svg viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="g1" x1="0" x2="1"><stop offset="0" stop-color="#824ED1"/><stop offset="1" stop-color="#6F42C7"/></linearGradient></defs><rect width="600" height="300" fill="url(#g1)"/><text x="50%" y="50%" fill="rgba(255,255,255,0.9)" font-size="28" font-family="Poppins" dominant-baseline="middle" text-anchor="middle">Registration</text></svg>
            </div>
            <h3>Event Registration</h3>
            <p>Flexible ticketing, registration flows, and attendee data capture.</p>
          </div>
        <div class="card">
          <div class="icon" aria-hidden>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="4" width="18" height="6" rx="1" stroke="rgba(255,255,255,0.95)" stroke-width="1.5"/><rect x="3" y="14" width="10" height="6" rx="1" stroke="rgba(255,255,255,0.95)" stroke-width="1.5"/></svg>
          </div>
          <div class="module-visual">
            <svg viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="g2" x1="0" x2="1"><stop offset="0" stop-color="#7A4ECB"/><stop offset="1" stop-color="#824ED1"/></linearGradient></defs><rect width="600" height="300" fill="url(#g2)"/><text x="50%" y="50%" fill="rgba(255,255,255,0.9)" font-size="28" font-family="Poppins" dominant-baseline="middle" text-anchor="middle">Website & Agenda</text></svg>
          </div>
          <h3>Website & Agenda</h3>
          <p>Branded event websites and multi-track agenda editor.</p>
        </div>
        <div class="card">
          <div class="icon" aria-hidden>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="7" y="3" width="10" height="18" rx="2" stroke="rgba(255,255,255,0.95)" stroke-width="1.5"/><circle cx="12" cy="18" r="1" fill="rgba(255,255,255,0.95)"/></svg>
          </div>
          <div class="module-visual">
            <svg viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="g3" x1="0" x2="1"><stop offset="0" stop-color="#6F42C7"/><stop offset="1" stop-color="#4E3C7F"/></linearGradient></defs><rect width="600" height="300" fill="url(#g3)"/><text x="50%" y="50%" fill="rgba(255,255,255,0.9)" font-size="28" font-family="Poppins" dominant-baseline="middle" text-anchor="middle">Mobile App</text></svg>
          </div>
          <h3>Mobile App</h3>
          <p>Engage attendees with a native event app and push notifications.</p>
        </div>
        <div class="card">
          <div class="icon" aria-hidden>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2" stroke="rgba(255,255,255,0.95)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="rgba(255,255,255,0.95)" stroke-width="1.5"/></svg>
          </div>
          <div class="module-visual">
            <svg viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="g4" x1="0" x2="1"><stop offset="0" stop-color="#824ED1"/><stop offset="1" stop-color="#7A4ECB"/></linearGradient></defs><rect width="600" height="300" fill="url(#g4)"/><text x="50%" y="50%" fill="rgba(255,255,255,0.9)" font-size="28" font-family="Poppins" dominant-baseline="middle" text-anchor="middle">Networking</text></svg>
          </div>
          <h3>Event Networking</h3>
          <p>Smart matchmaking and attendee connection tools.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Trusted by / logos carousel (placeholders) -->
  <section id="trusted" style="padding:46px 0;">
    <div style="max-width:1100px;margin:0 auto;text-align:center;color:rgba(255,255,255,0.9)">
      <h3 style="margin-bottom:18px">Trusted by teams worldwide</h3>
      <div class="logo-track" style="overflow:hidden;padding:10px 0;">
        <div class="logo-row" style="display:flex;gap:28px;align-items:center;will-change:transform;">
          <!-- simple SVG placeholders to avoid copying logos -->
          <div class="logo-blob" aria-hidden style="width:120px;height:48px;background:var(--surface-opaque);display:flex;align-items:center;justify-content:center;border-radius:8px;color:var(--text-dark);font-weight:700">Amazon</div>
          <div class="logo-blob" style="width:120px;height:48px;background:var(--surface-opaque);display:flex;align-items:center;justify-content:center;border-radius:8px;color:var(--text-dark);font-weight:700">HubSpot</div>
          <div class="logo-blob" style="width:120px;height:48px;background:var(--surface-opaque);display:flex;align-items:center;justify-content:center;border-radius:8px;color:var(--text-dark);font-weight:700">Bloomberg</div>
          <div class="logo-blob" style="width:120px;height:48px;background:var(--surface-opaque);display:flex;align-items:center;justify-content:center;border-radius:8px;color:var(--text-dark);font-weight:700">FT</div>
          <div class="logo-blob" style="width:120px;height:48px;background:var(--surface-opaque);display:flex;align-items:center;justify-content:center;border-radius:8px;color:var(--text-dark);font-weight:700">WSJ</div>
          <div class="logo-blob" style="width:120px;height:48px;background:var(--surface-opaque);display:flex;align-items:center;justify-content:center;border-radius:8px;color:var(--text-dark);font-weight:700">Time</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials / Why switch -->
  <section id="why" style="padding:56px 4%;">
    <div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 420px;gap:28px;align-items:center">
      <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:28px;margin-bottom:12px">Why teams made the switch</h2>
        <p style="color:rgba(255,255,255,0.88);max-width:56ch">Consolidate tools, streamline operations, and boost ROI with a single platform that handles registration, engagement, and onsite operations.</p>
        <div style="display:flex;gap:12px;margin-top:20px">
          <button class="btn-cta">Request demo</button>
          <button style="background:transparent;border:1px solid rgba(255,255,255,0.06);padding:10px 14px;border-radius:8px;color:var(--white)">Read case studies</button>
        </div>
      </div>
      <div style="background:var(--surface-opaque);padding:18px;border-radius:12px;border:1px solid rgba(12,8,20,0.06)">
        <div class="os-visual" style="margin-bottom:12px">
          <svg viewBox="0 0 900 380" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="osg" x1="0" x2="1"><stop offset="0" stop-color="#7A4ECB"/><stop offset="1" stop-color="#6F42C7"/></linearGradient></defs><rect width="900" height="380" fill="url(#osg)"/><text x="50%" y="50%" fill="rgba(255,255,255,0.95)" font-size="32" font-family="Poppins" dominant-baseline="middle" text-anchor="middle">Event Experience OS — Visual</text></svg>
        </div>
        <blockquote style="margin:0;color:var(--text-dark)">“We scaled our attendee experience and saw immediate lift in engagement.”</blockquote>
        <div style="margin-top:12px;color:rgba(6,6,10,0.72)">— Event Director, ExampleCo</div>
      </div>
    </div>
  </section>
  <footer>
    <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px">
      <div>© <?=date('Y')?> Eventy Test</div>
      <div style="opacity:0.85">Made with your palette — ready to customize</div>
    </div>
  </footer>

  <script>
    // simple reveal on scroll
    const obs = new IntersectionObserver((entries)=>{
      for(const e of entries){
        if(e.isIntersecting){
          e.target.classList.add('visible');
          obs.unobserve(e.target);
        }
      }
    },{threshold:0.12});
    document.querySelectorAll('.card').forEach(c=>obs.observe(c));

    // sticky header on scroll
    const header = document.querySelector('header');
    window.addEventListener('scroll',()=>{
      if(window.scrollY>24) header.classList.add('scrolled'); else header.classList.remove('scrolled');
    });

    // simple logo carousel — clones row to loop
    (function(){
      const row = document.querySelector('.logo-row');
      if(!row) return;
      const speed = 40; // px per second
      // clone to create infinite loop
      const clone = row.cloneNode(true);
      row.parentNode.appendChild(clone);
      let pos = 0;
      let width = row.scrollWidth;
      let raf;
      function step(ts){
        pos += (speed/60); // approx per frame
        if(pos >= width) pos = 0;
        row.parentNode.scrollLeft = pos;
        raf = requestAnimationFrame(step);
      }
      raf = requestAnimationFrame(step);
      // pause on hover
      row.parentNode.addEventListener('mouseenter',()=>{ cancelAnimationFrame(raf); });
      row.parentNode.addEventListener('mouseleave',()=>{ raf = requestAnimationFrame(step); });
    })();

    // small UI micro-interactions
    document.querySelectorAll('.btn-cta').forEach(b=>{
      b.addEventListener('mouseenter',()=>b.style.transform='translateY(-4px) scale(1.02)');
      b.addEventListener('mouseleave',()=>b.style.transform='');
      b.addEventListener('focus',()=>b.style.boxShadow='0 10px 30px rgba(124,78,201,0.18)');
      b.addEventListener('blur',()=>b.style.boxShadow='');
    });
  </script>
</body>
</html>
