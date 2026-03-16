<?php
require_once __DIR__ . '/../config.php';
redirectIfNotLoggedIn();

// Définir un titre par défaut si non défini
$pageTitle = $pageTitle ?? 'Administration';
$username = $_SESSION['admin_username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - <?php echo SITE_NAME; ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <?php echo SITE_NAME; ?> - Admin
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : ''; ?>><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="projects.php" <?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'class="active"' : ''; ?>><i class="fas fa-code"></i> Projets</a></li>
                <li><a href="publications.php" <?php echo basename($_SERVER['PHP_SELF']) == 'publications.php' ? 'class="active"' : ''; ?>><i class="fas fa-file-alt"></i> Publications</a></li>
                <li><a href="blog.php" <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'class="active"' : ''; ?>><i class="fas fa-blog"></i> Blog</a></li>
                <li><a href="profile.php" <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'class="active"' : ''; ?>><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="change_password.php" <?php echo basename($_SERVER['PHP_SELF']) == 'change_password.php' ? 'class="active"' : ''; ?>><i class="fas fa-key"></i> Changer mot de passe</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Main content -->
        <main class="admin-main">
            <header class="admin-header">
                <h1><?php echo $pageTitle; ?></h1>
                <div class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($username); ?></span>
                    <a href="logout.php" class="logout-btn" title="Déconnexion"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </header>
            <div class="admin-content">