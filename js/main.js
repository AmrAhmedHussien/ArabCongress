/* Arab Congress – main.js */

/* Navbar scroll */
(function () {
  const nav = document.getElementById('mainNav');
  if (!nav) return;
  function update() { nav.classList.toggle('scrolled', window.scrollY > 60); }
  window.addEventListener('scroll', update, { passive: true });
  update();
})();

/* Modal System */
const MODALS = {
  cairo:       document.getElementById('cairoModal'),
  alex:        document.getElementById('alexModal'),
  coastal:     document.getElementById('coastalModal'),
  luxorAswan:  document.getElementById('luxorAswanModal'),
};

function openModal(key) {
  const modal = MODALS[key];
  if (!modal) return;
  // Close any already-open modal first
  closeAllModals(false);
  modal.classList.add('open');
  document.body.style.overflow = 'hidden';
  modal.scrollTop = 0;
}

function closeAllModals(restoreScroll) {
  if (restoreScroll === undefined) restoreScroll = true;
  Object.values(MODALS).forEach(function (m) {
    if (m) m.classList.remove('open');
  });
  if (restoreScroll) document.body.style.overflow = '';
}

// Close on Escape key
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') closeAllModals();
});

/* Booking Forms */
document.querySelectorAll('.dest-booking-form').forEach(function (form) {
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    handleBookingSubmit(form);
  });
});

function handleBookingSubmit(form) {
  var submitBtn  = form.querySelector('.btn-submit');
  var btnLabel   = form.querySelector('.btn-label');
  var btnSpinner = form.querySelector('.btn-spinner');
  var msgDiv     = form.closest('.form-card').querySelector('.form-msg');

  // --- Client-side validation ---
  var destination = (form.querySelector('[name="destination"]') || {}).value || '';
  var full_name   = (form.querySelector('[name="full_name"]') || {}).value || '';
  var mobile      = (form.querySelector('[name="mobile"]') || {}).value || '';
  var email       = (form.querySelector('[name="email"]') || {}).value || '';
  var date        = (form.querySelector('[name="date"]') || {}).value || '';

  full_name = full_name.trim();
  mobile    = mobile.trim();
  email     = email.trim();
  date      = date.trim();
  destination = destination.trim();

  if (!destination || !full_name || !mobile || !email || !date) {
    showMsg(msgDiv, 'error', 'Please fill in all required fields.');
    return;
  }
  if (!isValidEmail(email)) {
    showMsg(msgDiv, 'error', 'Please enter a valid email address.');
    return;
  }

  // --- Loading state ---
  btnLabel.classList.add('d-none');
  btnSpinner.classList.remove('d-none');
  submitBtn.disabled = true;
  msgDiv.classList.add('d-none');

  fetch('submit_booking.php', {
    method: 'POST',
    body: new FormData(form),
  })
    .then(function (res) {
      if (!res.ok) throw new Error('Network error');
      return res.json();
    })
    .then(function (data) {
      if (data.success) {
        showMsg(msgDiv, 'success', data.message || 'Booking submitted successfully!');
        form.reset();
      } else {
        showMsg(msgDiv, 'error', data.message || 'Something went wrong. Please try again.');
      }
    })
    .catch(function () {
      showMsg(msgDiv, 'error', 'Connection error. Please contact us directly at arabcongress.co@gmail.com');
    })
    .finally(function () {
      btnLabel.classList.remove('d-none');
      btnSpinner.classList.add('d-none');
      submitBtn.disabled = false;
    });
}

function showMsg(el, type, text) {
  el.className = 'form-msg alert mb-4 ' + (type === 'success' ? 'alert-success' : 'alert-danger');
  el.textContent = text;
  el.classList.remove('d-none');
  el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}
