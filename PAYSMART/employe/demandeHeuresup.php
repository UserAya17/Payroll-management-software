<?php
include "menuEmploye.php";
include 'connect.php';
$mt = $_SESSION['matricule'];
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    if(isset($_POST['demander']))
    {
        $sql = "SELECT * FROM utilisateur WHERE login= '$mt'";
        $res = $bd->query($sql);
        $r = $res->fetch(PDO::FETCH_ASSOC);
        $matricule = $r['matricule'];
        if(isset($_POST['datejour']) && isset($_POST['nbrHeures']))
        {
          
            // Vérifier si la case est cochée
            $jourFerier = isset($_POST['jourFerier']) ? 1 : 0;
 
            
            //recuperer les donnees 
            $datejour=$_POST['datejour'];
            $nbreHeures=$_POST['nbrHeures'];
            //la requette d'insertion
            $req="INSERT INTO heuresup (nombreHeures,dateJour,valider,dateDemandeHS,jourFerier,idUser) VALUES ('$nbreHeures','$datejour','en_cours',NOW(),'$jourFerier','$mt')";
            //execution de la requette
            $res = $bd->query( $req);
            if ($res) 
            {
              $req2 = "INSERT INTO notification(etat,envoyeur,type,recepteur) VALUES ('0','$mt','heure sup','Q0979')";
                $res2 = $bd->query( $req2);
                if($res2)
                {
                  //header("location:consultHeureSup.php");
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
      Demander heure sup
    </div>
    <div class="form">

    <div class="inputfield">
          <label>Date</label>
          <input name="datejour" type="datetime-local" id="input-first-name" class="input"  required >
       </div> 
       <div class="inputfield">
          <label>Nombre d'heures</label>
          <input name="nbrHeures" type="number" id="input-username"  class="input" required >
       </div> 
       <div class="inputfield terms">
       <table>
        <tr>
        <td>
        <label class="check">
            <input name="jourFerier" type="checkbox" id="input-first-name" value="0"  >
            <span class="checkmark"></span>
          </label>
        </td>
        <td> <br> <p>Jour ferier</p></td>
        </tr>
       </table>
         
        
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