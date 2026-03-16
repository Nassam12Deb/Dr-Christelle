<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier un article" : "Ajouter un article";
include 'header.php';

$article = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM blog WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch();
    if (!$article) {
        header('Location: blog.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $date = $_POST['date'];
    $read_time = $_POST['read_time'];
    $image = $_POST['image']; // classe FontAwesome

    if ($id) {
        $sql = "UPDATE blog SET title=?, slug=?, excerpt=?, content=?, tags=?, date=?, read_time=?, image=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $slug, $excerpt, $content, $tags, $date, $read_time, $image, $id]);
    } else {
        $sql = "INSERT INTO blog (title, slug, excerpt, content, tags, date, read_time, image) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $slug, $excerpt, $content, $tags, $date, $read_time, $image]);
    }
    header('Location: blog.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier l\'article' : 'Ajouter un article'; ?></h2>

<form method="POST" class="admin-form">
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($article['title'] ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label>Slug (URL)</label>
        <input type="text" name="slug" class="form-control" value="<?php echo htmlspecialchars($article['slug'] ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label>Extrait</label>
        <textarea name="excerpt" class="form-control" rows="3"><?php echo htmlspecialchars($article['excerpt'] ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label>Contenu</label>
        <textarea name="content" class="form-control" rows="10"><?php echo htmlspecialchars($article['content'] ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label>Tags (séparés par des virgules)</label>
        <input type="text" name="tags" class="form-control" value="<?php echo htmlspecialchars($article['tags'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Date</label>
        <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($article['date'] ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label>Temps de lecture (minutes)</label>
        <input type="number" name="read_time" class="form-control" value="<?php echo htmlspecialchars($article['read_time'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Icône (classe FontAwesome, ex: fa-lock)</label>
        <input type="text" name="image" class="form-control" value="<?php echo htmlspecialchars($article['image'] ?? 'fa-lock'); ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="blog.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>