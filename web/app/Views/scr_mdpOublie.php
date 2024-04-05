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
                <h1 class="h2">Mot de passe oublié</h1>
                <br>
              </div>
              <form action="<?= site_url('connexion/mdp_oublie/nouveau_mdp') ?>" method="post" class="form-signin ">   
            <div class="form-floating text-secondary">
            <input type="mail" name="mail" class="form-control" id="floatingmail" placeholder="">
            <label for="floatingmail">Email</label>
            </div>  
            <div class="form-floating text-secondary">
            <input type="password" name="mdp" class="form-control" id="floatingPassword" placeholder="">
            <label for="floatingPassword">Nouveau mot de passe</label>
            </div>
            <div class="form-floating text-secondary">
            <input type="password" name="mdp_confirme" class="form-control" id="floatingPassword" placeholder="">
            <label for="floatingPassword">Confirmer le nouveau mot de passe</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Confirmer</button>
        </form>
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
