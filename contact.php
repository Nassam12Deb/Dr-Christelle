<?php include 'header.php'; ?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right">Contact</h1>

        <div class="contact-grid">
            <div class="card">
                <div class="contact-info" data-aos="fade-right" data-aos-delay="100">
                    <h3>Restons en contact</h3>
                    <p>Collaborations académiques, expertises, conférences.</p>

                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-text">
                                <strong>Email</strong>
                                <span>christelle.dejolie@example.com</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-text">
                                <strong>Bureau</strong>
                                <span>Paris, France</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-text">
                                <strong>Téléphone</strong>
                                <span>+33 1 23 45 67 89</span>
                            </div>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        <a href="#" aria-label="ORCID"><i class="fab fa-orcid"></i></a>
                        <a href="#" aria-label="Google Scholar"><i class="fas fa-graduation-cap"></i></a>
                    </div>

                    <div style="margin-top: 30px;">
                        <a href="#" class="btn btn-primary">Prendre rendez‑vous</a>
                        <a href="assets/cv.pdf" class="btn btn-secondary" download>Télécharger CV</a>
                    </div>
                </div>
            </div>

            <div class="contact-form" data-aos="fade-left" data-aos-delay="200">
                <form id="contactForm">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Votre nom" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Sujet" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>