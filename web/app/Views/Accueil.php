<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <title>Ressource Relationnelles Accueil</title>
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

         #specialDiv{
      position: fixed;
      bottom: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-size: 100%;
      background-color: lightblue;
      display: none; /* Masquer initialement la div */
      background-image: url('./media/specialImage.png');
      background-repeat: repeat;
      background-position: center;
    }
      </style>
   </head>
   <body class= "bg-body-tertiary">
   <?= view('header') ?>
   <main class= "mt-5">
         <div id="title" class="container d-flex justify-content-center marianne-bold">
            <div class="row align-items-start">
               <div class="col-3 text-end">
                  <h1 class="display-1">(RE)</h1>
               </div>
               <div class="col-3 text-start my-lg-2 ms-4">
                  <h1 class="display-6">SOURCES <br> LATIONNELLES</h1>
               </div>
            </div>
         </div>
         <div class="d-flex justify-content-center my-3">
            <p class="marianne-italic">La plateforme pour améliorer vos relations</p>
         </div>
         <div class="custom-blue py-2">
            <div class="pb-2 container">
              <p class="h3 text-light">Ressources Populaires</p>
            </div>
            <div id="divRessources" class="container d-flex flex-column justify-content-center flex-lg-row card-group pb-4">

            <div class="card text-black mx-1 bg-light mb-3">    
                  <div class="card-body">
                    <h5 class="card-title  placeholder-glow">
                    <span class="placeholder col-8"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                    </p>
                  </div>
                  <div class="card-header  placeholder-glow custom-text-dark-blue">
                  <span class="placeholder col-8"></span>
                  </div>
                </div>


                <div class="card text-black mx-1 bg-light mb-3">    
                  <div class="card-body">
                    <h5 class="card-title  placeholder-glow">
                    <span class="placeholder col-8"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                    </p>
                  </div>
                  <div class="card-header  placeholder-glow custom-text-dark-blue">
                  <span class="placeholder col-8"></span>
                  </div>
                </div>

                <div class="card text-black mx-1 bg-light mb-3">    
                  <div class="card-body">
                    <h5 class="card-title  placeholder-glow">
                    <span class="placeholder col-8"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                    </p>
                  </div>
                  <div class="card-header  placeholder-glow custom-text-dark-blue">
                  <span class="placeholder col-8"></span>
                  </div>
                </div>

                <div class="card text-black mx-1 bg-light mb-3">    
                  <div class="card-body">
                    <h5 class="card-title  placeholder-glow">
                    <span class="placeholder col-8"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                    <span class="placeholder col-7"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                      <span class="placeholder col-8"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-4"></span>
                      <span class="placeholder col-6"></span>
                    </p>
                  </div>
                  <div class="card-header  placeholder-glow custom-text-dark-blue">
                  <span class="placeholder col-8"></span>
                  </div>
                </div>

            </div>
         </div>

         <div id="info" class=" flex-column d-flex text-center justify-content-center py-4">
            <p class="display-6"> « Le Projet » </p>
            <div class="mx-2">
            <!--<p> C'est un site internet qui est trop cher à mettre en place réellement donc on doit faire un projet infaisable</p>-->
            <p>Praesent faucibus, lacus non eleifend rhoncus, sem quam euismod nunc, et ultrices nunc nunc in diam. Nunc elit eros, hendrerit eu nibh quis, malesuada bibendum lacus. Mauris rhoncus metus non enim dictum, et semper eget.</p>
            </div>
          
         </div>

   <?= view('footer') ?>


<div id="specialDiv">
</div>

      <script>
document.addEventListener("keydown", function(event) {
  if (event.key === 'O' && event.getModifierState('CapsLock')) {
    // Afficher la div
    console.log('POV : Moi en train de galérer au projet')
    var specialDiv = document.getElementById('specialDiv');
    specialDiv.style.display = 'block';
  

      // Masquer la div après 1 seconde
      setTimeout(function() {
      specialDiv.style.display = 'none';
    }, 50); // 1000 millisecondes équivalent à 1 seconde
  }
});



const divRessources= document.getElementById("divRessources");

// Fonction pour effectuer la requête à la route
async function chargerRessources() {
  try {
    const baseUrl = "<?php echo base_url(); ?>";
    const response = await fetch(`${baseUrl}/getAccueil/5`);
    if (!response.ok) {
      throw new Error('Erreur lors de la récupération des ressources.');
    }

    const data = await response.text();
    afficherRessources(data);
  } catch (error) {
    console.error(error);
  }
}

function afficherRessources(ressources) {
  console.log(ressources);

  divRessources.innerHTML = ressources;
}
document.addEventListener('DOMContentLoaded', () => {
  chargerRessources();
});




var timer = false;
document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("keydown", function(event) {
        if (event.key === 'E' && event.getModifierState('CapsLock') && timer == false) {
            var imageAChanger = document.getElementById('img-banner');
            if (imageAChanger) { // Vérifie si l'élément existe
                var urlImageOriginale = imageAChanger.src;
                var nouvelleImage = new Image();
                nouvelleImage.src = './media/banner-test.png';
                nouvelleImage.alt = imageAChanger.alt;
                nouvelleImage.width = imageAChanger.width;
                nouvelleImage.height = imageAChanger.height;
                nouvelleImage.id = imageAChanger.id;
                imageAChanger.parentNode.replaceChild(nouvelleImage, imageAChanger);
                timer = true;
                setTimeout(function() {
                    timer = false;
                    var imageOriginale = new Image();
                    imageOriginale.src = urlImageOriginale;
                    imageOriginale.alt = nouvelleImage.alt;
                    imageOriginale.width = nouvelleImage.width;
                    imageOriginale.height = nouvelleImage.height;
                    imageOriginale.id = nouvelleImage.id;
                    nouvelleImage.parentNode.replaceChild(imageOriginale, nouvelleImage);
                }, 200); // 50 millisecondes
            } else {
                console.error("L'élément avec l'ID 'img-banner' n'existe pas dans le DOM.");
            }
        }
    });
});


// Remplace l'ancienne image par la nouvelle dans le DOM
// imageAChanger.parentNode.replaceChild(nouvelleImage, imageAChanger);

      </script>
   </body>
</html>

