<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Seeker Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- STYLES -->
    <style {csp-style-nonce}>

        .green-foodseeker{
            background-color: #2B9348 !important;
        }

        .btn-primary{
            background-color: #2B9348 !important;
            border-color: #2B9348 !important;
        }
        .btn-primary:hover{
            background-color: #1B8338 !important
        }
        .btn-primary:active{
            background-color: #0B7328 !important
        }

        .btn-secondary{
            background-color: #80B918 !important;
            border-color: #80B918 !important;
        }
        .btn-secondary:hover{
            background-color: #70A908 !important
        }
        .btn-secondary:active{
            background-color: #609900 !important
        }



      .form-signin {
  max-width: 350px;
  min-width: 330px;
  padding: 1rem;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input {
    margin-bottom: 2px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;  
}

.form-signin:focus input {
    border-color: #0B7328 !important;
    outline-color: #0B7328 !important;
}
    </style>
</head>
<body>
    
<div class="my-5 py-5">

</div>
    <div class=" col-md d-flex mx-auto justify-content-center">
        <form action="<?= site_url('/inscription/processRegister') ?>" method="post" class="form-signin">
            <h1 class="h3 mb-3 fw-normal">Inscription</h1>

            <div class="form-floating text-secondary">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="">
            <label for="floatingInput">Nom d'utilisateur</label>
            </div>
            <div class="form-floating text-secondary">
            <input type="text" name="civilite" class="form-control" id="floatingCivilite" placeholder="">
            <label for="floatingCivilite">Civilite</label>
            </div>
            <div class="form-floating text-secondary">
            <input type="mail" name="mail" class="form-control" id="floatingMail" placeholder="">
            <label for="floatingMail">Mail</label>
            </div>
            <div class="form-floating text-secondary">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="">
            <label for="floatingPassword">Mot de passe</label>
            </div>
            <div class="form-floating text-secondary">
            <input type="password" name="confirm_password" class="form-control" id="floatingConfirmPassword" placeholder="">
            <label for="floatingConfirmPassword">Confirmer le mot de passe</label>
            </div>
            <button class="btn btn-secondary w-100 py-2 my-3" type="submit">S'inscrire</button>
        </form>
    </div>
  
  
</main>
</div>



<div class="my-5 py-5">

</div>


</body>
</html>