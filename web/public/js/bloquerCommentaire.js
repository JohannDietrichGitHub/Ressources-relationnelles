document.addEventListener('DOMContentLoaded', function () {
    const commentairesABloquer = document.getElementsByClassName('bloquer-commentaire');
    const commentairesArray = Array.from(commentairesABloquer);
    const sessionDiv = document.getElementById('session');
    const sessionId = sessionDiv.getAttribute('data-session-id');

    commentairesArray.forEach(lien => {
        lien.addEventListener('click', function(e) {
            e.preventDefault();

            const idCommentaire = this.getAttribute('data-id-commentaire');
            const baseurl = window.location.origin;
console.log(idCommentaire);
            fetch(`${baseurl}/app-ressources-relationnelles/web/public/bloquerCommentaire/${idCommentaire}/${sessionId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ idCommentaire: idCommentaire })
            })
                .then(response => {
                    if (!response === "ok") {
                        throw new Error('Erreur lors de la requête AJAX');
                    }
                    this.closest('.commentaire').remove();
                })
                .catch(error => {
                    console.error('Erreur :', error);
                });
        });
    });
});