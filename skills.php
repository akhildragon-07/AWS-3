<?php
/**
 * AWS Dynamic Student Portfolio - Skills, Certifications & Activities Page
 * Powered by Amazon DynamoDB
 * Dynamically queries flexible NoSQL attributes using AWS SDK for PHP / EC2 IAM Role
 */

require_once __DIR__ . '/aws/dynamodb.php';

$portfolioResult = getStudentPortfolioData('akhil-rajan-p');
$isSuccess       = $portfolioResult['success'] ?? false;
$dataSource      = $portfolioResult['source'] ?? 'Amazon DynamoDB';
$isMock          = $portfolioResult['is_mock'] ?? false;
$errorMessage    = $portfolioResult['error'] ?? 'Unable to retrieve skills information at the moment.';

$skillsItem = $portfolioResult['data']['skills'] ?? null;
$certsItem  = $portfolioResult['data']['certifications'] ?? null;
$extraItem  = $portfolioResult['data']['extracurricular'] ?? null;

// Group definitions for skills rendering
$skillGroups = $skillsItem['groups'] ?? [
    'Programming Languages' => ['Python', 'Java', 'JavaScript', 'C', 'C++'],
    'Frameworks & Web'      => ['FastAPI', 'OpenCV', 'HTML', 'CSS'],
    'Databases'             => ['MongoDB', 'SQLite', 'SQLAlchemy'],
    'Developer Tools'       => ['Git', 'GitHub', 'Postman', 'VS Code']
];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skills &amp; Certifications | Amazon DynamoDB | Akhil Rajan P</title>
  <meta name="description" content="Technical skills, certifications, and leadership activities of Akhil Rajan P dynamically retrieved from Amazon DynamoDB.">
  <meta name="theme-color" content="#07090e">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: { space: '#07090e' },
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
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚡</text></svg>">
</head>
<body class="bg-space text-slate-100 font-sans antialiased overflow-x-hidden selection:bg-cyan-500/30 selection:text-cyan-200">

  <!-- Scroll Progress Indicator -->
  <div id="scroll-progress" class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-cyan-400 via-indigo-500 to-purple-500 z-50 transition-all duration-75 w-0"></div>

  <!-- Ambient Glows & Interactive Canvas -->
  <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
    <canvas id="particle-canvas" class="absolute inset-0 w-full h-full opacity-60"></canvas>
    <div class="ambient-glow glow-1"></div>
    <div class="ambient-glow glow-2"></div>
    <div class="cyber-grid"></div>
  </div>

  <!-- Main Navigation Bar -->
  <header id="navbar" class="fixed top-0 left-0 right-0 z-40 transition-all duration-300 backdrop-blur-md bg-slate-950/70 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      
      <!-- Brand Logo -->
      <a href="index.php" class="group flex items-center gap-3 text-decoration-none">
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
      <nav class="hidden md:flex items-center gap-1 lg:gap-2">
        <a href="index.php#hero" class="nav-link">Home</a>
        <a href="index.php#about" class="nav-link">About</a>
        <a href="index.php#education" class="nav-link">Education</a>
        <a href="index.php#projects" class="nav-link">Projects</a>
        <a href="index.php#experience" class="nav-link">Experience</a>
        <a href="skills.php" class="nav-link active">Skills</a>
        <a href="academic.php" class="nav-link">Academic Records</a>
        <a href="#certifications" class="nav-link">Certifications</a>
        <a href="index.php#contact" class="nav-link">Contact</a>
      </nav>

      <!-- Action Buttons -->
      <div class="hidden lg:flex items-center gap-3">
        <a href="academic.php" class="btn-secondary text-xs font-mono py-2 px-3.5">
          <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
          </svg>
          RDS Academic
        </a>
        <a href="index.php#contact" class="btn-primary text-xs font-mono py-2 px-4">
          <span>Contact</span>
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
          </svg>
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
      <a href="index.php#hero" class="mobile-nav-link">Home</a>
      <a href="index.php#about" class="mobile-nav-link">About</a>
      <a href="index.php#education" class="mobile-nav-link">Education</a>
      <a href="index.php#projects" class="mobile-nav-link">Projects</a>
      <a href="index.php#experience" class="mobile-nav-link">Experience</a>
      <a href="skills.php" class="mobile-nav-link active text-purple-400 font-semibold">Skills (DynamoDB)</a>
      <a href="academic.php" class="mobile-nav-link">Academic Records (RDS)</a>
      <a href="#certifications" class="mobile-nav-link">Certifications</a>
      <a href="index.php#contact" class="mobile-nav-link">Contact</a>
    </div>
  </header>

  <!-- Main Content Wrapper -->
  <main class="relative z-10 pt-28 pb-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-12">

      <!-- Header Banner & DynamoDB Status Pill -->
      <div class="glass-card p-8 sm:p-10 border-purple-500/30 relative overflow-hidden">
        <div class="absolute -top-16 -right-16 w-60 h-60 bg-gradient-to-br from-purple-500/10 to-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10">
          <div class="space-y-3 max-w-3xl">
            <div class="section-tag">AWS Cloud Architecture &bull; NoSQL Flexible Data</div>
            <h1 class="text-3xl sm:text-5xl font-display font-extrabold text-white tracking-tight leading-tight">
              Skills &amp; Certifications
            </h1>
            <p class="text-slate-300 text-base sm:text-lg font-light leading-relaxed">
              Technical proficiencies, professional credentials, and extracurriculars queried dynamically from <span class="text-purple-300 font-medium">Amazon DynamoDB</span>.
            </p>
          </div>

          <!-- Dynamic AWS Status Badges -->
          <div class="flex flex-col sm:flex-row lg:flex-col gap-3 self-start lg:self-auto shrink-0">
            <!-- Data Source Indicator -->
            <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-xl bg-purple-950/80 border border-purple-500/40 text-purple-300 font-mono text-xs shadow-glow-xs">
              <span class="w-2.5 h-2.5 rounded-full bg-purple-400 animate-pulse"></span>
              <span class="font-semibold">Data Source: <?= htmlspecialchars($dataSource) ?></span>
            </div>

            <!-- Architecture Info -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-slate-900/80 border border-slate-800 text-slate-400 font-mono text-[11px]">
              <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
              <span>Table: <strong class="text-slate-200">student_portfolio</strong></span>
              <span class="text-slate-600">&bull;</span>
              <span>Key: <strong class="text-slate-200">student_id</strong></span>
            </div>
          </div>
        </div>

        <?php if ($isMock): ?>
        <div class="mt-6 p-3 rounded-lg bg-amber-950/60 border border-amber-500/40 text-amber-300 text-xs font-mono flex items-center gap-2">
          <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          <span><strong>Notice:</strong> <?= htmlspecialchars($dataSource) ?>. For live AWS queries, configure EC2 IAM role / credentials and verify the DynamoDB table exists.</span>
        </div>
        <?php endif; ?>
      </div>

      <!-- MAIN DATA DISPLAY SECTION -->
      <?php if ($isSuccess && ($skillsItem || $certsItem || $extraItem)): ?>
      
      <!-- 1. TECHNICAL SKILLS SECTION -->
      <section id="technical-skills" class="space-y-6">
        <div class="flex items-center justify-between pb-2 border-b border-slate-800">
          <div>
            <h2 class="text-xl font-display font-bold text-white flex items-center gap-2">
              <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
              </svg>
              Technical Skills
            </h2>
            <p class="text-xs font-mono text-slate-400 mt-0.5">Partition Key: <code class="text-cyan-300">student_id=akhil-rajan-p</code> &bull; Sort Key: <code class="text-cyan-300">category=skills</code></p>
          </div>
          <span class="text-xs font-mono text-cyan-400">16 Items Stored</span>
        </div>

        <!-- Categorized Skills Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <!-- Group 1: Programming Languages -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-cyan-500/50 transition-all">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Programming</h3>
                  <span class="text-[11px] font-mono text-slate-400">Core Languages</span>
                </div>
              </div>
              <div class="flex flex-wrap gap-2">
                <?php foreach (($skillGroups['Programming Languages'] ?? ['Python', 'Java', 'JavaScript', 'C', 'C++']) as $tech): ?>
                  <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-cyan-400"></span><?= htmlspecialchars($tech) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              5 Languages
            </div>
          </div>

          <!-- Group 2: Frameworks & Web -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-indigo-500/50 transition-all">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Backend &amp; Web</h3>
                  <span class="text-[11px] font-mono text-slate-400">Frameworks &amp; Vision</span>
                </div>
              </div>
              <div class="flex flex-wrap gap-2">
                <?php foreach (($skillGroups['Frameworks & Web'] ?? ['FastAPI', 'OpenCV', 'HTML', 'CSS']) as $tech): ?>
                  <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-emerald-400"></span><?= htmlspecialchars($tech) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              4 Frameworks &amp; Technologies
            </div>
          </div>

          <!-- Group 3: Databases -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-emerald-500/50 transition-all">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Databases</h3>
                  <span class="text-[11px] font-mono text-slate-400">Storage &amp; ORM</span>
                </div>
              </div>
              <div class="flex flex-wrap gap-2">
                <?php foreach (($skillGroups['Databases'] ?? ['MongoDB', 'SQLite', 'SQLAlchemy']) as $tech): ?>
                  <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-blue-400"></span><?= htmlspecialchars($tech) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              3 Data Technologies
            </div>
          </div>

          <!-- Group 4: Developer Tools -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-purple-500/50 transition-all">
            <div>
              <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-800">
                <div class="w-9 h-9 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                  <h3 class="text-white font-display font-bold text-base">Developer Tools</h3>
                  <span class="text-[11px] font-mono text-slate-400">Environment &amp; VCS</span>
                </div>
              </div>
              <div class="flex flex-wrap gap-2">
                <?php foreach (($skillGroups['Developer Tools'] ?? ['Git', 'GitHub', 'Postman', 'VS Code']) as $tech): ?>
                  <span class="skill-chip"><span class="w-2 h-2 rounded-full bg-amber-400"></span><?= htmlspecialchars($tech) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="mt-6 pt-3 border-t border-slate-800/80 text-[11px] font-mono text-slate-400">
              4 Developer Tools
            </div>
          </div>

        </div>
      </section>

      <!-- 2. CERTIFICATIONS & EXTRACURRICULAR SECTION -->
      <section id="certifications" class="space-y-6 pt-6">
        <div class="flex items-center justify-between pb-2 border-b border-slate-800">
          <div>
            <h2 class="text-xl font-display font-bold text-white flex items-center gap-2">
              <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
              </svg>
              Certifications &amp; Extracurricular Leadership
            </h2>
            <p class="text-xs font-mono text-slate-400 mt-0.5">DynamoDB Documents: <code class="text-purple-300">category=certifications</code> &bull; <code class="text-purple-300">category=extracurricular</code></p>
          </div>
          <span class="text-xs font-mono text-purple-400">Verified Credentials</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          
          <!-- Card 1: Certification -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-cyan-500/60 transition-all">
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <div>
                  <span class="text-xs font-mono text-cyan-400">Official Certification</span>
                  <h3 class="text-lg font-display font-bold text-white">
                    <?= htmlspecialchars($certsItem['items'][0] ?? 'IBM Agentic AI Internship Certificate') ?>
                  </h3>
                </div>
              </div>

              <p class="text-slate-300 text-sm leading-relaxed">
                <?= htmlspecialchars($certsItem['description'] ?? 'Recognized credential validating practical engineering capability in Agentic AI workflows, prompt optimization, and AI application development.') ?>
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs font-mono text-slate-400">
              <span class="text-cyan-400 font-semibold">Verified Credential</span>
              <span>Issuer: <?= htmlspecialchars($certsItem['issuer'] ?? 'IBM') ?></span>
            </div>
          </div>

          <!-- Card 2: Extracurricular -->
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-purple-500/60 transition-all">
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                  <span class="text-xs font-mono text-purple-400">Campus Leadership</span>
                  <h3 class="text-lg font-display font-bold text-white">
                    <?= htmlspecialchars($extraItem['items'][0] ?? 'Member – IIAIC Club, VIT-AP University') ?>
                  </h3>
                </div>
              </div>

              <p class="text-slate-300 text-sm leading-relaxed">
                <?= htmlspecialchars($extraItem['description'] ?? 'Active member of IIAIC Club at VIT-AP University participating in technical initiatives, workshops, and AI collaboration.') ?>
              </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs font-mono text-slate-400">
              <span class="text-purple-400 font-semibold">Active Member</span>
              <span><?= htmlspecialchars($extraItem['organization'] ?? 'VIT-AP University') ?></span>
            </div>
          </div>

        </div>
      </section>

      <!-- 3. DYNAMODB DOCUMENT INSPECTOR -->
      <div class="glass-card p-6 overflow-hidden">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-800">
          <div>
            <h3 class="text-base font-display font-bold text-white">DynamoDB NoSQL Document Inspector</h3>
            <p class="text-xs font-mono text-slate-400">Raw JSON representation of unmarshaled DynamoDB documents</p>
          </div>
          <span class="font-mono text-xs text-purple-400 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-purple-400"></span> AWS SDK Query OK
          </span>
        </div>

        <pre class="bg-slate-950/80 p-4 rounded-xl text-[11px] font-mono text-cyan-300/90 overflow-x-auto border border-slate-800"><code><?= htmlspecialchars(json_encode([
          'partition_key'   => 'student_id = akhil-rajan-p',
          'skills_item'     => $skillsItem,
          'certifications'  => $certsItem,
          'extracurricular' => $extraItem
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) ?></code></pre>
      </div>

      <?php else: ?>
      
      <!-- Graceful Error Card (DynamoDB Unavailable) -->
      <div class="glass-card p-8 border-rose-500/30 text-center space-y-4 max-w-2xl mx-auto">
        <div class="w-14 h-14 rounded-full bg-rose-500/10 border border-rose-500/40 flex items-center justify-center text-rose-400 mx-auto">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
        </div>
        <h2 class="text-xl font-display font-bold text-white"><?= htmlspecialchars($errorMessage) ?></h2>
        <p class="text-slate-400 text-sm leading-relaxed max-w-md mx-auto">
          The Amazon DynamoDB service could not be queried. Verify that the EC2 IAM role has <code class="font-mono text-purple-300">dynamodb:Query</code> / <code class="font-mono text-purple-300">dynamodb:Scan</code> permissions, the table <code class="font-mono text-cyan-300">student_portfolio</code> exists in <code class="font-mono text-slate-300"><?= htmlspecialchars(getenv('AWS_REGION') ?: 'us-east-1') ?></code>, and Composer dependencies are installed.
        </p>
        <div class="pt-2">
          <a href="skills.php?mock=1" class="btn-secondary text-xs font-mono py-2 px-4">
            <span>View Simulated Skills Data (Demo Mode)</span>
          </a>
        </div>
      </div>

      <?php endif; ?>

      <!-- AWS Architecture & Viva Explanation Box -->
      <div class="glass-card p-6 sm:p-8 border-slate-800">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-10 h-10 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-display font-bold text-white">Why Amazon DynamoDB for Skills &amp; Certifications?</h3>
            <p class="text-xs font-mono text-slate-400">Cloud Architecture &amp; Assignment Viva Rationale</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2 text-xs text-slate-300">
          <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 space-y-1.5">
            <div class="text-purple-400 font-mono font-semibold">1. Flexible NoSQL Schema</div>
            <p class="text-slate-400 leading-relaxed">
              Skills, certifications, and activities have variable attributes (arrays, subcategories, nested maps, issuer strings). DynamoDB accommodates semi-structured documents with zero schema migration overhead.
            </p>
          </div>
          <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 space-y-1.5">
            <div class="text-cyan-400 font-mono font-semibold">2. Single-Digit Millisecond Latency</div>
            <p class="text-slate-400 leading-relaxed">
              DynamoDB is a fully managed key-value and document database that delivers predictable single-digit millisecond performance at any scale with on-demand auto-scaling.
            </p>
          </div>
          <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 space-y-1.5">
            <div class="text-emerald-400 font-mono font-semibold">3. Secure IAM Role Authentication</div>
            <p class="text-slate-400 leading-relaxed">
              The application queries DynamoDB using AWS SDK for PHP credentials automatically supplied by the Amazon EC2 IAM Instance Profile. Zero static access keys exist in source code or server configs.
            </p>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- FOOTER -->
  <footer class="border-t border-slate-800/80 py-10 px-4 sm:px-6 lg:px-8 bg-slate-950/80 relative z-10">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center font-mono font-bold text-xs text-cyan-400">
          AR
        </div>
        <div class="text-xs font-mono text-slate-400">
          &copy; <?= date('Y') ?> <span class="text-slate-200">Akhil Rajan P</span> &bull; Amazon DynamoDB Integration
        </div>
      </div>

      <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-[11px] font-mono text-slate-400">
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        <span>Hosted on Amazon EC2</span>
      </div>

      <div class="flex items-center gap-4 text-xs font-mono">
        <a href="index.php" class="text-slate-400 hover:text-cyan-400 transition-colors">Portfolio Home</a>
        <a href="academic.php" class="text-slate-400 hover:text-cyan-400 transition-colors">RDS Academic</a>
      </div>
    </div>
  </footer>

  <!-- Canvas Particles Script -->
  <script src="./script.js"></script>
</body>
</html>
