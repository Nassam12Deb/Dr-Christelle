<?php include 'header.php';

$projects = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right"><?php echo $t['projects_title']; ?></h1>

        <div class="filter-buttons" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all"><?php echo $t['filter_all']; ?></button>
            <button class="filter-btn" data-filter="research"><?php echo $t['filter_rd']; ?></button>
            <button class="filter-btn" data-filter="defensive"><?php echo $t['filter_defensive']; ?></button>
            <button class="filter-btn" data-filter="tools"><?php echo $t['filter_tools']; ?></button>
        </div>

        <div class="projects-grid">
            <?php foreach ($projects as $project):
                $title    = ($lang === 'en' && !empty($project['title_en']))    ? $project['title_en']    : $project['title'];
                $problem  = ($lang === 'en' && !empty($project['problem_en']))  ? $project['problem_en']  : $project['problem'];
                $solution = ($lang === 'en' && !empty($project['solution_en'])) ? $project['solution_en'] : $project['solution'];
                $results  = ($lang === 'en' && !empty($project['results_en']))  ? $project['results_en']  : $project['results'];
            ?>
            <div class="project-card" data-category="<?php echo $project['category']; ?>" data-aos="fade-up" data-aos-delay="100">
                <div class="project-header">
                    <h3><?php echo htmlspecialchars($title); ?></h3>
                    <span class="project-category"><?php echo htmlspecialchars($project['category']); ?></span>
                </div>
                <div class="project-body">
                    <p><strong><?php echo $t['project_problem']; ?> :</strong> <?php echo htmlspecialchars($problem); ?></p>
                    <p><strong><?php echo $t['project_solution']; ?> :</strong> <?php echo htmlspecialchars($solution); ?></p>
                    <?php if ($project['technologies']): ?>
                    <div class="project-tech">
                        <?php foreach (explode(',', $project['technologies']) as $tech): ?>
                            <span><?php echo trim(htmlspecialchars($tech)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <p><strong><?php echo $t['project_results']; ?> :</strong> <?php echo htmlspecialchars($results); ?></p>
                </div>
                <div class="project-footer">
                    <?php if ($project['github_link']): ?>
                        <a href="<?php echo htmlspecialchars($project['github_link']); ?>" class="project-link"><i class="fab fa-github"></i> <?php echo $t['project_code']; ?></a>
                    <?php endif; ?>
                    <?php if ($project['demo_link']): ?>
                        <a href="<?php echo htmlspecialchars($project['demo_link']); ?>" class="project-link"><i class="fas fa-external-link-alt"></i> <?php echo $t['project_demo']; ?></a>
                    <?php endif; ?>
                    <?php if ($project['publication_link']): ?>
                        <a href="<?php echo htmlspecialchars($project['publication_link']); ?>" class="project-link"><i class="fas fa-file-pdf"></i> <?php echo $t['project_pub']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>