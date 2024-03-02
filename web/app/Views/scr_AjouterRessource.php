<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tiny.cloud/1/g2g8jz1jhnb770m550zsm7oti8is5tql3lmwla2dah58xvsr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            init_instance_callback : function(editor) {
                editor.on('NodeChange Change KeyUp SetContent', function(e) {
                    tinymce.triggerSave();
                });
            },
            setup: function (editor) {
                editor.on('init', function () {
                    this.getElement().setAttribute('data-mce-required', true);
                });
            }
        });
    </script>
    <!-- STYLES -->
    <style {csp-style-nonce}>
        #ajouterRessource {
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
        #boutonAjouterRessource {
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
?>
<form id="ajouterRessource" action="#" method="post">
    <input class="ajouterInput" type="text" name="ressource_titre" placeholder="Titre de la ressource" required>
    <textarea id="mytextarea" class="ajouterInput" name="ressource_contenu" placeholder="contenu de la ressource"></textarea>
    <label for="ressource_type">Sélectionnez une type :</label>
    <select name="ressource_type" id="ressource_type">
        <?php

        use App\Controllers\Categorie;
        use App\Controllers\Relation;

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
    <button id="boutonAjouterRessource" type="submit">Ajouter ressource</button>
</form>

<?= view('footer') ?>
</body>
</html>