document.addEventListener('DOMContentLoaded', function() {
    // Initialisation AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-in-out'
    });

    // Gestion du thème
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = themeToggle.querySelector('i');
    const currentTheme = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', currentTheme);
    updateThemeButton(currentTheme);

    themeToggle.addEventListener('click', () => {
        const newTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeButton(newTheme);
    });

    function updateThemeButton(theme) {
        themeIcon.className = theme === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
    }

    // Animation de texte tapé (accueil)
    const typedTextSpan = document.getElementById('typed-text');
    if (typedTextSpan) {
        const texts = [
            'Cybersecurity Researcher',
            'AI Security Specialist',
            'Cloud Security Architect',
            'Professor'
        ];
        let textIndex = 0, charIndex = 0, isDeleting = false;
        function type() {
            const current = texts[textIndex];
            if (!isDeleting && charIndex <= current.length) {
                typedTextSpan.textContent = current.substring(0, charIndex++);
                if (charIndex > current.length) {
                    isDeleting = true;
                    setTimeout(type, 2000);
                    return;
                }
            } else if (isDeleting && charIndex >= 0) {
                typedTextSpan.textContent = current.substring(0, charIndex--);
                if (charIndex < 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % texts.length;
                }
            }
            setTimeout(type, isDeleting ? 50 : 100);
        }
        setTimeout(type, 1000);
    }

    // Mobile menu
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
        });
    }

    // Filtrage des projets
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    if (filterBtns.length) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.dataset.filter;
                projectCards.forEach(card => {
                    if (filter === 'all' || card.dataset.category.includes(filter)) {
                        card.style.display = 'block';
                        setTimeout(() => card.style.opacity = '1', 10);
                    } else {
                        card.style.opacity = '0';
                        setTimeout(() => card.style.display = 'none', 300);
                    }
                });
            });
        });
    }

    // Animation des barres de compétences (data-width)
    const skillBars = document.querySelectorAll('.skill-level');
    if (skillBars.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const width = bar.dataset.width;
                    if (width) {
                        bar.style.width = width + '%';
                    }
                    observer.unobserve(bar);
                }
            });
        }, { threshold: 0.5 });
        skillBars.forEach(bar => observer.observe(bar));
    }
});