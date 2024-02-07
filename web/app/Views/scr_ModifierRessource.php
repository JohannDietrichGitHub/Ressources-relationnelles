<?php
use App\Controllers\Categorie;
use App\Controllers\Relation;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

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
        #modifierRessource {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .modifierInput {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #boutonModifierRessource {
            background-color: #2B9348;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #1B8338;
        }
        button[type="submit"]:active {
            background-color: #0B7328;
        }
    </style>
    </style>
</head>
<body>
<?= view('header') ?>
<?php
// Récupérez le message FlashData
$error = session()->getFlashdata('error');

// Vérifiez si le message d'erreur existe avant de l'afficher
if ($error) {
    echo '<div style="color: red;">' . $error . '</div>';
}
if (!isset($ressource) || empty($ressource)) {
    echo '<h1>Selectionnez l\'ID de la ressource à modifier</h1>';
    echo '<form action="#" method="post">';
    echo '<input type="number" name="ressource_id" placeholder="ID de la ressource" required>';
    echo '<button type="submit">Selectionner ressource</button>';
}
?>
<?php
if (isset($ressource)) {
    echo '<h1>Modifier la ressource</h1>';
?>
<form id="modifierRessource" action="#" method="post">
    <input type="hidden" name="ressource_id_cacher" value="<?php echo($ressource->RES_ID) ?>">
    <input class="modifierInput" type="text" name="ressource_titre" placeholder="Titre de la ressource" value="<?php esc($ressource->RES_NOM) ?>" required>
    <input class="modifierInput" type="text" name="ressource_contenu" placeholder="Contenu de la ressource"  value="<?php esc($ressource->RES_CONTENU) ?>" required>
    <label for="ressource_type">Sélectionnez une type :</label>
    <select name="ressource_type" id="ressource_type">
        <?php

        $types = ['Defi', 'Document informatif'];
        foreach ($types as $type) {
            echo '<option value="' . $type . '">' . $type . '</option>';
        }
        ?>
    </select>

    <label for="ressource_categorie">Sélectionnez une catégorie :</label>
    <select name="ressource_categorie" id="ressource_categorie">
        <?php
        $categorie = new Categorie();
        $categories = $categorie->getCategories();
        foreach ($categories as $categorie) {
            echo '<option value="' . $categorie->CAT_ID . '">' . $categorie->CAT_NOM . '</option>';
        }
        ?>
    </select>

    <label for="ressource_relations">Sélectionnez une ou plusieurs relations :</label>
    <select name="ressource_relations[]" id="ressource_relations" multiple>
        <?php
        // Remplacez le tableau suivant par votre propre source de données pour les relations
        $relation = new Relation();
        $relations = $relation->getRelations();
        foreach ($relations as $relation) {
            echo '<option value="' . $relation->REL_ID . '">' . $relation->REL_TYPE . '</option>';
        }
        ?>
    </select>
    <button id="boutonModifierRessource" type="submit">modifier ressource</button>
</form>
<?php } ?>
<?= view('footer') ?>
</body>
</html>