<?php
    // Exemple de données à passer à la vue Commentaire.php
    $commentaireData = [
        'pseudo'=> $commentaire->commentaire_utilisateur,
        'date' => $commentaire->commentaire_date,
        'contenu' => $commentaire->commentaire_txt
        foreach ($reponses as $commentaire->$reponse) : ?>
            <?= view('Commentaire', [
                'pseudo' => $reponse->reponse_utilisateur,
                'date' => $reponse->reponse_date,
                'contenu' => $reponse->reponse_txt
            ]) ?>
        <?php endforeach; ?>
    ];

    echo view('Commentaire', $commentaireData);
?>
