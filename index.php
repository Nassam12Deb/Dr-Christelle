<?php include 'header.php';

$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch();
if (!$profile) {
    $profile = ['full_name' => 'Dr. Dejolie Christelle', 'photo' => '', 'cv_file' => ''];
}
?>

<section class="hero">
    <div class="hero-container">
        <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
            <h1 class="hero-title">
                <span class="title-accent">Dr.</span>
                <?php echo htmlspecialchars($profile['full_name']); ?>
            </h1>
            <h2 class="hero-subtitle">
                <span id="typed-text"></span><span class="typed-cursor">|</span>
            </h2>
            <p class="hero-description"><?php echo $t['hero_description']; ?></p>
            <div class="hero-buttons">
                <a href="about.php" class="btn btn-primary"><?php echo $t['hero_btn_about']; ?></a>
                <?php
                $cv = $profile['cv_file'] ?? '';
                if (!empty($cv) && file_exists(__DIR__ . '/' . $cv)) {
                    echo '<a href="' . BASE_URL . $cv . '" class="btn btn-secondary" download>' . $t['hero_btn_cv'] . '</a>';
                }
                ?>
                <a href="contact.php" class="btn btn-outline"><?php echo $t['hero_btn_contact']; ?></a>
            </div>
        </div>

        <div class="hero-image" data-aos="fade-left" data-aos-duration="1000">
            <div class="image-glow floating">
                <?php
                $photo    = $profile['photo'] ?? '';
                $photoUrl = '';
                if (!empty($photo)) {
                    $absolutePath = __DIR__ . '/' . $photo;
                    if (file_exists($absolutePath)) {
                        $photoUrl = BASE_URL . $photo;
                    }
                }
                ?>
                <?php if ($photoUrl): ?>
                    <img src="<?php echo $photoUrl; ?>" alt="Photo de profil"
                         style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                <?php else: ?>
                    <i class="fas fa-user-shield"></i>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number">10+</div>
                <div class="stat-label"><?php echo $t['stat_experience']; ?></div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number">50+</div>
                <div class="stat-label"><?php echo $t['stat_projects']; ?></div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number">100+</div>
                <div class="stat-label"><?php echo $t['stat_students']; ?></div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-number">30+</div>
                <div class="stat-label"><?php echo $t['stat_publications']; ?></div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>