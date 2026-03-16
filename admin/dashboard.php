<?php
$pageTitle = "Tableau de bord";
include 'header.php';

// Compter les éléments
$projectsCount = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$publicationsCount = $pdo->query("SELECT COUNT(*) FROM publications")->fetchColumn();
$blogCount = $pdo->query("SELECT COUNT(*) FROM blog")->fetchColumn();
?>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <i class="fas fa-code"></i>
        <h3>Projets</h3>
        <p><?php echo $projectsCount; ?></p>
        <a href="projects.php" class="btn btn-small btn-primary">Gérer</a>
    </div>
    <div class="dashboard-card">
        <i class="fas fa-file-alt"></i>
        <h3>Publications</h3>
        <p><?php echo $publicationsCount; ?></p>
        <a href="publications.php" class="btn btn-small btn-primary">Gérer</a>
    </div>
    <div class="dashboard-card">
        <i class="fas fa-blog"></i>
        <h3>Articles de blog</h3>
        <p><?php echo $blogCount; ?></p>
        <a href="blog.php" class="btn btn-small btn-primary">Gérer</a>
    </div>
    <div class="dashboard-card">
        <i class="fas fa-user"></i>
        <h3>Profil</h3>
        <p>Modifier vos informations</p>
        <a href="profile.php" class="btn btn-small btn-primary">Modifier</a>
    </div>
</div>

<?php include 'footer.php'; ?>