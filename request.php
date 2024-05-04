<?php
    include "database.php";
    include "/var/www/html/AJAX/Doctolib-AJAX/doctolibAJAX/doctolibAJAX/RDV/functionRdv.php";

    ini_set('display_errors',1);
    error_reporting(E_ALL);

    $con = dbConnect();
    //dbDeleteRDV($con, 19); supprime bien rdv, cette fonction fonctionne

    $request = substr($_SERVER['PATH_INFO'], 1); 
    $request = explode('/', $request); 
    $requestRessource = array_shift($request);

    if($requestRessource === 'medecin'){

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Récupération et filtrage des paramètres GET
            $nom = isset($_GET['nom']) ? ucfirst(strtolower($_GET['nom'])) : '';
            $specialite = isset($_GET['specialite']) ? $_GET['specialite'] : '';
        
            // Appel de la fonction dbRequestDoctor avec les paramètres filtrés
            $doctor = dbRequestDoctor($con, $nom, $specialite);
        
            // Vérification si la réponse est valide avant d'encoder en JSON
            if ($doctor === false) {
                // Gérer le cas où la requête a échoué
                echo json_encode(array('error' => 'Une erreur s\'est produite lors de la récupération des données.'));
            } else {
                // Encodage du résultat en JSON et envoi
                echo json_encode($doctor);
            }
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //
        }
        elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
            //
        }
        elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            //
        }

    }
    elseif($requestRessource === 'rdv'){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $rdv = dbRequestRDV($con);
            $rdv = json_decode($rdv);
            echo $rdv;
        }
    }

    if($requestRessource === 'rdv'){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_GET['email']) ){

                $email = $_GET['email']; 
                $rdv = dbRequestRDV($con, $email);
                $rdv = json_encode($rdv);
                echo $rdv;
            }
        }
        elseif($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            parse_str(file_get_contents("php://input"), $_DELETE);
            $id = $_DELETE['id'];
            $success = dbDeleteRDV($con, $id);
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
            exit;
        }
    }

?>