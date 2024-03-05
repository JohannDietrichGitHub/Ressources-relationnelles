<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Ressource</title>
    <style>
      body {
        background: #E6E6FA
      }

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

      .bg-soft-tag {
        background-color: rgba(116, 120, 141, .15) !important;
        color: #74788d !important;
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
  <body> <?= view('header') ?>
    <!-- <div class="ressource-container"> --> <?php
    if (!empty($ressource)) {
//        $commentaireArray = getCommentaires($ressource->id)
        ?> <div class="ressource">
      <h2> <?= esc($ressource->RES_NOM) ?> </h2>
      <p> <?= esc($ressource->RES_CONTENU) ?> </p>
      <p> <?= esc($ressource->RES_DATE_CREATION) ?> </p>
      <div class="commentaire-container"> <?php
          include_once('scr_feedCommentaires.php');
                ?> </div>
    </div> <?php
    }
    if (!empty($ressources)) : ?>
        <?php foreach ($ressources as $ressource) : ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Votre contenu de ressource ici -->
                        <div class="candidate-list-box bookmark-post card mt-4">
                            <div class="p-4 card-body ressources">
                                <div class="align-items-center row">
                                    <div class="col-lg-5">
                                        <div class="candidate-list-content mt-3 mt-lg-0">
                                            <h5 class="fs-19 mb-0">
                                                <a class="ressources-link h4" href="<?= site_url('/ressource/' . $ressource->RES_ID) ?>"> <?= esc($ressource->RES_NOM) ?> </a>
                                            </h5>
                                            <p class="text-muted mb-2"> <?= isset($idUsers) ? esc($idUsers) : '' ?></p>
                                            <!-- Affichez les autres informations de ressource ici -->
                                            <ul class="list-inline mb-0 text-muted">
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-map-marker"></i> <?= substr(html_entity_decode($ressource->RES_CONTENU), 0, 200) . "..." ?>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="mdi mdi-wallet"></i><?= esc($ressource->RES_DATE_CREATION) ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                            <span class="badge bg-soft-tag fs-14 mt-1">Design</span>
                                            <span class="badge bg-soft-tag fs-14 mt-1">Developer</span>
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

    <!-- </div> --> <?= view('footer') ?>
  </body>
  <script>
    function toggleFavoris() {
      var btn = document.getElementById('favoris-icon');
      btn.classList.toggle('active');
    }
  </script>