<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier un projet" : "Ajouter un projet";
include 'header.php';

$project = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    if (!$project) {
        header('Location: projects.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $problem = $_POST['problem'];
    $solution = $_POST['solution'];
    $technologies = $_POST['technologies'];
    $results = $_POST['results'];
    $github_link = $_POST['github_link'];
    $demo_link = $_POST['demo_link'];
    $publication_link = $_POST['publication_link'];

    if ($id) {
        $sql = "UPDATE projects SET title=?, category=?, problem=?, solution=?, technologies=?, results=?, github_link=?, demo_link=?, publication_link=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $category, $problem, $solution, $technologies, $results, $github_link, $demo_link, $publication_link, $id]);
    } else {
        $sql = "INSERT INTO projects (title, category, problem, solution, technologies, results, github_link, demo_link, publication_link) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $category, $problem, $solution, $technologies, $results, $github_link, $demo_link, $publication_link]);
    }
    header('Location: projects.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier le projet' : 'Ajouter un projet'; ?></h2>

<form method="POST" class="admin-form">
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <select name="category" class="form-control" required>
            <option value="research" <?php echo ($project['category']??'')=='research'?'selected':''; ?>>R&D</option>
            <option value="defensive" <?php echo ($project['category']??'')=='defensive'?'selected':''; ?>>Défensif</option>
            <option value="tools" <?php echo ($project['category']??'')=='tools'?'selected':''; ?>>Outils</option>
        </select>
    </div>
    <div class="form-group">
        <label>Problématique</label>
        <textarea name="problem" class="form-control" rows="3"><?php echo htmlspecialchars($project['problem'] ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label>Solution</label>
        <textarea name="solution" class="form-control" rows="3"><?php echo htmlspecialchars($project['solution'] ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label>Technologies (séparées par des virgules)</label>
        <input type="text" name="technologies" class="form-control" value="<?php echo htmlspecialchars($project['technologies'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Résultats</label>
        <textarea name="results" class="form-control" rows="3"><?php echo htmlspecialchars($project['results'] ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label>Lien GitHub</label>
        <input type="url" name="github_link" class="form-control" value="<?php echo htmlspecialchars($project['github_link'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Lien Démo</label>
        <input type="url" name="demo_link" class="form-control" value="<?php echo htmlspecialchars($project['demo_link'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Lien Publication</label>
        <input type="url" name="publication_link" class="form-control" value="<?php echo htmlspecialchars($project['publication_link'] ?? ''); ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="projects.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>