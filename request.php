<?php
    include "database.php";

    ini_set('display_errors',1);
    error_reporting(E_ALL);

    $con = dbConnect();

    $request = substr($_SERVER['PATH_INFO'], 1); 
    $request = explode('/', $request); 
    $requestRessource = array_shift($request);

    if($requestRessource === 'medecin'){

        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_GET['nom']) ){

                $nom = ucfirst(strtolower($_GET['nom'])); 
                $doctor = dbRequestDoctor($con, $nom);
                $doctor = json_encode($doctor);
                echo $doctor;
            }
            else{
                $doctor = dbRequestDoctor($con);
                $doctor = json_encode($doctor);
                echo $doctor;
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

?>