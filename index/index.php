<?php
  session_start();
  include '../functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="header.css" rel="stylesheet">
        <script src="../affichage.js"></script>
        <title> Accueil </title>
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

          <div id="accueil" class="visible">
            <h2>Contenu de la page Accueil...</h2>

            <input placeholder="Click here, then press and release a key." size="40" onkeyup="handleKeyUp(event)"/>
            <p id="log"></p>

            <div id="medecins"></div>

          </div>

          <div id="rdv" class="invisible">
              <h2>Contenu de la page Mes RDV...</h2>
          </div>

          <div id="connexion" class="invisible">
                <form method="POST" align="center">
                    <a href="../Connexion/SeConnecter/seconnecter.php">Se connecter</a>
                    <a href="#" onclick="afficherDiv('inscription')">S'inscrire</a>
                    <a href="../Connexion/Deconnexion/deconnexion.php" id="deconnexion">Se déconnecter</a>
          </div>

          <div id="inscription" class="invisible">
                <form method="POST" align="center">
                    <a class="type" href="../Connexion/Inscription/InscriptionPatient/inscriptionpatient.php">Patient</a>
                    <a class="type" href="../Connexion/Inscription/InscriptionPraticien/inscriptionpraticien.php">Praticien</a>
                </form>
          </div>

        </main>

    </body>

</html>