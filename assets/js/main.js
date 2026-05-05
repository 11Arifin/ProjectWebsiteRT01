// ===== NAVBAR SCROLL =====
const navbar = document.getElementById('navbar');
const navHamburger = document.getElementById('navHamburger');
const navMenu = document.getElementById('navMenu');

window.addEventListener('scroll', () => {
  if (window.scrollY > 50) navbar.classList.add('scrolled');
  else navbar.classList.remove('scrolled');

  // Scroll to top visibility
  const scrollTop = document.getElementById('scrollTop');
  if (scrollTop) {
    if (window.scrollY > 400) scrollTop.classList.add('visible');
    else scrollTop.classList.remove('visible');
  }
});

// ===== HAMBURGER MENU =====
if (navHamburger) {
  navHamburger.addEventListener('click', () => {
    navMenu.classList.toggle('open');
    navHamburger.classList.toggle('active');
  });
}

// Close menu on outside click
document.addEventListener('click', (e) => {
  if (navMenu && !navbar.contains(e.target)) {
    navMenu.classList.remove('open');
    navHamburger && navHamburger.classList.remove('active');
  }
});

// ===== SCROLL TO TOP =====
const scrollTopBtn = document.getElementById('scrollTop');
if (scrollTopBtn) {
  scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// ===== ANIMATE ON SCROLL =====
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-fadeInUp').forEach(el => observer.observe(el));

// ===== COUNTER ANIMATION =====
function animateCounter(el) {
  const target = parseInt(el.getAttribute('data-target'));
  const duration = 1500;
  const step = target / (duration / 16);
  let current = 0;

  const timer = setInterval(() => {
    current += step;
    if (current >= target) {
      el.textContent = target;
      clearInterval(timer);
    } else {
      el.textContent = Math.floor(current);
    }
  }, 16);
}

const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      animateCounter(entry.target);
      counterObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('.stat-number[data-target]').forEach(el => counterObserver.observe(el));

// ===== ACTIVE NAV LINK =====
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', function() {
    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
    this.classList.add('active');
  });
});
