<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Food Seeker Recette</title>

    <!-- STYLES -->
    <style {csp-style-nonce}>

        .green-foodseeker{
            background-color: #2B9348 !important;
        }

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
        #supprimerRessource {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .supprimerInput {
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
    </style>
</head>
<body>
<?php
// Récupérez le message FlashData
$error = session()->getFlashdata('error');

// Vérifiez si le message d'erreur existe avant de l'afficher
if ($error) {
    echo '<div style="color: red;">' . $error . '</div>';
}
?>
    <form id="supprimerRessource" action="#" method="post">
        <h2>Entrez l'id de la ressource a supprimer (à rendre inactive)</h2>
        <input class="supprimerInput" type="text" name="ressource_id" placeholder="Id de la ressource">
        <button id="boutonSupprimerRessource" type="submit">Supprimer</button>
    </form>
</body>