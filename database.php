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


  
  function dbRequestDoctor($db, $nom = '')
  {
    try {
      $request = 'SELECT * FROM practicien';
      if ($nom != '') {
          $request .= ' WHERE nom LIKE :nom';
          $nom .= '%';
      }
      $statement = $db->prepare($request);
      if ($nom != '') {
          $statement->bindParam(':nom', $nom, PDO::PARAM_STR, 20);
      }
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $exception) {
      error_log('Request error: ' . $exception->getMessage());
      return false;
  }
  return $result;
  }

?>