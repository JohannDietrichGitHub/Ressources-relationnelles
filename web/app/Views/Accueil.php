<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <title>Food Seeker Accueil</title>
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
            <div class="container d-flex flex-column justify-content-center flex-lg-row card-group pb-4">

                <div class="card text-black mx-1 bg-light mb-3">         
                  <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Sed quis enim et augue tincidunt porta. Nulla facilisi. Mauris pharetra elementum orci, non dictum purus. Nullam iaculis massa at sapien mollis auctor. Curabitur lacus lacus, ultrices in tempor non, mollis a nunc. In ex.</p>
                  </div>
                  <div class="card-header custom-text-dark-blue">Catégorie</div>
                </div>


                <div class="card text-black mx-1 bg-light mb-3">
                  <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Suspendisse sapien ipsum, vehicula sit amet molestie ut, dignissim ac risus. Mauris eget dictum justo, eget porttitor nunc. Nullam ultrices diam et elit ultrices, a placerat nunc pellentesque. Duis vitae sagittis aenean.</p>
                  </div>
                  <div class="card-header custom-text-dark-blue">Catégorie</div>
                </div>

                <div class="card text-black mx-1 bg-light mb-3">
                  <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Mauris interdum placerat diam, ut tempus quam sodales auctor. Nunc sodales orci quis tincidunt lacinia. Nunc vitae aliquet orci, a ultricies enim. Nunc fringilla augue nec faucibus rutrum. Etiam nisi ipsum, aliquet duis.</p>
                  </div>
                  <div class="card-header custom-text-dark-blue">Catégorie</div>
                </div>

                <div class="card text-black mx-1 bg-light mb-3">    
                  <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Nullam eu dapibus tellus. Pellentesque sit amet metus eget purus iaculis ullamcorper. Aenean nunc leo, molestie sed eleifend eget, ullamcorper a leo. Cras interdum pharetra maximus. Duis vitae tellus nisi. Etiam vivamus.</p>
                  </div>
                  <div class="card-header custom-text-dark-blue">Catégorie</div>
                </div>

                <div class="card text-black mx-1 bg-light mb-3">             
                  <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Etiam rutrum vestibulum lacus quis pretium. Sed eget tincidunt elit. Vestibulum cursus augue vel lobortis convallis. Vivamus in erat sit amet nisl pulvinar tincidunt. Phasellus euismod, arcu et placerat auctor, erat nec.</p>
                  </div>
                  <div class="card-header mx-1 custom-text-dark-blue">Catégorie</div>
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

      </main>

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