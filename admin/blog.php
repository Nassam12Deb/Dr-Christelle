<?php
$pageTitle = "Gestion du blog";
include 'header.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM blog WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: blog.php?msg=deleted');
    exit;
}

$articles = $pdo->query("SELECT * FROM blog ORDER BY date DESC")->fetchAll();
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Liste des articles</h2>
    <a href="blog_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvel article</a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Article supprimé avec succès.</div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $a): ?>
            <tr>
                <td><?php echo htmlspecialchars($a['title']); ?></td>
                <td><?php echo $a['date']; ?></td>
                <td>
                    <a href="blog_edit.php?id=<?php echo $a['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> Modifier</a>
                    <a href="?delete=<?php echo $a['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>