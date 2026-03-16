<?php
require_once __DIR__ . '/../config.php';
redirectIfNotLoggedIn();

$pageTitle = $pageTitle ?? 'Administration';
$username = $_SESSION['admin_username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - <?php echo SITE_NAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="sidebar-brand"><?php echo SITE_NAME; ?> - Admin</div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : ''; ?>><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>

                <li style="padding: 10px 20px 5px; color: var(--text-secondary); font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Contenu</li>
                <li><a href="projects.php" <?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'class="active"' : ''; ?>><i class="fas fa-code"></i> Projets</a></li>
                <li><a href="publications.php" <?php echo basename($_SERVER['PHP_SELF']) == 'publications.php' ? 'class="active"' : ''; ?>><i class="fas fa-file-alt"></i> Publications</a></li>
                <li><a href="blog.php" <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'class="active"' : ''; ?>><i class="fas fa-blog"></i> Blog</a></li>

                <li style="padding: 10px 20px 5px; color: var(--text-secondary); font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Profil</li>
                <li><a href="profile.php" <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'class="active"' : ''; ?>><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="skills.php" <?php echo basename($_SERVER['PHP_SELF']) == 'skills.php' ? 'class="active"' : ''; ?>><i class="fas fa-chart-bar"></i> Compétences</a></li>
                <li><a href="certifications.php" <?php echo basename($_SERVER['PHP_SELF']) == 'certifications.php' ? 'class="active"' : ''; ?>><i class="fas fa-certificate"></i> Certifications</a></li>
                <li><a href="teachings.php" <?php echo basename($_SERVER['PHP_SELF']) == 'teachings.php' ? 'class="active"' : ''; ?>><i class="fas fa-chalkboard-teacher"></i> Enseignements</a></li>
                <li><a href="conferences.php" <?php echo basename($_SERVER['PHP_SELF']) == 'conferences.php' ? 'class="active"' : ''; ?>><i class="fas fa-microphone"></i> Conférences</a></li>

                <li style="padding: 10px 20px 5px; color: var(--text-secondary); font-size:0.75rem; text-transform:uppercase; letter-spacing:1px;">Compte</li>
                <li><a href="change_password.php" <?php echo basename($_SERVER['PHP_SELF']) == 'change_password.php' ? 'class="active"' : ''; ?>><i class="fas fa-key"></i> Mot de passe</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <h1><?php echo $pageTitle; ?></h1>
                <div class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($username); ?></span>
                    <a href="logout.php" class="logout-btn" title="Déconnexion"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </header>
            <div class="admin-content">