<?php
$pageTitle = "Gestion des publications";
include 'header.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM publications WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: publications.php?msg=deleted');
    exit;
}

$pubs = $pdo->query("SELECT * FROM publications ORDER BY year DESC")->fetchAll();
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Liste des publications</h2>
    <a href="publication_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle publication</a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Publication supprimée avec succès.</div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Revue</th>
                <th>Année</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pubs as $p): ?>
            <tr>
                <td><?php echo htmlspecialchars($p['title']); ?></td>
                <td><?php echo htmlspecialchars($p['journal']); ?></td>
                <td><?php echo $p['year']; ?></td>
                <td>
                    <a href="publication_edit.php?id=<?php echo $p['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> Modifier</a>
                    <a href="?delete=<?php echo $p['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>