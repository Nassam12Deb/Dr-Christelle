<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier une certification" : "Ajouter une certification";
include 'header.php';

$cert = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM certifications WHERE id = ?");
    $stmt->execute([$id]);
    $cert = $stmt->fetch();
    if (!$cert) { header('Location: certifications.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = $_POST['name'];
    $sort_order = (int)$_POST['sort_order'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE certifications SET name=?, sort_order=? WHERE id=?");
        $stmt->execute([$name, $sort_order, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO certifications (name, sort_order) VALUES (?,?)");
        $stmt->execute([$name, $sort_order]);
    }
    header('Location: certifications.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier la certification' : 'Ajouter une certification'; ?></h2>

<form method="POST" class="admin-form" style="max-width:500px;">
    <div class="form-group">
        <label>Nom (ex: CISSP, OSCP, CEH...)</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($cert['name'] ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label>Ordre d'affichage</label>
        <input type="number" name="sort_order" class="form-control" value="<?php echo $cert['sort_order'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="certifications.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>