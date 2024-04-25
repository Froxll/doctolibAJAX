<?php
date_default_timezone_set('Europe/London');

  function dbRequestRDV($db){
    if(isset($_SESSION['mail'])){
      $userMail = $_SESSION['mail'];
      try {
        $request = "SELECT horaire,date,mail_1,id FROM RDV WHERE mail_2 LIKE '$userMail'";
        $statement = $db->prepare($request);
        $statement->execute();
        $result = $statement ->fetchALL(PDO::FETCH_ASSOC);
      } catch(PDOException $exception){
        error_log('Request error: ' . $exception->getMessage());
        return false;
      } 
    }
    else{
      $userMail = $_SESSION['mail_p'];
      try {
        $request = "SELECT horaire,date,mail_2,id FROM RDV WHERE mail_1 LIKE '$userMail'";
        $statement = $db->prepare($request);
        $statement->execute();
        $result = $statement ->fetchALL(PDO::FETCH_ASSOC);
      } catch(PDOException $exception){
        error_log('Request error: ' . $exception->getMessage());
        return false;
      } 
    }
    return $result;
  }

    function annulerdv(){
        if(isset($_POST["annulerRDV"])){
            $selectedID = $_POST["submitID"];
        
            $conn = dbConnect();
            
            $res = $conn->query("DELETE FROM RDV WHERE id = '$selectedID'");
        
          }
    }

    function affichagerdv_encours(){
        $conn = dbConnect();

                $userMail = $_SESSION['mail'];

                $showRDV = $conn->prepare("SELECT horaire,date,mail_1,id FROM RDV WHERE mail_2 LIKE '$userMail'");
              
                $showRDV->setFetchMode(PDO::FETCH_ASSOC); 
                $showRDV->execute();
                
                //récuperer ici les rdv du patient connecté puis les afficher
                $patientRdvInfo = $showRDV->fetchAll();

                date_default_timezone_set('Europe/Paris');
                $today = new DateTime();
                $todayDateFormat = $today->format('d/m/Y');
                $todayHoraireFormat = $today->format('H:i');


                $j=0;
                for($i=0; $i<count($patientRdvInfo); $i++){
                  if(strtotime($patientRdvInfo[$i]['date']) > strtotime($todayDateFormat) || strtotime($patientRdvInfo[$i]['date'])==0){
                    $j+=1;
                      echo "<h5>Rendez vous n°".$j." :</h5> Le ".$patientRdvInfo[$i]['date']." à ".$patientRdvInfo[$i]['horaire']." avec le docteur présentant l'adresse mail suivante : ".$patientRdvInfo[$i]['mail_1'].'<br>';
                      ?>
                        <form method='post'>
                          <input type='submit' value="Annuler rendez-vous" name='annulerRDV'></input>
                          <input type="hidden" value='<?= $patientRdvInfo[$i]['id'] ?>' name="submitID">
                        </form>
                      <?php
                  }
                  elseif (strtotime($patientRdvInfo[$i]['date']) == strtotime($todayDateFormat) && $patientRdvInfo[$i]['horaire'] > $todayHoraireFormat) {
                    $j+=1;
                      echo "<h5>Rendez vous n°".$j." :</h5> Le ".$patientRdvInfo[$i]['date']." à ".$patientRdvInfo[$i]['horaire']." avec le docteur présentant l'adresse mail suivante : ".$patientRdvInfo[$i]['mail_1'].'<br>';
                      ?>
                        <form method='post'>
                          <input type='submit' value="Annuler rendez-vous" name='annulerRDV'></input>
                          <input type="hidden" value='<?= $patientRdvInfo[$i]['id'] ?>' name="submitID">
                        </form>
                      <?php
                  }{
                    $j = $j;
                  }
                }
    }

    function affichagerdv_passés(){
        $conn = dbConnect();

                $userMail = $_SESSION['mail'];

                $showRDV = $conn->prepare("SELECT horaire,date,mail_1,id FROM RDV WHERE mail_2 LIKE '$userMail'");
              
                $showRDV->setFetchMode(PDO::FETCH_ASSOC); 
                $showRDV->execute();
                
                //récuperer ici les rdv du patient connecté puis les afficher
                $patientRdvInfo = $showRDV->fetchAll();

                date_default_timezone_set('Europe/Paris');
                $today = new DateTime();
                $todayDateFormat = $today->format('d/m/Y');
                $todayHoraireFormat = $today->format('H:i');


                $j=0;
                for($i=0; $i<count($patientRdvInfo); $i++){
                  if(strtotime($patientRdvInfo[$i]['date']) < strtotime($todayDateFormat) && strtotime($patientRdvInfo[$i]['date']) != 0){
                    $j+=1;
                      echo "<h5>Rendez vous n°".$j." :</h5> Le ".$patientRdvInfo[$i]['date']." à ".$patientRdvInfo[$i]['horaire']." avec le docteur présentant l'adresse mail suivante : ".$patientRdvInfo[$i]['mail_1'].'<br>';
                      ?>
                        <form method='post'>
                          <input type='submit' value="Reprendre un rendez-vous" name='reprendreRDV'></input>
                          <input type="hidden" value='<?= $patientRdvInfo[$i]['mail_1'] ?>' name="submitMail_1">
                        </form>
                      <?php
                      reprendreRDV();
                  }
                  elseif(strtotime($patientRdvInfo[$i]['date']) == strtotime($todayDateFormat) && $patientRdvInfo[$i]['horaire'] < $todayHoraireFormat) {
                    $j+=1;
                      echo "<h5>Rendez vous n°".$j." :</h5> Le ".$patientRdvInfo[$i]['date']." à ".$patientRdvInfo[$i]['horaire']." avec le docteur présentant l'adresse mail suivante : ".$patientRdvInfo[$i]['mail_1'].'<br>';
                      ?>
                        <form method='post'>
                          <input type='submit' value="Reprendre un rendez-vous" name='reprendreRDV'></input>
                          <input type="hidden" value='<?= $patientRdvInfo[$i]['mail_1'] ?>' name="submitMail_1">
                        </form>
                      <?php
                      reprendreRDV();
                  }
                  else{
                    $j=$j;
                  }
                }
    }

    function reprendreRDV(){
      if(isset($_POST["reprendreRDV"])){
        
        $selectedEmail = $_POST["submitMail_1"];
    
        $conn = dbConnect();
        
        $res = $conn->query("SELECT nom, prenom, telephone, specialite FROM PRACTICIEN WHERE mail = '$selectedEmail'");

        $arrayHoraireFixe = array('09:00','09:30','10:00','10:30','11:00','11:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30');

        $info = json_encode(ajoutRdvInfo($selectedEmail));

        $horairesArray = json_decode($info, true);
        $today = new DateTime();

        $present = true;                    //true si l'horaire affichée est présente dans la bdd (hoarire prise) RDV false sinon (disponible)

        $tabArray = array();
        $MAX = count($horairesArray)-1;
        
        if(count($horairesArray) != 0){
          
          for($i=0; $i<7; $i++){

            if($i*14 < $MAX){
              $varIndexDate = $i*14;
            }
            else{
              $varIndexDate = $MAX;
            }
            array_push($tabArray, $horairesArray[$varIndexDate]['date']);
            $tabArray = array_unique($tabArray);
            //$tabArray contient les dates à laquelle des rendez-vous sont pris (seulement la date du jour)
            
            ?>

            <div id="globalHoraire">

            <?php
            
            
            $todayGoodFormat = $today->format('d/m/Y');
            echo $todayGoodFormat;

            for($j=0; $j<14; $j++){

              $horaireActuel = $arrayHoraireFixe[$j];
              $present = false;

              // Format de la date et de l'heure actuelles
              $dateHeureActuelles = $today->format('d/m/Y') . ' ' . $horaireActuel;

              // Vérifier si la date et l'heure actuelles sont prises
              foreach ($horairesArray as $rdv) {
                  if ($rdv['date'] == $today->format('d/m/Y') && $rdv['horaire'] == $horaireActuel) {
                      $present = true;
                      break;
                  }
              }



              if($present == true){
                ?>
                  <form method='post'>
                    <input type='submit' value='<?= $arrayHoraireFixe[$j] ?>' name='submitHoraire' id='CSSHorairePrise'></input>
                    <input type="hidden" value='<?= $todayGoodFormat ?>' name="submitDate" >
                    <input type="hidden" value='<?=  $selectedEmail ?>' name="submitMail" >
                  </form>
                <?php
                
              }
              else{
                ?>
                  <form method='post'>
                    <input type='submit' value='<?= $arrayHoraireFixe[$j] ?>' name='submitHoraire' id='CSSHoraireLibre'></input>
                    <input type="hidden" value='<?= $todayGoodFormat ?>' name="submitDate">
                    <input type="hidden" value='<?=  $selectedEmail ?>' name="submitMail" >
                  </form>
                <?php
                
              }

            }

            $today->add(new DateInterval('P1D'));
            

            ?>

            </div>

          <?php

          echo '<br>';

          }
        }
      }
    }

    
      if(isset($_POST["submitHoraire"])){

          $conn = dbconnect();

          $res = $conn->query("SELECT MAX(id) FROM RDV");
          $res->setFetchMode(PDO::FETCH_ASSOC); 
          $res->execute();

          $maxID = 1;

          if ($res) {
            $maxID = $res->fetchColumn() + 1;
          }

          $selectedHour = $_POST["submitHoraire"];
          $selectedMail = $_POST["submitMail"];
          $selectedDate = $_POST["submitDate"];
          $userMail = $_SESSION['mail'];

          $res = $conn->query("INSERT INTO RDV values ('$maxID','$selectedDate','$selectedHour','$selectedMail','$userMail')");

          echo '<script>alert(\'Votre rendez vous à bien été pris.\');</script>';
        
      }
    

    function ajoutRdvInfo($SearchMailPracticien){

      $conn = dbConnect();
    
      $BDDRDV = $conn->prepare("SELECT horaire,date FROM RDV WHERE mail_1 LIKE :SearchMailPracticien");
    
      $BDDRDV->bindParam(':SearchMailPracticien', $SearchMailPracticien, PDO::PARAM_STR);
      $BDDRDV->setFetchMode(PDO::FETCH_ASSOC); 
      $BDDRDV->execute();
    
      $PracticienRdvInfo = $BDDRDV->fetchAll();
    
      return $PracticienRdvInfo;
    }
  
?>