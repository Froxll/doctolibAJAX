<?php
    include "constants.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function dbConnect(){
        $dsn = 'pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT;
        try{
            $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
        } catch(PDOException $e) {
            echo 'Connexion échouée : '. $e->getMessage();
            return;
        }
        return $conn;
    }

    function affichage_utilisateur_connecte(){
        if(isset($_SESSION['mail'])){
            echo strtoupper($_SESSION['prenom']).' '.strtoupper($_SESSION['nom']).' '.'<img src="../bulle.png">';
          }
          if(isset($_SESSION['mail_p'])){
            echo strtoupper($_SESSION['prenom']).' '.strtoupper($_SESSION['nom']).' '.'<img id="med" src="../med.png">';
          }
    }
    
?>
