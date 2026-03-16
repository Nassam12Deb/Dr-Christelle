<?php
$pageTitle = "Gestion des compétences";
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: skills.php?msg=deleted');
    exit;
}

$skills = $pdo->query("SELECT * FROM skills ORDER BY category, sort_order")->fetchAll();
$categories = ['offensive' => 'Offensif', 'defensive' => 'Défensif', 'tools' => 'Outils'];
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Compétences</h2>
    <a href="skill_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle compétence</a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success">Compétence supprimée.</div>
<?php endif; ?>

<?php foreach ($categories as $cat => $label): ?>
    <h3 style="color: var(--accent-primary); margin: 30px 0 15px; font-size:1.2rem;">
        <?php echo $label; ?>
    </h3>
    <div class="table-container" style="margin-bottom: 10px;">
        <table>
            <thead>
                <tr>
                    <th>Nom FR</th>
                    <th>Nom EN</th>
                    <th>Niveau</th>
                    <th>Ordre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($skills as $s): ?>
                <?php if ($s['category'] !== $cat) continue; ?>
                <tr>
                    <td><?php echo htmlspecialchars($s['name']); ?></td>
                    <td><?php echo htmlspecialchars($s['name_en'] ?? ''); ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:100px; height:6px; background:rgba(255,255,255,0.1); border-radius:3px; overflow:hidden;">
                                <div style="width:<?php echo $s['level']; ?>%; height:100%; background:linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));"></div>
                            </div>
                            <span style="color:var(--accent-primary); font-weight:600;"><?php echo $s['level']; ?>%</span>
                        </div>
                    </td>
                    <td><?php echo $s['sort_order']; ?></td>
                    <td>
                        <a href="skill_edit.php?id=<?php echo $s['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> Modifier</a>
                        <a href="?delete=<?php echo $s['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>