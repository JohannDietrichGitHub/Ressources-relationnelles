<!DOCTYPE html>
<html lang="fr">
<head>
      <meta charset="UTF-8">
      <title>Resources relationnelles</title>
      <!-- STYLES -->
      <style {csp-style-nonce}>
         .bg-accueil {
         overflow: hidden;
         position: relative;
         }
         .bg-accueil::before {
         content: "";
         position: absolute;
         left: 0;
         right: 0;
         z-index: -1;
         display: block;
         background-image: url("./images/bg-title.jpg");
         background-size:cover;
         overflow: hidden;
         background-position-y: -0px;
         width: 110%;
         height: 110%;
         left: -5%;
         top: -5%;
         filter: blur(12px);
         }
      </style>
   </head>
<body>
<?= view('header') ?>
  <main>
      <div class="container h-100 mt-3 mb-5">
        <div class="row h-100 pb-3">
          <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
              <div class="text-center mt-4">
                <h1 class="h2">Administrer les utilisateurs</h1>
                <br>
              </div>
              <?php if (!empty($utilisateurs)) : ?>
    <table class="table mb-5">
        <thead class="table-light">
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Etat</th>
                <th>Rôle</th>
                <th>Promotion</th>
                <th>Activation/Désactivation</th>
            </tr>
        </thead>
        <tbody>       
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= $utilisateur->UTI_ID ?></td>
                        <td><?= $utilisateur->UTI_NOM ?></td>
                        <td><?= $utilisateur->UTI_MAIL ?></td> 
                        <?php if($utilisateur->UTI_ETAT == "A"):  ?>
                            <td> Actif </td>
                        <?php elseif($utilisateur->UTI_ETAT == "I"):  ?> 
                            <td> Inactif </td> 
                        <?php endif; ?>                   
                        <?php if($utilisateur->UTI_ID_ROL == 3):  ?>
                            <td>Utilisateur</td>  
                            <td>
                                <a href="<?= base_url('administrer_utilisateur/promouvoir_utilisateur/2/' . esc($utilisateur->UTI_ID)) ?>" class="btn btn-primary my-4 my-lg-1 custom-button">Promouvoir modérateur</a>
                                <a href="<?= base_url('administrer_utilisateur/promouvoir_utilisateur/1/' . esc($utilisateur->UTI_ID)) ?>" class="btn btn-primary my-4 my-lg-1 custom-button">Promouvoir administrateur</a>
                            </td> 
                        <?php elseif($utilisateur->UTI_ID_ROL == 2):  ?>
                            <td>Modérateur</td>
                            <td>
                                <a href="<?= base_url('administrer_utilisateur/promouvoir_utilisateur/3/' . esc($utilisateur->UTI_ID)) ?>" class="btn btn-primary my-4 my-lg-1 custom-button">Promouvoir utilisateur</a>
                                <a href="<?= base_url('administrer_utilisateur/promouvoir_utilisateur/1/' . esc($utilisateur->UTI_ID)) ?>" class="btn btn-primary my-4 my-lg-1 custom-button">Promouvoir administrateur</a>
                            </td>
                        <?php elseif($utilisateur->UTI_ID_ROL == 1): ?>   
                            <td>Administrateur</td>                         
                            <td>
                                <a href="<?= base_url('administrer_utilisateur/promouvoir_utilisateur/3/' . esc($utilisateur->UTI_ID)) ?>" class="btn btn-primary my-4 my-lg-1 custom-button">Promouvoir utilisateur</a>
                                <a href="<?= base_url('administrer_utilisateur/promouvoir_utilisateur/2/' . esc($utilisateur->UTI_ID)) ?>" class="btn btn-primary my-4 my-lg-1 custom-button">Promouvoir modérateur</a>
                            </td> 
                        <?php endif; ?>
                        <?php if($utilisateur->UTI_ETAT == "A"):  ?>
                            <td>
                                <a href="<?= base_url('administrer_utilisateur/activation_utilisateur/2/' . esc($utilisateur->UTI_ID)) ?>" class="btn custom-blue my-4 my-lg-1 custom-button">Désactiver l'utilisateur</a>
                            </td>    
                        <?php elseif($utilisateur->UTI_ETAT == "I"):  ?> 
                            <td>
                                <a href="<?= base_url('administrer_utilisateur/activation_utilisateur/1/' . esc($utilisateur->UTI_ID)) ?>" class="btn custom-blue my-4 my-lg-1 custom-button">Activer l'utilisateur</a>
                            </td>  
                        <?php endif; ?> 
                    </tr>
                <?php endforeach; ?>       
        </tbody>
    </table>
<?php else :?>
    <p>Aucun utilisateur trouvé.</p>
<?php endif; ?>
              </div>
              </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  <?= view('footer') ?>
</html>
