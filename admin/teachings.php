<?php
$pageTitle = "Gestion des enseignements";
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM teachings WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: teachings.php?msg=deleted');
    exit;
}

$teachings = $pdo->query("SELECT * FROM teachings ORDER BY sort_order")->fetchAll();
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Enseignements</h2>
    <a href="teaching_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvel enseignement</a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Enseignement supprimé.</div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Titre FR</th>
                <th>Titre EN</th>
                <th>Niveau</th>
                <th>Ordre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachings as $t): ?>
            <tr>
                <td><?php echo htmlspecialchars($t['title']); ?></td>
                <td><?php echo htmlspecialchars($t['title_en'] ?? ''); ?></td>
                <td style="color:var(--text-secondary); font-size:0.9rem;"><?php echo htmlspecialchars($t['level'] ?? ''); ?></td>
                <td><?php echo $t['sort_order']; ?></td>
                <td>
                    <a href="teaching_edit.php?id=<?php echo $t['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> Modifier</a>
                    <a href="?delete=<?php echo $t['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>