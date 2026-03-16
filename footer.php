</main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <span class="logo-accent">Dr.</span> Dejolie
                </div>
                <p class="footer-tagline"><?php echo $t['footer_tagline']; ?></p>
                <div class="footer-links">
                    <a href="index.php"><?php echo $t['nav_home']; ?></a>
                    <a href="about.php"><?php echo $t['nav_about']; ?></a>
                    <a href="projects.php"><?php echo $t['nav_projects']; ?></a>
                    <a href="publications.php"><?php echo $t['nav_publications']; ?></a>
                    <a href="blog.php"><?php echo $t['nav_blog']; ?></a>
                    <a href="contact.php"><?php echo $t['nav_contact']; ?></a>
                </div>
                <div class="social-links">
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    <a href="#" aria-label="ORCID"><i class="fab fa-orcid"></i></a>
                    <a href="#" aria-label="Google Scholar"><i class="fas fa-graduation-cap"></i></a>
                </div>
                <p class="copyright">&copy; <?php echo CURRENT_YEAR; ?> Dr. Dejolie Christelle. <?php echo $t['footer_rights']; ?></p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        // Typed texts depuis PHP
        window.typedTexts = <?php echo json_encode($t['typed_texts']); ?>;
    </script>
</body>
</html>