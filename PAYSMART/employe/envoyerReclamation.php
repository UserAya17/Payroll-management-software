<?php
	require_once ('connect.php');
	include "menuEmploye.php";
    $test = $_SESSION['login'];
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    if(isset($_POST['demander']))
    {
        $sql = "SELECT * FROM utilisateur WHERE login= '$test'";
        $res = $bd->query($sql);
        $r = $res->fetch(PDO::FETCH_ASSOC);
        $matricule = $r['matricule'];
        if(isset($_POST['nom_de_la_zone_de_texte']) && isset($_POST['reclamation']))
        {
            //recuperer les donnees 
            $type=$_POST['reclamation'];
            $recep=$_POST['choix'];
            $reclamation=$_POST['nom_de_la_zone_de_texte'];
            //la requette d'insertion            
            $req="INSERT INTO reclamation (typeReclamation,valider,idUser,reclamation,dateReclamation) VALUES ('$type','$recep','$matricule','$reclamation',NOW())";
            //execution de la requette
            $res = $bd->query($req);
           if ($res) 
            {
                if( $recep=='encours rp')
                $req2 = "INSERT INTO notification(etat,envoyeur,type,recepteur) VALUES ('0','$matricule','reclamation','A1234')";
                else 
                $req2 = "INSERT INTO notification(etat,envoyeur,type,recepteur) VALUES ('0','$matricule','reclamation','Q0979')";
                $res2 = $bd->query( $req2);
                if($res2)
                {
                   // echo '<script>window.location.href = "consulterReclamation.php";</script>';
                }
                else  $erreur = "erreur d'insertion de la notification";
              
            }
            else
            {
                $erreur = "erreur d'insertion a la base";
            }
        }
        else 
        {
            echo "Vous devez remplir tous les champs.";
        }
    }
}
 ?>




  
<br><br><br><br><br><br><br><br><br><br>

<form action="" method="post">
<div class="wrapper">
    <div class="title">
      Ajouter Reclamation
    </div>
    <div class="form">
        <div class="inputfield">
          <label>Type</label>
          <div class="custom_select">
          <select name="reclamation">
                  <option value="" disabled selected hidden>Sélectionnez type de réclamation</option>
                  <option value="absence">Absence</option>
                  <option value="bulletin">Bulletin</option>
                  <option value="conge">Congé</option>
                  <option value="heurs_sup">Heures supplémentaires</option>
                  <option value="prime">Prime</option>
                  <option value="autre">Autre</option>
                </select>
          </div>
       </div> 
  
      <div class="inputfield">
          <label>Commentaire</label>
          <textarea name="nom_de_la_zone_de_texte" class="textarea"></textarea>
       </div> 
    
      
    <input type="radio" name="choix" value="en_cours" checked> RH &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
    <input type="radio" name="choix" value="encours rp"> RP
    <br> <br>  
      <div class="inputfield">

        <button class="btn" type="submit" name="demander">Demander</button>&nbsp &nbsp &nbsp &nbsp
              <button class="btn" type="reset" form="schedule-form"><i class="fa fa-reset"></i>Annuler</button>
      </div>
    </div>
</div>	
</form>


</body>
</html>