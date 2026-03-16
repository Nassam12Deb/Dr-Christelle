<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> | <?php echo SITE_TITLE; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <span class="logo-accent">Dr.</span> Dejolie
            </a>
            <ul class="nav-menu">
                <?php
                $pages = [
                    'index.php' => $t['nav_home'],
                    'about.php' => $t['nav_about'],
                    'projects.php' => $t['nav_projects'],
                    'publications.php' => $t['nav_publications'],
                    'blog.php' => $t['nav_blog'],
                    'contact.php' => $t['nav_contact'],
                ];
                $current = basename($_SERVER['PHP_SELF']);
                foreach ($pages as $file => $title) {
                    $active = ($file == $current) ? 'active' : '';
                    echo "<li><a href=\"$file\" class=\"nav-link $active\">$title</a></li>";
                }
                ?>
                <li>
                    <?php
                    $otherLang = ($lang === 'fr') ? 'en' : 'fr';
                    $otherLabel = ($lang === 'fr') ? 'EN' : 'FR';
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    // Conserver les autres paramètres GET sauf lang
                    $params = $_GET;
                    $params['lang'] = $otherLang;
                    $queryString = http_build_query($params);
                    ?>
                    <a href="<?php echo $currentPage . '?' . $queryString; ?>" class="nav-link lang-switch"
                        title="Switch language">
                        <?php echo $otherLabel; ?>
                    </a>
                </li>
                <li>
                    <button id="themeToggle" class="theme-toggle" aria-label="Changer le thème">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>
    <main>