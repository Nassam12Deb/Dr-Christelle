document.addEventListener('DOMContentLoaded', function() {
    // Confirmation de suppression
    const deleteLinks = document.querySelectorAll('.delete-link');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                e.preventDefault();
            }
        });
    });

    // Éventuellement, bascule de la sidebar sur mobile
    // (non implémenté ici, mais peut être ajouté)
});