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
    $title = $_POST['title'];
    $journal = $_POST['journal'];
    $year = $_POST['year'];
    $authors = $_POST['authors'];
    $doi = $_POST['doi'];
    $type = $_POST['type'];

    if ($id) {
        $sql = "UPDATE publications SET title=?, journal=?, year=?, authors=?, doi=?, type=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $journal, $year, $authors, $doi, $type, $id]);
    } else {
        $sql = "INSERT INTO publications (title, journal, year, authors, doi, type) VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $journal, $year, $authors, $doi, $type]);
    }
    header('Location: publications.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier la publication' : 'Ajouter une publication'; ?></h2>

<form method="POST" class="admin-form">
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($pub['title'] ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label>Revue / Ouvrage</label>
        <input type="text" name="journal" class="form-control" value="<?php echo htmlspecialchars($pub['journal'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Année</label>
        <input type="number" name="year" class="form-control" value="<?php echo htmlspecialchars($pub['year'] ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label>Auteurs</label>
        <input type="text" name="authors" class="form-control" value="<?php echo htmlspecialchars($pub['authors'] ?? ''); ?>" placeholder="C. Dejolie, A. Martin">
    </div>
    <div class="form-group">
        <label>DOI</label>
        <input type="text" name="doi" class="form-control" value="<?php echo htmlspecialchars($pub['doi'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Type</label>
        <select name="type" class="form-control">
            <option value="article" <?php echo ($pub['type']??'')=='article'?'selected':''; ?>>Article</option>
            <option value="chapter" <?php echo ($pub['type']??'')=='chapter'?'selected':''; ?>>Chapitre</option>
        </select>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="publications.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>