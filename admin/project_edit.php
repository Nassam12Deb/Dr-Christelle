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
    $title            = $_POST['title'];
    $title_en         = $_POST['title_en'];
    $category         = $_POST['category'];
    $problem          = $_POST['problem'];
    $problem_en       = $_POST['problem_en'];
    $solution         = $_POST['solution'];
    $solution_en      = $_POST['solution_en'];
    $technologies     = $_POST['technologies'];
    $results          = $_POST['results'];
    $results_en       = $_POST['results_en'];
    $github_link      = $_POST['github_link'];
    $demo_link        = $_POST['demo_link'];
    $publication_link = $_POST['publication_link'];

    if ($id) {
        $sql = "UPDATE projects SET title=?, title_en=?, category=?, problem=?, problem_en=?, solution=?, solution_en=?, technologies=?, results=?, results_en=?, github_link=?, demo_link=?, publication_link=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $title_en, $category, $problem, $problem_en, $solution, $solution_en, $technologies, $results, $results_en, $github_link, $demo_link, $publication_link, $id]);
    } else {
        $sql = "INSERT INTO projects (title, title_en, category, problem, problem_en, solution, solution_en, technologies, results, results_en, github_link, demo_link, publication_link) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $title_en, $category, $problem, $problem_en, $solution, $solution_en, $technologies, $results, $results_en, $github_link, $demo_link, $publication_link]);
    }
    header('Location: projects.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier le projet' : 'Ajouter un projet'; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Titre 🇫🇷</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Title 🇬🇧</label>
            <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($project['title_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <select name="category" class="form-control" required>
            <option value="research"   <?php echo ($project['category'] ?? '') == 'research'   ? 'selected' : ''; ?>>R&D</option>
            <option value="defensive"  <?php echo ($project['category'] ?? '') == 'defensive'  ? 'selected' : ''; ?>>Défensif</option>
            <option value="tools"      <?php echo ($project['category'] ?? '') == 'tools'      ? 'selected' : ''; ?>>Outils</option>
        </select>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Problématique 🇫🇷</label>
            <textarea name="problem" class="form-control" rows="3"><?php echo htmlspecialchars($project['problem'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>Problem 🇬🇧</label>
            <textarea name="problem_en" class="form-control" rows="3"><?php echo htmlspecialchars($project['problem_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Solution 🇫🇷</label>
            <textarea name="solution" class="form-control" rows="3"><?php echo htmlspecialchars($project['solution'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>Solution 🇬🇧</label>
            <textarea name="solution_en" class="form-control" rows="3"><?php echo htmlspecialchars($project['solution_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Technologies (séparées par des virgules)</label>
        <input type="text" name="technologies" class="form-control" value="<?php echo htmlspecialchars($project['technologies'] ?? ''); ?>">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Résultats 🇫🇷</label>
            <textarea name="results" class="form-control" rows="3"><?php echo htmlspecialchars($project['results'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>Results 🇬🇧</label>
            <textarea name="results_en" class="form-control" rows="3"><?php echo htmlspecialchars($project['results_en'] ?? ''); ?></textarea>
        </div>
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