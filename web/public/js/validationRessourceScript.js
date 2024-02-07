document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.boutton-valider, .boutton-invalider').forEach(function (button) {
        button.addEventListener('click', function (event) {
            const targetButton = event.target.closest('.boutton-valider, .boutton-invalider');
            if (targetButton !== this) return; // Sortir si l'événement n'est pas déclenché par l'élément lui-même

            const resourceId = this.getAttribute('data');
            const action = this.classList.contains('boutton-valider') ? 'valider' : 'invalider';
            const baseurl = window.location.origin;

            fetch(baseurl + '/ressource/update-ressource-status/' + resourceId + '/' + action, {
            })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erreur lors de la requête.');
                    }
                })
                .then(data => {
                    console.log(data);
                    // Si la requête réussit, rechercher et masquer le bloc ressource-container le plus proche
                    const ressourceContainer = this.closest('.ressource-container');
                    if (ressourceContainer) {
                        ressourceContainer.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
});
