<?php include 'header.php';

// Récupérer le profil
$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch();
?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right">À propos</h1>

        <!-- Profil - Version améliorée -->
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
                    <div class="profile-badge"><?php echo htmlspecialchars($profile['title']); ?></div>
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
                        <strong>Diplôme</strong>
                        <span>Doctorat en Cybersécurité</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-university"></i></div>
                    <div class="stat-content">
                        <strong>Université</strong>
                        <span><?php echo htmlspecialchars($profile['university']); ?></span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-content">
                        <strong>Disponibilité</strong>
                        <span><?php echo htmlspecialchars($profile['availability']); ?></span>
                    </div>
                </div>
            </div>

            <div class="profile-bio">
                <?php echo nl2br(htmlspecialchars($profile['bio'])); ?>
            </div>
        </div>

        <!-- Compétences -->
        <h2 class="section-title" data-aos="fade-right" style="margin-top: 80px;">Compétences</h2>
        <div class="skills-container">
            <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                <h4><i class="fas fa-bug"></i> Offensif</h4>
                <div class="skill-item">
                    <span class="skill-name">Tests d’intrusion</span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="90"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <span class="skill-name">Reverse Engineering</span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="75"></div>
                    </div>
                </div>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                <h4><i class="fas fa-shield-alt"></i> Défensif</h4>
                <div class="skill-item">
                    <span class="skill-name">SOC / Threat Hunting</span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="88"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <span class="skill-name">Forensic</span>
                    <div class="skill-bar">
                        <div class="skill-level" data-width="80"></div>
                    </div>
                </div>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                <h4><i class="fas fa-code"></i> Outils & langages</h4>
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
        <h2 class="section-title" data-aos="fade-right">Certifications</h2>
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
        <h2 class="section-title" data-aos="fade-right" style="margin-top: 80px;">Recherche</h2>
        <div class="card" style="margin-bottom: 30px;" data-aos="fade-up">
            <h3 class="text-accent">Thèse de Doctorat</h3>
            <p><strong>Sécurité adaptative des infrastructures cloud par apprentissage automatique</strong> (2019)</p>
            <p>Détection d’intrusions en temps réel basée sur l’IA avec un taux de détection de 99,2%.</p>
        </div>
        <div class="skills-container">
            <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                <h4><i class="fas fa-robot"></i> AI Security</h4>
                <p>Robustesse des modèles, adversarial attacks</p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                <h4><i class="fas fa-cloud"></i> Cloud Security</h4>
                <p>Architectures Zero Trust, chiffrement homomorphe</p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                <h4><i class="fas fa-shield-virus"></i> Threat Intelligence</h4>
                <p>Analyse de malware, OSINT</p>
            </div>
        </div>

        <!-- Enseignement -->
        <h2 class="section-title" data-aos="fade-right">Enseignement</h2>
        <div class="skills-container">
            <div class="skill-category" data-aos="fade-up" data-aos-delay="100">
                <h4>Cybersécurité avancée</h4>
                <p class="timeline-location">Master 2 · 30h</p>
                <p>Cryptographie, tests d’intrusion, réponse à incident.</p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="200">
                <h4>Sécurité des systèmes d’information</h4>
                <p class="timeline-location">Licence 3 · 24h</p>
                <p>Normes ISO 27001, gestion des risques, audits.</p>
            </div>
            <div class="skill-category" data-aos="fade-up" data-aos-delay="300">
                <h4>Machine Learning pour la cybersécurité</h4>
                <p class="timeline-location">Master 1 · 20h</p>
                <p>Détection d’anomalies, classification de malwares.</p>
            </div>
        </div>

        <!-- Conférences -->
        <h2 class="section-title" data-aos="fade-right">Conférences</h2>
        <div class="timeline">
            <div class="timeline-item" data-aos="fade-left" data-aos-delay="100">
                <div class="timeline-date">2023</div>
                <div class="timeline-content">
                    <h5>Black Hat Europe</h5>
                    <div class="timeline-location"><i class="fas fa-map-marker-alt"></i> Londres, UK</div>
                    <p>Workshop : « Practical Adversarial Attacks on IDS »</p>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-left" data-aos-delay="200">
                <div class="timeline-date">2022</div>
                <div class="timeline-content">
                    <h5>RSA Conference</h5>
                    <div class="timeline-location"><i class="fas fa-map-marker-alt"></i> San Francisco, USA</div>
                    <p>Présentation : « AI for Threat Hunting »</p>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-left" data-aos-delay="300">
                <div class="timeline-date">2021</div>
                <div class="timeline-content">
                    <h5>Forum International de la Cybersécurité</h5>
                    <div class="timeline-location"><i class="fas fa-map-marker-alt"></i> Lille, France</div>
                    <p>Table ronde : « Enjeux de la conformité RGPD/NIS2 »</p>
                </div>
            </div>
        </div>

        <!-- Témoignage -->
        <div class="testimonial" data-aos="zoom-in">
            <p>« Le cours de Dr. Dejolie m’a permis de comprendre concrètement comment analyser un malware et réagir en
                équipe. Une approche terrain inestimable. »</p>
            <p class="testimonial-author">— Ancien étudiant, analyste SOC</p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>