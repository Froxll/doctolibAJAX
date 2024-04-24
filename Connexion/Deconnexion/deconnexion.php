<?php
    session_start();

    if (isset($_SESSION['mail']) || isset($_SESSION['mail_p'])) {
        // Détruire toutes les données de session
        $_SESSION = array();
        session_destroy();
        header('Location: ../../index/index.php');
    } 
    else 
    {
        // Rediriger vers la page d'accueil si l'utilisateur n'est pas connecté
        header('Location: ../SeConnecter/seconnecter.php');
    }
?>