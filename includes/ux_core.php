<?php
/**
 * UX Core — Premium Card Framework
 * Skeleton v6 (v9.2) — Oceanic Blueprint Edition
 */

function render_css() {
    // Already defined in assets/css/style.css, but this ensures critical layout vars
    ?>
    <style>
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .premium-card {
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.5);
            display: flex;
            flex-direction: column;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle at center, rgba(34, 211, 238, 0.03) 0%, transparent 70%);
            pointer-events: none;
        }

        .premium-card:hover {
            transform: translateY(-8px);
            border-color: rgba(34, 211, 238, 0.4);
            background: rgba(15, 23, 42, 0.7);
            box-shadow: 0 30px 60px -15px rgba(34, 211, 238, 0.15);
        }

        .premium-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .premium-card .card-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .premium-card .card-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .premium-card .card-icon {
            width: 50px;
            height: 50px;
            background: rgba(34, 211, 238, 0.1);
            color: var(--accent-primary);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border: 1px solid rgba(34, 211, 238, 0.1);
        }

        .premium-card .card-value {
            font-family: var(--font-display);
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 1rem;
        }

        .premium-card .card-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .premium-card .trend-badge {
            padding: 4px 10px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trend-up { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .trend-down { background: rgba(244, 63, 94, 0.1); color: #f43f5e; }

        .progress-container {
            width: 100%;
            height: 8px;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            margin-top: 1rem;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 10px;
            transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .premium-card { animation: slideIn 0.6s ease-out backwards; }
    </style>
    <?php
}

function render_premium_card($title, $value, $trend = null, $trendType = 'up', $icon = '📊', $progress = null, $delay = 0) {
    ?>
    <div class="premium-card" style="animation-delay: <?= $delay ?>ms">
        <div class="card-header">
            <div class="card-info">
                <span class="card-title"><?= htmlspecialchars($title) ?></span>
            </div>
            <div class="card-icon"><?= $icon ?></div>
        </div>
        
        <div class="card-value"><?= htmlspecialchars($value) ?></div>
        
        <?php if ($progress !== null): ?>
            <div class="progress-container">
                <div class="progress-bar" style="width: <?= (int)$progress ?>%"></div>
            </div>
        <?php endif; ?>

        <?php if ($trend): ?>
            <div class="card-footer">
                <div class="trend-badge <?= $trendType === 'up' ? 'trend-up' : 'trend-down' ?>">
                    <?= $trendType === 'up' ? '↗' : '↘' ?> <?= htmlspecialchars($trend) ?>
                </div>
                <span style="font-size: 0.75rem; color: var(--text-muted);">vs last period</span>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
