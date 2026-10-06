<?php
/**
 * AWS Dynamic Student Portfolio - Academic Records Page
 * Powered by Amazon RDS MySQL
 * Relational Schema: id, institution, degree, program, qualification, percentage, year
 */

require_once __DIR__ . '/config/database.php';

$academicData = getAcademicRecords();
$isSuccess    = $academicData['success'] ?? false;
$records      = $academicData['records'] ?? [];
$dataSource   = $academicData['source'] ?? 'Amazon RDS MySQL';
$isMock       = $academicData['is_mock'] ?? false;
$errorMessage = $academicData['error'] ?? 'Unable to retrieve academic records at the moment.';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academic Records | Amazon RDS MySQL | Akhil Rajan P</title>
  <meta name="description" content="Academic credentials of Akhil Rajan P dynamically retrieved from Amazon RDS MySQL.">
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
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📊</text></svg>">
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
        <a href="skills.php" class="nav-link">Skills</a>
        <a href="academic.php" class="nav-link active">Academic Records</a>
        <a href="skills.php#certifications" class="nav-link">Certifications</a>
        <a href="index.php#contact" class="nav-link">Contact</a>
      </nav>

      <!-- Action Buttons -->
      <div class="hidden lg:flex items-center gap-3">
        <a href="skills.php" class="btn-secondary text-xs font-mono py-2 px-3.5">
          <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          DynamoDB Skills
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
      <a href="skills.php" class="mobile-nav-link">Skills</a>
      <a href="academic.php" class="mobile-nav-link active text-cyan-400 font-semibold">Academic Records (RDS)</a>
      <a href="skills.php#certifications" class="mobile-nav-link">Certifications</a>
      <a href="index.php#contact" class="mobile-nav-link">Contact</a>
    </div>
  </header>

  <!-- Main Content Wrapper -->
  <main class="relative z-10 pt-28 pb-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-12">

      <!-- Header Banner & AWS Integration Indicators -->
      <div class="glass-card p-8 sm:p-10 border-cyan-500/30 relative overflow-hidden">
        <div class="absolute -top-16 -right-16 w-60 h-60 bg-gradient-to-br from-cyan-500/10 to-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10">
          <div class="space-y-3 max-w-3xl">
            <div class="section-tag">AWS Cloud Architecture &bull; Relational Data</div>
            <h1 class="text-3xl sm:text-5xl font-display font-extrabold text-white tracking-tight leading-tight">
              Academic Records
            </h1>
            <p class="text-slate-300 text-base sm:text-lg font-light leading-relaxed">
              Structured academic qualifications retrieved dynamically from <span class="text-cyan-300 font-medium">Amazon RDS (Relational Database Service) MySQL</span>.
            </p>
          </div>

          <!-- Dynamic AWS Status Badges -->
          <div class="flex flex-col sm:flex-row lg:flex-col gap-3 self-start lg:self-auto shrink-0">
            <!-- Data Source Indicator -->
            <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-xl bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 font-mono text-xs shadow-glow-xs">
              <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
              <span class="font-semibold">Data Source: <?= htmlspecialchars($dataSource) ?></span>
            </div>

            <!-- Architecture Info -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-slate-900/80 border border-slate-800 text-slate-400 font-mono text-[11px]">
              <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
              </svg>
              <span>Table: <strong class="text-slate-200">academic_records</strong></span>
              <span class="text-slate-600">&bull;</span>
              <span>Engine: <strong class="text-slate-200">MySQL</strong></span>
            </div>
          </div>
        </div>

        <?php if ($isMock): ?>
        <div class="mt-6 p-3 rounded-lg bg-amber-950/60 border border-amber-500/40 text-amber-300 text-xs font-mono flex items-center gap-2">
          <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
          <span><strong>Notice:</strong> <?= htmlspecialchars($dataSource) ?>. For live AWS data, ensure RDS MySQL instance is running and credentials are set in <code class="bg-black/30 px-1 py-0.5 rounded">.env</code>.</span>
        </div>
        <?php endif; ?>
      </div>

      <!-- MAIN DATA DISPLAY SECTION -->
      <?php if ($isSuccess && !empty($records)): ?>
      
      <!-- Academic Cards Timeline -->
      <div class="space-y-6">
        <div class="flex items-center justify-between pb-2 border-b border-slate-800">
          <h2 class="text-xl font-display font-bold text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
            </svg>
            Structured Academic Credentials
          </h2>
          <span class="text-xs font-mono text-slate-400"><?= count($records) ?> Records Retrieved</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <?php foreach ($records as $index => $row): ?>
          <div class="glass-card p-6 flex flex-col justify-between group hover:border-cyan-400/50 transition-all duration-300">
            <div class="space-y-4">
              
              <!-- Record Index & Badge -->
              <div class="flex items-center justify-between">
                <span class="px-2.5 py-1 rounded bg-cyan-950/80 border border-cyan-500/40 text-cyan-300 font-mono text-xs">
                  Record #<?= htmlspecialchars($row['id'] ?? ($index + 1)) ?>
                </span>
                <span class="font-mono text-xs text-slate-400">
                  <?= htmlspecialchars($row['year'] ?? '') ?>
                </span>
              </div>

              <!-- Institution Name -->
              <div>
                <h3 class="text-lg font-display font-bold text-white group-hover:text-cyan-300 transition-colors">
                  <?= htmlspecialchars($row['institution']) ?>
                </h3>
                <p class="text-xs font-mono text-slate-400 mt-1">
                  <?= htmlspecialchars($row['qualification'] ?? '') ?>
                </p>
              </div>

              <!-- Degree / Program -->
              <div class="p-3.5 rounded-lg bg-slate-950/70 border border-slate-800 text-xs space-y-1">
                <div class="text-slate-400 font-mono text-[10px] uppercase tracking-wider">Degree / Program</div>
                <div class="text-slate-200 font-medium font-sans">
                  <?= htmlspecialchars($row['degree']) ?> &ndash; <?= htmlspecialchars($row['program']) ?>
                </div>
              </div>

            </div>

            <!-- Performance Metric (Percentage Evaluation) -->
            <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between font-mono text-xs">
              <span class="text-slate-400">Evaluation:</span>
              <?php if (!empty($row['percentage'])): ?>
                <span class="px-2.5 py-1 rounded bg-indigo-950/80 border border-indigo-500/40 text-indigo-300 font-bold">
                  <?= htmlspecialchars(rtrim(rtrim($row['percentage'], '0'), '.')) ?>%
                </span>
              <?php else: ?>
                <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-cyan-300 font-medium">
                  Undergraduate Program
                </span>
              <?php endif; ?>
            </div>

          </div>
          <?php endforeach; ?>
        </div>

        <!-- Relational Table View -->
        <div class="glass-card p-6 overflow-hidden mt-8">
          <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-800">
            <div>
              <h3 class="text-base font-display font-bold text-white">Relational Table View</h3>
              <p class="text-xs font-mono text-slate-400">Direct SQL result set from <code class="text-cyan-300">SELECT id, institution, degree, program, qualification, percentage, year FROM academic_records</code></p>
            </div>
            <span class="font-mono text-xs text-emerald-400 flex items-center gap-1.5">
              <span class="w-2 h-2 rounded-full bg-emerald-400"></span> PDO Query OK
            </span>
          </div>

          <div class="overflow-x-auto">
            <table class="w-full text-left font-mono text-xs border-collapse">
              <thead>
                <tr class="border-b border-slate-800 text-slate-400 bg-slate-950/60">
                  <th class="py-3 px-4">id</th>
                  <th class="py-3 px-4">institution</th>
                  <th class="py-3 px-4">degree</th>
                  <th class="py-3 px-4">program</th>
                  <th class="py-3 px-4">qualification</th>
                  <th class="py-3 px-4">percentage</th>
                  <th class="py-3 px-4">year</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-800/60 text-slate-300">
                <?php foreach ($records as $row): ?>
                <tr class="hover:bg-slate-900/40 transition-colors">
                  <td class="py-3 px-4 text-cyan-400 font-bold"><?= htmlspecialchars($row['id']) ?></td>
                  <td class="py-3 px-4 text-white font-medium"><?= htmlspecialchars($row['institution']) ?></td>
                  <td class="py-3 px-4 text-slate-300"><?= htmlspecialchars($row['degree']) ?></td>
                  <td class="py-3 px-4 text-slate-200"><?= htmlspecialchars($row['program']) ?></td>
                  <td class="py-3 px-4 text-slate-400"><?= htmlspecialchars($row['qualification']) ?></td>
                  <td class="py-3 px-4 font-bold text-indigo-300">
                    <?= !empty($row['percentage']) ? htmlspecialchars(rtrim(rtrim($row['percentage'], '0'), '.')) . '%' : '<span class="text-slate-500 font-normal">NULL</span>' ?>
                  </td>
                  <td class="py-3 px-4 text-slate-400"><?= htmlspecialchars($row['year']) ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <?php else: ?>
      
      <!-- Graceful Error Card (RDS Unavailable) -->
      <div class="glass-card p-8 border-rose-500/30 text-center space-y-4 max-w-2xl mx-auto">
        <div class="w-14 h-14 rounded-full bg-rose-500/10 border border-rose-500/40 flex items-center justify-center text-rose-400 mx-auto">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
        </div>
        <h2 class="text-xl font-display font-bold text-white"><?= htmlspecialchars($errorMessage) ?></h2>
        <p class="text-slate-400 text-sm leading-relaxed max-w-md mx-auto">
          The Amazon RDS MySQL database could not be reached. Please verify that your EC2 security group has outbound access to port 3306 on the RDS instance and credentials are configured in <code class="font-mono text-cyan-300">.env</code>.
        </p>
        <div class="pt-2">
          <a href="academic.php?mock=1" class="btn-secondary text-xs font-mono py-2 px-4">
            <span>View Simulated Academic Records (Demo Mode)</span>
          </a>
        </div>
      </div>

      <?php endif; ?>

      <!-- AWS Architecture & Viva Explanation Box -->
      <div class="glass-card p-6 sm:p-8 border-slate-800">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-display font-bold text-white">Why Amazon RDS MySQL for Academic Records?</h3>
            <p class="text-xs font-mono text-slate-400">Cloud Architecture &amp; Assignment Viva Rationale</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2 text-xs text-slate-300">
          <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 space-y-1.5">
            <div class="text-cyan-400 font-mono font-semibold">1. Structured Relational Schema</div>
            <p class="text-slate-400 leading-relaxed">
              Academic credentials adhere to a rigid tabular structure with strictly typed fields (institution, degree, qualification, percentage, year). A relational SQL database guarantees schema enforcement.
            </p>
          </div>
          <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 space-y-1.5">
            <div class="text-indigo-400 font-mono font-semibold">2. ACID Transaction Integrity</div>
            <p class="text-slate-400 leading-relaxed">
              Official academic records require atomic integrity and consistency. Amazon RDS automatically provides automated backups, Multi-AZ replication, and point-in-time recovery.
            </p>
          </div>
          <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800/80 space-y-1.5">
            <div class="text-purple-400 font-mono font-semibold">3. Least Privilege &amp; Isolation</div>
            <p class="text-slate-400 leading-relaxed">
              The RDS instance resides in a private DB subnet group, accepting inbound MySQL traffic exclusively from the Amazon EC2 Web Server security group, completely blocking public internet exposure.
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
          &copy; <?= date('Y') ?> <span class="text-slate-200">Akhil Rajan P</span> &bull; Amazon RDS MySQL Integration
        </div>
      </div>

      <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-[11px] font-mono text-slate-400">
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        <span>Hosted on Amazon EC2</span>
      </div>

      <div class="flex items-center gap-4 text-xs font-mono">
        <a href="index.php" class="text-slate-400 hover:text-cyan-400 transition-colors">Portfolio Home</a>
        <a href="skills.php" class="text-slate-400 hover:text-cyan-400 transition-colors">DynamoDB Skills</a>
      </div>
    </div>
  </footer>

  <!-- Canvas Particles Script -->
  <script src="./script.js"></script>
</body>
</html>
