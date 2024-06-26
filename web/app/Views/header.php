<!DOCTYPE html>
<html lang="fr">
  <head>
  <link rel="icon" href="<?= base_url('favicon.ico'); ?>"  type="image/ico" >
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="<?= base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" crossorigin="anonymous">
  <link href="<?= base_url('css/custom.css');?>" rel="stylesheet">
  <link href="<?= base_url('css/ressource.css');?>" rel="stylesheet">  
  <script src=" <?= base_url('bootstrap/js/bootstrap.bundle.min.js'); ?>" crossorigin="anonymous"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <title>Ressources Relationnelles</title>
  </head>
  <style>

.search-icon {
    width: 30px; /* Largeur de votre icône */
    height: 30px; /* Hauteur de votre icône */
    background-image: url('<?= base_url('icon/search.svg'); ?>');
    background-size: cover; /* Ajuster la taille de l'image pour remplir le conteneur */
    cursor: pointer; /* Indiquer que le conteneur est cliquable */
}
  </style>
<body>
<?php
    $userId = $_SESSION['user_id'] ?? null;
    $idRole = $_SESSION['id_role'] ?? null;
?>
<nav class="navbar navbar-dark navbar-expand-lg custom-dark-blue">
  <div class="container-fluid">

    <a class="navbar-brand" href="<?= base_url('/'); ?>">
      <img id="img-banner"src="<?= base_url('media/banner.png'); ?>" alt="" height="60">
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
        <?php if ($userId !== null): ?>
          <li class="nav-item">          
   
          </li>
        <?php endif; ?>
        <?php if ($idRole == 1): ?>
          <li class="nav-item">          
            <a class="nav-link text-light" href="<?= base_url('/administrer_utilisateur') ?>">Gestion des utilisateurs</a>         
          </li>
        <?php endif; ?>
      </ul>
      
      <div class="d-flex flex-row justify-content-between ms-5-lg me-2">
  <?php if ($userId !== null): ?>
    <div class="d-flex align-items-center flex-grow-1"> <!-- Utilisation de flex-grow-1 pour que ce div prenne toute la largeur disponible -->
      <button class="btn btn-secondary py-auto me-lg-2 my-lg-1 custom-button w-100" type="submit" onclick="window.location.href='<?= base_url('ressource/ajout'); ?>'">Ajouter une ressource </button>
    </div>
    <div class="dropdown">
      <ion-icon name="person-circle-outline" class="" type="button" data-bs-toggle="dropdown" id="profil" style="color: white;font-size: 50px;"></ion-icon>
      <ul class="dropdown-menu dropdown-menu-end w-100" aria-labelledby="profil"> <!-- Utilisation de w-100 pour que le dropdown-menu prenne toute la largeur -->
        <li><a class="dropdown-item" href="<?= base_url('/gestion_profil') ?>">Gérer son profil</a></li>
        <li><a class="dropdown-item" href="<?= base_url('/utilisateur/ressourcesfavorites') ?>">Tableau de bord</a></li>
        <li><a class="dropdown-item" href="<?= base_url('/utilisateur/vosressources') ?>">Vos ressources</a></li>
          <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="<?= base_url('/deconnexion'); ?>">Déconnexion</a></li>
      </ul>
    </div>
  <?php else: ?>

        <button class="btn btn-secondary me-lg-2 my-lg-1 custom-button" type="submit" onclick="window.location.href='<?= base_url('inscription'); ?>'">Inscription</button>
        <button class="btn btn-primary my-4 my-lg-1 custom-button" type="submit" onclick="window.location.href='<?= base_url('connexion'); ?>'">Connexion</button>
        <?php endif; ?>

      </div>
      
      
      <form class="d-flex search-button align-items-center" role="search" action="<?= base_url('/recherche') ?>" method="get">
        <input class="form-control shadow-none border-0" id="rechercher" type="text" name=nom placeholder="Rechercher..." aria-label="Search">
        <button style="border: none; background-color: transparent">
          <div class="search-icon"></div>
        </button>

      </form>
    </div>
  </div>
</nav>

<?php if (session()->has('success')) : ?>
      <div class="position-absolute" style="width: 100%; top: 60px;">
        <div class="alert alert-success alert-dismissible fade show inner-message" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        
    <?php endif; ?>
    <?php if (session()->has('error')) : ?>
      <div class="position-absolute" style="width: 100%; top: 60px;">
        <div class="alert alert-danger alert-dismissible fade show inner-message" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>



</body>
</html>