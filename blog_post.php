<?php include 'header.php';

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    header('Location: blog.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM blog WHERE slug = ?");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    header('Location: blog.php');
    exit;
}

$title   = ($lang === 'en' && !empty($article['title_en']))   ? $article['title_en']   : $article['title'];
$content = ($lang === 'en' && !empty($article['content_en'])) ? $article['content_en'] : $article['content'];
$tags    = ($lang === 'en' && !empty($article['tags_en']))    ? $article['tags_en']    : $article['tags'];
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <article class="blog-post">
            <h1 class="section-title" data-aos="fade-right"><?php echo htmlspecialchars($title); ?></h1>
            <div class="blog-meta" style="margin-bottom: 30px;">
                <span><i class="far fa-calendar"></i> <?php echo date('d F Y', strtotime($article['date'])); ?></span>
                <span style="margin-left:20px;"><i class="far fa-clock"></i> <?php echo $article['read_time']; ?> <?php echo $t['blog_min']; ?></span>
            </div>
            <div class="blog-content" style="line-height:1.8;">
                <?php echo nl2br(htmlspecialchars($content)); ?>
            </div>
            <?php if ($tags): ?>
            <div class="blog-tags" style="margin-top:40px;">
                <?php foreach (explode(',', $tags) as $tag): ?>
                    <span class="tag"><?php echo trim(htmlspecialchars($tag)); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div style="margin-top: 40px;">
                <a href="blog.php" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> <?php echo $t['blog_back']; ?>
                </a>
            </div>
        </article>
    </div>
</section>

<?php include 'footer.php'; ?>