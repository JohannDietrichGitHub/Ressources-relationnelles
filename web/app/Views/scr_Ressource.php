<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ressource</title>

    <!-- STYLES -->
    <style {csp-style-nonce}>

        .btn-primary{
    background-color: #2B9348 !important;
            border-color: #2B9348 !important;
        }
        .btn-primary:hover{
    background-color: #1B8338 !important
        }
        .btn-primary:active{
    background-color: #0B7328 !important
        }

        .btn-secondary{
    background-color: #80B918 !important;
            border-color: #80B918 !important;
        }
        .btn-secondary:hover{
    background-color: #70A908 !important
        }
        .btn-secondary:active{
    background-color: #609900 !important
        }
        .recette_container {
    max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            align-content: center;
        }
        .recette {
    padding: 1rem;
            border: 2px solid black;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
    </style>
    </style>
</head>
<body>
    <div class="ressource-container">
<?php
    if (!empty($ressource)) {
//        $commentaireArray = getCommentaires($ressource->id)
        ?>
        <div class="ressource">
            <h2><?= esc($ressource->RES_NOM) ?></h2>
            <p><?= esc($ressource->RES_CONTENU) ?></p>
            <p><?= esc($ressource->RES_DATE_CREATION) ?></p>
            <div class="commentaire-container">
                <?php
//                foreach ($commentaireArray as $commentaire) {
//                    esc($commentaire);
//                }
                ?>
            </div>
        </div>
        <?php
    }
?>
    </div>
</body>