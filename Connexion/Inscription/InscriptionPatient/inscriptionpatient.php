<?php
  session_start();

  //Redirection
  if(isset($_SESSION['mail']) || isset($_SESSION['mail_p'])) {
    header('Location: http://localhost/Code/doctolib/Connexion/connexion.php');
  }

  include '../../../functions.php';
  include 'functionpatient.php';
 ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link href="../../../index/header.css" rel="stylesheet">
        <link href="inscriptionpatient.css" rel="stylesheet">
        <script src="../../../affichage.js"></script>
        <title> Inscription Practicien </title>
    </head>

    <body>

        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#" onclick="afficherDiv('accueil')">Accueil</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="ID">
                  </div>

                  <?php
                    affichage_utilisateur_connecte();
                  ?> 
                  
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" onclick="afficherDiv('rdv')">Mes RDV</a>
                      </li>
                      <li class="nav-item">
                        <a id="boutonConnexion" class="nav-link" href="#" onclick="afficherDiv('connexion')">Connexion</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        </header>

        <main>
          <div id="formulaire" class="visible">
            <form class="row g-3" method="POST" align="center">
              <div class="col-md-6">
                <input name='prenom' type="text" class="form-control" id="inputEmail4"  placeholder="Prénom">
              </div>
              <div class="col-md-6">
                <input  name='nom' type="text" class="form-control" id="inputPassword4"  placeholder="Nom">
              </div>
              <div class="col-12">
                <input  name='numero' type="text" class="form-control" id="inputAddress" placeholder="Numéro de téléphone">
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
                inscriptionpatient();
              ?>
              </div>
            </form>
          </div>

          <div id="accueil" class="invisible">


          <div id="recherche">
            <input placeholder="Click here, then press and release a key." size="40" onkeyup="handleKeyUp(event)"/>

            <select name="specialite" id="specialite">
              <option value="pas_de_preference">Pas de préférence</option>
              <option value="generaliste">Généraliste</option>
              <option value="podologue">Podologue</option>
              <option value="psychologue">Psychologue</option>
              <option value="dermatologue">Dermatologue</option>
              
            </select>

            <p id="log"></p>

          </div>

          <div id="medecins"></div>

          </div>

          <div id="rdv" class="invisible">
              <h2>Contenu de la page Mes RDV...</h2>
          </div>

          <div id="connexion" class="invisible">
                <form method="POST" align="center">
                    <a href="../../SeConnecter/seconnecter.php">Se connecter</a>
                    <a href="#" onclick="afficherDiv('inscription')">S'inscrire</a>
                    <a href="../Connexion/Deconnexion/deconnexion.php" id="deconnexion">Se déconnecter</a>
          </div>

          <div id="inscription" class="invisible">
                <form method="POST" align="center">
                    <a class="type" href="inscriptionpatient.php">Patient</a>
                    <a class="type" href="../InscriptionPraticien/inscriptionpraticien.php">Praticien</a>
                </form>
          </div>

        </main>

        <footer>
        </footer>
    </body>
</html>