<?php include 'header.php';

$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch();

$profileTitle = ($lang === 'en' && !empty($profile['title_en'])) ? $profile['title_en'] : $profile['title'];
$profileAvailability = ($lang === 'en' && !empty($profile['availability_en'])) ? $profile['availability_en'] : $profile['availability'];
$profileBio = ($lang === 'en' && !empty($profile['bio_en'])) ? $profile['bio_en'] : $profile['bio'];
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right"><?php echo $t['about_title']; ?></h1>

        <div class="profile-modern" data-aos="fade-up">
            <div class="profile-card">
                <div class="profile-avatar-wrapper">
                    <div class="profile-avatar-glow">
                        <?php if ($profile['photo']): ?>
                            <img src="<?php echo BASE_URL . $profile['photo']; ?>" alt="Photo" class="profile-avatar-img">
                        <?php else: ?>
                            <i class="fas fa-user-md profile-avatar-icon"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="profile-info">
                    <h3 class="profile-name"><?php echo htmlspecialchars($profile['full_name']); ?></h3>
                    <div class="profile-badge"><?php echo htmlspecialchars($profileTitle); ?></div>
                    <div class="profile-location">
                        <i class="fas fa-map-marker-alt text-accent"></i>
                        <span><?php echo htmlspecialchars($profile['location']); ?></span>
                    </div>
                </div>
            </div>

            <div class="profile-stats-grid">
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div class="stat-content">
                        <strong><?php echo $t['about_degree']; ?></strong>
                        <span><?php echo $t['about_degree_val']; ?></span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-university"></i></div>
                    <div class="stat-content">
                        <strong><?php echo $t['about_university']; ?></strong>
                        <span><?php echo htmlspecialchars($profile['university']); ?></span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-content">
                        <strong><?php echo $t['about_availability']; ?></strong>
                        <span><?php echo htmlspecialchars($profileAvailability); ?></span>
                    </div>
                </div>
            </div>

            <div class="profile-bio">
                <?php echo nl2br(htmlspecialchars($profileBio)); ?>
            </div>
        </div>

        <!-- Compétences -->
        <h2 class="section-title" data-aos="fade-right" style="margin-top: 80px;"><?php echo $t['about_skills']; ?></h2>
        <div class="skills-container">
            <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                <h4><i class="fas fa-bug"></i> <?php echo $t['about_offensive']; ?></h4>
                <div class="skill-item">
                    <span class="skill-name"><?php echo $t['skill_pentest']; ?></span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="90"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <span class="skill-name"><?php echo $t['skill_reverse']; ?></span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="75"></div>
                    </div>
                </div>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                <h4><i class="fas fa-shield-alt"></i> <?php echo $t['about_defensive']; ?></h4>
                <div class="skill-item">
                    <span class="skill-name"><?php echo $t['skill_soc']; ?></span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="88"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <span class="skill-name"><?php echo $t['skill_forensic']; ?></span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="80"></div>
                    </div>
                </div>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                <h4><i class="fas fa-code"></i> <?php echo $t['about_tools']; ?></h4>
                <div class="tags-cloud">
                    <span class="tag">Python</span>
                    <span class="tag">Bash</span>
                    <span class="tag">Linux</span>
                    <span class="tag">AWS/Azure</span>
                    <span class="tag">TensorFlow</span>
                    <span class="tag">Wireshark</span>
                </div>
            </div>
        </div>

        <!-- Certifications -->
        <h2 class="section-title" data-aos="fade-right"><?php echo $t['about_certs']; ?></h2>
        <div class="tags-cloud" style="justify-content: center;" data-aos="fade-up">
            <span class="tag">CISSP</span>
            <span class="tag">OSCP</span>
            <span class="tag">ISO 27001 LA</span>
            <span class="tag">GIAC GCIH</span>
            <span class="tag">CEH</span>
            <span class="tag">Security+</span>
            <span class="tag">AWS Security</span>
            <span class="tag">Azure AI</span>
        </div>

        <!-- Recherche -->
        <h2 class="section-title" data-aos="fade-right" style="margin-top: 80px;"><?php echo $t['about_research']; ?>
        </h2>
        <div class="card" style="margin-bottom: 30px;" data-aos="fade-up">
            <h3 class="text-accent"><?php echo $t['about_thesis']; ?></h3>
            <p><strong><?php echo $t['about_thesis_title']; ?></strong> <?php echo $t['about_thesis_year']; ?></p>
            <p><?php echo $t['about_thesis_desc']; ?></p>
        </div>
        <div class="skills-container">
            <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                <h4><i class="fas fa-robot"></i> <?php echo $t['research_ai']; ?></h4>
                <p><?php echo $t['research_ai_desc']; ?></p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                <h4><i class="fas fa-cloud"></i> <?php echo $t['research_cloud']; ?></h4>
                <p><?php echo $t['research_cloud_desc']; ?></p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                <h4><i class="fas fa-shield-virus"></i> <?php echo $t['research_threat']; ?></h4>
                <p><?php echo $t['research_threat_desc']; ?></p>
            </div>
        </div>

        <!-- Enseignement -->
        <h2 class="section-title" data-aos="fade-right"><?php echo $t['about_teaching']; ?></h2>
        <div class="skills-container">
            <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                <h4><?php echo $t['teach_1_title']; ?></h4>
                <p class="timeline-location"><?php echo $t['teach_1_level']; ?></p>
                <p><?php echo $t['teach_1_desc']; ?></p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                <h4><?php echo $t['teach_2_title']; ?></h4>
                <p class="timeline-location"><?php echo $t['teach_2_level']; ?></p>
                <p><?php echo $t['teach_2_desc']; ?></p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                <h4><?php echo $t['teach_3_title']; ?></h4>
                <p class="timeline-location"><?php echo $t['teach_3_level']; ?></p>
                <p><?php echo $t['teach_3_desc']; ?></p>
            </div>
        </div>

        <!-- Conférences -->
        <h2 class="section-title" data-aos="fade-right"><?php echo $t['about_conferences']; ?></h2>
        <div class="timeline">
            <div class="timeline-item" data-aos="fade-left" data-aos-delay="100">
                <div class="timeline-date">2023</div>
                <div class="timeline-content">
                    <h5><?php echo $t['conf_1_title']; ?></h5>
                    <div class="timeline-location"><i class="fas fa-map-marker-alt"></i>
                        <?php echo $t['conf_1_location']; ?></div>
                    <p><?php echo $t['conf_1_desc']; ?></p>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-left" data-aos-delay="200">
                <div class="timeline-date">2022</div>
                <div class="timeline-content">
                    <h5><?php echo $t['conf_2_title']; ?></h5>
                    <div class="timeline-location"><i class="fas fa-map-marker-alt"></i>
                        <?php echo $t['conf_2_location']; ?></div>
                    <p><?php echo $t['conf_2_desc']; ?></p>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-left" data-aos-delay="300">
                <div class="timeline-date">2021</div>
                <div class="timeline-content">
                    <h5><?php echo $t['conf_3_title']; ?></h5>
                    <div class="timeline-location"><i class="fas fa-map-marker-alt"></i>
                        <?php echo $t['conf_3_location']; ?></div>
                    <p><?php echo $t['conf_3_desc']; ?></p>
                </div>
            </div>
        </div>

        <!-- Témoignage -->
        <div class="testimonial" data-aos="zoom-in">
            <p><?php echo $t['about_testimonial']; ?></p>
            <p class="testimonial-author"><?php echo $t['about_testimonial_author']; ?></p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>