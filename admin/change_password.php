<?php
$pageTitle = "Changer mon mot de passe";
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $error = "Les nouveaux mots de passe ne correspondent pas.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['admin_id']]);
        $user = $stmt->fetch();

        if ($user && password_verify($current, $user['password'])) {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update->execute([$hash, $_SESSION['admin_id']]);
            $success = "Mot de passe modifié avec succès.";
        } else {
            $error = "Le mot de passe actuel est incorrect.";
        }
    }
}
?>

<h2>Changer mon mot de passe</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<form method="POST" class="admin-form" style="max-width: 500px;">
    <div class="form-group">
        <label>Mot de passe actuel</label>
        <input type="password" name="current_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nouveau mot de passe</label>
        <input type="password" name="new_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Confirmer le nouveau mot de passe</label>
        <input type="password" name="confirm_password" class="form-control" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
    </div>
</form>

<?php include 'footer.php'; ?>