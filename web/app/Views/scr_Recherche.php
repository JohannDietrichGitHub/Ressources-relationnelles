<?php
   use App\Controllers\Ressource;
   use App\Controllers\Utilisateur;
   
   ?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <title>Ressources</title>
   </head>
   <?= view('header') ?>
   <body>
      <main>
      <div class="container mb-5">
        <h2 class="mt-4"> Resultat(s) pour
                    <?php   $request = service('request');
                            $nomRecherche = $request->getVar('nom');
                            echo esc($nomRecherche) ?>
        </h2>
          <script src="<?= base_url('/js/ajouterFavoris.js') ?>"></script>
         <?php
            if (!empty($resultats)) : ?>
            <?php foreach ($resultats as $ressource) : ?>
            
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
         <?php endforeach; ?>
         <?php else: ?>
            <p class="my-5">Aucun résultat à afficher.</p>
         <?php endif; ?>
         </div>
      </main>
   </body>
   <?= view('footer') ?>
   <script>
      function toggleFavoris() {
        var btn = document.getElementById('favoris-icon');
        btn.classList.toggle('active');
      }
   </script>
