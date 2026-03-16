<?php include 'header.php';

$articles = $pdo->query("SELECT * FROM blog ORDER BY date DESC")->fetchAll();
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right"><?php echo $t['blog_title']; ?></h1>
        <p class="text-center text-secondary mb-5" data-aos="fade-up"><?php echo $t['blog_subtitle']; ?></p>

        <div class="blog-grid">
            <?php foreach ($articles as $article):
                $title   = ($lang === 'en' && !empty($article['title_en']))   ? $article['title_en']   : $article['title'];
                $excerpt = ($lang === 'en' && !empty($article['excerpt_en'])) ? $article['excerpt_en'] : $article['excerpt'];
                $tags    = ($lang === 'en' && !empty($article['tags_en']))    ? $article['tags_en']    : $article['tags'];
            ?>
            <div class="blog-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="blog-image">
                    <i class="fas <?php echo htmlspecialchars($article['image']); ?>"></i>
                </div>
                <div class="blog-content">
                    <div class="blog-date">
                        <i class="far fa-calendar"></i>
                        <?php echo date('d F Y', strtotime($article['date'])); ?> · <?php echo $article['read_time']; ?> <?php echo $t['blog_min']; ?>
                    </div>
                    <h3 class="blog-title"><?php echo htmlspecialchars($title); ?></h3>
                    <p class="blog-excerpt"><?php echo htmlspecialchars($excerpt); ?></p>
                    <?php if ($tags): ?>
                    <div class="blog-tags">
                        <?php foreach (explode(',', $tags) as $tag): ?>
                            <span class="tag"><?php echo trim(htmlspecialchars($tag)); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <a href="blog_post.php?slug=<?php echo urlencode($article['slug']); ?>" class="blog-link">
                        <?php echo $t['blog_read_more']; ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>