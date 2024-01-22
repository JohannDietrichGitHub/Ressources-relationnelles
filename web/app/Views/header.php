<!DOCTYPE html>
<html lang="fr">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./css/css.css" rel="stylesheet">  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </head>
<body>
<nav class="navbar navbar-expand-lg green-foodseeker">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url('/'); ?>">Food Seeker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url('/'); ?>">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/recette') ?>">Recettes</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="<?= base_url('/recherche') ?>" method="get">
        <input class="form-control me-2" type="text" name=rechercheRecette placeholder="Recette" aria-label="Search">
        <button class="btn btn-outline-dark" type="submit">Rechercher</button>
      </form>
      <div class="d-flex ms-5 me-2">
        <button class="btn btn-light" type="submit" onclick="window.location.href='<?= base_url('login'); ?>'">Espace Client</button>
      </div>
    </div>
    <!-- [TODO] 05/01/2024 - Changer cette partie pour afficher les messages plus proprement -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('error')) : ?>
        <div class="alert alert-error" role="alert">
            <?= session('error') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('errorconnect')) : ?>
        <div class="alert alert-error" role="alert">
            <?= session('errorconnect') ?>
        </div>
    <?php endif; ?>
  </div>
</nav>

  <script>
    function rechercherRecette(){
      var inputData = document.getElementById('rechercher').value;

      console.log(inputData);

      // $.ajax({
      //   type: "POST",
      //   url:"";
      //   data: { nom_de_votre_input: inputData},
      //   success: function(response){
      //     console.log(response);
      //   }
      // })


      fetch('<?= base_url('recherche/rechercheRecette'); ?>',{
        method: 'POST',
        headers:{
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({saisieRecherche: inputData})
      })
      .then(response => response.json())
      .then(data => {
        console.log(data);
      })
    }
  </script>

</body>
</html>