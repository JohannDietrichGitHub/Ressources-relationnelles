<?php
    // Exemple de données à passer à la vue Commentaire.php
    $commentaireData = [
        'pseudo'=> $reponse->reponse_utilisateur,
        'date' => $reponse->reponse_date,
        'contenu' => $reponse->reponse_txt
    ];

    echo view('Commentaire', $commentaireData);
?>
