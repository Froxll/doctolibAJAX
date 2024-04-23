<?php
    function inscriptionpraticien(){
        $conn = dbConnect();

        if(isset($_POST['envoie'])){
            //vérif si tout les champs sont remplis
            if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['numero']) AND !empty($_POST['ville']) AND !empty($_POST['spe']) AND !empty($_POST['mail']) AND !empty($_POST['mdp'])){
                //Récupération des informations rentrées
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $numero = $_POST['numero'];
                $ville = $_POST['ville'];
                $spe = $_POST['spe'];
                $mail = $_POST['mail'];
                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                //vérif si la personne est déja enregistré
                $verifUser = $conn->prepare("SELECT nom,prenom FROM practicien WHERE mail = ?");
                $verifUser->execute(array($mail));
                if($verifUser->rowCount() > 0){
                  echo "Il éxiste déja un mail enregistré";
                }
                else{
                  //ajout dans la BDD
                  $insertUser = $conn->prepare("INSERT INTO practicien(mail,nom,prenom,telephone,ville,specialite,mdp)VALUES(?, ? ,? ,? ,?, ?, ?)");
                  $insertUser->execute(array($mail,$nom,$prenom,$numero,$ville,$spe,$mdp));
                  header('Location: ../../SeConnecter/seconnecter.php');
                }
            }
            else{
              echo "Veuillez completer tout les champs";
            }
          }
    }
?>