<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FAQ</title>
    <!-- STYLES -->
</head>
<body class= "bg-body-tertiary">
<?= view('header') ?>
<main class= "mt-5 mb-5">
    <div id="title" class="container d-flex justify-content-center marianne-bold">
        <div class="row align-items-start">
            <div class="col-3 text-end">
                <h1 class="display-1">FAQ</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2>Questions Fréquentes</h2>
        <div class="accordion" id="faqAccordion">
            <!-- Question 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Qu'est-ce que Ressource Relationnelles et quel est son objectif principal ?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ressource Relationnelles est une plateforme sponsorisée par le gouvernement qui vise à rassembler les individus autour de diverses ressources telles que des articles et des activités dans le but de favoriser les relations interpersonnelles et le bien-être social.
                    </div>
                </div>
            </div>
            <!-- Question 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Comment puis-je participer ou contribuer à Ressource Relationnelles ?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pour participer ou contribuer à Ressource Relationnelles, vous pouvez soumettre du contenu pertinent, participer à des discussions et activités communautaires, ainsi que partager vos expériences et connaissances avec d'autres membres.
                    </div>
                </div>
            </div>
            <!-- Question 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Qui peut publier du contenu sur Ressource Relationnelles ?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Toute personne intéressée à partager des ressources et à contribuer à la communauté peut publier du contenu sur Ressource Relationnelles. Cependant, le contenu est soumis à une modération pour garantir sa pertinence et sa qualité.
                    </div>
                </div>
            </div>
            <!-- Question 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Quel type de ressources puis-je trouver sur Ressource Relationnelles ?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sur Ressource Relationnelles, vous pouvez trouver une variété de ressources telles que des articles sur le bien-être social, des activités de groupe pour renforcer les relations interpersonnelles, des conseils pour améliorer la communication, et bien plus encore.
                    </div>
                </div>
            </div>
            <!-- Question 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Comment puis-je contacter l'équipe de Ressource Relationnelles ?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Vous pouvez nous contacter en utilisant le formulaire de contact disponible sur notre site Web ou en envoyant un e-mail à [adresse e-mail de contact]. Notre équipe se fera un plaisir de répondre à vos questions et de vous aider dans la mesure du possible.
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= view('footer') ?>


<div id="specialDiv">
</div>

</body>
</html>
