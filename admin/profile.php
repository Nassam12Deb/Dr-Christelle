<?php
$pageTitle = "Modifier le profil";
include 'header.php';

$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name       = $_POST['full_name'];
    $title           = $_POST['title'];
    $title_en        = $_POST['title_en'];
    $university      = $_POST['university'];
    $availability    = $_POST['availability'];
    $availability_en = $_POST['availability_en'];
    $location        = $_POST['location'];
    $bio             = $_POST['bio'];
    $bio_en          = $_POST['bio_en'];
    $cv_file         = $_POST['cv_file'];

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../assets/img/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName   = uniqid() . '_' . basename($_FILES['photo']['name']);
        $uploadFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            $photo = 'assets/img/' . $fileName;
        } else {
            $photo = $profile['photo'];
        }
    } else {
        $photo = $profile['photo'] ?? '';
    }

    $sql = "UPDATE profile SET full_name=?, title=?, title_en=?, university=?, availability=?, availability_en=?, location=?, bio=?, bio_en=?, cv_file=?, photo=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$full_name, $title, $title_en, $university, $availability, $availability_en, $location, $bio, $bio_en, $cv_file, $photo, $profile['id']]);

    header('Location: profile.php?success=1');
    exit;
}
?>

<h2>Modifier le profil</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Profil mis à jour avec succès.</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="admin-form" style="max-width: 900px;">
    <div class="form-group">
        <label>Nom complet</label>
        <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($profile['full_name']); ?>" required>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Titre 🇫🇷</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($profile['title'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>Title 🇬🇧</label>
            <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($profile['title_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Université</label>
        <input type="text" name="university" class="form-control" value="<?php echo htmlspecialchars($profile['university'] ?? ''); ?>">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Disponibilité 🇫🇷</label>
            <input type="text" name="availability" class="form-control" value="<?php echo htmlspecialchars($profile['availability'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>Availability 🇬🇧</label>
            <input type="text" name="availability_en" class="form-control" value="<?php echo htmlspecialchars($profile['availability_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Localisation</label>
        <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($profile['location'] ?? ''); ?>">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Biographie 🇫🇷</label>
            <textarea name="bio" class="form-control" rows="6"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>Biography 🇬🇧</label>
            <textarea name="bio_en" class="form-control" rows="6"><?php echo htmlspecialchars($profile['bio_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Chemin du CV (ex: assets/cv.pdf)</label>
        <input type="text" name="cv_file" class="form-control" value="<?php echo htmlspecialchars($profile['cv_file'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label>Photo de profil</label>
        <?php if (!empty($profile['photo'])): ?>
            <div style="margin-bottom:10px;">
                <img src="<?php echo BASE_URL . $profile['photo']; ?>" alt="Photo" style="max-width:150px; border-radius:10px;">
            </div>
        <?php endif; ?>
        <input type="file" name="photo" accept="image/*" class="form-control">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </div>
</form>

<?php include 'footer.php'; ?>