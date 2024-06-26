<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <?= view('header') ?>
  <main>
      <div class="container h-100 mt-3 mb-5">
        <div class="row h-100 pb-3">
          <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
              <div class="text-center mt-4">
                <h1 class="h2">Inscription</h1>
                <p class="lead">
                  Merci de remplir les informations ci-dessous.
                </p>
              </div>
              <form action="<?= site_url('/inscription/sinscrire') ?>" method="post">
                <div class="card">
                  <div class="card-body">
                    <div class="m-sm-4">
              <div class="form-group">
              <?php if (session()->has('validation') && session('validation')->getError('civilite') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('civilite')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('nom') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('nom')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('prenom') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('prenom')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('dateNaiss') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('dateNaiss')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('adresse') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('adresse')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('cp') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('cp')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('ville') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('ville')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('tel') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('tel')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('mail') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('mail')  ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->has('validation') && session('validation')->getError('mdp') != NULL) : ?>
                  <div class="alert alert-danger">   
                      <?= session('validation')->getError('mdp')  ?>
                  </div>
              <?php endif; ?>
              <label>Civilité</label>
              <div class="dropdown form-group">
              <input type="hidden" name="civilite" id="hiddenCivilite" value="">
              <button class="form-control form-button form-control-lg btn dropdown-toggle shadow-none text-start" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Veuillez sélectionner une réponse
              </button>
              <ul class="dropdown-menu form-control form-control-lg" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#" onclick="updateDropdown('Monsieur')">Monsieur</a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdown('Madame')">Madame</a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdown('Autre')">Autre</a></li>
              </ul>
              </div>
              <script>
                function updateDropdown(selectedValue) {
                    document.getElementById('dropdownMenuButton1').innerText = selectedValue;
                    document.getElementById('hiddenCivilite').value = selectedValue;
                }
              </script>
              </div>
              <div class="form-group">
              <label>Nom</label>
              <input class="form-control form-control-lg shadow-none" type="text" name="nom" placeholder="Entrez votre nom">
              </div>
              <div class="form-group">
              <label>Prénom</label>
              <input class="form-control form-control-lg shadow-none" type="text" name="prenom" placeholder="Entrez votre prénom">
              </div>
              <div class="form-group">
              <label>Date de naissance</label>
              <input class="form-control form-control-lg shadow-none" type="date" name="dateNaissance" placeholder="Sélectionnez votre date de naissance">
              </div>
              <div class="form-group">
              <label>Adresse</label>
              <input class="form-control form-control-lg shadow-none" type="text" name="adresse" placeholder="Entrez votre adresse">
              </div>
              <div class="form-group">
              <label>Code Postal</label>
              <input class="form-control form-control-lg shadow-none" type="text" name="cp" pattern="[0-9]{1,6}" placeholder="Code Postal">
              </div>
              <div class="form-group">
              <label>Ville</label>
              <input class="form-control form-control-lg shadow-none" type="text" name="ville" placeholder="Ville">
              </div>
              <div class="form-group">
              <label>Téléphone</label>
              <input class="form-control form-control-lg shadow-none" type="text" name="tel" pattern="[0-9]{1,10}" placeholder="Entrez votre numéro de téléphone">
              </div>
              <div class="form-group">
              <label>Email</label>
              <input class="form-control form-control-lg shadow-none" type="mail" name="mail" placeholder="Entrez votre email">
              </div>
              <div class="form-group">
              <label>Mot de passe</label>
              <input class="form-control form-control-lg shadow-none" type="password" name="mdp" placeholder="Entrez votre mot de passe">
              </div>
              <div class="form-group">
              <label>Confirmer Mot de Passe</label>
              <input class="form-control form-control-lg shadow-none" type="password" name="mdpConfirmer" placeholder="Confirmez votre mot de passe">
              </div>
              <div class="text-center mt-3">
              <button type="submit" class="btn btn-lg btn-primary">S'inscrire</button>
              </div>
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
  </body>
</html>