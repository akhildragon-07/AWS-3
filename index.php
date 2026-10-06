<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>Akhil Rajan P | Software Engineer & AI/ML Developer</title>
  <meta name="title" content="Akhil Rajan P | Software Engineer & AI/ML Developer">
  <meta name="description" content="Official portfolio of Akhil Rajan P - Third-year B.Tech CSE (AI & ML) student at VIT-AP University. Hands-on experience in Agentic AI, Computer Vision, FastAPI, and Backend Development.">
  <meta name="keywords" content="Akhil Rajan P, Portfolio, Software Engineering, AI/ML, Agentic AI, Computer Vision, FastAPI, VIT-AP, Python, Developer, S3 Static Website">
  <meta name="author" content="Akhil Rajan P">
  <meta name="theme-color" content="#07090e">
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://github.com/akhildragon-07">
  <meta property="og:title" content="Akhil Rajan P | Software Engineer & AI/ML Developer">
  <meta property="og:description" content="Third-year B.Tech CSE (AI & ML) student at VIT-AP University. Experienced in Agentic AI, Computer Vision, FastAPI, and Backend Development.">
  
  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Akhil Rajan P | Software Engineer & AI/ML Developer">
  <meta property="twitter:description" content="Third-year B.Tech CSE (AI & ML) student at VIT-AP University. Experienced in Agentic AI, Computer Vision, FastAPI, and Backend Development.">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Tailwind CSS CDN for instant static utility rendering without build steps -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            space: '#07090e',
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            display: ['Space Grotesk', 'sans-serif'],
            mono: ['JetBrains Mono', 'monospace'],
          }
        }
      }
    }
  </script>

  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="./style.css">
  
  <!-- Favicon / Brand SVG -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚡</text></svg>">
