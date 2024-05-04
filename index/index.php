<?php
  session_start();
  include '../functions.php';

  /*$conn = dbConnect();
  $id_rdv = 11;
  $date = '26/05/2024';
  $mail_practicien = 'nathan@gadbin.com';
  // 9h/12h puis 14h/18h
  $plagesHoraires = array(
    array("debut" => 10, "fin" => 11),
    array("debut" => 14, "fin" => 18)
  );

  foreach ($plagesHoraires as $plage) {
    $debut = $plage["debut"];
    $fin = $plage["fin"];

    for ($heure = $debut; $heure < $fin; $heure++) {
        for ($minute = 0; $minute < 60; $minute += 30) {
            
            $heureFormattee = str_pad($heure, 2, "0", STR_PAD_LEFT);
            $minuteFormattee = str_pad($minute, 2, "0", STR_PAD_LEFT);

            
            $horaire = "$heureFormattee:$minuteFormattee";

            $res = $conn->query("INSERT INTO RDV values ('$id_rdv','$date','$horaire','$mail_practicien','nathan@gadbin.com')");
            $id_rdv+=1;

            
          }
        }
      }
*/

//$res = $conn->query("DELETE FROM RDV WHERE date = '09/01/2024'");

//$res = $conn->query("INSERT INTO RDV values ('4255','02/01/2024','16:30','natalie@gadbin.com','test@gmail.com')")


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="header.css" rel="stylesheet">

        <script src="../RDV/rdv.js"></script>
        <link href="index.css" rel="stylesheet">
        

        <script src="../affichage.js"></script>
        <script src="../Accueil/accueil.js"></script>
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
                  <?php
                    affichage_utilisateur_connecte();
                  ?> 
                  </div>
                  
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" onclick="afficherDiv('rdv'); getRDV()">Mes RDV</a>
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

            <div id="recherche">
              <input placeholder="Click here, then press and release a key." size="40" onkeyup="handleKeyUp(event)"/>

              <select name="specialite" id="specialite">
                <option value="pas_de_preference">Pas de préférence</option>
                <option value="Generaliste">Généraliste</option>
                <option value="Podologue">Podologue</option>
                <option value="Psychologue">Psychologue</option>
                <option value="Dermatologue">Dermatologue</option>
                
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
                <?php
                  // Vérifier si l'utilisateur est connecté
                  if(isset($_SESSION['mail']) || isset($_SESSION['mail_p'])) {
                      echo '<a href="#">Se connecter</a>
                            <a href="#">S\'inscrire</a>';
                  } else {
                       echo "<a href=\"../Connexion/SeConnecter/seconnecter.php\">Se connecter</a>
                             <a href=\"#\" onclick=\"afficherDiv('inscription')\">S'inscrire</a>";
                  }
                  ?>
                  <a href="../Connexion/Deconnexion/deconnexion.php" id="deconnexion">Se déconnecter</a>
          </div>

          <div id="inscription" class="invisible">
                <form method="POST" align="center">
                    <a class="type" href="../Connexion/Inscription/InscriptionPatient/inscriptionpatient.php">Patient</a>
                    <a class="type" href="../Connexion/Inscription/InscriptionPraticien/inscriptionpraticien.php">Praticien</a>
                </form>
          </div>

          <div id="formulaire" class="invisible"></div>

        </main>

    </body>

</html>