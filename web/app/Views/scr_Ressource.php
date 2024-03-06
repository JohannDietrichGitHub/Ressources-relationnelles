<?php

use App\Controllers\Ressource;
use App\Controllers\Utilisateur;

?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <title>Ressources</title>
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
         #favoris-btn {
         background-color: transparent !important;
         border: none !important;
         cursor: pointer;
         background-color: none;
         }
         #favoris-icon.active {
         fill: #ffbd03;
         /* Changer la couleur de remplissage en jaune */
         stroke: #eeac02;
         }
      </style>
   </head>
   <?= view('header') ?>
   <body>
      <main>
         <?php
            if (!empty($ressource)) {
            //        $commentaireArray = getCommentaires($ressource->id)
                ?>
         <div class="ressource">
            <h2> <?= esc($ressource->RES_NOM) ?> </h2>
            <p> <?= html_entity_decode( esc($ressource->RES_CONTENU)) ?> </p>
            <p> <?= esc($ressource->RES_DATE_CREATION) ?> </p>
            <div class="commentaire-container"> <?php
               include_once('scr_feedCommentaires.php');
                     ?> </div>
         </div>
         <?php
            }
            if (!empty($ressources)) : ?>
         <?php foreach ($ressources as $ressource) : ?>
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
                        <button onclick="toggleFavoris()" id="favoris-btn">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" id="favoris-icon" stroke-linejoin="round">
                              <path d="M5 3v18l7-5 7 5V3H5z"></path>
                           </svg>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
         <?php endforeach; ?>
         <?php endif; ?>
      </main>
   </body>
   <?= view('footer') ?>
   <script>
      function toggleFavoris() {
        var btn = document.getElementById('favoris-icon');
        btn.classList.toggle('active');
      }
   </script>