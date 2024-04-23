<?php
  session_start();

  //Redirection
  if(isset($_SESSION['mail']) || isset($_SESSION['mail_p'])) {
    header('Location: ../connexion.php');
  }

  include '../../functions.php';
  include 'functionseconnecter.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <title> Connexion </title>
        <link href="seconnecter.css" rel="stylesheet">
        <link href="../../header.css" rel="stylesheet">
    </head>
    <body>

        <header>

          <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="../../index.php">Accueil</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../../index.php">Mes RDV</a>
                  </li>
                  <li class="nav-item">

                    <a class="nav-link" href="../connexion.php">Connexion</a>

                  </li>
                </ul>
              </div>
            </div>
          </nav>

        </header>

        <main>
            <div id="formulaire">   
              <form method="post" align="center">
                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="inlineRadioOptions"
                    id="inlineRadio1"
                    value="option1"
                  />
                  <label class="form-check-label" for="inlineRadio1">Patient</label>
                </div>

                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="inlineRadioOptions"
                    id="inlineRadio2"
                    value="option2"
                  />
                  <label class="form-check-label" for="inlineRadio2">Praticien</label>
                </div>
                <br>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
                    <input name='mail' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete='off'>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input name='mdp' type="password" class="form-control" id="exampleInputPassword1" autocomplete='off'>
                </div>
                <button type="submit" class="btn btn-primary" name='envoie'>Se connecter</button>
                <div id="error">
                  <?php
                    seconnecter();
                  ?>
                  </div>
              </form>
            </div>
        </main>

        <footer>

        </footer>

    </body>
</html>