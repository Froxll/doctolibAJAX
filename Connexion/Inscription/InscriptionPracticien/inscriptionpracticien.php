<?php
  include '../../../functions.php';
  include 'functionpraticien.php';

  //Redirection
  if(isset($_SESSION['mail']) || isset($_SESSION['mail_p'])) {
    header('Location: http://localhost/Code/doctolib/Connexion/connexion.php');
  }

 ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <title> Inscription Practicien </title>
        <link href="../../../header.css" rel="stylesheet">
        <link href="../InscriptionPatient/inscriptionpatient.css" rel="stylesheet">
    </head>
    <body>

        <header>

            <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
                <div class="container-fluid">
                  <a class="navbar-brand" href="../../../index.php">Accueil</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../../index.php">Mes RDV</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="../../connexion.php">Se connecter</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>

        </header>

        <main>
          <div id="formulaire">
            <form class="row g-3" method="POST" align="center">
              <div class="col-md-6">
                <input name='prenom' type="text" class="form-control" id="inputEmail4"  placeholder="Prénom">
              </div>
              <div class="col-md-6">
                <input  name='nom' type="text" class="form-control" id="inputPassword4"  placeholder="Nom">
              </div>
              <div class="col-md-6">
                <input name='numero' type="text" class="form-control" id="inputEmail4"  placeholder="Numéro de téléphone">
              </div>
              <div class="col-md-6">
                <input name='ville' type="text" class="form-control" id="inputEmail4"  placeholder="Ville de pratique">
              </div>
              <div class="col-12">
                <input  name='spe' type="text" class="form-control" id="inputAddress" placeholder="Spécialitées">
              </div>
              <div class="col-md-6">
                <input name='mail' type="email" class="form-control" id="inputEmail4"  placeholder="Adresse mail">
              </div>
              <div class="col-md-6">
                <input name='mdp' type="password" class="form-control" id="inputPassword4"  placeholder="Mot de passe">
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary" name='envoie'>S'inscrire</button>
              </div>
            
            <div id="error">

              <?php
                inscriptionpraticien()
              ?>
            </form>
            </div>
          </div>
        </main>
    </body>

</html>