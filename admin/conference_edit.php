<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier une conférence" : "Ajouter une conférence";
include 'header.php';

$conf = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM conferences WHERE id = ?");
    $stmt->execute([$id]);
    $conf = $stmt->fetch();
    if (!$conf) { header('Location: conferences.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year           = $_POST['year'];
    $title          = $_POST['title'];
    $title_en       = $_POST['title_en'];
    $location       = $_POST['location'];
    $location_en    = $_POST['location_en'];
    $description    = $_POST['description'];
    $description_en = $_POST['description_en'];
    $sort_order     = (int)$_POST['sort_order'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE conferences SET year=?, title=?, title_en=?, location=?, location_en=?, description=?, description_en=?, sort_order=? WHERE id=?");
        $stmt->execute([$year, $title, $title_en, $location, $location_en, $description, $description_en, $sort_order, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO conferences (year, title, title_en, location, location_en, description, description_en, sort_order) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$year, $title, $title_en, $location, $location_en, $description, $description_en, $sort_order]);
    }
    header('Location: conferences.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier la conférence' : 'Ajouter une conférence'; ?></h2>

<form method="POST" class="admin-form">
    <div class="form-group">
        <label>Année</label>
        <input type="number" name="year" class="form-control" value="<?php echo $conf['year'] ?? date('Y'); ?>" required>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Titre 🇫🇷</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($conf['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Title 🇬🇧</label>
            <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($conf['title_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Lieu 🇫🇷 (ex: Paris, France)</label>
            <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($conf['location'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>Location 🇬🇧</label>
            <input type="text" name="location_en" class="form-control" value="<?php echo htmlspecialchars($conf['location_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Description 🇫🇷</label>
            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($conf['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>Description 🇬🇧</label>
            <textarea name="description_en" class="form-control" rows="3"><?php echo htmlspecialchars($conf['description_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Ordre d'affichage</label>
        <input type="number" name="sort_order" class="form-control" value="<?php echo $conf['sort_order'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="conferences.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>