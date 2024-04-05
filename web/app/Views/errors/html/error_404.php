<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 : Page Non Trouvée</title>

    <style>
        .wrap {
            max-width: 1024px;
            margin: 5rem auto;
            padding: 2rem;
            text-align: center;
            /* border: 1px solid #efefef; */
            /* border-radius: 0.5rem; */
            z-index: 1;
            /* background-color: #fefefe; */
            position: relative;
        }


        #star-pattern{
            background-image: url('./media/pattern.svg');
            background-size: 10%;  
            top: 0;
            left: 0;
            position: absolute;
            height: 100%;
            width: 100%;
            opacity: 0.2;
            z-index: -1;
            animation: pan 80s linear infinite;
            will-change: background-position;
        }

        @keyframes pan {
  0% {
    background-position: 0% 0%;
  }
  100% {
    background-position: 100% -100%;
  }
}
    </style>
</head>
<body>

<?= view('header') ?>
<main>
<div id="star-pattern"></div>
<div class="wrap">
        <h1>Erreur 404 : Page non trouvée</h1>
        <p class="mt-3">
            <?php if (ENVIRONMENT !== 'production') : ?>
                Frero je trouve pas ta route
            <?php else : ?>
                <p>La page demandée est introuvable.</p>
            <?php endif; ?>
        </p>
        </div>
        

    </div>
</main>
<?= view('footer') ?>
</body>
</html>
