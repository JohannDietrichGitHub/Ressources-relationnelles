<?php
use App\Controllers\Ressource;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .ressources-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 40%;
        }

        .ressource-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            width: 100%;
        }

        .ressource-contenu {
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            width: 100%;
        }

        .button-confirmation-container {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            width: 100%;
        }
    </style>
    <script src="<?= base_url('/js/validationRessourceScript.js') ?>"></script>
</head>
<body>
<div class="ressources-container">
    <h1>Ressources a vérifier : </h1>
    <?php
    $ressourceController = new Ressource();
    $ressourcesAValider = $ressourceController->afficherRessourcesAVerifier();

    foreach ($ressourcesAValider as $ressource) {
        ?>
        <div class="ressource-container">
            <h2> <?php echo($ressource->RES_NOM) ?></h2>
            <div class="ressource-contenu"> <?php echo($ressource->RES_CONTENU)?></div>
            <div class="button-confirmation-container">
                <div class="boutton-valider">
                    <input id="valider" class="boutton-valider" type="button" data="<?php echo($ressource->RES_ID) ?>" value="valider">
                </div>
                <div class="boutton-invalider">
                    <input id="invalider" class="boutton-invalider" type="button" data="<?php echo($ressource->RES_ID) ?>" value="invalider">
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
</body>