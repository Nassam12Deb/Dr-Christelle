<?php
$pageTitle = "Gestion des conférences";
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM conferences WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: conferences.php?msg=deleted');
    exit;
}

$conferences = $pdo->query("SELECT * FROM conferences ORDER BY year DESC, sort_order")->fetchAll();
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Conférences</h2>
    <a href="conference_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle conférence</a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Conférence supprimée.</div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Année</th>
                <th>Titre FR</th>
                <th>Titre EN</th>
                <th>Lieu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conferences as $c): ?>
            <tr>
                <td style="color:var(--accent-primary); font-weight:700;"><?php echo $c['year']; ?></td>
                <td><?php echo htmlspecialchars($c['title']); ?></td>
                <td><?php echo htmlspecialchars($c['title_en'] ?? ''); ?></td>
                <td style="color:var(--text-secondary); font-size:0.9rem;"><?php echo htmlspecialchars($c['location'] ?? ''); ?></td>
                <td>
                    <a href="conference_edit.php?id=<?php echo $c['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> Modifier</a>
                    <a href="?delete=<?php echo $c['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>