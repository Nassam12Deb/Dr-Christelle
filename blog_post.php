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
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <article class="blog-post">
            <h1 class="section-title" data-aos="fade-right"><?php echo htmlspecialchars($article['title']); ?></h1>
            <div class="blog-meta" style="margin-bottom: 30px;">
                <span><i class="far fa-calendar"></i> <?php echo date('d F Y', strtotime($article['date'])); ?></span>
                <span style="margin-left:20px;"><i class="far fa-clock"></i> <?php echo $article['read_time']; ?> min</span>
            </div>
            <div class="blog-content" style="line-height:1.8;">
                <?php echo nl2br(htmlspecialchars($article['content'])); ?>
            </div>
            <?php if ($article['tags']): ?>
            <div class="blog-tags" style="margin-top:40px;">
                <?php foreach (explode(',', $article['tags']) as $tag): ?>
                    <span class="tag"><?php echo trim(htmlspecialchars($tag)); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </article>
    </div>
</section>

<?php include 'footer.php'; ?>