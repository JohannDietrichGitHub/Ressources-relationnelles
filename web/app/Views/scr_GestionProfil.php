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
                <h1 class="h2">Gestion du profil</h1>
                <br>
              </div>
              <form action="<?= site_url('/gestion_profil/modifier_profil' . esc($utilisateur->UTI_ID)) ?>" method="post" class="form-signin">
                <div class="dropdown form-group">
                    <input type="hidden" name="civilite" id="hiddenCivilite" value =<?= esc($utilisateur->UTI_CIVILITE) ?>>
                    <button class="form-control form-button form-control-lg btn dropdown-toggle shadow-none text-start" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Veuillez sélectionner votre civilité
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
        <div class="form-floating text-secondary mt-3">
            <input type="text" name="nom" class="form-control" id="floatingNom" value =<?= esc($utilisateur->UTI_NOM) ?>>
            <label for="floatingNom">Nom</label>
        </div>
        <div class="form-floating text-secondary mt-3">
            <input type="text" name="prenom" class="form-control" id="floatingPrenom" value =<?= esc($utilisateur->UTI_PRENOM) ?>>
            <label for="floatingPrenom">Prénom</label>
        </div>
        <div class="form-floating text-secondary mt-3">
            <input type="textarea" name="adresse" class="form-control" id="floatingAdresse" value ="<?= esc($utilisateur->UTI_ADRESSE) ?>">
            <label for="floatingAdresse">Adresse</label>
        </div> 
        <div class="form-floating text-secondary mt-3">
            <input type="text" name="cp" class="form-control" id="floatingCp" value =<?= esc($utilisateur->UTI_CP) ?>>
            <label for="floatingCp">Code postal</label>
        </div> 
        <div class="form-floating text-secondary mt-3">
            <input type="text" name="ville" class="form-control" id="floatingVille" value =<?= esc($utilisateur->UTI_VILLE) ?>>
            <label for="floatingVille">Ville</label>
        </div>
        <div class="form-floating text-secondary mt-3">
            <input type="text" name="numTel" class="form-control" id="floatingNumTel" value =<?= esc($utilisateur->UTI_NUM_TEL) ?>>
            <label for="floatingNumTel">Numéro de téléphone</label>
        </div>  
        <button class="btn btn-secondary w-100 py-2 my-3" type="submit">Valider les modifications</button>
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
