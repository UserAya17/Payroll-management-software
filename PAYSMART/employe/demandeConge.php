<?php
include 'menuEmploye.php';
include 'connect.php';
$test = $_SESSION['login'];
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    if(isset($_POST['demander']))
    {
        $sql = "SELECT * FROM utilisateur WHERE login= '$test'";
        $res = $bd->query($sql);
        $r = $res->fetch(PDO::FETCH_ASSOC);
        $matricule = $r['matricule'];
        if(isset($_POST['datedebut']) &&  isset($_POST['datefin']) && 
            isset($_POST['typec']))
        {
            //recuperer les donnees 
            $datedebut=$_POST['datedebut'];
           // $duree=$_POST['duree'];
            $datefin=$_POST['datefin'];

// Create DateTime objects for the start and end dates
$start = new DateTime($datedebut);
$end = new DateTime($datefin);

// Calculate the difference between the dates
$interval = $start->diff($end);

// Get the difference in days
$duree = $interval->days;


            $typeConge=$_POST['typec'];
            //la requette d'insertion
            $req="INSERT INTO conge (start_datetime,dureeConge,type,valide,dateDemande,end_datetime,idUser) VALUES ('$datedebut','$duree','$typeConge','en_cours',NOW(),'$datefin','$matricule')";
            //execution de la requette
            $res = $bd->query( $req);
            if ($res) 
            {
                $req2 = "INSERT INTO notification(etat,envoyeur,type,recepteur) VALUES ('0','$matricule','demande de conge','Q0979')";
                $res2 = $bd->query( $req2);
                if($res2)
                {
                  //header("location:consultConge.php");
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


<style>
  .nav_trsp ul li{
    font-size: 17px; 
  }
</style>
<body>

<br><br><br><br><br><br><br><br><br><br>


      <form action="" method="post">
<div class="wrapper">
    <div class="title">
      Demander conge
    </div>
    <div class="form">

    <div class="inputfield">
          <label>Date debut</label>
          <input name="datedebut" type="datetime-local" id="input-first-name" class="input"  required >
       
       </div> 
       <div class="inputfield">
          <label>Type</label>
          <div class="custom_select">
          <select name="typec" id="input-username" >
                        <option value="">--Selectionnez--</option>
                        <option value="1">Paye</option>
                        <option value="0">Non Paye</option>
                        </select>
          </div>
       </div> 

       <div class="inputfield">
          <label>Date Fin</label>
          <input name="datefin" type="datetime-local" id="input-first-name"  class="input"  required >
       </div> 
      <div class="inputfield">

        <button class="btn" type="submit" name="demander">Demander</button>&nbsp &nbsp &nbsp &nbsp
              <button class="btn" type="reset" form="schedule-form"><i class="fa fa-reset"></i>Annuler</button>
      </div>
    </div>
</div>	
</form>



<script>
  flatpickr("#date", {
    dateFormat: "d/m/Y",
    locale: "fr"
  });
</script>
    </div>
    
  </footer>
 
<script>
  flatpickr("#date", {
    dateFormat: "d/m/Y",
    locale: "fr"
  });
</script>
    </div>
    
  </footer>
  </form>
</body>