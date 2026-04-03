<?php
/**
 * Auth Bridge — Skeleton v6 (v9.1)
 * Handles OAuth2 Callback and Session management.
 */
require_once 'includes/config.php';
require_once 'includes/ms_graph.php';

session_start();

$ms = new MsGraph(MS_CLIENT_ID, MS_CLIENT_SECRET, MS_REDIRECT_URI, MS_TENANT_ID);
$action = $_GET['action'] ?? '';

// 1. LOGIN REDIRECT
if ($action === 'login') {
    header("Location: " . $ms->getLoginUrl());
    exit;
}

// 2. CALLBACK HANDLING
if (isset($_GET['code'])) {
    // Validate state
    if (!isset($_GET['state']) || $_GET['state'] !== $_SESSION['ms_auth_state']) {
        die("Invalid auth state. Potential CSRF detected.");
    }

    $response = $ms->getTokenFromCode($_GET['code']);
    
    if ($response['status'] === 200) {
        $data = $response['data'];
        $_SESSION['ms_access_token']  = $data['access_token'];
        $_SESSION['ms_refresh_token'] = $data['refresh_token'] ?? '';
        $_SESSION['ms_token_expires'] = time() + $data['expires_in'];

        // Fetch User Profile for the dashboard
        $profile = $ms->graphCall('/me', $data['access_token']);
        $_SESSION['ms_user_profile'] = $profile['data'];

        header("Location: index.php");
        exit;
    } else {
        die("Auth Error: " . print_r($response['data'], true));
    }
}

// 3. LOGOUT
if ($action === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
