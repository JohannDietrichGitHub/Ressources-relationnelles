<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <!-- STYLES -->
      <link href="<?= base_url('css/custom.css');?>" rel="stylesheet">
      <script src="<?= base_url('/js/bloquerCommentaire.js') ?>"></script>
   </head>
   <body>
      <?php
         $session = \Config\Services::session();

         use App\Controllers\Commentaire;
         $uri = current_url(true);
         $segments = $uri->getSegments();
         $ressourceId = $segments[count($segments) - 1];
         $user = new \App\Controllers\Utilisateur();
         $commentaireClass = new Commentaire();
         $commentaireArray = $commentaireClass->afficherFeedCommentaires($ressourceId);

         if (isset($_SESSION['user_id']))
         { ?>
      <form action="<?= base_url('ajouterCommentaire') ?>" method="post">
         <div class="d-flex flex-row mt-2 mb-4">
            <input class="ajouterInput form-control mr-3 py-3 shadow-none" type="text" name="commentaire_contenu" class="d-flex form-control" placeholder="Ajouter un commentaire" required>
            <input type="hidden" name="commentaire_uti_id" value="<?= esc($_SESSION['user_id']) ?>">
            <input type="hidden" name="commentaire_res_id" value="<?= esc($ressourceId) ?>">
            <button type="submit" class="btn custom-dark-blue text-light px-3 ms-3">Commenter</button>
         </div>
      </form>
      <?php
         } else {
             echo "Connectez-vous pour ajouter un commentaire";
         }

         if (isset($commentaireArray) && !empty($commentaireArray))
         {
             foreach ($commentaireArray as $commentaire) : ?>
      <?php if (isset($_SESSION['user_id'])) { ?>
      <div id="session" data-session-id="<?php echo $_SESSION['user_id']; ?>"></div>
      <?php } ?>
      <?php $nomUtilisateur = $user::recupNomUtilisateurParID($commentaire->COM_UTI_ID);  ?>
      <div class="border mt-4 border-2 rounded">
         <div class="commentaire-padding ">
            <span class="text-muted fst-italic" style="display: inline-block;"><?= esc($nomUtilisateur) ?></span>
            <span class="text-muted mb-1" style="font-size: 0.75em; display: inline-block; white-space: nowrap;"> posté le <?= esc($commentaire->COM_TSP_CRE) ?></span>

         <p><?= esc($commentaire->COM_CONTENU) ?></p>
         </div>
         <div>
            <?php $role = isset($_SESSION['user_id']) ? $user::recupRoleParID($_SESSION['user_id']) : 'utilisateur'; ?>
            <?php if (isset($session) && $role === "Modérateur") { ?>
               <div class=" position-relative">
               <button class="btnRepondre bloquer-commentaire position-absolute bottom-0 end-0 mb-0 me-2 custom-text-dark-red text-light"><a data-id-commentaire="<?= $commentaire->COM_ID ?>" class="custom-text-dark-red bloquer-commentaire">Supprimer le commentaire</a></button>
               </div>
               <?php
               }?>
         </div>
         <?php if(isset($_SESSION['user_id']))
            { ?>
         <div style="background-color: #f1f2f3;">
            <button type="button" class="btnRepondre" onclick="toggleResponse(event)">Répondre</button>
            <div class="zone-reponse py-2 px-3" name="zone-reponse"  style="display: none;">
               <form action="<?= base_url('ajouterCommentaire') ?>" method="post">
                  <input type="hidden" name="commentaire_id_commentaire_repondu_reponse" value="<?= esc($commentaire->COM_ID) ?>">
                  <input class="ajouterInput enter-reponse w-100 pb-5 rounded border-1 " type="text" name="commentaire_contenu_reponse" placeholder="Répondre au commentaire" required>
                  <input type="hidden" name="commentaire_uti_id_reponse" value="<?= esc($_SESSION['user_id']) ?>">
                  <input type="hidden" name="commentaire_res_id_reponse" value="<?= esc($ressourceId) ?>">
                  <button type="submit" class="btn custom-dark-blue text-light mt-2">Poster la réponse</button>
               </form>
            </div>
         </div>
      </div>
      <?php
         $commentaireReponseArray = $commentaireClass->afficherFeedSousCommentaires($commentaire->COM_ID);
         if (isset($commentaireReponseArray) && !empty($commentaireReponseArray))
         {
             foreach ($commentaireReponseArray as $commentaireReponse) : ?>
      <div class="commentaire-padding border border-2 rounded mt-1 ms-5">
         <div class="commentaire">
            <?php $nomUtilisateur = $user::recupNomUtilisateurParID($commentaireReponse->COM_UTI_ID); ?>
            <div class="mb-1">
               <span class="text-muted fst-italic" style="display: inline-block;"><?= esc($nomUtilisateur) ?></span>
               <span class="text-muted" style="font-size: 0.75em; display: inline-block; white-space: nowrap;"> posté le <?= esc($commentaire->COM_TSP_CRE) ?></span>
            </div>
            <p><?= esc($commentaireReponse->COM_CONTENU) ?></p>

            <?php if (isset($session) && $role === "Modérateur") { ?>
               <div class=" position-relative">
               <button class="btnRepondre bloquer-commentaire position-absolute bottom-0 end-0 mb-0 me-2 text-light"><a    data-id-commentaire=" <?= $commentaireReponse->COM_ID ?>" class="custom-text-dark-red bloquer-commentaire">Supprimer le commentaire</a></button>
               </div>
               <?php
               }?>
         </div>
      </div>
      <?php endforeach;
         };
         ?>
      <?php   } ?>
      <?php endforeach;
         } else {
             echo "Aucun commentaire pour cette ressource";
         }
         ?>
      <script>
         function toggleResponse(event) {
             var zoneReponse = event.currentTarget.nextElementSibling;
             zoneReponse.style.display = (zoneReponse.style.display === 'none') ? 'block' : 'none';
         }





      </script>
   </body>
</html>
