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
<?php $userId = $_SESSION['user_id'] ?? null; 
$idRole = $_SESSION['id_role'] ?? null; ?>
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
      <?php if ($userId !== null): ?>
          <button class="btn btn-primary my-4 my-lg-1 custom-button" type="submit" onclick="window.location.href='<?= base_url('deconnexion'); ?>'">Déconnexion</button>
      <?php else: ?>
        <button class="btn btn-secondary me-lg-2 my-lg-1 custom-button" type="submit" onclick="window.location.href='<?= base_url('inscription'); ?>'">Inscription</button>
        <button class="btn btn-primary my-4 my-lg-1 custom-button" type="submit" onclick="window.location.href='<?= base_url('connexion'); ?>'">Connexion</button>
      <?php endif; ?>
      </div>
      
      
      <form class="d-flex search-button align-items-center" role="search" action="<?= base_url('/recherche') ?>" method="get">
        <input class="form-control shadow-none border-0" type="text" name=recherche placeholder="Rechercher..." aria-label="Search">
        <object class="align-middle"data="./icon/search.svg" height="30"> </object>
      </form>
    </div>
  </div>
</nav>

<?php if (session()->has('success')) : ?>
      <div class="position-absolute" style="width: 100%; top: 60px;">
        <div class="alert alert-success inner-message" role="alert">
            <?= session('success') ?>
        </div>
        </div>
        
    <?php endif; ?>
    <?php if (session()->has('error')) : ?>
      <div class="position-absolute" style="width: 100%; top: 60px;">
        <div class="alert alert-danger inner-message" role="alert">
            <?= session('error') ?>
        </div>
    </div>
    <?php endif; ?>

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