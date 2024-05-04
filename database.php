<?php

  require_once('constants.php');

  function dbConnect()
  {
    try
    {
      $db = new PDO('pgsql:host='.DB_SERVER.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    catch (PDOException $exception)
    {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    return $db;
  }


  
  function dbRequestDoctor($db, $nom = '', $specialite = ''){
    try {
        $request = 'SELECT * FROM practicien';
        $parameters = array();

        if ($nom != '') {
            $request .= ' WHERE nom LIKE :nom';
            $nom .= '%';
            $parameters[':nom'] = $nom;
        }

        if ($specialite != '') {
            if ($nom != '') {
                $request .= ' AND';
            } else {
                $request .= ' WHERE';
            }
            $request .= ' specialite LIKE :specialite';
            $specialite .= '%';
            $parameters[':specialite'] = $specialite;
        }

        $statement = $db->prepare($request);
        $statement->execute($parameters);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Request error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

  function dbRequestRDV($db, $email){
    try {
      // Requête SQL pour récupérer les rendez-vous du praticien avec l'email spécifié
      $request = 'SELECT * FROM RDV WHERE mail_1 = :email';

      $statement = $db->prepare($request);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
      error_log('Request error: ' . $exception->getMessage());
      return false;
    }
  return $result;
  }

  function dbDeleteRDV($db, $id){   //Pas besoin de l'email du médecin car l'id rdv est unique
    try
    {
      $request = 'DELETE FROM rdv WHERE id=:id';
      $statement = $db->prepare($request);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return true;
  }

?>