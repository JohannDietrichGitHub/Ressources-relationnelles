<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!-- STYLES -->
    <style {csp-style-nonce}>
        .commentaire {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        button[type="submit"]:hover {
            background-color: #1B8338;
        }
        button[type="submit"]:active {
            background-color: #0B7328;
        }
    </style>
    <script src="<?= base_url('/js/bloquerCommentaire.js') ?>"></script>
</head>
<body>
<?php

use App\Controllers\Commentaire;
$uri = current_url(true);
$segments = $uri->getSegments();
$ressourceId = $segments[count($segments) - 1];
$user = new \App\Controllers\Utilisateur();
$commentaireClass = new Commentaire();
$commentaireArray = $commentaireClass->afficherFeedCommentaires($ressourceId);
if (isset($commentaireArray) && !empty($commentaireArray))
{
    foreach ($commentaireArray as $commentaire) : ?>
        <div class="commentaire">
            <?php if (isset($session['id'])): ?>
                <div id="session" data-session-id="<?php echo $session['id']; ?>"></div>
            <?php endif; ?>
            <?php $nomUtilisateur = $user->recupNomUtilisateurParID($commentaire->COM_UTI_ID);  ?>
            <p><?= esc($nomUtilisateur) ?></p>
            <p><?= esc($commentaire->COM_CONTENU) ?></p>
            <p><?= esc($commentaire->COM_TSP_CRE) ?></p>
            <?php $role = isset($session) ? $user->recupRoleParID($session['id']) : 'utilisateur'; ?>
            <?php if (isset($session) && $role === "Modérateur") {
                echo "<a class='bloquer-commentaire' data-id-commentaire='$commentaire->COM_ID'> X </a>";
            }?>

            <?php if(isset($session))
            { ?>
            <form action="<?= base_url('ajouterCommentaire') ?>" method="post">
                <input type="hidden" name="commentaire_id_commentaire_repondu_reponse" value="<?= esc($commentaire->COM_ID) ?>">
                <input class="ajouterInput" type="text" name="commentaire_contenu_reponse" placeholder="Répondre au commentaire" required>
                <input type="hidden" name="commentaire_uti_id_reponse" value="<?= esc($session['id']) ?>">
                <input type="hidden" name="commentaire_res_id_reponse" value="<?= esc($ressourceId) ?>">
                <button type="submit">Répondre</button>
                <?php
                $commentaireReponseArray = $commentaireClass->afficherFeedSousCommentaires($commentaire->COM_ID);
                if (isset($commentaireReponseArray) && !empty($commentaireReponseArray))
                {
                    foreach ($commentaireReponseArray as $commentaireReponse) : ?>
                        <div class="commentaire">
                            <?php $nomUtilisateur = $user->recupNomUtilisateurParID($commentaire->COM_UTI_ID); ?>
                            <p><?= esc($nomUtilisateur) ?></p>
                            <p><?= esc($commentaireReponse->COM_CONTENU) ?></p>
                            <p><?= esc($commentaireReponse->COM_TSP_CRE) ?></p>
                            <?php if (isset($session) && $role === "Modérateur") {
                                echo "<a class='bloquer-commentaire' data-id-commentaire='$commentaireReponse->COM_ID'> X </a>";
                            }?>
                        </div>
                    <?php endforeach;
                };
                ?>
            </form>
    <?php   } ?>
        </div>
    <?php endforeach;
} else {
    echo "Aucun commentaire pour cette ressource";
}

?>
</body>
</html>
