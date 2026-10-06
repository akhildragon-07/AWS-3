/**
 * AKHIL RAJAN P - PORTFOLIO JAVASCRIPT
 * Anti-Gravity Particle System, Interactive Modals, Nav, Filters & Form
 */

document.addEventListener('DOMContentLoaded', () => {
  initParticleCanvas();
  initNavigation();
  initScrollProgress();
  initSkillFilters();
  initProjectModals();
  initResumeModal();
  initCopyButtons();
  initContactForm();
  updateCurrentYear();
});

/* --------------------------------------------------------------------------
   1. Interactive Anti-Gravity Canvas Particle System
   -------------------------------------------------------------------------- */
function initParticleCanvas() {
  const canvas = document.getElementById('particle-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let width = (canvas.width = window.innerWidth);
  let height = (canvas.height = window.innerHeight);

  let particles = [];
  const particleCount = Math.min(Math.floor(window.innerWidth / 18), 65);
  const mouse = { x: -1000, y: -1000, radius: 140 };

  window.addEventListener('resize', () => {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
    createParticles();
  });

  window.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  });

  window.addEventListener('mouseleave', () => {
    mouse.x = -1000;
    mouse.y = -1000;
  });

  class Particle {
    constructor() {
      this.x = Math.random() * width;
      this.y = Math.random() * height;
      this.size = Math.random() * 2 + 1;
      this.vx = (Math.random() - 0.5) * 0.6;
      this.vy = (Math.random() - 0.5) * 0.6;
      this.baseColor = Math.random() > 0.4 ? 'rgba(0, 242, 254, ' : 'rgba(99, 102, 241, ';
      this.alpha = Math.random() * 0.5 + 0.2;
    }

    update() {
      this.x += this.vx;
      this.y += this.vy;

      // Wrap edges
      if (this.x < 0) this.x = width;
      if (this.x > width) this.x = 0;
      if (this.y < 0) this.y = height;
      if (this.y > height) this.y = 0;

      // Mouse repulsion / Anti-gravity float
      const dx = mouse.x - this.x;
      const dy = mouse.y - this.y;
      const distance = Math.sqrt(dx * dx + dy * dy);

      if (distance < mouse.radius) {
        const force = (mouse.radius - distance) / mouse.radius;
        const angle = Math.atan2(dy, dx);
        this.x -= Math.cos(angle) * force * 3;
        this.y -= Math.sin(angle) * force * 3;
      }
    }

    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fillStyle = this.baseColor + this.alpha + ')';
      ctx.shadowBlur = 8;
      ctx.shadowColor = '#00f2fe';
      ctx.fill();
    }
  }

  function createParticles() {
    particles = [];
    for (let i = 0; i < particleCount; i++) {
      particles.push(new Particle());
    }
  }

  function connectParticles() {
    const maxDist = 120;
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < maxDist) {
          const alpha = (1 - dist / maxDist) * 0.15;
          ctx.strokeStyle = `rgba(0, 242, 254, ${alpha})`;
          ctx.lineWidth = 0.8;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.stroke();
        }
      }
    }
  }

  createParticles();

  function animate() {
    ctx.clearRect(0, 0, width, height);
    for (let i = 0; i < particles.length; i++) {
      particles[i].update();
      particles[i].draw();
    }
    connectParticles();
    requestAnimationFrame(animate);
  }

  animate();
}

/* --------------------------------------------------------------------------
   2. Scroll Progress Bar
   -------------------------------------------------------------------------- */
function initScrollProgress() {
  const progressBar = document.getElementById('scroll-progress');
  if (!progressBar) return;

  window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    progressBar.style.width = `${progress}%`;
  });
}

/* --------------------------------------------------------------------------
   3. Main Navigation & Mobile Drawer
   -------------------------------------------------------------------------- */
