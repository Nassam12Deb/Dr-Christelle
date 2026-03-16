<?php include 'header.php';

$publications = $pdo->query("SELECT * FROM publications ORDER BY year DESC")->fetchAll();
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right">Publications</h1>

        <div class="publications-list">
            <?php foreach ($publications as $pub): ?>
            <div class="publication-item" data-aos="fade-left" data-aos-delay="100">
                <div class="pub-icon"><i class="fas fa-file-alt"></i></div>
                <div class="pub-content">
                    <h4><?php echo htmlspecialchars($pub['title']); ?></h4>
                    <p class="pub-meta"><?php echo htmlspecialchars($pub['journal']); ?>, <?php echo $pub['year']; ?></p>
                    <p class="pub-authors"><?php echo htmlspecialchars($pub['authors']); ?></p>
                    <?php if ($pub['doi']): ?>
                        <a href="https://doi.org/<?php echo htmlspecialchars($pub['doi']); ?>" class="pub-doi">DOI: <?php echo htmlspecialchars($pub['doi']); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>