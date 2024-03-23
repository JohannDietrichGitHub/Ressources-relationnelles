<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <title>Ressources</title>
   </head>
   <style>
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
   </style>
   <body>
      <?=  view('header'); ?>
      <main>
         <div class="container my-5">
         <h1 class="mb-3">Tableau de Bord</h1>
         <h4 class="mb-4">Ressources</h3>
            <div class="accordion" id="dashboard">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     Ressources Favorites
                     </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#dashboard">
                     <div class="accordion-body">
                        <?php
                           use App\Controllers\Ressource;
                           use App\Controllers\Utilisateur;
                           
                           if (!empty($ressourcesFavorites)) : ?>
                        <script src="<?= base_url('/js/ajouterFavoris.js') ?>"></script>
                        <?php foreach ($ressourcesFavorites as $ressource) : ?>
                        <div class="container">
                           <div class="row">
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
                                                   <span class="text-muted fst-italic" style="display: inline-block;"><?= esc(Utilisateur::recupNomUtilisateurParID($ressource->RES_UTI_ID)) ?></span>
                                                   <span class="text-muted" style="font-size: 0.8em; display: inline-block; white-space: nowrap;"> posté le <?= esc($ressource->RES_DATE_CREATION) ?></span>
                                                </div>
                                                <ul class="list-inline mb-0 text-muted">
                                                   <li class="list-item fs-6">
                                                      <i class="mdi mdi-map-marker"></i> <?= substr(strip_tags($ressource->RES_CONTENU), 0, 200) . "..." ?>
                                                   </li>
                                                   <li class="list-item">
                                                   </li>
                                                </ul>
                                                <div>
                                                   <span>
                                                   <span class="badge bg-categorie-tag fs-14 mt-3"><?= esc($ressource->categorie) ?></span>
                                                   </span>
                                                   <?php foreach ($ressource->relations as $relation) { ?>
                                                   <span class="badge bg-relation-tag fs-14 mt-3"><?= $relation ?></span>
                                                   <?php } ?>
                                                   <span class="badge bg-info fs-14 mt-3" style="color: #54586d"><?= esc($ressource->type) ?></span>
                                                </div>
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
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
            <div class="accordion-item">
               <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Ressources à valider
                  </button>
               </h2>
               <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dashboard">
                  <div class="accordion-body">
                     <strong>Bientôt disponible :)
                  </div>
               </div>
            </div>

            <div class="my-5">
               <h4>Paramètres</h3>
            </div>
         </div>

      </main>
      <?= view('footer') ?>
   </body>

   <script>
      function toggleFavoris() {
        var btn = document.getElementById('favoris-icon');
        btn.classList.toggle('active');
      }
   </script>