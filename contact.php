<?php include 'header.php'; ?>

<section class="section" style="margin-top: 100px;">
    <div class="container">
        <h1 class="section-title" data-aos="fade-right"><?php echo $t['contact_title']; ?></h1>

        <div class="contact-grid">
            <div class="card">
                <div class="contact-info" data-aos="fade-right" data-aos-delay="100">
                    <h3><?php echo $t['contact_h3']; ?></h3>
                    <p><?php echo $t['contact_subtitle']; ?></p>

                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-text">
                                <strong><?php echo $t['contact_email']; ?></strong>
                                <span>christelle.dejolie@example.com</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-text">
                                <strong><?php echo $t['contact_office']; ?></strong>
                                <span>Paris, France</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-text">
                                <strong><?php echo $t['contact_phone']; ?></strong>
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
                        <a href="#" class="btn btn-primary"><?php echo $t['contact_appointment']; ?></a>
                        <a href="assets/cv.pdf" class="btn btn-secondary" download><?php echo $t['contact_cv']; ?></a>
                    </div>
                </div>
            </div>

            <div class="contact-form" data-aos="fade-left" data-aos-delay="200">
                <form id="contactForm">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="<?php echo $t['contact_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="<?php echo $t['contact_email_placeholder']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="<?php echo $t['contact_subject']; ?>" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" placeholder="<?php echo $t['contact_message']; ?>" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> <?php echo $t['contact_send']; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>