function initNavigation() {
  const mobileBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIconBars = document.getElementById('menu-icon-bars');
  const menuIconClose = document.getElementById('menu-icon-close');

  if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener('click', () => {
      const isOpen = !mobileMenu.classList.contains('hidden');
      if (isOpen) {
        mobileMenu.classList.add('hidden');
        menuIconBars.classList.remove('hidden');
        menuIconClose.classList.add('hidden');
      } else {
        mobileMenu.classList.remove('hidden');
        menuIconBars.classList.add('hidden');
        menuIconClose.classList.remove('hidden');
      }
    });

    // Close mobile menu when any nav item is clicked
    mobileMenu.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        menuIconBars.classList.remove('hidden');
        menuIconClose.classList.add('hidden');
      });
    });
  }

  // Active section highlighting
  const sections = document.querySelectorAll('section[id]');
  const desktopNavLinks = document.querySelectorAll('.nav-link');

  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 120;
      const sectionHeight = section.offsetHeight;
      if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
        current = section.getAttribute('id');
      }
    });

    desktopNavLinks.forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${current}`) {
        link.classList.add('active');
      }
    });
  });
}

/* --------------------------------------------------------------------------
   4. Skill Filter System
   -------------------------------------------------------------------------- */
function initSkillFilters() {
  const filterBtns = document.querySelectorAll('.skill-filter-btn');
  const categoryCards = document.querySelectorAll('.skill-category-card');

  filterBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      filterBtns.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');

      categoryCards.forEach((card) => {
        const category = card.getAttribute('data-category');
        if (filter === 'all' || filter === category) {
          card.style.display = 'flex';
          card.style.opacity = '1';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
}

/* --------------------------------------------------------------------------
   5. Project Architecture Details Modals
   -------------------------------------------------------------------------- */
const PROJECT_DETAILS = {
  'solar-inspection': {
    title: 'AI-Based Drone Solar Panel Inspection System',
    category: 'Computer Vision & Automated Aerial Inspection',
    description: 'An automated aerial inspection platform using Python, FastAPI, OpenCV, SQLAlchemy, and SQLite for defect detection, health scoring, and energy-loss estimation.',
    technologies: ['Python', 'FastAPI', 'OpenCV', 'SQLAlchemy', 'SQLite'],
    modules: [
      {
        name: 'Aerial Image Processing & CV Pipeline',
        desc: 'Leverages OpenCV algorithms to ingest thermal/RGB drone captures, perform geometric rectification, and run contour analysis to identify anomalies such as localized hotspot cracks, physical micro-fractures, and uniform surface soiling.'
      },
      {
        name: 'Health Scoring & Energy-Loss Metric',
        desc: 'Computes continuous quantitative health metrics evaluating panel degradation severity and projects predicted megawatt-hour energy yield deficits over operating cycles.'
      },
      {
        name: 'FastAPI Backend & SQLAlchemy Database',
        desc: 'Exposes high-performance asynchronous REST endpoints for uploading inspection flight imagery, triggering asynchronous defect pipelines, and managing relational inspection records in SQLite via SQLAlchemy ORM models.'
      }
    ],
    github: 'https://github.com/akhildragon-07'
  },
  'travel-sphere': {
    title: 'TravelSphere – Smart Travel Management System',
    category: 'Multi-Role Responsive Web Prototype',
    description: 'Built a responsive HTML/CSS prototype with role-based dashboards for Travelers, Travel Agents, Administrators, and NATPAC Scientists.',
    technologies: ['HTML5', 'CSS3', 'JavaScript', 'Responsive UI', 'Role Architecture'],
    modules: [
      {
        name: 'Traveler Dashboard',
        desc: 'Intuitive self-service booking portal allowing users to plan itineraries, track reservations, and view transport options.'
      },
      {
        name: 'Travel Agent Portal',
        desc: 'Dedicated console for travel agencies to curate customized packages, manage group bookings, and monitor ticketing workflows.'
      },
      {
        name: 'Administrator Console',
        desc: 'Centralized management dashboard for platform configuration, user roles, security audits, and system status.'
      },
      {
        name: 'NATPAC Scientists Portal',
        desc: 'Specialized analytics interface tailored for transport researchers and scientists at NATPAC to evaluate commuter flows, travel patterns, and sustainability metrics.'
      }
    ],
    github: 'https://github.com/akhildragon-07'
  },
  'solar-tracking': {
    title: 'Sun Position Tracking Solar Panel System',
    category: 'Sensor-Based Embedded Automation',
    description: 'Developed a sensor-based automatic solar tracking system to maximize energy generation.',
    technologies: ['Sensors', 'Hardware Automation', 'Solar Energy Optimization', 'Embedded Logic'],
    modules: [
      {
        name: 'Sensor Array & Light Angle Detection',
        desc: 'Utilizes differential light-dependent sensor arrangements to continuously sample incident solar irradiance across multiple axes.'
      },
      {
        name: 'Real-Time Orientation Controller',
        desc: 'Implements precision feedback control loops to dynamically reposition solar photovoltaic surfaces toward optimal sun elevation and azimuth.'
      },
      {
        name: 'Energy Harvest Optimization',
        desc: 'Significantly enhances total daily power generation efficiency compared to fixed-tilt solar installations by eliminating off-axis incident angle losses.'
      }
    ],
    github: 'https://github.com/akhildragon-07'
  }
};

function initProjectModals() {
  const modal = document.getElementById('project-modal');
  const modalContent = document.getElementById('project-modal-content');
  const openButtons = document.querySelectorAll('.open-project-modal');

  if (!modal || !modalContent) return;

  function renderProjectModal(projectId) {
    const data = PROJECT_DETAILS[projectId];
    if (!data) return;

    modalContent.innerHTML = `
      <div class="flex items-start justify-between pb-4 border-b border-slate-800">
        <div>
          <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">${data.category}</span>
          <h3 class="text-xl font-display font-bold text-white mt-1">${data.title}</h3>
        </div>
        <button id="close-project-btn" class="p-1.5 rounded-lg bg-slate-900 text-slate-400 hover:text-white border border-slate-700">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="space-y-4 text-xs font-mono text-slate-300">
        <div>
          <h4 class="text-slate-400 uppercase text-[11px] mb-1">Overview</h4>
          <p class="text-slate-200 text-sm font-sans leading-relaxed">${data.description}</p>
        </div>

        <div>
          <h4 class="text-slate-400 uppercase text-[11px] mb-2">Technology Stack</h4>
          <div class="flex flex-wrap gap-1.5">
            ${data.technologies.map(t => `<span class="tag-tech">${t}</span>`).join('')}
          </div>
        </div>

        <div>
          <h4 class="text-slate-400 uppercase text-[11px] mb-2">Key Modules & Architecture</h4>
          <div class="space-y-2">
            ${data.modules.map(m => `
              <div class="p-3 rounded-lg bg-slate-950 border border-slate-800">
                <div class="text-cyan-300 font-bold text-xs mb-0.5">${m.name}</div>
                <div class="text-slate-300 font-sans text-xs leading-relaxed">${m.desc}</div>
              </div>
            `).join('')}
          </div>
        </div>
      </div>

      <div class="pt-4 border-t border-slate-800 flex items-center justify-between">
        <a href="${data.github}" target="_blank" rel="noopener noreferrer" class="btn-secondary text-xs py-2 px-4">
          <svg class="w-4 h-4 fill-current text-cyan-400" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
          <span>View on GitHub</span>
        </a>

        <button id="modal-bottom-close-btn" class="btn-ghost text-xs py-2 px-4">Close</button>
      </div>
    `;

    // Bind modal close buttons
    const closeBtn = document.getElementById('close-project-btn');
    const bottomCloseBtn = document.getElementById('modal-bottom-close-btn');

    const closeModal = () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    };

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (bottomCloseBtn) bottomCloseBtn.addEventListener('click', closeModal);
  }

  openButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const projectId = btn.getAttribute('data-project');
      renderProjectModal(projectId);
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    });
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });
}

/* --------------------------------------------------------------------------
   6. Resume Modal System
   -------------------------------------------------------------------------- */
function initResumeModal() {
  const modal = document.getElementById('resume-modal');
  const openBtns = [
    document.getElementById('open-resume-btn'),
    document.getElementById('mobile-open-resume-btn')
  ].filter(Boolean);
  const closeBtn = document.getElementById('close-resume-btn');
  const cancelBtn = document.getElementById('modal-cancel-btn');

  if (!modal) return;

  const openModal = (e) => {
    if (e) e.preventDefault();
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  };

  const closeModal = () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  };

  openBtns.forEach((btn) => btn.addEventListener('click', openModal));
  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal();
    }
  });
}

/* --------------------------------------------------------------------------
   7. Copy to Clipboard Utility with Toast
   -------------------------------------------------------------------------- */
function initCopyButtons() {
  const copyButtons = document.querySelectorAll('.copy-btn');
  const toast = document.getElementById('toast');
  const toastMsg = document.getElementById('toast-msg');

  function showToast(msg) {
    if (!toast || !toastMsg) return;
    toastMsg.textContent = msg;
    toast.classList.remove('hidden');
    toast.classList.add('flex');

    setTimeout(() => {
      toast.classList.add('hidden');
      toast.classList.remove('flex');
    }, 2800);
  }

  copyButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const text = btn.getAttribute('data-copy');
      if (text) {
        navigator.clipboard.writeText(text).then(() => {
          showToast(`Copied: ${text}`);
        }).catch(() => {
          // Fallback
          const tempInput = document.createElement('input');
          tempInput.value = text;
          document.body.appendChild(tempInput);
          tempInput.select();
          document.execCommand('copy');
          document.body.removeChild(tempInput);
          showToast(`Copied: ${text}`);
        });
      }
    });
  });
}

/* --------------------------------------------------------------------------
   8. Static Contact Form Mailto Generator
   -------------------------------------------------------------------------- */
function initContactForm() {
  const form = document.getElementById('contact-form');
  const feedback = document.getElementById('form-feedback');

  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();

    if (!name || !email || !subject || !message) return;

    const emailTo = 'akhilvit28@gmail.com';
    const emailSubject = encodeURIComponent(`[Portfolio Contact] ${subject} - from ${name}`);
    const emailBody = encodeURIComponent(
      `Hi Akhil,\n\nName: ${name}\nEmail: ${email}\n\nMessage:\n${message}\n\nSent from your portfolio website.`
    );

    const mailtoUrl = `mailto:${emailTo}?subject=${emailSubject}&body=${emailBody}`;

    if (feedback) {
      feedback.classList.remove('hidden');
    }

    // Trigger user mail client
    window.location.href = mailtoUrl;

    setTimeout(() => {
      form.reset();
      if (feedback) {
        setTimeout(() => feedback.classList.add('hidden'), 5000);
      }
    }, 1000);
  });
}

/* --------------------------------------------------------------------------
   9. Footer Year
   -------------------------------------------------------------------------- */
function updateCurrentYear() {
  const yearEl = document.getElementById('current-year');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }
}
