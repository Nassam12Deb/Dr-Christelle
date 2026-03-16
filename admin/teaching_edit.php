<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier un enseignement" : "Ajouter un enseignement";
include 'header.php';

$teaching = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM teachings WHERE id = ?");
    $stmt->execute([$id]);
    $teaching = $stmt->fetch();
    if (!$teaching) { header('Location: teachings.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title          = $_POST['title'];
    $title_en       = $_POST['title_en'];
    $level          = $_POST['level'];
    $level_en       = $_POST['level_en'];
    $description    = $_POST['description'];
    $description_en = $_POST['description_en'];
    $sort_order     = (int)$_POST['sort_order'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE teachings SET title=?, title_en=?, level=?, level_en=?, description=?, description_en=?, sort_order=? WHERE id=?");
        $stmt->execute([$title, $title_en, $level, $level_en, $description, $description_en, $sort_order, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO teachings (title, title_en, level, level_en, description, description_en, sort_order) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$title, $title_en, $level, $level_en, $description, $description_en, $sort_order]);
    }
    header('Location: teachings.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier l\'enseignement' : 'Ajouter un enseignement'; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Titre 🇫🇷</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($teaching['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Title 🇬🇧</label>
            <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($teaching['title_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Niveau 🇫🇷 (ex: Master 2 · 30h)</label>
            <input type="text" name="level" class="form-control" value="<?php echo htmlspecialchars($teaching['level'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>Level 🇬🇧 (ex: Master 2 · 30h)</label>
            <input type="text" name="level_en" class="form-control" value="<?php echo htmlspecialchars($teaching['level_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Description 🇫🇷</label>
            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($teaching['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>Description 🇬🇧</label>
            <textarea name="description_en" class="form-control" rows="3"><?php echo htmlspecialchars($teaching['description_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Ordre d'affichage</label>
        <input type="number" name="sort_order" class="form-control" value="<?php echo $teaching['sort_order'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="teachings.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>