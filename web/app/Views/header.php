<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?= base_url('/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" crossorigin="anonymous">
    <link href="<?= base_url('/css/custom.css') ?>" rel="stylesheet">
    <script src="<?= base_url('/bootstrap/js/bootstrap.bundle.min.js') ?>" crossorigin="anonymous"></script>
    <title>Ressources Relationnelles</title>
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-lg custom-dark-blue">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">
      <img src="/media/banner.png" href="<?= base_url('/'); ?>" alt="" height="60">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="<?= base_url('/'); ?>">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?= base_url('/ressources') ?>">Ressources</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?= base_url('/FAQ') ?>">FAQ</a>
        </li>
      </ul>
      
      <div class="d-flex flex-column flex-lg-row ms-5-lg me-2">
        <button class="btn btn-secondary me-lg-2 my-lg-1 custom-button" type="submit" onclick="window.location.href='<?= base_url('inscription'); ?>'">Inscription</button>
        <button class="btn btn-primary my-4 my-lg-1 custom-button" type="submit" onclick="window.location.href='<?= base_url('connexion'); ?>'">Connexion</button>
      </div>
      
      <form class="d-flex search-button align-items-center" role="search" action="<?= base_url('/recherche') ?>" method="get">
        <input class="form-control shadow-none border-0" type="text" name=recherche placeholder="Rechercher..." aria-label="Search">
        <object class="align-middle"data="./icon/search.svg" height="30"> </object>
      </form>
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