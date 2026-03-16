<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier une compétence" : "Ajouter une compétence";
include 'header.php';

$skill = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM skills WHERE id = ?");
    $stmt->execute([$id]);
    $skill = $stmt->fetch();
    if (!$skill) { header('Location: skills.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = $_POST['name'];
    $name_en    = $_POST['name_en'];
    $category   = $_POST['category'];
    $level      = (int)$_POST['level'];
    $sort_order = (int)$_POST['sort_order'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE skills SET name=?, name_en=?, category=?, level=?, sort_order=? WHERE id=?");
        $stmt->execute([$name, $name_en, $category, $level, $sort_order, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO skills (name, name_en, category, level, sort_order) VALUES (?,?,?,?,?)");
        $stmt->execute([$name, $name_en, $category, $level, $sort_order]);
    }
    header('Location: skills.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier la compétence' : 'Ajouter une compétence'; ?></h2>

<form method="POST" class="admin-form" style="max-width:700px;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Nom 🇫🇷</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($skill['name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Name 🇬🇧</label>
            <input type="text" name="name_en" class="form-control" value="<?php echo htmlspecialchars($skill['name_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <select name="category" class="form-control" required>
            <option value="offensive"  <?php echo ($skill['category'] ?? '') == 'offensive'  ? 'selected' : ''; ?>>Offensif</option>
            <option value="defensive"  <?php echo ($skill['category'] ?? '') == 'defensive'  ? 'selected' : ''; ?>>Défensif</option>
            <option value="tools"      <?php echo ($skill['category'] ?? '') == 'tools'      ? 'selected' : ''; ?>>Outils (tag)</option>
        </select>
    </div>
    <div class="form-group">
        <label>Niveau (0-100) — ignoré pour la catégorie Outils</label>
        <div style="display:flex; align-items:center; gap:15px;">
            <input type="range" name="level" min="0" max="100" value="<?php echo $skill['level'] ?? 80; ?>"
                   oninput="document.getElementById('levelVal').textContent=this.value+'%'"
                   style="flex:1; accent-color:var(--accent-primary);">
            <span id="levelVal" style="color:var(--accent-primary); font-weight:600; min-width:45px;">
                <?php echo ($skill['level'] ?? 80) . '%'; ?>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label>Ordre d'affichage</label>
        <input type="number" name="sort_order" class="form-control" value="<?php echo $skill['sort_order'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="skills.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>