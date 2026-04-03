<?php
/**
 * MSEndpoint SaaS Skeleton — V6 (Premium Edition)
 * A professional, high-end starting point for M365 automation tools.
 */
require_once 'includes/config.php';
require_once 'includes/ms_graph.php';
require_once 'includes/ux_core.php';

session_start();

$isAuthenticated = !empty($_SESSION['ms_access_token']);
$user = $_SESSION['ms_user_profile'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> — Advanced M365 Productivity</title>
    
    <!-- Design System Alignment -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <?php render_css(); ?>
</head>
<body class="<?= $isAuthenticated ? 'dashboard-view' : 'landing-view' ?>">
    <nav class="navbar">
        <div class="container" style="display:flex; align-items:center; width:100%;">
            <a href="index.php" class="logo">
                <span class="logo-icon">💠</span>
                <span class="logo-text"><?= SITE_NAME ?></span>
            </a>
            <div class="nav-links">
                <?php if ($isAuthenticated): ?>
                    <span class="user-pill"><?= htmlspecialchars($user['displayName'] ?? 'Administrator') ?></span>
                    <a href="auth.php?action=logout" style="color:var(--accent-primary); font-weight:700;">Logout</a>
                <?php else: ?>
                    <a href="#features">Features</a>
                    <a href="#security">Security</a>
                    <a href="auth.php?action=login" class="btn-primary" style="padding: 0.6rem 1.2rem; border-radius: 10px; font-size: 0.85rem;">Get Started</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if (!$isAuthenticated): ?>
    <!-- ── PREMIUM LANDING STATE ── -->
    <header class="hero">
        <div class="container">
            <div class="badge">Professional Endpoint Automation</div>
            <h1 class="gradient-text"><?= HERO_TITLE ?></h1>
            <p><?= HERO_SUBTITLE ?></p>
            <div class="hero-actions" style="display:flex; gap:1.5rem; justify-content:center;">
                <a href="auth.php?action=login" class="btn-primary">Connect Your Tenant</a>
                <a href="#features" class="btn-outline">Technical Overview</a>
            </div>
        </div>
    </header>

    <section id="features" class="features">
        <div class="container">
            <div class="features-grid">
                <div class="glass-card feature-card">
                    <div class="icon">⚡</div>
                    <h3>Graph Native</h3>
                    <p>Built directly on the Microsoft Graph API for sub-second latency and absolute accuracy.</p>
                </div>
                <div class="glass-card feature-card">
                    <div class="icon">🛡️</div>
                    <h3>Zero Trust Security</h3>
                    <p>OAuth2 integrated flow ensuring your administrative context is never cached or stored.</p>
                </div>
                <div class="glass-card feature-card">
                    <div class="icon">📈</div>
                    <h3>Insights First</h3>
                    <p>Beautifully visualized metrics translated from raw Intune logs into actionable intelligence.</p>
                </div>
            </div>
        </div>
    </section>
    <?php else: ?>
    <!-- ── PREMIUM DASHBOARD STATE ── -->
    <div class="container" style="padding-top: 120px; padding-bottom: 5rem;">
        <div style="margin-bottom: 3rem;">
            <span style="color:var(--accent-primary); font-weight:700; font-size:0.85rem; text-transform:uppercase; letter-spacing:2px;">Live Environment</span>
            <h2 style="font-family:var(--font-display); font-size:3rem; margin-top:0.5rem; color:var(--text-primary);">Management Dashboard</h2>
            <p style="color:var(--text-muted);">Connected to <strong><?= htmlspecialchars($user['mail'] ?? 'Enterprise Tenant') ?></strong></p>
        </div>

        <div class="dashboard-grid">
            <?php 
            // Implementation of high-end metric cards
            render_premium_card("Policy Compliance", "98.2%", "1.2%", "up", "✅", 98, 100);
            render_premium_card("Security Alerts", "04", "2", "down", "🚨", 15, 200);
            render_premium_card("Active Syncs", "1,244", "124", "up", "🔄", 85, 300);
            render_premium_card("API Latency", "124ms", "-12ms", "up", "🌐", 100, 400);
            ?>
        </div>
        
        <div class="glass-card" style="margin-top:2.5rem; padding: 2.5rem; border-color: rgba(34,211,238,0.15); border-left: 4px solid var(--accent-primary);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
                <h3 style="font-family:var(--font-display); font-size:1.4rem;">Deployment Activity Log</h3>
                <span class="badge" style="margin-bottom:0; font-size:0.65rem;">Real-time</span>
            </div>
            <p style="color:var(--text-muted); font-size:0.95rem; line-height:1.6;">
                The Graph API is currently streaming synchronization data from the Intune service. 
                All policy modifications and assignment changes are tracked and visualized in the charts above.
            </p>
        </div>
    </div>
    <?php endif; ?>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?> — A premium tool by <strong style="color:var(--accent-primary);">MSEndpoint Academy</strong></p>
            <div style="margin-top:1rem; font-size:0.75rem; color:rgba(255,255,255,0.2);">
                Professional-grade automation for Microsoft Modern Workplace environments.
            </div>
        </div>
    </footer>

    <script>
        // Subtle entrance reveals
        document.addEventListener('DOMContentLoaded', () => {
            console.log("MSEndpoint SaaS Framework Initialized.");
        });
    </script>
</body>
</html>
