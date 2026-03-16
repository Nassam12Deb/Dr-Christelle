<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier une publication" : "Ajouter une publication";
include 'header.php';

$pub = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM publications WHERE id = ?");
    $stmt->execute([$id]);
    $pub = $stmt->fetch();
    if (!$pub) {
        header('Location: publications.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title      = $_POST['title'];
    $title_en   = $_POST['title_en'];
    $journal    = $_POST['journal'];
    $journal_en = $_POST['journal_en'];
    $year       = $_POST['year'];
    $authors    = $_POST['authors'];
    $authors_en = $_POST['authors_en'];
    $doi        = $_POST['doi'];
    $type       = $_POST['type'];

    if ($id) {
        $sql = "UPDATE publications SET title=?, title_en=?, journal=?, journal_en=?, year=?, authors=?, authors_en=?, doi=?, type=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $title_en, $journal, $journal_en, $year, $authors, $authors_en, $doi, $type, $id]);
    } else {
        $sql = "INSERT INTO publications (title, title_en, journal, journal_en, year, authors, authors_en, doi, type) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $title_en, $journal, $journal_en, $year, $authors, $authors_en, $doi, $type]);
    }
    header('Location: publications.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier la publication' : 'Ajouter une publication'; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Titre 🇫🇷</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($pub['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Title 🇬🇧</label>
            <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($pub['title_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Revue 🇫🇷</label>
            <input type="text" name="journal" class="form-control" value="<?php echo htmlspecialchars($pub['journal'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>Journal 🇬🇧</label>
            <input type="text" name="journal_en" class="form-control" value="<?php echo htmlspecialchars($pub['journal_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Année</label>
        <input type="number" name="year" class="form-control" value="<?php echo htmlspecialchars($pub['year'] ?? ''); ?>" required>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Auteurs 🇫🇷</label>
            <input type="text" name="authors" class="form-control" value="<?php echo htmlspecialchars($pub['authors'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>Authors 🇬🇧</label>
            <input type="text" name="authors_en" class="form-control" value="<?php echo htmlspecialchars($pub['authors_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label>DOI</label>
        <input type="text" name="doi" class="form-control" value="<?php echo htmlspecialchars($pub['doi'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Type</label>
        <select name="type" class="form-control">
            <option value="article" <?php echo ($pub['type'] ?? '') == 'article' ? 'selected' : ''; ?>>Article</option>
            <option value="chapter" <?php echo ($pub['type'] ?? '') == 'chapter' ? 'selected' : ''; ?>>Chapitre</option>
        </select>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="publications.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>