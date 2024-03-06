<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!-- STYLES -->
    <style {csp-style-nonce}>

        #ajouterCommentaire {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .ajouterInput {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button[type="submit"]:hover {
            background-color: #1B8338;
        }
        button[type="submit"]:active {
            background-color: #0B7328;
        }
    </style>
</head>
<body>
<?php
if (isset($session)) {
    $uri = current_url(true);
    $segments = $uri->getSegments();
    $ressourceId = $segments[count($segments) - 1];
    ?>
    <form id="ajouterCommentaire" action="<?= base_url('ajouterCommentaire') ?>" method="post">
        <input class="ajouterInput" type="text" name="commentaire_contenu" placeholder="Contenu du commentaire" required>
        <input type="hidden" name="commentaire_uti_id" value="<?= esc($session['id']) ?>">
        <input type="hidden" name="commentaire_res_id" value="<?= esc($ressourceId) ?>">
        <button id="boutonAjouterCommentaire" type="submit">Ajouter Commentaire</button>
    </form>
<?php }else {
    echo "<p id='ajouterCommentaire'>Vous devez être connecté pour ajouter un commentaire</p>";
}
?>

</body>
</html>