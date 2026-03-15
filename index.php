<?php
if (file_exists(__DIR__ . '/maintenance.flag')) {
    include __DIR__ . '/maintenance.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Arab Congress – Official organizer of ISPN Conference tourism services in Egypt.">
  <title>Arab Congress – Come To Egypt</title>
  <link rel="icon" type="image/png" href="assets/Cairo/Arab Congress 3D.png.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,900;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-dark fixed-top" id="mainNav">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
    <a class="navbar-brand p-0" href="#">
      <!-- <img src="assets/Cairo/Arab Congress white.png" alt="Arab Congress" height="44"> -->
    </a>
    <div class="d-none d-md-flex align-items-center gap-3">
      <a href="mailto:arabcongress.co@gmail.com" class="nav-email">arabcongress.co@gmail.com</a>
      <a href="https://wa.me/message/56PURZNDQBU6N1" target="_blank" rel="noopener" class="btn btn-outline-light btn-sm px-3">WhatsApp</a>
    </div>
  </div>
</nav>

<!-- ===== HERO ===== -->
<section id="hero" class="hero-section">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h1 class="hero-title">Come To Egypt</h1>
    <div class="hero-title-logo">
      <img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress">
    </div>
    <div class="hero-body">
      <p>We are <strong class="highlight">Arab Congress</strong> for Conference and Exhibition Organization,
         the official organizer of the <strong class="highlight">ISPN</strong> Conference in Egypt.</p>
      <p>Our company is responsible for managing the <strong class="highlight">tourism services</strong>
         related to the conference, including</p>
      <ul>
        <li>Arranging tour programs.</li>
        <li>Transportation within and outside Cairo.</li>
        <li>Hotel accommodations.</li>
        <li>Other related services.</li>
      </ul>
    </div>
    <div class="hero-contact">
      <p><strong>Contact Us: <a href="mailto:arabcongress.co@gmail.com">arabcongress.co@gmail.com</a></strong></p>
      <p><a href="https://wa.me/message/56PURZNDQBU6N1" target="_blank" rel="noopener">WhatsApp: wa.me/message/56PURZNDQBU6N1</a></p>
    </div>
  </div>
  <div class="hero-scroll">
    <span>Explore Destinations</span>
    <div class="scroll-arrow">&#8595;</div>
  </div>
</section>

<!-- ===== DESTINATIONS ===== -->
<section id="destinations" class="destinations-section">
  <div class="container">
    <h2 class="section-title text-center">Choose Your Destination</h2>
    <div class="cities-row">

      <!-- CAIRO -->
      <div class="city-card cairo-card" onclick="openModal('cairo')"
           role="button" tabindex="0" aria-label="Explore Cairo"
           onkeydown="if(event.key==='Enter')openModal('cairo')">
        <div class="city-overlay"></div>
        <span class="cairo-text">CAIRO</span>
        <div class="city-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt=""></div>
        <div class="city-hover-text">Click to Explore</div>
      </div>

      <!-- ALEXANDRIA -->
      <div class="city-card alex-btn-card" onclick="openModal('alex')"
           role="button" tabindex="0" aria-label="Explore Alexandria"
           onkeydown="if(event.key==='Enter')openModal('alex')">
        <div class="city-overlay"></div>
        <span class="alex-clip-text">ALEXANDRIA</span>
        <div class="city-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt=""></div>
        <div class="city-hover-text">Click to Explore</div>
      </div>

      <!-- LUXOR & ASWAN (one combined card) -->
      <div class="city-card la-btn-card" onclick="openModal('luxorAswan')"
           role="button" tabindex="0" aria-label="Explore Luxor and Aswan"
           onkeydown="if(event.key==='Enter')openModal('luxorAswan')">
        <div class="city-overlay"></div>
        <span class="la-clip-text">LUXOR<br>ASWAN</span>
        <div class="city-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt=""></div>
        <div class="city-hover-text">Click to Explore</div>
      </div>

      <!-- COASTAL GEMS -->
      <div class="city-card coastal-btn-card" onclick="openModal('coastal')"
           role="button" tabindex="0" aria-label="Explore Egypt's Coastal Gems"
           onkeydown="if(event.key==='Enter')openModal('coastal')">
        <img src="assets/coastal gems/Coastal GEMS.png.png" alt="Coastal Gems" class="city-img">
        <div class="city-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt=""></div>
        <div class="city-hover-text">Click to Explore</div>
      </div>

      <!-- SPOUSES & PARTNERS PROGRAM -->
      <div class="city-card special-card spouses-card" onclick="openModal('spouses')"
           role="button" tabindex="0" aria-label="Spouses and Partners Program"
           onkeydown="if(event.key==='Enter')openModal('spouses')">
        <div class="city-overlay"></div>
        <div class="special-card-inner">
          <span class="special-card-label">Special Program</span>
          <div class="special-card-title">Spouses &amp;<br>Partners</div>
          <div class="special-card-sub">Program</div>
        </div>
        <div class="city-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt=""></div>
        <div class="city-hover-text">Click to Explore</div>
      </div>

      <!-- CONFERENCE TOUR -->
      <div class="city-card special-card conference-card" onclick="openModal('conference')"
           role="button" tabindex="0" aria-label="Conference Tour October 9th"
           onkeydown="if(event.key==='Enter')openModal('conference')">
        <div class="city-overlay"></div>
        <div class="special-card-inner">
          <span class="special-card-label">Conference Excursion</span>
          <div class="special-card-title">Conference<br>Tour</div>
          <div class="special-card-sub">October 9th</div>
        </div>
        <div class="city-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt=""></div>
        <div class="city-hover-text">Click to Explore</div>
      </div>

    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="site-footer">
  <div class="container text-center">
    <img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress" class="footer-logo">
    <p class="footer-tagline">We are ready to make your experience unforgettable!</p>
    <div class="footer-links">
      <p><a href="mailto:arabcongress.co@gmail.com">arabcongress.co@gmail.com</a></p>
      <p><a href="https://wa.me/message/56PURZNDQBU6N1" target="_blank" rel="noopener">https://wa.me/message/56PURZNDQBU6N1</a></p>
      <p class="footer-mobiles">Mobile: +201050605502 / +201063126206</p>
    </div>
    <p class="footer-copy">&copy; 2025 Arab Congress for Conference and Exhibition Organization. All rights reserved.</p>
  </div>
</footer>

<!-- CAIRO MODAL -->
<div id="cairoModal" class="dest-modal" role="dialog" aria-modal="true" aria-label="Cairo">
  <button class="modal-close-btn" onclick="closeAllModals()" aria-label="Close">&#10005;</button>
  <div class="dest-modal-inner">

    <div class="cairo-hero">
      <div class="cairo-hero-overlay"></div>
      <div class="cairo-hero-text">CAIRO</div>
      <div class="modal-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress"></div>
      <div class="modal-scroll-hint"><span>Scroll to explore</span><div class="scroll-arrow">&#8595;</div></div>
    </div>

    <div class="cairo-info-section">
      <div class="cairo-info-body">
        <h2 class="cairo-section-title">CAIRO</h2>
        <p class="cairo-intro">
          Cairo is a city of endless choices. You can mix and match these<br>
          iconic locations based on your own interests whether you are<br>
          a history buff, a foodie, or an architecture lover!
        </p>
        <ol class="cairo-list">
          <li>The Giza Pyramids &amp; Sphinx</li>
          <li>The Grand Egyptian Museum</li>
          <li>The Citadel of Saladin</li>
          <li>Al-Muizz Street</li>
          <li>Khan el-Khalili Bazaar</li>
          <li>The National Museum of Egyptian Civilization</li>
          <li>The Religious Complex</li>
          <li>The Nile River</li>
          <li>Cairo Tower &amp; Downtown</li>
        </ol>
        <p class="cairo-contact-line">
          <strong>Contact Us: <a href="mailto:arabcongress.co@gmail.com" class="dest-link">arabcongress.co@gmail.com</a></strong>
        </p>
      </div>
    </div>

    <div class="cairo-photos-section">
      <div class="cairo-photos-body">
        <div class="photos-grid">
          <div class="photo-card">
            <div class="photo-label"><span>Pyramids</span></div>
            <img src="assets/Cairo/Pyramids.webp" alt="Pyramids" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>G.E.M</span></div>
            <img src="assets/Cairo/G.E.M.jpg" alt="Grand Egyptian Museum" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>Citadel of Saladin</span></div>
            <img src="assets/Cairo/Citadel of Saladin.jpg" alt="Citadel of Saladin" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>Al-Muizz Street</span></div>
            <img src="assets/Cairo/Al-Muizz Street.jpg" alt="Al-Muizz Street" loading="lazy">
          </div>
        </div>
        <p class="cairo-contact-line text-center mt-4">
          <strong>Contact Us: <a href="https://wa.me/message/56PURZNDQBU6N1" target="_blank" rel="noopener" class="dest-link">https://wa.me/message/56PURZNDQBU6N1</a></strong>
        </p>
      </div>
    </div>

    <div class="cairo-photos-section alt-bg">
      <div class="cairo-photos-body">
        <div class="photos-grid">
          <div class="photo-card">
            <div class="photo-label"><span>Khan el-Khalili</span></div>
            <img src="assets/Cairo/Khan el-Khalili.jpg" alt="Khan el-Khalili" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>N.M.E.C</span></div>
            <img src="assets/Cairo/N.M.E.C.jpg" alt="N.M.E.C" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>Religious Complex</span></div>
            <img src="assets/Cairo/Religious Complex.jpg" alt="Religious Complex" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>Nile River</span></div>
            <img src="assets/Cairo/Nile River.jpg" alt="Nile River" loading="lazy">
          </div>
        </div>
        <p class="cairo-contact-line text-center mt-4">
          <strong>Contact Us: <a href="mailto:arabcongress.co@gmail.com" class="dest-link">arabcongress.co@gmail.com</a></strong>
        </p>
      </div>
    </div>

    <div class="modal-form-section">
      <div class="container">
        <h2 class="section-title text-center">Book Your Cairo Tour</h2>
        <p class="form-sub text-center">Reserve your spot for an unforgettable Cairo experience</p>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 col-xl-7">
            <div class="form-card">
              <div class="form-msg d-none alert mb-4" role="alert"></div>
              <form class="dest-booking-form" novalidate>
                <input type="hidden" name="destination" value="Cairo">
                <div class="row g-4">
                  <div class="col-12 col-md-6">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control booking-input" placeholder="Enter your full name" required autocomplete="name">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Mobile Number <span class="required">*</span></label>
                    <input type="tel" name="mobile" class="form-control booking-input" placeholder="+20 XXX XXX XXXX" required autocomplete="tel">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control booking-input" placeholder="your@email.com" required autocomplete="email">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Preferred Date <span class="required">*</span></label>
                    <input type="date" name="date" class="form-control booking-input" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Notes / Special Requests</label>
                    <textarea name="notes" class="form-control booking-input" rows="4" placeholder="Any special requests..."></textarea>
                  </div>
                  <div class="col-12 text-center pt-2">
                    <button type="submit" class="btn-submit">
                      <span class="btn-label">Submit Booking</span>
                      <span class="btn-spinner d-none"><span class="spinner-border spinner-border-sm me-2"></span>Sending...</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- ALEXANDRIA MODAL -->
<div id="alexModal" class="dest-modal" role="dialog" aria-modal="true" aria-label="Alexandria">
  <button class="modal-close-btn" onclick="closeAllModals()" aria-label="Close">&#10005;</button>
  <div class="dest-modal-inner">

    <div class="dest-hero alex-hero">
      <img src="assets/ALEX/ALEX IMAGE.png.png" alt="Alexandria" class="dest-hero-fullimg">
      <div class="modal-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress"></div>
      <div class="modal-scroll-hint"><span>Scroll to explore</span><div class="scroll-arrow">&#8595;</div></div>
    </div>

    <div class="dest-content-section cream-bg">
      <div class="city-strip alex-strip">
        <span class="city-strip-text">ALEXANDRIA</span>
      </div>
      <div class="dest-content-body">
        <div class="photos-grid">
          <div class="photo-card">
            <div class="photo-label"><span>Qaitbay</span></div>
            <img src="assets/ALEX/Qaitbay.png.png" alt="Qaitbay" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>Bibliotheca</span></div>
            <img src="assets/ALEX/Bibliotheca.jpg.jpg" alt="Bibliotheca" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>Montaza Palace</span></div>
            <img src="assets/ALEX/Montaza Palace.png.png" alt="Montaza Palace" loading="lazy">
          </div>
          <div class="photo-card">
            <div class="photo-label"><span>Stanley Bridge</span></div>
            <img src="assets/ALEX/Stanley Bridge.jpg.jpg" alt="Stanley Bridge" loading="lazy">
          </div>
        </div>
        <div class="hotels-block">
          <div class="hotels-heading">
            <h3 class="hotels-title">Hotels</h3>
            <p class="hotels-sub">RECOMMENDATION</p>
          </div>
          <ul class="hotels-list">
            <li>Four Seasons Hotel Alexandria</li>
            <li>Sheraton Montazah Hotel</li>
            <li>Tolip Hotel Royal Alexandria</li>
          </ul>
        </div>
        <p class="cairo-contact-line text-center mt-4">
          <strong>Contact Us: <a href="https://wa.me/message/56PURZNDQBU6N1" target="_blank" rel="noopener" class="dest-link">https://wa.me/message/56PURZNDQBU6N1</a></strong>
        </p>
      </div>
    </div>

    <div class="modal-form-section">
      <div class="container">
        <h2 class="section-title text-center">Book Your Alexandria Tour</h2>
        <p class="form-sub text-center">Reserve your spot for an unforgettable Alexandria experience</p>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 col-xl-7">
            <div class="form-card">
              <div class="form-msg d-none alert mb-4" role="alert"></div>
              <form class="dest-booking-form" novalidate>
                <input type="hidden" name="destination" value="Alexandria">
                <div class="row g-4">
                  <div class="col-12 col-md-6">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control booking-input" placeholder="Enter your full name" required autocomplete="name">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Mobile Number <span class="required">*</span></label>
                    <input type="tel" name="mobile" class="form-control booking-input" placeholder="+20 XXX XXX XXXX" required autocomplete="tel">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control booking-input" placeholder="your@email.com" required autocomplete="email">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Preferred Date <span class="required">*</span></label>
                    <input type="date" name="date" class="form-control booking-input" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Notes / Special Requests</label>
                    <textarea name="notes" class="form-control booking-input" rows="4" placeholder="Any special requests..."></textarea>
                  </div>
                  <div class="col-12 text-center pt-2">
                    <button type="submit" class="btn-submit">
                      <span class="btn-label">Submit Booking</span>
                      <span class="btn-spinner d-none"><span class="spinner-border spinner-border-sm me-2"></span>Sending...</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- COASTAL GEMS MODAL -->
<div id="coastalModal" class="dest-modal" role="dialog" aria-modal="true" aria-label="Egypt's Coastal Gems">
  <button class="modal-close-btn" onclick="closeAllModals()" aria-label="Close">&#10005;</button>
  <div class="dest-modal-inner">

    <div class="dest-hero coastal-hero">
      <img src="assets/coastal gems/Coastal GEMS.png.png" alt="Egypt's Coastal Gems" class="dest-hero-fullimg">
      <div class="modal-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress"></div>
      <div class="modal-scroll-hint"><span>Scroll to explore</span><div class="scroll-arrow">&#8595;</div></div>
    </div>

    <div class="coastal-dest-section">
      <div class="coastal-dest-img-wrap">
        <img src="assets/coastal gems/Sharm El-sheikh.jpg.jpg" alt="Sharm El-Sheikh" loading="lazy">
      </div>
      <div class="coastal-dest-info">
        <h3 class="coastal-dest-title">Sharm El-Sheikh</h3>
        <p class="coastal-dest-sub">A National Geographic &amp; Luxury Escapes Exclusive Destination</p>
        <div class="hotels-block inline">
          <div class="hotels-heading">
            <h3 class="hotels-title">Hotels</h3>
            <p class="hotels-sub">RECOMMENDATION</p>
          </div>
          <ul class="hotels-list">
            <li>Concorde El Salam</li>
            <li>Savoy Hotel</li>
            <li>Dreams Resorts</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="coastal-dest-section alt">
      <div class="coastal-dest-img-wrap">
        <img src="assets/coastal gems/Hurghada.jpg.jpg" alt="Hurghada" loading="lazy">
      </div>
      <div class="coastal-dest-info">
        <h3 class="coastal-dest-title">Hurghada</h3>
        <p class="coastal-dest-sub">Red Sea's Gem – Egypt</p>
        <div class="hotels-block inline">
          <div class="hotels-heading">
            <h3 class="hotels-title">Hotels</h3>
            <p class="hotels-sub">RECOMMENDATION</p>
          </div>
          <ul class="hotels-list">
            <li>Hurghada Marriott Beach Resort</li>
            <li>Continental Hotel Hurghada</li>
            <li>Desert Rose Hotels Hurghada</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="coastal-dest-section">
      <div class="coastal-dest-img-wrap">
        <img src="assets/coastal gems/EL GOUNA.jpg.jpg" alt="El Gouna" loading="lazy">
      </div>
      <div class="coastal-dest-info">
        <h3 class="coastal-dest-title">El Gouna</h3>
        <p class="coastal-dest-sub">Red Sea, Egypt</p>
        <div class="hotels-block inline">
          <div class="hotels-heading">
            <h3 class="hotels-title">Hotels</h3>
            <p class="hotels-sub">RECOMMENDATION</p>
          </div>
          <ul class="hotels-list">
            <li>Doubletree by Hilton</li>
            <li>Steigenberger Golf Resort El Gouna</li>
            <li>M&ouml;venpick Resort &amp; Spa El Gouna</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="coastal-dest-section alt">
      <div class="coastal-dest-img-wrap">
        <img src="assets/coastal gems/AIN SOKHNA.jpg.jpg" alt="Ain Sokhna" loading="lazy">
      </div>
      <div class="coastal-dest-info">
        <h3 class="coastal-dest-title">Ain Sokhna</h3>
        <p class="coastal-dest-sub">Gateway to the Red Sea</p>
        <div class="hotels-block inline">
          <div class="hotels-heading">
            <h3 class="hotels-title">Hotels</h3>
            <p class="hotels-sub">RECOMMENDATION</p>
          </div>
          <ul class="hotels-list">
            <li>Porto Sokhna Beach</li>
            <li>M&ouml;venpick El Sokhna</li>
            <li>Stella Di Mare Grand Hotel</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="modal-form-section">
      <div class="container">
        <h2 class="section-title text-center">Book Your Coastal Tour</h2>
        <p class="form-sub text-center">Reserve your spot at Egypt's most stunning coastal destinations</p>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 col-xl-7">
            <div class="form-card">
              <div class="form-msg d-none alert mb-4" role="alert"></div>
              <form class="dest-booking-form" novalidate>
                <div class="row g-4">
                  <div class="col-12">
                    <label class="form-label">Destination <span class="required">*</span></label>
                    <select name="destination" class="form-control booking-input" required>
                      <option value="" disabled selected>Select your destination</option>
                      <option value="Sharm El-Sheikh">Sharm El-Sheikh</option>
                      <option value="Hurghada">Hurghada</option>
                      <option value="El-Gouna">El-Gouna</option>
                      <option value="Ain Sokhna">Ain Sokhna</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control booking-input" placeholder="Enter your full name" required autocomplete="name">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Mobile Number <span class="required">*</span></label>
                    <input type="tel" name="mobile" class="form-control booking-input" placeholder="+20 XXX XXX XXXX" required autocomplete="tel">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control booking-input" placeholder="your@email.com" required autocomplete="email">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Preferred Date <span class="required">*</span></label>
                    <input type="date" name="date" class="form-control booking-input" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Notes / Special Requests</label>
                    <textarea name="notes" class="form-control booking-input" rows="4" placeholder="Any special requests..."></textarea>
                  </div>
                  <div class="col-12 text-center pt-2">
                    <button type="submit" class="btn-submit">
                      <span class="btn-label">Submit Booking</span>
                      <span class="btn-spinner d-none"><span class="spinner-border spinner-border-sm me-2"></span>Sending...</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- LUXOR & ASWAN MODAL -->
<div id="luxorAswanModal" class="dest-modal" role="dialog" aria-modal="true" aria-label="Luxor and Aswan">
  <button class="modal-close-btn" onclick="closeAllModals()" aria-label="Close">&#10005;</button>
  <div class="dest-modal-inner">

    <div class="la-hero">
      <div class="la-half luxor-half">
        <div class="la-overlay"></div>
        <h2 class="la-title luxor-title">LUXOR</h2>
      </div>
      <div class="la-half aswan-half">
        <div class="la-overlay"></div>
        <h2 class="la-title aswan-title">ASWAN</h2>
      </div>
      <div class="modal-brand la-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress"></div>
      <div class="modal-scroll-hint"><span>Scroll to explore</span><div class="scroll-arrow">&#8595;</div></div>
    </div>

    <div class="la-content-section">
      <div class="container-fluid px-0">
        <div class="la-columns">

          <div class="la-col luxor-col">
            <h3 class="la-col-title">LUXOR</h3>
            <div class="photos-grid">
              <div class="photo-card">
                <div class="photo-label"><span>Karnak Temple</span></div>
                <img src="assets/LUXOR/Karnak Temple.jpg" alt="Karnak Temple" loading="lazy">
              </div>
              <div class="photo-card">
                <div class="photo-label"><span>Valley of the Kings</span></div>
                <img src="assets/LUXOR/Valley of the Kings.jpg" alt="Valley of the Kings" loading="lazy">
              </div>
              <div class="photo-card">
                <div class="photo-label"><span>Hatshepsut Temple</span></div>
                <img src="assets/LUXOR/Hatshepsut Temple.jpg" alt="Hatshepsut Temple" loading="lazy">
              </div>
              <div class="photo-card">
                <div class="photo-label"><span>Hot Air Balloon</span></div>
                <img src="assets/LUXOR/Hot Air Balloon Ride.jpg" alt="Hot Air Balloon Ride" loading="lazy">
              </div>
            </div>
            <div class="hotels-block">
              <div class="hotels-heading">
                <h3 class="hotels-title">Hotels</h3>
                <p class="hotels-sub">RECOMMENDATION</p>
              </div>
              <ul class="hotels-list">
                <li>Jolie Ville Luxor</li>
                <li>Sonesta St. George Hotel</li>
                <li>Aracan Eatabe Luxor</li>
              </ul>
            </div>
          </div>

          <div class="la-col aswan-col">
            <h3 class="la-col-title">ASWAN</h3>
            <div class="photos-grid">
              <div class="photo-card">
                <div class="photo-label"><span>Philae Temple</span></div>
                <img src="assets/Aswan/Philae Temple.jpg" alt="Philae Temple" loading="lazy">
              </div>
              <div class="photo-card">
                <div class="photo-label"><span>Abu Simbel Temples</span></div>
                <img src="assets/Aswan/Abu Simbel Temples.jpg" alt="Abu Simbel Temples" loading="lazy">
              </div>
              <div class="photo-card">
                <div class="photo-label"><span>Nubian Village</span></div>
                <img src="assets/Aswan/Nubian Village.jpg" alt="Nubian Village" loading="lazy">
              </div>
              <div class="photo-card">
                <div class="photo-label"><span>Felucca at Sunset</span></div>
                <img src="assets/Aswan/Felucca Ride at Sunset.jpg" alt="Felucca Ride at Sunset" loading="lazy">
              </div>
            </div>
            <div class="hotels-block">
              <div class="hotels-heading">
                <h3 class="hotels-title">Hotels</h3>
                <p class="hotels-sub">RECOMMENDATION</p>
              </div>
              <ul class="hotels-list">
                <li>Pyramisa Island Hotel</li>
                <li>Sofitel Legend Old Cataract</li>
                <li>Basma Executive Club</li>
              </ul>
            </div>
          </div>

        </div>
        <p class="cairo-contact-line text-center py-4">
          <strong>Contact Us: <a href="mailto:arabcongress.co@gmail.com" class="dest-link">arabcongress.co@gmail.com</a>
          &nbsp;|&nbsp; <a href="https://wa.me/message/56PURZNDQBU6N1" target="_blank" rel="noopener" class="dest-link">WhatsApp</a></strong>
        </p>
      </div>
    </div>

    <div class="modal-form-section">
      <div class="container">
        <h2 class="section-title text-center">Book Your Luxor &amp; Aswan Tour</h2>
        <p class="form-sub text-center">Explore the ancient wonders of Upper Egypt</p>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 col-xl-7">
            <div class="form-card">
              <div class="form-msg d-none alert mb-4" role="alert"></div>
              <form class="dest-booking-form" novalidate>
                <input type="hidden" name="destination" value="Luxor & Aswan">
                <div class="row g-4">
                  <div class="col-12 col-md-6">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control booking-input" placeholder="Enter your full name" required autocomplete="name">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Mobile Number <span class="required">*</span></label>
                    <input type="tel" name="mobile" class="form-control booking-input" placeholder="+20 XXX XXX XXXX" required autocomplete="tel">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control booking-input" placeholder="your@email.com" required autocomplete="email">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Preferred Date <span class="required">*</span></label>
                    <input type="date" name="date" class="form-control booking-input" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Notes / Special Requests</label>
                    <textarea name="notes" class="form-control booking-input" rows="4" placeholder="Any special requests..."></textarea>
                  </div>
                  <div class="col-12 text-center pt-2">
                    <button type="submit" class="btn-submit">
                      <span class="btn-label">Submit Booking</span>
                      <span class="btn-spinner d-none"><span class="spinner-border spinner-border-sm me-2"></span>Sending...</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- SPOUSES & PARTNERS MODAL -->
<div id="spousesModal" class="dest-modal" role="dialog" aria-modal="true" aria-label="Spouses and Partners Program">
  <button class="modal-close-btn" onclick="closeAllModals()" aria-label="Close">&#10005;</button>
  <div class="dest-modal-inner">

    <!-- Hero -->
    <div class="spouses-hero">
      <div class="special-hero-overlay"></div>
      <h1 class="special-hero-title">SPOUSES &amp; PARTNERS</h1>
      <p class="special-hero-sub">Program</p>
      <div class="modal-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress"></div>
      <div class="modal-scroll-hint"><span>Scroll to explore</span><div class="scroll-arrow">&#8595;</div></div>
    </div>

    <!-- Tour Selection -->
    <div class="tour-select-section">
      <div class="text-center mb-2">
        <h2 class="tour-select-heading">Select Your Tours</h2>
        <p class="tour-select-note">Oct. 9 Conference Tour is mandatory for all attendees</p>
      </div>
      <div class="tour-cards-grid">

        <!-- Oct 7 -->
        <label class="tour-select-card" for="tour_oct7">
          <div class="tour-select-card-body">
            <span class="tour-date-badge">Oct 7</span>
            <div class="tour-name">National Museum of Egyptian Civilization</div>
            <div class="tour-desc">A journey through Egyptian history.</div>
          </div>
          <input id="tour_oct7" type="checkbox" name="selected_tours[]" value="Oct 7 – National Museum" class="tour-checkbox" form="spousesForm">
        </label>

        <!-- Oct 8 -->
        <label class="tour-select-card" for="tour_oct8">
          <div class="tour-select-card-body">
            <span class="tour-date-badge">Oct 8</span>
            <div class="tour-name">Nile Dinner Cruise</div>
            <div class="tour-desc">An evening of dining and folklore on the Nile.</div>
          </div>
          <input id="tour_oct8" type="checkbox" name="selected_tours[]" value="Oct 8 – Nile Dinner Cruise" class="tour-checkbox" form="spousesForm">
        </label>

        <!-- Oct 9 – Mandatory -->
        <label class="tour-select-card mandatory" for="tour_oct9_display">
          <div class="tour-select-card-body">
            <span class="tour-date-badge">Oct 9</span>
            <div class="tour-name">Conference Tour</div>
            <div class="tour-desc">Joining the main conference excursion.</div>
            <span class="tour-mandatory-badge">Mandatory</span>
          </div>
          <input id="tour_oct9_display" type="checkbox" class="tour-checkbox" checked disabled aria-hidden="true">
        </label>
        <!-- Hidden input always submits the mandatory Oct 9 value -->
        <input type="hidden" name="selected_tours[]" value="Oct 9 – Conference Tour (Mandatory)" form="spousesForm">

        <!-- Oct 10 -->
        <label class="tour-select-card" for="tour_oct10">
          <div class="tour-select-card-body">
            <span class="tour-date-badge">Oct 10</span>
            <div class="tour-name">Salah El-Din Citadel</div>
            <div class="tour-desc">Exploring Islamic Cairo and the Alabaster Mosque.</div>
          </div>
          <input id="tour_oct10" type="checkbox" name="selected_tours[]" value="Oct 10 – Salah El-Din Citadel" class="tour-checkbox" form="spousesForm">
        </label>

      </div>
    </div>

    <!-- Booking Form -->
    <div class="modal-form-section">
      <div class="container">
        <h2 class="section-title text-center">Register for the Program</h2>
        <p class="form-sub text-center">Complete your registration below</p>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 col-xl-7">
            <div class="form-card">
              <div class="form-msg d-none alert mb-4" role="alert"></div>
              <form id="spousesForm" class="dest-booking-form" data-form-type="spouses" novalidate>
                <input type="hidden" name="type" value="spouses_program">
                <input type="hidden" name="destination" value="Spouses &amp; Partners Program">
                <div class="row g-4">
                  <div class="col-12 col-md-6">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control booking-input" placeholder="Enter your full name" required autocomplete="name">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Mobile Number <span class="required">*</span></label>
                    <input type="tel" name="mobile" class="form-control booking-input" placeholder="+20 XXX XXX XXXX" required autocomplete="tel">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control booking-input" placeholder="your@email.com" required autocomplete="email">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Notes / Special Requests</label>
                    <textarea name="notes" class="form-control booking-input" rows="4" placeholder="Any special requests..."></textarea>
                  </div>
                  <div class="col-12 text-center pt-2">
                    <button type="submit" class="btn-submit">
                      <span class="btn-label">Submit Registration</span>
                      <span class="btn-spinner d-none"><span class="spinner-border spinner-border-sm me-2"></span>Sending...</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- CONFERENCE TOUR MODAL -->
<div id="conferenceModal" class="dest-modal" role="dialog" aria-modal="true" aria-label="Conference Tour October 9th">
  <button class="modal-close-btn" onclick="closeAllModals()" aria-label="Close">&#10005;</button>
  <div class="dest-modal-inner">

    <!-- Hero -->
    <div class="conference-hero">
      <div class="special-hero-overlay"></div>
      <h1 class="special-hero-title">CONFERENCE TOUR</h1>
      <p class="special-hero-sub">October 9th, 2024</p>
      <div class="modal-brand"><img src="assets/Cairo/Arab Congress 3D.png.png" alt="Arab Congress"></div>
      <div class="modal-scroll-hint"><span>Scroll to explore</span><div class="scroll-arrow">&#8595;</div></div>
    </div>

    <!-- Tour Options -->
    <div class="conf-options-section">
      <div class="text-center mb-2">
        <h2 class="conf-options-heading">Choose Your Tour</h2>
      </div>
      <div class="conf-options-note mx-auto">Please select only one tour option for this day.</div>
      <div class="conf-options-grid">

        <!-- Option 1: Giza Pyramids & Sphinx -->
        <div class="conf-option-card">
          <label for="opt1" style="display:block;cursor:pointer;margin:0;">
            <img src="assets/Cairo/Pyramids.webp" alt="Giza Pyramids" class="conf-option-img">
            <div class="conf-option-body">
              <div class="conf-option-title">Giza Pyramids &amp; Sphinx</div>
              <span class="conf-time-badge">10:00 AM – 1:00 PM</span>
              <p class="conf-option-desc">Visit the Great Pyramids (Khufu, Khafre, Menkaure) and the Sphinx, followed by lunch.</p>
              <div class="conf-option-radio-row">
                <input type="radio" name="conf_tour_option" value="Giza Pyramids &amp; Sphinx" id="opt1" form="conferenceForm">
                <label for="opt1">Select this option</label>
              </div>
            </div>
          </label>
        </div>

        <!-- Option 2: Grand Egyptian Museum -->
        <div class="conf-option-card">
          <label for="opt2" style="display:block;cursor:pointer;margin:0;">
            <img src="assets/Cairo/G.E.M.jpg" alt="Grand Egyptian Museum" class="conf-option-img">
            <div class="conf-option-body">
              <div class="conf-option-title">The Grand Egyptian Museum</div>
              <span class="conf-time-badge">11:00 AM – 1:00 PM</span>
              <p class="conf-option-desc">A guided tour inside the world's largest archaeological museum, followed by lunch.</p>
              <div class="conf-option-radio-row">
                <input type="radio" name="conf_tour_option" value="Grand Egyptian Museum (GEM)" id="opt2" form="conferenceForm">
                <label for="opt2">Select this option</label>
              </div>
            </div>
          </label>
        </div>

      </div>
    </div>

    <!-- Booking Form -->
    <div class="modal-form-section">
      <div class="container">
        <h2 class="section-title text-center">Book Your Conference Tour</h2>
        <p class="form-sub text-center">October 9th – Select your preferred excursion above</p>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8 col-xl-7">
            <div class="form-card">
              <div class="form-msg d-none alert mb-4" role="alert"></div>
              <form id="conferenceForm" class="dest-booking-form" data-form-type="conference" novalidate>
                <input type="hidden" name="type" value="conference_tour">
                <input type="hidden" name="destination" value="">
                <div class="row g-4">
                  <div class="col-12 col-md-6">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control booking-input" placeholder="Enter your full name" required autocomplete="name">
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label">Mobile Number <span class="required">*</span></label>
                    <input type="tel" name="mobile" class="form-control booking-input" placeholder="+20 XXX XXX XXXX" required autocomplete="tel">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control booking-input" placeholder="your@email.com" required autocomplete="email">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Notes / Special Requests</label>
                    <textarea name="notes" class="form-control booking-input" rows="4" placeholder="Any special requests..."></textarea>
                  </div>
                  <div class="col-12 text-center pt-2">
                    <button type="submit" class="btn-submit">
                      <span class="btn-label">Submit Booking</span>
                      <span class="btn-spinner d-none"><span class="spinner-border spinner-border-sm me-2"></span>Sending...</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