</head>
<body class="bg-space text-slate-100 font-sans antialiased overflow-x-hidden selection:bg-cyan-500/30 selection:text-cyan-200">

  <!-- Top Scroll Progress Indicator -->
  <div id="scroll-progress" class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-cyan-400 via-indigo-500 to-purple-500 z-50 transition-all duration-75 w-0"></div>

  <!-- Background Ambient Glows & Interactive Canvas -->
  <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
    <canvas id="particle-canvas" class="absolute inset-0 w-full h-full opacity-60"></canvas>
    <div class="ambient-glow glow-1"></div>
    <div class="ambient-glow glow-2"></div>
    <div class="ambient-glow glow-3"></div>
    <div class="cyber-grid"></div>
  </div>

  <!-- Main Navigation Bar -->
  <header id="navbar" class="fixed top-0 left-0 right-0 z-40 transition-all duration-300 backdrop-blur-md bg-slate-950/70 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      
      <!-- Brand Logo -->
      <a href="#hero" class="group flex items-center gap-3 text-decoration-none">
        <div class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-cyan-500/20 to-purple-600/20 border border-cyan-500/40 group-hover:border-cyan-400 transition-all duration-300 shadow-glow-sm">
          <span class="font-mono font-bold text-lg text-cyan-400 group-hover:scale-110 transition-transform">AR</span>
          <span class="absolute -top-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
          </span>
        </div>
        <div class="flex flex-col">
          <span class="font-display font-bold text-slate-100 text-base tracking-wide group-hover:text-cyan-300 transition-colors">AKHIL RAJAN P</span>
          <span class="font-mono text-[11px] text-slate-400 flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> AWS Cloud Portfolio
          </span>
        </div>
      </a>

      <!-- Desktop Navigation Links -->
      <nav class="hidden md:flex items-center gap-1 lg:gap-1.5 text-xs">
        <a href="#hero" class="nav-link">Home</a>
        <a href="#about" class="nav-link">About</a>
        <a href="#education" class="nav-link">Education</a>
        <a href="#projects" class="nav-link">Projects</a>
        <a href="#experience" class="nav-link">Experience</a>
        <a href="skills.php" class="nav-link text-purple-300 hover:text-purple-200">Skills</a>
        <a href="academic.php" class="nav-link text-cyan-300 hover:text-cyan-200 font-semibold">Academic Records</a>
        <a href="#certifications" class="nav-link">Certifications</a>
        <a href="#contact" class="nav-link">Contact</a>
      </nav>

      <!-- Action Buttons -->
      <div class="hidden xl:flex items-center gap-2">
        <a href="academic.php" class="btn-secondary text-xs font-mono py-1.5 px-3 border-cyan-500/40 text-cyan-300 hover:text-white" title="Query Amazon RDS MySQL">
          <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
          </svg>
          RDS Academic
        </a>
        <a href="skills.php" class="btn-secondary text-xs font-mono py-1.5 px-3 border-purple-500/40 text-purple-300 hover:text-white" title="Query Amazon DynamoDB">
          <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          DynamoDB
        </a>
      </div>

      <!-- Mobile Hamburger Button -->
      <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg bg-slate-900/80 border border-slate-700/60 text-slate-300 hover:text-cyan-400 focus:outline-none" aria-label="Toggle menu">
        <svg id="menu-icon-bars" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
        </svg>
        <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-slate-950/95 border-b border-slate-800 backdrop-blur-xl px-4 pt-3 pb-6 space-y-2">
      <a href="#hero" class="mobile-nav-link">Home</a>
      <a href="#about" class="mobile-nav-link">About</a>
      <a href="#education" class="mobile-nav-link">Education</a>
      <a href="#projects" class="mobile-nav-link">Projects</a>
      <a href="#experience" class="mobile-nav-link">Experience</a>
      <a href="skills.php" class="mobile-nav-link text-purple-300 font-semibold">Skills (DynamoDB)</a>
      <a href="academic.php" class="mobile-nav-link text-cyan-300 font-semibold">Academic Records (RDS)</a>
      <a href="#certifications" class="mobile-nav-link">Certifications</a>
      <a href="#contact" class="mobile-nav-link">Contact</a>
      <div class="pt-3 flex flex-col gap-2">
        <a href="academic.php" class="btn-secondary w-full justify-center py-2.5 text-xs font-mono border-cyan-500/40 text-cyan-300">
          <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
          </svg>
          Academic Records (Amazon RDS)
        </a>
        <a href="skills.php" class="btn-secondary w-full justify-center py-2.5 text-xs font-mono border-purple-500/40 text-purple-300">
          <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          Skills &amp; Certs (Amazon DynamoDB)
        </a>
      </div>
    </div>
  </header>

  <!-- Main Content Wrapper -->
  <main class="relative z-10 pt-20">

    <!-- HERO SECTION -->
    <section id="hero" class="relative min-h-[92vh] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-16">
      <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <!-- Left Hero Content -->
        <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
          
          <!-- Futuristic Status Pill -->
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-950/60 border border-cyan-500/30 text-cyan-300 text-xs font-mono shadow-glow-xs animate-float-slow">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
            <span>B.Tech CSE (AI &amp; ML) &bull; VIT-AP University</span>
          </div>

          <!-- Main Hero Heading -->
          <div class="space-y-2">
            <p class="text-xs sm:text-sm font-mono text-slate-400 tracking-widest uppercase">Hi, I'm</p>
            <h1 class="text-4xl sm:text-6xl xl:text-7xl font-display font-extrabold tracking-tight text-white leading-none">
              <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-100 to-slate-400">AKHIL</span>
              <span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-indigo-400 to-purple-400"> RAJAN P</span>
            </h1>
            <p class="text-lg sm:text-xl font-medium text-cyan-300/90 font-display">
              Software Engineer &bull; Agentic AI &amp; Backend Developer
            </p>
          </div>

          <!-- Aspiration & Summary Paragraph -->
          <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 font-light">
            Third-year B.Tech CSE (AI &amp; ML) student with hands-on expertise in <span class="text-cyan-300 font-medium">Agentic AI</span>, <span class="text-cyan-300 font-medium">Computer Vision</span>, <span class="text-cyan-300 font-medium">FastAPI</span>, and backend architecture. Aspiring to build high-scale, resilient software solutions and real-world AI applications.
          </p>

          <!-- CTAs -->
          <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-2">
            <a href="academic.php" class="btn-primary">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
              </svg>
              <span>RDS Academic Records</span>
            </a>

            <a href="skills.php" class="btn-secondary border-purple-500/50 text-purple-300 hover:text-white">
              <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
              <span>DynamoDB Skills</span>
            </a>
            
            <a href="#projects" class="btn-ghost">
              <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
              </svg>
              <span>Projects</span>
            </a>

            <a href="assets/resume/Akhil_Rajan_P_Resume.pdf" download="Akhil_Rajan_P_Resume.pdf" class="btn-ghost" id="hero-resume-download">
              <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
              </svg>
              <span>Resume</span>
            </a>
          </div>

          <!-- Quick Metrics Ticker -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-6 border-t border-slate-800/80">
            <div class="glass-card p-3 text-center">
              <div class="text-xl sm:text-2xl font-bold font-mono text-cyan-400">VIT-AP</div>
              <div class="text-[11px] text-slate-400 uppercase tracking-wider font-mono">B.Tech (AI &amp; ML)</div>
            </div>
            <div class="glass-card p-3 text-center">
              <div class="text-xl sm:text-2xl font-bold font-mono text-indigo-400">IBM</div>
              <div class="text-[11px] text-slate-400 uppercase tracking-wider font-mono">Agentic AI Intern</div>
            </div>
            <div class="glass-card p-3 text-center">
              <div class="text-xl sm:text-2xl font-bold font-mono text-emerald-400">AWS RDS</div>
              <div class="text-[11px] text-slate-400 uppercase tracking-wider font-mono">MySQL Academic Data</div>
            </div>
            <div class="glass-card p-3 text-center">
              <div class="text-xl sm:text-2xl font-bold font-mono text-purple-400">DynamoDB</div>
              <div class="text-[11px] text-slate-400 uppercase tracking-wider font-mono">NoSQL Skills Store</div>
            </div>
          </div>

        </div>

        <!-- Right Hero Visual: Holographic Anti-Gravity Terminal & Core Card -->
        <div class="lg:col-span-5 flex justify-center">
          <div class="relative w-full max-w-md">
            
            <!-- Floating Hologram AI Orb in background -->
            <div class="absolute -top-12 -right-8 w-44 h-44 rounded-full bg-gradient-to-tr from-cyan-500/20 to-purple-600/30 blur-2xl animate-pulse pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-8 w-40 h-40 rounded-full bg-gradient-to-br from-indigo-500/20 to-cyan-500/20 blur-2xl animate-pulse pointer-events-none"></div>

            <!-- Terminal Card -->
            <div class="glass-card p-6 relative overflow-hidden border-cyan-500/30 shadow-2xl backdrop-blur-xl animate-float">
              
              <!-- Window Controls Header -->
              <div class="flex items-center justify-between pb-4 border-b border-slate-800">
                <div class="flex items-center gap-2">
                  <span class="w-3 h-3 rounded-full bg-rose-500/80 inline-block"></span>
                  <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block"></span>
                  <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block"></span>
                </div>
                <div class="font-mono text-xs text-slate-400 flex items-center gap-1.5">
                  <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                  </svg>
                  <span>akhil@vit-ap:~</span>
                </div>
                <span class="font-mono text-[10px] px-2 py-0.5 rounded bg-cyan-950 text-cyan-300 border border-cyan-800/60">Live</span>
              </div>

              <!-- Terminal Content -->
              <div class="pt-4 space-y-3 font-mono text-xs text-slate-300">
                <div class="flex items-start gap-2">
                  <span class="text-cyan-400 select-none">&gt;</span>
                  <div>
                    <span class="text-purple-400">whoami</span>
                    <p class="text-slate-100 font-semibold mt-0.5">Akhil Rajan P</p>
                  </div>
                </div>

                <div class="flex items-start gap-2">
                  <span class="text-cyan-400 select-none">&gt;</span>
                  <div>
                    <span class="text-purple-400">cat</span> <span class="text-slate-300">profile.json</span>
                    <div class="mt-1 p-2.5 rounded bg-slate-950/80 border border-slate-800 text-[11px] leading-relaxed text-slate-300 space-y-1">
                      <p><span class="text-cyan-300">"degree"</span>: <span class="text-amber-300">"B.Tech CSE (AI &amp; ML)"</span>,</p>
                      <p><span class="text-cyan-300">"university"</span>: <span class="text-amber-300">"VIT-AP University"</span>,</p>
                      <p><span class="text-cyan-300">"internship"</span>: <span class="text-amber-300">"IBM Agentic AI"</span>,</p>
                      <p><span class="text-cyan-300">"location"</span>: <span class="text-slate-300">"Theni, Tamil Nadu, India"</span></p>
                    </div>
                  </div>
                </div>

                <div class="flex items-start gap-2">
                  <span class="text-cyan-400 select-none">&gt;</span>
                  <div>
                    <span class="text-purple-400">check</span> <span class="text-slate-300">--aspirations</span>
                    <p class="text-emerald-400 mt-0.5 flex items-center gap-1.5">
                      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                      </svg>
                      Software Engineering &bull; AI/ML Solutions
                    </p>
                  </div>
                </div>
              </div>

              <!-- Interactive Quick Actions Inside Card -->
              <div class="mt-5 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs font-mono">
                <a href="https://github.com/akhildragon-07" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-cyan-400 transition-colors flex items-center gap-1.5">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                  <span>akhildragon-07</span>
                </a>
                <a href="https://linkedin.com/in/akhil-rajan-p-978867393" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-cyan-400 transition-colors flex items-center gap-1.5">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                  <span>LinkedIn</span>
                </a>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section>


    <!-- ABOUT SECTION -->
    <section id="about" class="py-24 px-4 sm:px-6 lg:px-8 relative border-t border-slate-800/60">
      <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
          <div class="section-tag">About Me</div>
          <h2 class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight">
            Engineering Foundations &amp; AI Focus
          </h2>
          <p class="text-slate-400 font-light text-base sm:text-lg">
            A snapshot of my background, focus areas, and technical trajectory.
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
          
          <!-- Summary Narrative Card -->
          <div class="lg:col-span-7 glass-card p-8 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                  </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-white">Summary</h3>
              </div>
              
              <p class="text-slate-300 leading-relaxed text-base">
                Third-year <strong class="text-white font-medium">B.Tech CSE (AI &amp; ML)</strong> student at <strong class="text-cyan-300 font-medium">VIT-AP University</strong> with hands-on experience in Agentic AI, Computer Vision, FastAPI, and backend development. Completed an <strong class="text-white font-medium">IBM Agentic AI Internship</strong> and built AI-powered and web applications.
              </p>

              <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-800 space-y-2">
                <div class="flex items-center gap-2 text-cyan-400 font-mono text-xs font-semibold uppercase tracking-wider">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                  <span>Aspiration</span>
                </div>
                <p class="text-slate-300 text-sm italic">
                  "To secure a Software Engineering or AI/ML role where I can build scalable software solutions and contribute to real-world AI applications."
                </p>
              </div>
            </div>

            <!-- Key Metadata Badges -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4 border-t border-slate-800/80 text-xs font-mono">
              <div class="p-3 rounded-lg bg-slate-950/60 border border-slate-800">
                <div class="text-slate-400">Institution</div>
                <div class="text-cyan-300 font-semibold mt-1">VIT-AP University</div>
              </div>
              <div class="p-3 rounded-lg bg-slate-950/60 border border-slate-800">
                <div class="text-slate-400">Specialization</div>
                <div class="text-purple-300 font-semibold mt-1">AI &amp; ML</div>
              </div>
              <div class="p-3 rounded-lg bg-slate-950/60 border border-slate-800">
                <div class="text-slate-400">Origin</div>
                <div class="text-slate-200 font-semibold mt-1">Theni, Tamil Nadu</div>
              </div>
            </div>

          </div>

          <!-- Highlight Core Pillars -->
          <div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
            
            <!-- Pillar 1 -->
            <div class="glass-card p-5 group hover:border-cyan-500/50 transition-all">
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 shrink-0 group-hover:scale-110 transition-transform">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-display font-semibold text-base">Agentic AI &amp; Prompt Engineering</h4>
                  <p class="text-slate-400 text-xs mt-1 leading-relaxed">
                    Trained through the IBM Agentic AI Internship in designing autonomous workflows and developing AI-powered software tools.
                  </p>
                </div>
              </div>
            </div>

            <!-- Pillar 2 -->
            <div class="glass-card p-5 group hover:border-indigo-500/50 transition-all">
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-lg bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shrink-0 group-hover:scale-110 transition-transform">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-display font-semibold text-base">Computer Vision &amp; AI Inspection</h4>
                  <p class="text-slate-400 text-xs mt-1 leading-relaxed">
                    Created automated drone aerial inspection pipelines utilizing OpenCV for defect detection, health scoring, and energy-loss evaluation.
                  </p>
                </div>
              </div>
            </div>

            <!-- Pillar 3 -->
            <div class="glass-card p-5 group hover:border-purple-500/50 transition-all">
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 shrink-0 group-hover:scale-110 transition-transform">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                  </svg>
                </div>
                <div>
                  <h4 class="text-white font-display font-semibold text-base">Backend &amp; Database Architecture</h4>
                  <p class="text-slate-400 text-xs mt-1 leading-relaxed">
                    Proficient in building asynchronous REST APIs with FastAPI, SQLAlchemy ORM, SQLite, and MongoDB.
                  </p>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section>


    <!-- SKILLS SECTION -->
    <section id="skills" class="py-24 px-4 sm:px-6 lg:px-8 relative bg-slate-950/40">
      <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 space-y-3">
          <div class="section-tag">Technical Competencies</div>
          <h2 class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight">
            Skills &amp; Technology Stack
          </h2>
          <p class="text-slate-400 font-light text-base sm:text-lg">
            Core technologies and tools extracted directly from my resume.
          </p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
          <button class="skill-filter-btn active" data-filter="all">All Skills</button>
          <button class="skill-filter-btn" data-filter="languages">Programming</button>
          <button class="skill-filter-btn" data-filter="web-ai">Web &amp; AI</button>
          <button class="skill-filter-btn" data-filter="databases">Databases &amp; ORM</button>
          <button class="skill-filter-btn" data-filter="tools">Developer Tools</button>
        </div>

        <!-- Skills Grid Organized strictly by Resume -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="skills-container">
          
          <!-- Category 1: Programming Languages -->
          <div class="glass-card p-6 flex flex-col justify-between skill-category-card" data-category="languages">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Languages</h3>
                  <span class="text-[11px] font-mono text-slate-400">Core Programming</span>
                </div>
              </div>

              <div class="flex flex-wrap gap-2">
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-cyan-400"></span>Python</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-indigo-400"></span>Java</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-amber-400"></span>JavaScript</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-blue-400"></span>C</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-purple-400"></span>C++</span>
              </div>
            </div>
            
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              5 Languages
            </div>
          </div>

          <!-- Category 2: Web & AI Frameworks -->
          <div class="glass-card p-6 flex flex-col justify-between skill-category-card" data-category="web-ai">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Web &amp; AI</h3>
                  <span class="text-[11px] font-mono text-slate-400">Frameworks &amp; Vision</span>
                </div>
              </div>

              <div class="flex flex-wrap gap-2">
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-emerald-400"></span>FastAPI</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-cyan-400"></span>OpenCV</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-orange-400"></span>HTML</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-blue-400"></span>CSS</span>
              </div>
            </div>
            
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              4 Frameworks / Tech
            </div>
          </div>

          <!-- Category 3: Databases & ORM -->
          <div class="glass-card p-6 flex flex-col justify-between skill-category-card" data-category="databases">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Databases</h3>
                  <span class="text-[11px] font-mono text-slate-400">Storage &amp; ORM</span>
                </div>
              </div>

              <div class="flex flex-wrap gap-2">
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-emerald-500"></span>MongoDB</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-blue-400"></span>SQLite</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-rose-400"></span>SQLAlchemy</span>
              </div>
            </div>
            
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              3 Data Technologies
            </div>
          </div>

          <!-- Category 4: Tools & Platforms -->
          <div class="glass-card p-6 flex flex-col justify-between skill-category-card" data-category="tools">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Developer Tools</h3>
                  <span class="text-[11px] font-mono text-slate-400">Environment &amp; VCS</span>
                </div>
              </div>

              <div class="flex flex-wrap gap-2">
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-orange-500"></span>Git</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-slate-200"></span>GitHub</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-amber-500"></span>Postman</span>
                <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-blue-500"></span>VS Code</span>
              </div>
            </div>
            
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              4 Developer Tools
            </div>
          </div>

        </div>

        <!-- Dynamic DynamoDB Callout Banner -->
        <div class="mt-10 text-center">
          <a href="skills.php" class="btn-secondary border-purple-500/50 text-purple-300 hover:text-white py-3 px-6 shadow-glow-xs">
            <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
            <span>Query Live Skills &amp; Certifications on Amazon DynamoDB &rarr;</span>
          </a>
        </div>

      </div>
    </section>


    <!-- PROJECTS SECTION -->
    <section id="projects" class="py-24 px-4 sm:px-6 lg:px-8 relative border-t border-slate-800/60">
      <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
          <div class="section-tag">Featured Works</div>
          <h2 class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight">
            Key Engineering Projects
          </h2>
          <p class="text-slate-400 font-light text-base sm:text-lg">
            Directly from resume: AI automated inspection, responsive management systems, and solar hardware automation.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          
          <!-- PROJECT 1: AI-Based Drone Solar Panel Inspection System -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-cyan-500/60 transition-all duration-300 relative overflow-hidden project-card">
            <div class="space-y-4">
              
              <!-- Project Category Tag & Number -->
              <div class="flex items-center justify-between">
                <span class="px-2.5 py-1 rounded bg-cyan-950/80 border border-cyan-500/40 text-cyan-300 font-mono text-xs">
                  AI &bull; Computer Vision
                </span>
                <span class="font-mono text-xs text-slate-400">01</span>
              </div>

              <!-- Project Title -->
              <h3 class="text-xl font-display font-bold text-white group-hover:text-cyan-300 transition-colors leading-snug">
                AI-Based Drone Solar Panel Inspection System
              </h3>

              <!-- Project Description (Exact Resume Content) -->
              <p class="text-slate-300 text-sm leading-relaxed font-light">
                Developed an automated aerial inspection platform using Python, FastAPI, OpenCV, SQLAlchemy, and SQLite for defect detection, health scoring, and energy-loss estimation.
              </p>

              <!-- Tech Stack Tags -->
              <div class="flex flex-wrap gap-1.5 pt-2">
                <span class="tag-tech">Python</span>
                <span class="tag-tech">FastAPI</span>
                <span class="tag-tech">OpenCV</span>
                <span class="tag-tech">SQLAlchemy</span>
                <span class="tag-tech">SQLite</span>
              </div>

              <!-- Key Capabilities bullet points -->
              <div class="p-3 rounded-lg bg-slate-950/70 border border-slate-800/80 text-xs space-y-1.5 text-slate-300 font-mono">
                <div class="flex items-center gap-2 text-cyan-400 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span> Automated Defect Detection
                </div>
                <div class="flex items-center gap-2 text-cyan-400 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span> Solar Panel Health Scoring
                </div>
                <div class="flex items-center gap-2 text-cyan-400 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span> Energy-Loss Estimation
                </div>
              </div>

            </div>

            <!-- Card Actions -->
            <div class="pt-6 mt-4 border-t border-slate-800/80 flex items-center justify-between">
              <a href="https://github.com/akhildragon-07" target="_blank" rel="noopener noreferrer" class="btn-secondary text-xs py-2 px-3">
                <svg class="w-4 h-4 text-cyan-400 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                <span>GitHub</span>
              </a>

              <button class="open-project-modal text-xs font-mono text-slate-400 hover:text-cyan-400 transition-colors flex items-center gap-1" data-project="solar-inspection">
                <span>Architecture</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </button>
            </div>

          </div>

          <!-- PROJECT 2: TravelSphere – Smart Travel Management System -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-indigo-500/60 transition-all duration-300 relative overflow-hidden project-card">
            <div class="space-y-4">
              
              <!-- Project Category Tag & Number -->
              <div class="flex items-center justify-between">
                <span class="px-2.5 py-1 rounded bg-indigo-950/80 border border-indigo-500/40 text-indigo-300 font-mono text-xs">
                  Web &bull; UI Prototype
                </span>
                <span class="font-mono text-xs text-slate-400">02</span>
              </div>

              <!-- Project Title -->
              <h3 class="text-xl font-display font-bold text-white group-hover:text-indigo-300 transition-colors leading-snug">
                TravelSphere – Smart Travel Management System
              </h3>

              <!-- Project Description (Exact Resume Content) -->
              <p class="text-slate-300 text-sm leading-relaxed font-light">
                Built a responsive HTML/CSS prototype with role-based dashboards for Travelers, Travel Agents, Administrators, and NATPAC Scientists.
              </p>

              <!-- Tech Stack Tags -->
              <div class="flex flex-wrap gap-1.5 pt-2">
                <span class="tag-tech">HTML</span>
                <span class="tag-tech">CSS</span>
                <span class="tag-tech">Responsive UI</span>
                <span class="tag-tech">Role Dashboards</span>
              </div>

              <!-- Roles Matrix -->
              <div class="p-3 rounded-lg bg-slate-950/70 border border-slate-800/80 text-xs space-y-1.5 text-slate-300 font-mono">
                <div class="flex items-center gap-2 text-indigo-300 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span> Travelers &amp; Travel Agents
                </div>
                <div class="flex items-center gap-2 text-indigo-300 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span> System Administrators
                </div>
                <div class="flex items-center gap-2 text-indigo-300 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span> NATPAC Scientists
                </div>
              </div>

            </div>

            <!-- Card Actions -->
            <div class="pt-6 mt-4 border-t border-slate-800/80 flex items-center justify-between">
              <a href="https://github.com/akhildragon-07" target="_blank" rel="noopener noreferrer" class="btn-secondary text-xs py-2 px-3">
                <svg class="w-4 h-4 text-cyan-400 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                <span>GitHub</span>
              </a>

              <button class="open-project-modal text-xs font-mono text-slate-400 hover:text-indigo-300 transition-colors flex items-center gap-1" data-project="travel-sphere">
                <span>View Details</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </button>
            </div>

          </div>

          <!-- PROJECT 3: Sun Position Tracking Solar Panel System -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-purple-500/60 transition-all duration-300 relative overflow-hidden project-card">
            <div class="space-y-4">
              
              <!-- Project Category Tag & Number -->
              <div class="flex items-center justify-between">
                <span class="px-2.5 py-1 rounded bg-purple-950/80 border border-purple-500/40 text-purple-300 font-mono text-xs">
                  Embedded &bull; Automation
                </span>
                <span class="font-mono text-xs text-slate-400">03</span>
              </div>

              <!-- Project Title -->
              <h3 class="text-xl font-display font-bold text-white group-hover:text-purple-300 transition-colors leading-snug">
                Sun Position Tracking Solar Panel System
              </h3>

              <!-- Project Description (Exact Resume Content) -->
              <p class="text-slate-300 text-sm leading-relaxed font-light">
                Developed a sensor-based automatic solar tracking system to maximize energy generation.
              </p>

              <!-- Tech Stack Tags -->
              <div class="flex flex-wrap gap-1.5 pt-2">
                <span class="tag-tech">Sensors</span>
                <span class="tag-tech">Automation</span>
                <span class="tag-tech">Solar Energy</span>
                <span class="tag-tech">Hardware Systems</span>
              </div>

              <!-- Key Capabilities bullet points -->
              <div class="p-3 rounded-lg bg-slate-950/70 border border-slate-800/80 text-xs space-y-1.5 text-slate-300 font-mono">
                <div class="flex items-center gap-2 text-purple-300 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span> Automatic Orientation Tracking
                </div>
                <div class="flex items-center gap-2 text-purple-300 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span> Sensor-Driven Real-time Control
                </div>
                <div class="flex items-center gap-2 text-purple-300 font-sans font-medium">
                  <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span> Maximized Energy Yield
                </div>
              </div>

            </div>

            <!-- Card Actions -->
            <div class="pt-6 mt-4 border-t border-slate-800/80 flex items-center justify-between">
              <a href="https://github.com/akhildragon-07" target="_blank" rel="noopener noreferrer" class="btn-secondary text-xs py-2 px-3">
                <svg class="w-4 h-4 text-cyan-400 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                <span>GitHub</span>
              </a>

              <button class="open-project-modal text-xs font-mono text-slate-400 hover:text-purple-300 transition-colors flex items-center gap-1" data-project="solar-tracking">
                <span>View Details</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </button>
            </div>

          </div>

        </div>

      </div>
    </section>


    <!-- EXPERIENCE SECTION -->
    <section id="experience" class="py-24 px-4 sm:px-6 lg:px-8 relative bg-slate-950/40">
      <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
          <div class="section-tag">Work Experience</div>
          <h2 class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight">
            Industry Internship
          </h2>
          <p class="text-slate-400 font-light text-base sm:text-lg">
            Practical experience delivering AI-driven solutions and autonomous agentic workflows.
          </p>
        </div>

        <div class="max-w-4xl mx-auto">
          
          <!-- Experience Card (IBM Agentic AI Internship) -->
          <div class="glass-card p-8 relative overflow-hidden border-cyan-500/30 group hover:border-cyan-400/60 transition-all">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-800">
              <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500/20 to-indigo-600/20 border border-cyan-500/40 flex items-center justify-center font-display font-bold text-cyan-400 text-lg shadow-glow-sm">
                  IBM
                </div>
                <div>
                  <h3 class="text-xl font-display font-bold text-white group-hover:text-cyan-300 transition-colors">
                    IBM Agentic AI Internship
                  </h3>
                  <p class="text-sm font-mono text-cyan-400">Agentic AI Intern</p>
                </div>
              </div>

              <!-- Duration Badge -->
              <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300 self-start md:self-auto">
                <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>May 2026 – July 2026</span>
              </div>
            </div>

            <!-- Experience Details (Exact Resume Content) -->
            <div class="pt-6 space-y-4">
              <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400">Key Contributions &amp; Responsibilities</h4>
              
              <ul class="space-y-3 text-slate-300 text-sm">
                <li class="flex items-start gap-3">
                  <span class="w-2 h-2 rounded-full bg-cyan-400 mt-1.5 shrink-0"></span>
                  <span>Worked on <strong class="text-white font-medium">Agentic AI workflows</strong>, designing and orchestrating multi-step autonomous processes.</span>
                </li>
                <li class="flex items-start gap-3">
                  <span class="w-2 h-2 rounded-full bg-indigo-400 mt-1.5 shrink-0"></span>
                  <span>Applied <strong class="text-white font-medium">Prompt Engineering</strong> techniques to optimize LLM outputs and agent interaction accuracy.</span>
                </li>
                <li class="flex items-start gap-3">
                  <span class="w-2 h-2 rounded-full bg-purple-400 mt-1.5 shrink-0"></span>
                  <span>Engineered <strong class="text-white font-medium">AI-powered application development</strong> pipelines for real-world automated tasks.</span>
                </li>
              </ul>

              <!-- Skills tags applied -->
              <div class="flex flex-wrap gap-2 pt-4">
                <span class="skill-chip">Agentic AI</span>
                <span class="skill-chip">Prompt Engineering</span>
                <span class="skill-chip">AI Application Development</span>
                <span class="skill-chip">Python</span>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section>


    <!-- EDUCATION SECTION -->
    <section id="education" class="py-24 px-4 sm:px-6 lg:px-8 relative border-t border-slate-800/60">
      <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
          <div class="section-tag">Academic Background</div>
          <h2 class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight">
            Education Timeline
          </h2>
          <p class="text-slate-400 font-light text-base sm:text-lg">
            Academic credentials and performance record extracted from resume.
          </p>
        </div>

        <!-- Futuristic Timeline -->
        <div class="max-w-3xl mx-auto relative border-l-2 border-slate-800 ml-4 md:ml-auto space-y-12 pl-6 md:pl-10">
          
          <!-- ITEM 1: VIT-AP University -->
          <div class="relative group">
            <!-- Glowing Node -->
            <div class="absolute -left-[31px] md:-left-[47px] top-1.5 w-6 h-6 rounded-full bg-slate-950 border-2 border-cyan-400 flex items-center justify-center group-hover:scale-125 transition-transform shadow-glow-sm">
              <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
            </div>

            <div class="glass-card p-6 border-cyan-500/30 group-hover:border-cyan-400 transition-all">
              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                <h3 class="text-lg font-display font-bold text-white">VIT-AP University</h3>
                <span class="text-xs font-mono px-3 py-1 rounded bg-cyan-950/80 text-cyan-300 border border-cyan-500/40 self-start sm:self-auto">
                  Third-Year Undergraduate
                </span>
              </div>

              <p class="text-cyan-300 font-medium text-sm">
                B.Tech &ndash; Computer Science &amp; Engineering (AI &amp; ML)
              </p>

              <div class="mt-4 pt-3 border-t border-slate-800/80 flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400">Specialization</span>
                <span class="font-mono font-bold text-cyan-300 text-sm bg-cyan-950/60 px-2.5 py-1 rounded border border-cyan-500/30">
                  Artificial Intelligence &amp; Machine Learning
                </span>
              </div>
            </div>
          </div>

          <!-- ITEM 2: Velammal Vidyalaya CBSE Class XII -->
          <div class="relative group">
            <!-- Node -->
            <div class="absolute -left-[31px] md:-left-[47px] top-1.5 w-6 h-6 rounded-full bg-slate-950 border-2 border-indigo-400 flex items-center justify-center group-hover:scale-125 transition-transform">
              <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
            </div>

            <div class="glass-card p-6 border-slate-800 group-hover:border-indigo-400/50 transition-all">
              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                <h3 class="text-lg font-display font-bold text-white">Velammal Vidyalaya CBSE, Theni</h3>
                <span class="text-xs font-mono px-3 py-1 rounded bg-indigo-950/60 text-indigo-300 border border-indigo-500/30 self-start sm:self-auto">
                  Senior Secondary
                </span>
              </div>

              <p class="text-slate-300 font-medium text-sm">
                Class XII (CBSE)
              </p>

              <div class="mt-4 pt-3 border-t border-slate-800/80 flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400">Score</span>
                <span class="font-mono font-bold text-indigo-300 text-sm bg-indigo-950/60 px-2.5 py-1 rounded border border-indigo-500/30">
                  87.2%
                </span>
              </div>
            </div>
          </div>

          <!-- ITEM 3: Velammal Vidyalaya CBSE Class X -->
          <div class="relative group">
            <!-- Node -->
            <div class="absolute -left-[31px] md:-left-[47px] top-1.5 w-6 h-6 rounded-full bg-slate-950 border-2 border-purple-400 flex items-center justify-center group-hover:scale-125 transition-transform">
              <span class="w-2 h-2 rounded-full bg-purple-400"></span>
            </div>

            <div class="glass-card p-6 border-slate-800 group-hover:border-purple-400/50 transition-all">
              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                <h3 class="text-lg font-display font-bold text-white">Velammal Vidyalaya CBSE, Theni</h3>
                <span class="text-xs font-mono px-3 py-1 rounded bg-purple-950/60 text-purple-300 border border-purple-500/30 self-start sm:self-auto">
                  Secondary
                </span>
              </div>

              <p class="text-slate-300 font-medium text-sm">
                Class X (CBSE)
              </p>

              <div class="mt-4 pt-3 border-t border-slate-800/80 flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400">Score</span>
                <span class="font-mono font-bold text-purple-300 text-sm bg-purple-950/60 px-2.5 py-1 rounded border border-purple-500/30">
                  91.8%
                </span>
              </div>
            </div>
          </div>

        </div>

        <!-- Dynamic Amazon RDS Academic Records Callout Banner -->
        <div class="mt-12 text-center">
          <a href="academic.php" class="btn-primary py-3 px-6 shadow-glow-sm">
            <span class="w-2 h-2 rounded-full bg-cyan-300 animate-pulse"></span>
            <span>View Dynamic Amazon RDS MySQL Academic Records Table &rarr;</span>
          </a>
        </div>

      </div>
    </section>


    <!-- CERTIFICATIONS & EXTRACURRICULARS -->
    <section id="certifications" class="py-24 px-4 sm:px-6 lg:px-8 relative bg-slate-950/40">
      <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
          <div class="section-tag">Credentials &amp; Activities</div>
          <h2 class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight">
            Certifications &amp; Extracurriculars
          </h2>
          <p class="text-slate-400 font-light text-base sm:text-lg">
            Professional certifications and campus leadership activities.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
          
          <!-- Card 1: Certification -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-cyan-500/60 transition-all">
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                </div>
                <div>
                  <span class="text-xs font-mono text-cyan-400">Official Certification</span>
                  <h3 class="text-lg font-display font-bold text-white">
                    IBM Agentic AI Internship Certificate
                  </h3>
                </div>
              </div>

              <p class="text-slate-300 text-sm leading-relaxed">
                Recognized credential validating practical engineering capability in Agentic AI workflows, prompt optimization, and AI application pipelines.
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs font-mono text-slate-400">
              <span class="text-cyan-400 font-semibold">Verified Credential</span>
              <span>IBM</span>
            </div>
          </div>

          <!-- Card 2: Extracurricular Club Membership -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-purple-500/60 transition-all">
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>
                </div>
                <div>
                  <span class="text-xs font-mono text-purple-400">Campus Leadership</span>
                  <h3 class="text-lg font-display font-bold text-white">
                    Member &ndash; IIAIC Club
                  </h3>
                </div>
              </div>

              <p class="text-slate-300 text-sm leading-relaxed">
                Active member of the <strong class="text-white">IIAIC Club</strong> at <strong class="text-cyan-300">VIT-AP University</strong>, engaging in technical initiatives, AI workshops, and peer collaboration.
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs font-mono text-slate-400">
              <span class="text-purple-400 font-semibold">Active Member</span>
              <span>VIT-AP University</span>
            </div>
          </div>

        </div>

      </div>
    </section>


    <!-- CONTACT SECTION -->
    <section id="contact" class="py-24 px-4 sm:px-6 lg:px-8 relative border-t border-slate-800/60">
      <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
          <div class="section-tag">Get In Touch</div>
          <h2 class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight">
            Let's Build Something Impactful
          </h2>
          <p class="text-slate-400 font-light text-base sm:text-lg">
            Feel free to reach out for Software Engineering &amp; AI/ML opportunities, collaborations, or hackathons.
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
          
          <!-- Contact Channels -->
          <div class="lg:col-span-5 space-y-4">
            
            <!-- Email Card with Copy button -->
            <div class="glass-card p-5 group hover:border-cyan-500/50 transition-all flex items-center justify-between">
              <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div>
                  <div class="text-xs font-mono text-slate-400">Email Address</div>
                  <a href="mailto:akhilvit28@gmail.com" class="text-white font-mono text-sm hover:text-cyan-300 transition-colors font-medium">
                    akhilvit28@gmail.com
                  </a>
                </div>
              </div>
              
              <button class="copy-btn p-2 rounded-lg bg-slate-900 border border-slate-700 text-slate-300 hover:text-cyan-400 hover:border-cyan-500/50 transition-all" data-copy="akhilvit28@gmail.com" title="Copy Email">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
              </button>
            </div>

            <!-- Phone Card -->
            <div class="glass-card p-5 group hover:border-indigo-500/50 transition-all flex items-center justify-between">
              <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                </div>
                <div>
                  <div class="text-xs font-mono text-slate-400">Phone Number</div>
                  <a href="tel:9894093429" class="text-white font-mono text-sm hover:text-indigo-300 transition-colors font-medium">
                    +91 9894093429
                  </a>
                </div>
              </div>

              <button class="copy-btn p-2 rounded-lg bg-slate-900 border border-slate-700 text-slate-300 hover:text-indigo-400 hover:border-indigo-500/50 transition-all" data-copy="9894093429" title="Copy Phone">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
              </button>
            </div>

            <!-- Location Card -->
            <div class="glass-card p-5 group hover:border-purple-500/50 transition-all flex items-center gap-4">
              <div class="w-11 h-11 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs font-mono text-slate-400">Location</div>
                <div class="text-white font-mono text-sm font-medium">Theni, Tamil Nadu, India</div>
              </div>
            </div>

            <!-- Social Links Grid -->
            <div class="grid grid-cols-2 gap-3 pt-2">
              <a href="https://github.com/akhildragon-07" target="_blank" rel="noopener noreferrer" class="glass-card p-4 flex items-center gap-3 group hover:border-cyan-500/50 transition-all">
                <svg class="w-5 h-5 text-slate-300 group-hover:text-cyan-400 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                <div class="text-xs font-mono">
                  <div class="text-slate-400">GitHub</div>
                  <div class="text-slate-200 group-hover:text-cyan-300">akhildragon-07</div>
                </div>
              </a>

              <a href="https://linkedin.com/in/akhil-rajan-p-978867393" target="_blank" rel="noopener noreferrer" class="glass-card p-4 flex items-center gap-3 group hover:border-indigo-500/50 transition-all">
                <svg class="w-5 h-5 text-slate-300 group-hover:text-indigo-400 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                <div class="text-xs font-mono">
                  <div class="text-slate-400">LinkedIn</div>
                  <div class="text-slate-200 group-hover:text-indigo-300">akhil-rajan-p</div>
                </div>
              </a>
            </div>

          </div>

          <!-- Static Form (Client-side Mailto Generator & Feedback) -->
          <div class="lg:col-span-7 glass-card p-8 border-slate-800 relative">
            <h3 class="text-xl font-display font-bold text-white mb-2">Send a Message</h3>
            <p class="text-slate-400 text-xs font-mono mb-6">Direct static client-side email dispatch to akhilvit28@gmail.com</p>

            <form id="contact-form" class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label for="name" class="block text-xs font-mono text-slate-300 mb-1.5">Your Name *</label>
                  <input type="text" id="name" name="name" required placeholder="e.g. Alex Smith" class="input-field">
                </div>
                <div>
                  <label for="email" class="block text-xs font-mono text-slate-300 mb-1.5">Your Email *</label>
                  <input type="email" id="email" name="email" required placeholder="e.g. alex@example.com" class="input-field">
                </div>
              </div>

              <div>
                <label for="subject" class="block text-xs font-mono text-slate-300 mb-1.5">Subject *</label>
                <input type="text" id="subject" name="subject" required placeholder="Opportunity / Project Collaboration" class="input-field">
              </div>

              <div>
                <label for="message" class="block text-xs font-mono text-slate-300 mb-1.5">Message *</label>
                <textarea id="message" name="message" rows="4" required placeholder="Write your message here..." class="input-field resize-none"></textarea>
              </div>

              <button type="submit" class="btn-primary w-full justify-center py-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                <span>Compose &amp; Send Message</span>
              </button>
            </form>

            <div id="form-feedback" class="mt-4 hidden p-3 rounded-lg bg-emerald-950/80 border border-emerald-500/50 text-emerald-300 text-xs font-mono flex items-center gap-2">
              <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
              <span>Opening your default email client with the compiled message...</span>
            </div>

          </div>

        </div>

      </div>
    </section>

  </main>

  <!-- FOOTER -->
  <footer class="border-t border-slate-800/80 py-12 px-4 sm:px-6 lg:px-8 bg-slate-950/80 relative z-10">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
      
      <!-- Brand & Copyright -->
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center font-mono font-bold text-xs text-cyan-400">
          AR
        </div>
        <div class="text-xs font-mono text-slate-400">
          &copy; <?= date('Y') ?> <span class="text-slate-200">Akhil Rajan P</span>. Built with Vanilla HTML5, CSS3, &amp; JS.
        </div>
      </div>

      <!-- AWS Cloud Architecture Status Pill -->
      <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-[11px] font-mono text-slate-400">
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        <span>Hosted on Amazon EC2 &bull; RDS MySQL &bull; DynamoDB</span>
      </div>

      <!-- Back to Top Button -->
      <a href="#hero" class="text-xs font-mono text-slate-400 hover:text-cyan-400 flex items-center gap-1.5 transition-colors">
        <span>Back to Top</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
      </a>

    </div>
  </footer>

  <!-- RESUME PREVIEW & DOWNLOAD MODAL -->
  <div id="resume-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/80 backdrop-blur-md p-4 transition-all duration-300">
    <div class="glass-card max-w-2xl w-full p-6 sm:p-8 relative border-cyan-500/40 shadow-2xl space-y-6 max-h-[90vh] overflow-y-auto">
      
      <div class="flex items-center justify-between pb-4 border-b border-slate-800">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-lg bg-cyan-500/20 border border-cyan-500/40 flex items-center justify-center text-cyan-400 font-mono font-bold">
            CV
          </div>
          <div>
            <h3 class="text-xl font-display font-bold text-white">Akhil Rajan P &ndash; Resume</h3>
            <p class="text-xs font-mono text-cyan-400">Verified Resume Document</p>
          </div>
        </div>

        <button id="close-resume-btn" class="p-1.5 rounded-lg bg-slate-900 text-slate-400 hover:text-white border border-slate-700">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Quick Resume Snapshot Summary -->
      <div class="space-y-4 text-xs font-mono text-slate-300">
        <div class="p-3 rounded-lg bg-slate-950 border border-slate-800 space-y-1">
          <div class="text-slate-400 uppercase tracking-wider text-[10px]">Education</div>
          <div class="text-white font-semibold">VIT-AP University &bull; B.Tech CSE (AI &amp; ML)</div>
          <div class="text-slate-400">Velammal Vidyalaya CBSE (Class XII: 87.2% | Class X: 91.8%)</div>
        </div>

        <div class="p-3 rounded-lg bg-slate-950 border border-slate-800 space-y-1">
          <div class="text-slate-400 uppercase tracking-wider text-[10px]">Work Experience</div>
          <div class="text-white font-semibold">IBM Agentic AI Internship (May 2026 – July 2026)</div>
          <div class="text-slate-400">Agentic AI workflows, prompt engineering, and AI application development.</div>
        </div>

        <div class="p-3 rounded-lg bg-slate-950 border border-slate-800 space-y-1">
          <div class="text-slate-400 uppercase tracking-wider text-[10px]">Projects</div>
          <div class="text-cyan-300 font-semibold">1. AI-Based Drone Solar Panel Inspection System (FastAPI, OpenCV)</div>
          <div class="text-indigo-300 font-semibold">2. TravelSphere – Smart Travel Management System (HTML/CSS)</div>
          <div class="text-purple-300 font-semibold">3. Sun Position Tracking Solar Panel System (Sensors)</div>
        </div>
      </div>

      <!-- Actions -->
      <div class="pt-4 border-t border-slate-800 flex flex-wrap items-center justify-end gap-3">
        <button id="modal-cancel-btn" class="btn-ghost text-xs py-2 px-4">Close</button>
        <a href="assets/resume/Akhil_Rajan_P_Resume.pdf" download="Akhil_Rajan_P_Resume.pdf" class="btn-primary text-xs py-2.5 px-5">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
          </svg>
          <span>Download PDF File</span>
        </a>
      </div>

    </div>
  </div>

  <!-- PROJECT ARCHITECTURE & DETAILS MODAL -->
  <div id="project-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/80 backdrop-blur-md p-4 transition-all duration-300">
    <div class="glass-card max-w-2xl w-full p-6 sm:p-8 relative border-cyan-500/40 shadow-2xl space-y-6 max-h-[90vh] overflow-y-auto" id="project-modal-content">
      <!-- Dynamic modal content injected by script.js -->
    </div>
  </div>

  <!-- Toast Notification -->
  <div id="toast" class="fixed bottom-6 right-6 z-50 hidden items-center gap-2 px-4 py-3 rounded-xl bg-slate-900 border border-cyan-500/40 text-cyan-300 text-xs font-mono shadow-2xl backdrop-blur-md">
    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span id="toast-msg">Copied to clipboard!</span>
  </div>

  <!-- JavaScript -->
  <script src="./script.js"></script>
</body>
</html>
