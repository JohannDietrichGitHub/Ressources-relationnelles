<?php
use App\Controllers\Categorie;
use App\Controllers\Relation;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script src="https://cdn.tiny.cloud/1/g2g8jz1jhnb770m550zsm7oti8is5tql3lmwla2dah58xvsr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            language: 'fr_FR',
             branding: false,
             mobile: {
    menubar: true
  },
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
    <meta charset="UTF-8">

    <!-- STYLES -->
    <style>
        .ressource-container{
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            margin-top: 0px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .modifierInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<?= view('header') ?>
<body>

<main>
    <div class="container">
    <h1 class="my-3">Modifier la ressource</h1>
    <?php
// Récupérez le message FlashData
$error = session()->getFlashdata('error');

// Vérifiez si le message d'erreur existe avant de l'afficher

if (!isset($ressource) || empty($ressource)) {
    ?>

    
    <form action="#" class="ressource-container" method="post">
    <p class="">Selectionnez l'ID de la ressource à modifier</p>
    <input type="number" class="form-control form-number shadow-none"name="ressource_id" placeholder="ID de la ressource" required>
    <?php
if ($error) {
    echo '<div style="color: red;" class="fst-italic">' . $error . '</div>';
}
    ?>
    <button type="submit" class="btn custom-dark-blue text-light mt-4">Modifier la ressource sélectionnée</button>
    </form>    

    <?php
}
?>
<?php
if (isset($ressource)) {
    ?>



<form id="modifierRessource" class="ressource-container" action="#" method="post">
    <input type="hidden" name="ressource_id_cacher" value="<?= esc($ressource->RES_ID) ?>">
    <input class="modifierInput" type="text" name="ressource_titre" placeholder="Titre de la ressource" value="<?= esc($ressource->RES_NOM) ?>" required>
    <textarea id="mytextarea" name="ressource_contenu" placeholder="contenu de la ressource" required><?= esc($ressource->RES_CONTENU) ?></textarea>
    
    <div class="mt-4">
    <div>
               <p for="ressource_type" class="mb-1">Sélectionnez le type de la ressource :</p>
    <select name="ressource_type" id="ressource_type"  class="form-select shadow-none">
        <?php

        $types = ['Defi', 'Document informatif'];
        foreach ($types as $type) {
            echo '<option value="' . $type . '">' . $type . '</option>';
        }
        ?>
    </select>
    </div>
    <div class="mt-3">
               <p for="ressource_categorie" class="mb-1">Sélectionnez une catégorie :</p>
    <select name="ressource_categorie" id="ressource_categorie" class="form-select shadow-none">
        <?php
        $categorie = new Categorie();
        $categories = $categorie->getCategories();
        foreach ($categories as $categorie) {
            echo '<option value="' . $categorie->CAT_ID . '">' . $categorie->CAT_NOM . '</option>';
        }
        ?>
    </select>
    </div>
    <div class="mt-3">
               <p for="ressource_relations" class="mb-1">Sélectionnez une ou plusieurs relations :</p>
    <select name="ressource_relations[]" id="ressource_relations" class="form-select shadow-none"style="height:100px" multiple>
        <?php
        // Remplacez le tableau suivant par votre propre source de données pour les relations
        $relation = new Relation();
        $relations = $relation->getRelations();
        foreach ($relations as $relation) {
            echo '<option value="' . $relation->REL_ID . '">' . $relation->REL_TYPE . '</option>';
        }
        ?>
    </select>
    </div>
    
    <button id="boutonModifierRessource" class="btn custom-dark-blue text-light mt-4" type="submit">Modifier la ressource</button>
    </div>
</form>
<?php } ?>
</div>

</main>
</body>
<?= view('footer') ?>

</html>