<?php
use App\Controllers\Ressource;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
         .card {
         box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
         }
         a {
         color: #02af74;
         text-decoration: none;
         }
         .bookmark-post .favorite-icon a,
         .job-box.bookmark-post .favorite-icon a {
         background-color: #da3746;
         color: #fff;
         border-color: danger;
         }
         .favorite-icon a {
         display: inline-block;
         width: 30px;
         height: 30px;
         line-height: 30px;
         text-align: center;
         }
         .candidate-list-box .favorite-icon {
         position: absolute;
         right: 22px;
         top: 22px;
         }
         .bg-categorie-tag {
         background-color: rgba(116, 120, 141, .15) !important;
         color: #54586d !important;
         }
         .bg-relation-tag {
         background-color: rgba(0, 126, 167, .35) !important;
         color: #54586d !important;
         }
         .favoris-btn {
    background-color: transparent !important;
    border: none !important;
    cursor: pointer;
    fill: currentColor; /* Permet d'utiliser la couleur actuelle pour remplir le SVG */
    stroke: currentColor; /* Permet d'utiliser la couleur actuelle pour le contour du SVG */
}

.favoris-btn.active #favoris-icon {
    fill: #ffbd03;
    stroke: #eeac02;
}
.favoris-btn.active .favoris-icon {
     fill: #ffbd03;
     stroke: #eeac02;
}


.btnRepondre{
    background-color: transparent !important;
    border: none;
    color: #248db5;
    padding: 7px;

}


.bloquer-commentaire{
 text-decoration: none;
}
.enter-reponse{
   background-color: white;
}
      </style>
    <script src="<?= base_url('/js/validationRessourceScript.js') ?>"></script>
</head>
<body>
<main>
<?= view('header') ?>

<div class="container mb-5">
        <h2 class="mt-4"> Ressources à valider</h2>
          <script src="<?= base_url('/js/ajouterFavoris.js') ?>"></script>
         <?php
             $ressourceController = new Ressource();
             $ressourcesAValider = $ressourceController->afficherRessourcesAVerifier();
            if (!empty($ressourcesAValider)) : ?>
            <?php foreach ($ressourcesAValider as $ressource) : ?>
            
            <div class="row ressource-container">
               <div class="col-lg-12">
                  <!-- Votre contenu de ressource ici -->
                  <div class="candidate-list-box bookmark-post card mt-4">
                     <div class="p-3 card-body ressources">
                        <div class="align-items-center row">
                           <div class="col-lg-9">
                              <div class="candidate-list-content mt-3 mt-lg-0">
                                 <h5 class="fs-19 mb-0">
                                    <a class="ressources-link h4" href="<?= site_url('/ressource/' . $ressource->RES_ID) ?>"> <?= esc($ressource->RES_NOM) ?> </a>
                                 </h5>
                                 <div class="mb-1" >
                                    
                                    <span class="text-muted" style="font-size: 0.8em; display: inline-block; white-space: nowrap;"> posté le <?= esc($ressource->RES_DATE_CREATION) ?></span>
                                 </div>
                                 <ul class="list-inline mb-0 text-muted">
                                    <li class="list-item fs-6">
                                       <i class="mdi mdi-map-marker"></i> <?= substr(strip_tags($ressource->RES_CONTENU), 0, 200) . "..." ?>
                                    </li>
                                    <li class="list-item">
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="favorite-icon">
                        <button class="favoris-btn <?php if(Ressource::estEnFavoris($ressource->RES_ID)) { echo 'active'; }?>" value="<?= esc($ressource->RES_ID) ?>" onclick="ajouterAuxFavoris(this)">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" id="favoris-icon" stroke-linejoin="round" >
                              <path d="M5 3v18l7-5 7 5V3H5z"></path>
                           </svg>
                        </button>
                     </div>
                     <div class="">
                <div class=" ps-3 pb-1 boutton-valider">
                    <input id="valider" class="custom-button boutton-valider btn-secondary" style="box-shadow: none;" type="button" data="<?php echo($ressource->RES_ID) ?>" value="valider">
                </div>
                <div class=" ps-3 boutton-invalider">
                    <input id="invalider" class="custom-button boutton-invalider btn-secondary" type="button" data="<?php echo($ressource->RES_ID) ?>" value="invalider">
                </div>
            </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
         <?php else: ?>
            <p class="my-5">Aucun résultat à afficher.</p>
         <?php endif; ?>
         </div>











</main>
</body>
<?= view('footer') ?>   