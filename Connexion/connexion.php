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
        <title> Connexion </title>
        <link href="../header.css" rel="stylesheet">
        <link href="connexion.css" rel="stylesheet">
    </head>
    <body>

        <header>

            <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
                <div class="container-fluid">
                  <a class="navbar-brand" href="../index.php">Accueil</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="ID">
                  <?php
                    affichage_utilisateur_connecte();
                  ?>
                  </div>
                  
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Mes RDV</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>

        </header>

        <main>
            <div id="connexion">
                <form method="POST" align="center">
                    <a href="SeConnecter/seconnecter.php">Se connecter</a>
                    <a href="Inscription/inscription.php">S'inscrire</a>
                    <a href="Deconnexion/deconnexion.php" id="deconnexion">Se déconnecter</a>
                </form>
            </div>
        </main>

        <footer>
        </footer>
    </body>
</html>