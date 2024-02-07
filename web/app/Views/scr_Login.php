<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <?= view('header') ?>
  <main>
      <div class="container h-100 mt-3 mb-5">
        <div class="row h-100 pb-3">
          <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
              <div class="text-center mt-4">
                <h1 class="h2">Connexion</h1>
                <p class="lead">
                  Vous pouvez vous connecter via cette page.
                </p>
              </div>
              <form action="<?= site_url('login/seConnecter') ?>" method="post">
                <div class="card">
                  <div class="card-body">
                    <div class="m-sm-4">
              <form>
              <div class="form-group">
              <label>Email</label>
              <input class="form-control form-control-lg shadow-none" type="email" name="email" placeholder="Entrez votre email">
              </div>
              <div class="form-group">
              <label>Mot de passe</label>
              <input class="form-control form-control-lg shadow-none" type="password" name="mdp" placeholder="Entrez votre mot de passe">
              </div>
              <div class="form-group pt-2">
              <input class="form-check-input shadow-none" type="checkbox" name="checkbox" value="remember-me" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
              Rester connecté
              </label>
              </div>
              <div class="text-center mt-3">
              <button type="submit" class="btn btn-lg btn-primary">Se connecter</button>
              <p class="text-secondary" id="mdpOubli">Mot de passe oublié ? Cliquez-ici</p>
              </div>
              </form>
              </div>
              </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  <?= view('footer') ?>
  </body>
</html>