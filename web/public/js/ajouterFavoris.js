function ajouterAuxFavoris(button) {
    const ressourceId = button.value;
    const baseUrl = window.location.origin;
    fetch(`${baseUrl}/app-ressources-relationnelles/web/public/ressource/modifierFavoris/${ressourceId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => {
            if (response.ok) {
                button.classList.toggle('active');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX:', error);
        });
}