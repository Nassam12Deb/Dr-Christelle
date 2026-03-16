<?php include 'header.php';

$projects = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right">Projets techniques</h1>

        <div class="filter-buttons" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">Tous</button>
            <button class="filter-btn" data-filter="research">R&D</button>
            <button class="filter-btn" data-filter="defensive">Défensif</button>
            <button class="filter-btn" data-filter="tools">Outils</button>
        </div>

        <div class="projects-grid">
            <?php foreach ($projects as $project): ?>
            <div class="project-card" data-category="<?php echo $project['category']; ?>" data-aos="fade-up" data-aos-delay="100">
                <div class="project-header">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <span class="project-category"><?php echo $project['category']; ?></span>
                </div>
                <div class="project-body">
                    <p><strong>Problématique :</strong> <?php echo htmlspecialchars($project['problem']); ?></p>
                    <p><strong>Solution :</strong> <?php echo htmlspecialchars($project['solution']); ?></p>
                    <?php if ($project['technologies']): ?>
                    <div class="project-tech">
                        <?php foreach (explode(',', $project['technologies']) as $tech): ?>
                            <span><?php echo trim(htmlspecialchars($tech)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <p><strong>Résultats :</strong> <?php echo htmlspecialchars($project['results']); ?></p>
                </div>
                <div class="project-footer">
                    <?php if ($project['github_link']): ?>
                        <a href="<?php echo htmlspecialchars($project['github_link']); ?>" class="project-link"><i class="fab fa-github"></i> Code</a>
                    <?php endif; ?>
                    <?php if ($project['demo_link']): ?>
                        <a href="<?php echo htmlspecialchars($project['demo_link']); ?>" class="project-link"><i class="fas fa-external-link-alt"></i> Démo</a>
                    <?php endif; ?>
                    <?php if ($project['publication_link']): ?>
                        <a href="<?php echo htmlspecialchars($project['publication_link']); ?>" class="project-link"><i class="fas fa-file-pdf"></i> Publication</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>