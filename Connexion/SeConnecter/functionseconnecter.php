<?php
    function seconnecter(){
        $conn = dbConnect();

        if(isset($_POST['envoie'])){
            // Vérifications que tous les champs soient remplis
            if(!empty($_POST['inlineRadioOptions']) AND !empty($_POST['mail']) AND !empty($_POST['mdp'])){
              // Récupération des valeurs des champs

              if($_POST['inlineRadioOptions'] == "option1"){
                $type = $_POST['inlineRadioOptions'];
                $mail = $_POST['mail'];
                $mdp_post = $_POST['mdp'];

                // Préparation de la requête 
                $recupUser = $conn->prepare("SELECT nom, prenom, mdp FROM patient WHERE mail = ?");
                $recupUser->execute(array($mail));

                // Vérifier si l'utilisateur existe
                if($recupUser->rowCount() > 0){
                  // Récupérer les données dans la BDD
                  $userData = $recupUser->fetch(PDO::FETCH_ASSOC);

                  // Vérifier le mot de passe
                  if(password_verify($mdp_post, $userData['mdp'])){
                    // Mot de passe correct, définir les variables de session
                    $_SESSION['nom'] = $userData['nom'];
                    $_SESSION['prenom'] = $userData['prenom'];
                    $_SESSION['mail'] = $mail;

                    // Rediriger vers la page d'accueil
                    header('Location: ../../Accueil/accueil.php');
                  } else {
                    echo "Votre mot de passe est incorrect";
                  }

                } else {
                  echo "Adresse e-mail incorrecte";
                }
              }
              elseif($_POST['inlineRadioOptions'] == "option2"){
                  //récupération des données
                  $type = $_POST['inlineRadioOptions'];
                  $mail = $_POST['mail'];
                  $mdp_post = $_POST['mdp'];

                  // Préparation de la requête 
                  $recupUser = $conn->prepare("SELECT nom, prenom, mdp FROM practicien WHERE mail = ?");
                  $recupUser->execute(array($mail));

                  // Vérifier si l'utilisateur existe
                  if($recupUser->rowCount() > 0){
                    // Récupérer les données dans la BDD
                    $userData = $recupUser->fetch(PDO::FETCH_ASSOC);

                    // Vérifier le mot de passe
                    if(password_verify($mdp_post, $userData['mdp'])){
                      // Mot de passe correct, définir les variables de session
                      $_SESSION['nom'] = $userData['nom'];
                      $_SESSION['prenom'] = $userData['prenom'];
                      $_SESSION['mail_p'] = $mail;

                      // Rediriger vers la page d'accueil
                      header('Location: ../../Accueil/accueil.php');
                    } else {
                      echo "Votre mot de passe est incorrect";
                    }
                  } else {
                    echo "Adresse e-mail incorrecte";
                  }
              }
            } else {
              echo "Veuillez compléter tous les champs";
            }
          }
    }
?>