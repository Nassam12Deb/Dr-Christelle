<?php include 'header.php';

$articles = $pdo->query("SELECT * FROM blog ORDER BY date DESC")->fetchAll();
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right">Blog technique</h1>
        <p class="text-center text-secondary mb-5" data-aos="fade-up">IA & Cybersécurité, menaces émergentes, retours d’expérience</p>

        <div class="blog-grid">
            <?php foreach ($articles as $article): ?>
            <div class="blog-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="blog-image">
                    <i class="fas <?php echo htmlspecialchars($article['image']); ?>"></i>
                </div>
                <div class="blog-content">
                    <div class="blog-date"><i class="far fa-calendar"></i> <?php echo date('d F Y', strtotime($article['date'])); ?> · <?php echo $article['read_time']; ?> min</div>
                    <h3 class="blog-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p class="blog-excerpt"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                    <?php if ($article['tags']): ?>
                    <div class="blog-tags">
                        <?php foreach (explode(',', $article['tags']) as $tag): ?>
                            <span class="tag"><?php echo trim(htmlspecialchars($tag)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <a href="blog_post.php?slug=<?php echo urlencode($article['slug']); ?>" class="blog-link">Lire la suite <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>