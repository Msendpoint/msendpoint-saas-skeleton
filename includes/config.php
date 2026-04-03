<?php
// includes/config.php
// This file is populated with real values during the AI generation phase.

define('SITE_NAME', 'SaaS Tool Name');
define('HERO_TITLE', 'The Smarter Way to Automate Your Workflow');
define('HERO_SUBTITLE', 'Unleash the power of the cloud with our next-gen SaaS platform built for modern developers.');

// Payment settings
define('STRIPE_URL', '#');
define('PRICE_MONTHLY', '$9');
define('PRICE_SOURCE', '$19');

// Microsoft 365 / Graph API Settings (Populated during Build)
define('MS_CLIENT_ID', 'YOUR_CLIENT_ID');
define('MS_CLIENT_SECRET', 'YOUR_CLIENT_SECRET');
define('MS_REDIRECT_URI', 'http://localhost/msendpoint/apps/<?= $slug ?>/auth.php');
define('MS_TENANT_ID', 'common');

// Social links
define('GITHUB_URL', 'https://github.com/Msendpoint');
define('LINKEDIN_URL', 'https://www.linkedin.com/company/msendpoint');

// Logic specific to the tool should be added below
?>
