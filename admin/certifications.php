<?php
$pageTitle = "Gestion des certifications";
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM certifications WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: certifications.php?msg=deleted');
    exit;
}

$certs = $pdo->query("SELECT * FROM certifications ORDER BY sort_order")->fetchAll();
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Certifications</h2>
    <a href="certification_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle certification</a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Certification supprimée.</div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Ordre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($certs as $c): ?>
            <tr>
                <td>
                    <span style="background:rgba(0,255,195,0.1); color:var(--accent-primary); padding:4px 14px; border-radius:20px; border:1px solid rgba(0,255,195,0.3);">
                        <?php echo htmlspecialchars($c['name']); ?>
                    </span>
                </td>
                <td><?php echo $c['sort_order']; ?></td>
                <td>
                    <a href="certification_edit.php?id=<?php echo $c['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> Modifier</a>
                    <a href="?delete=<?php echo $c['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>