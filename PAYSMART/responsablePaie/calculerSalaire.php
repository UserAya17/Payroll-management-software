
<script>
  event.preventDefault();
  </script>
<?php
//require_once("session.php");
require('connect.php');
include 'menuRp.php';


$conn2 = mysqli_connect("localhost","root","","paysmart");
$nombres = array("+", "-", "*", "/","%",")","(","[","]",">","=","<");
$condALL="";
$nbEnfant=0;
$duree=0;
$CONGE=0;
$HS=0;
$ABSENCE=0;
$ALLOCATION=0;
$HS=0;
$CONGE=0;
$ABSENCE=0;
$CNSS=0;
$AMO=0;
$IGR=0;
$CIMR=0;
$SALAIRENET=0;
$heureTravail=0;
$SALAIREDEBASE=0;
$SBI=0;
$SNI=0;
$SBG=0;
$Valeur=0;
$Taux=0;
$SALAIREHORAIRE=0;

function evaluerFormule($formule) {
  $formule = trim($formule); // Supprimer les espaces en début et en fin de chaîne
  // Évaluer la formule en utilisant eval()
  eval("\$affect = $formule;");

  return $affect;
}

	//$matricule = $_GET['matricule'];
	//$filiale = $_GET['filiale'];
 
  //$matricule =
  $_SESSION['mat1']="jdf";
  $matricule =$_SESSION['mat'];

	$idfiliale = 1;
  $mois=$_POST['m'];
  $annee=$_POST['a'];

  $_SESSION['date1']=$mois."/".$annee;
//$sql = "SELECT * FROM votre_table WHERE MONTH(votre_colonne_date) = $mois";

$selSql1 = "SELECT * FROM `contrat` WHERE idUser= '$matricule' && idFiliale = '$idfiliale' ";
$res1 = $bd->query($selSql1);
$salaire= $res1->fetch(PDO::FETCH_ASSOC);

$idfiliale = $salaire['idFiliale'];

	$selSql = "SELECT * FROM `utilisateur` WHERE matricule= '$matricule'";
	$res = $bd->query($selSql);
	$user = $res->fetch(PDO::FETCH_ASSOC);

	$query = "SELECT * FROM `CONGE` WHERE idUser= '$matricule' && MONTH(dateDemande)=$mois && YEAR(dateDemande)=$annee";
$query_run = mysqli_query($conn2, $query);
$CONGE=0;
if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
          $CONGE+=$r['dureeCONGE'];
        }
      }
    }


  $query = "SELECT * FROM heuresup WHERE idUser= '$matricule' && MONTH(dateDemandeHS)=$mois && YEAR(dateDemandeHS)=$annee";
$query_run = mysqli_query($conn2, $query);
$HS=0;
if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
          $HS+=$r['nombreHeures'];
        }
      }
    }

    $query = "SELECT * FROM `ABSENCE` WHERE idUser= '$idfiliale' && MONTH(dateJour)=$mois && YEAR(dateJour)=$annee";
  $query_run = mysqli_query($conn2, $query);
  $ABSENCE=0;
  if ($query_run) {
      $num_rows = mysqli_num_rows($query_run);
      if ($num_rows > 0) {
          while ($r = mysqli_fetch_assoc($query_run)) {
            $ABSENCE+=$r['dureeABSENCE'];
          }
        }
      }

	$sql1= "SELECT * from filiale WHERE idFiliale = '$idfiliale' ";
	$i = $bd->query($sql1);
	$filiale = $i->fetch(PDO::FETCH_ASSOC);
  $heureTravail=$filiale['heureTravail'];


	$selSql9 = "SELECT * FROM `prime` WHERE idUser= '$matricule' && MONTH(date)=$mois && YEAR(date)=$annee ";
	$res9 = $bd->query($selSql9);
	$prime= $res9->fetch(PDO::FETCH_ASSOC);


    $conn2 = mysqli_connect("localhost","root","","paysmart");
    $query = "SELECT * FROM affectation WHERE idFiliale=1";
$query_run = mysqli_query($conn2, $query);

if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
          $id= $r['idRegle'];
 
          $query1 = "SELECT * FROM condition_regle WHERE idRegle=$id";
          $query_run1 = mysqli_query($conn2, $query1);
          
          if ($query_run1) {
              $num_rows1 = mysqli_num_rows($query_run1);
              if ($num_rows1 > 0) {
                $verifie=1;
                 
                  while ($r1 = mysqli_fetch_assoc($query_run1)) {
                   $cond=$r1['condition_R'];

                   $aff=$r1['affectation'];

                   $formu = trim($cond); 
                   // Séparer la chaîne en utilisant l'espace comme séparateur
                   $resultat1 = explode(' ', $formu);

                   $formu2 = trim($aff); 
                   // Séparer la chaîne en utilisant l'espace comme séparateur
                   $aff = explode(' ', $formu2);
                   if (!is_numeric($resultat1[0]) && !in_array($resultat1[0], $nombres)) 
    {
      echo $resultat1[0];
        switch ($resultat1[0])

        {
         
            case 'nbEnfant':   $resultat1 = str_replace('nbEnfant', $nbEnfant, $resultat1); break;
            case 'duree':  $resultat1 = str_replace('duree', $duree, $resultat1); break;
            case 'dureeCONGE':   $resultat1 = str_replace('dureeCONGE', $CONGE, $resultat1); break;
            case 'nombreHeures':  $resultat1 = str_replace('nombreHeures', $HS, $resultat1); break;
            case 'dureeABSENCE':   $resultat1 = str_replace('dureeABSENCE', $ABSENCE, $resultat1); break;
            case 'ALLOCATION':   $resultat1 = str_replace('ALLOCATION', $ALLOCATION, $resultat1); break;
            case 'HS':   $resultat1 = str_replace('HS', $HS, $resultat1); break;
            case 'CONGE':   $resultat1 = str_replace('CONGE', $CONGE, $resultat1); break;
            case 'ABSENCE':   $resultat1 = str_replace('ABSENCE', $ABSENCE, $resultat1); break;
            case 'CNSS':   $resultat1 = str_replace('CNSS', $CNSS, $resultat1); break;
            case 'AMO':   $resultat1 = str_replace('AMO', $AMO, $resultat1); break;
            case 'IGR':   $resultat1 = str_replace('IGR', $IGR, $resultat1); break;
            case 'CIMR':   $resultat1 = str_replace('CIMR', $CIMR, $resultat1); break;
            case 'SALAIRENET':   $resultat1 = str_replace('SALAIRENET', $SALAIRENET, $resultat1); break;
            case 'heureTravail':   $resultat1 = str_replace('heureTravail', $heureTravail, $resultat1); break;
            case 'SALAIREDEBASE':   $resultat1 = str_replace('SALAIREDEBASE', $SALAIREDEBASE, $resultat1); break;
            case 'PRIMEANC':   $resultat1 = str_replace('PRIMEANC', $PRIMEANC, $resultat1); break;
            case 'primeFA':   $resultat1 = str_replace('primeFA', $primeFA, $resultat1); break;
            case 'primeAcc':   $resultat1 = str_replace('primeAcc', $primeAcc, $resultat1); break;
            case 'PRIMERS':   $resultat1 = str_replace('PRIMERS', $PRIMERS, $resultat1); break;
            case 'AIDADHA':   $resultat1 = str_replace('AIDADHA', $AIDADHA, $resultat1); break;
            case 'AIDFITR':   $resultat1 = str_replace('AIDFITR', $AIDFITR, $resultat1); break;
            case 'SALAIREHORAIRE':   $resultat1 = str_replace('SALAIREHORAIRE', $SALAIREHORAIRE, $resultat1); break;
            case 'SBI':  $resultat1  = str_replace('SBI', $SBI, $resultat1 ); break;
            case 'SNI':  $resultat1  = str_replace('SNI', $SNI, $resultat1 ); break;
            case 'SBG':  $resultat1  = str_replace('SBG', $SBG, $resultat1 ); break;
            case 'Taux':   $resultat1 = str_replace('Taux', $Taux, $resultat1); break;
            case 'Valeur':   $resultat1 = str_replace('Valeur', $Valeur, $resultat1); break;
          }
      
    }//fin if
    if($verifie)
    {  $condALL="if(";
     
      for ($i = 0; $i < count($resultat1); $i++) {
        $condALL=$condALL.$resultat1[$i];
      }
      $condALL=$condALL.")";
      //Taux Valeur

      switch($aff[0])
      {
        
        case "Taux": $aff[0] = '$Taux'; break;
          

        
        case "Valeur": $aff[0] = '$Valeur'; break;
         
       
      }//fin switch
      
      for ($i = 0; $i < count($aff); $i++) {
        echo "hiiiiiiiiiiiiiiiiiiii".$aff[$i];
        $condALL= $condALL." ".$aff[$i];
      }

      
      $condALL= $condALL.";";
      $verifie=0;
    }//if
    else{
      
      $condALL=$condALL."else if(";
      for ($i = 0; $i < count($resultat1); $i++) {
        $condALL=$condALL.$resultat1[$i];
      }
      $condALL=$condALL.")";
      //Taux Valeur
      switch($aff[0])
      {
        case "Taux": $aff[0] = '$Taux'; break;
       

        case "Valeur": $aff[0] = '$Valeur'; break;
      
       
      }//switch

     
      for ($i = 0; $i < count($aff); $i++) {
        $condALL= $condALL." ".$aff[$i];
        }
        $condALL= $condALL.";";


    }//else
    echo $condALL;
eval($condALL);

}
}
}
     
      echo $id."ana id ";
      $sql22= "SELECT * FROM `regle` WHERE idRegle='$id' ";
	$i = $bd->query($sql22);
	$regle = $i->fetch(PDO::FETCH_ASSOC);
// gestion input readonly

$formule=$regle['regle'];
//alocation
$nbEnfant=$user['nombreEnfants'];
$duree=1;

//HS


  //  }
// CNS


$formule = trim($formule);
    
    // Séparer la chaîne en utilisant l'espace comme séparateur
    $resultat = explode(' ', $formule);
    
    // Afficher chaque élément séparément
    //foreach ($elements as $resultat) {
       
  //  }
//$nouvelleformule = str_replace($motAChanger, $nouveauMot, $formule);
// Exemple d'utilisation
$formule1="";
for ($i = 2; $i < count($resultat); $i++) {
    $formule1=$formule1." ".$resultat[$i];
}  
//switch case varible $resultat[$i] resultat ou stocker

for ($i = 2; $i < count($resultat); $i++) {
    //echo $resultat[$i] . "\n";


    if (!is_numeric($resultat[$i]) && !in_array($resultat[$i], $nombres)) 
    {
        
        switch ($resultat[$i])

        {
            case 'nbEnfant':   $formule1 = str_replace('nbEnfant', $nbEnfant, $formule1); break;
            case 'duree':  $formule1 = str_replace('duree', $duree, $formule1); break;
            case 'dureeCONGE':   $formule1 = str_replace('dureeCONGE', $CONGE, $formule1); break;
            case 'nombreHeures':  $formule1 = str_replace('nombreHeures', $HS, $formule1); break;
            case 'dureeABSENCE':   $formule1 = str_replace('dureeABSENCE', $ABSENCE, $formule1); break;
            case 'ALLOCATION':   $formule1 = str_replace('ALLOCATION', $ALLOCATION, $formule1); break;
            case 'HS':   $formule1 = str_replace('HS', $HS, $formule1); break;
            case 'CONGE':   $formule1 = str_replace('CONGE', $CONGE, $formule1); break;
            case 'ABSENCE':   $formule1 = str_replace('ABSENCE', $ABSENCE, $formule1); break;
            case 'CNSS':   $formule1 = str_replace('CNSS', $CNSS, $formule1); break;
            case 'AMO':   $formule1 = str_replace('AMO', $AMO, $formule1); break;
            case 'IGR':   $formule1 = str_replace('IGR', $IGR, $formule1); break;
            case 'CIMR':   $formule1 = str_replace('CIMR', $CIMR, $formule1); break;
            case 'SALAIRENET':   $formule1 = str_replace('SALAIRENET', $SALAIRENET, $formule1); break;
            case 'heureTravail':   $formule1 = str_replace('heureTravail', $heureTravail, $formule1); break;
            case 'SALAIREDEBASE':   $formule1 = str_replace('SALAIREDEBASE', $SALAIREDEBASE, $formule1); break;
            case 'PRIMEANC':   $formule1 = str_replace('PRIMEANC', $PRIMEANC, $formule1); break;
            case 'primeFA':   $formule1 = str_replace('primeFA', $primeFA, $formule1); break;
            case 'primeAcc':   $formule1 = str_replace('primeAcc', $primeAcc, $formule1); break;
            case 'PRIMERS':   $formule1 = str_replace('PRIMERS', $PRIMERS, $formule1); break;
            case 'AIDADHA':   $formule1 = str_replace('AIDADHA', $AIDADHA, $formule1); break;
            case 'AIDFITR':   $formule1 = str_replace('AIDFITR', $AIDFITR, $formule1); break;
            case 'Taux':   $formule1 = str_replace('Taux', $Taux, $formule1); break;
            case 'Valeur':   $formule1 = str_replace('Valeur', $Valeur, $formule1); break;
            case 'SALAIREHORAIRE':  $formule1 = str_replace('SALAIREHORAIRE', $SALAIREHORAIRE, $formule1); break;
            case 'SBI':  $formule1 = str_replace('SBI', $SBI, $formule1); break;
            case 'SNI':  $formule1 = str_replace('SNI', $SNI, $formule1); break;
            case 'SBG':  $formule1 = str_replace('SBG', $SBG, $formule1); break;
          }
          
      
    }
    
}

$affect = evaluerFormule( $formule1);


switch ($resultat[0])

{
    case 'ALLOCATION':   $ALLOCATION = $affect; break;
    case 'HS':   $RH = $affect; break;
    case 'CONGE':   $CONGE = $affect; break;
    case 'ABSENCE':   $ABSENCE = $affect; break;
    case 'CNSS':   $CNSS = $affect; break;
    case 'AMO':   $AMO = $affect; break;
    case 'IGR':   $IGR = $affect; break;
    case 'CIMR':   $CIMR = $affect; break;
    case 'SALAIRENET':   $SALAIRENET = $affect; break;
    case 'PRIMEANC':   $PRIMEANC = $affect; break;
    case 'PRIMERS':   $PRIMERS = $affect; break;
    case 'AIDADHA':   $AIDADHA = $affect; break;
    case 'AIDFITR':   $AIDFITR = $affect; break;
    case 'SBI':   $SBI = $affect; break;
    case 'SNI':   $SNI = $affect; break;
    case 'SBG':   $SBG = $affect; break;

}


}
}
}

	if(isset($_POST['calculer'])) 
	{
		if (isset($_POST['salaire']) && isset($_POST['ALLOCATION']) && isset($_POST['HS']) && isset($_POST['CONGE']) && isset($_POST['ABSENCE']) &&
			isset($_POST['CIMR']) && isset($_POST['CNSS']) && isset($_POST['AMO']) && isset($_POST['IGR']) ) 
	{
    $SALAIREDEBASE = $salaire['salaireDeBase'];
		$HS = $_POST['HS'];
		$ALLOCATION = $_POST['ALLOCATION'];
		$CONGE = $_POST['CONGE'];
		$salaire = $_POST['salaire'];
		$AMO = $_POST['AMO'];
		$CNSS = $_POST['CNSS'];
		$IGR = $_POST['IGR'];
		$CIMR = $_POST['CIMR'];
    $CNSS = $CNSS * -1;
    $IGR = $IGR * -1;
		$CIMR = $CIMR * -1;
    //$salaireCalculé = $salaire + $HS + $ALLOCATION + $CONGE - $ABSENCE - $CIMR - $CNSS - $AMO - $IGR;
		// $sql = "UPDATE utilisateur SET nom=?,prenom=?, cin=?,dateNaissance=?, adresse=?, email=?, sexe=?, age=?, rib=? , numeroTel=?, numeroCNSS=?, numeroAMO=?, numeroCIMR=?, numeroIGR=?,situationFamiliale=? WHERE matricule = ?";
		// $req=$bd->prepare($sql);
		// $req->execute(array( $nom, $prenom, $cin, $dateNaissance, $adresse, $email,  $gender, $age , $rib, $numeroTel, $CNSS, $AMO, $CIMR, $IGR, $situation,  $matricule));
		
		// if ($req) 
		// {
		// 	if($req2)
		// 	{
		// 		header("location: view.php");
		// 	}
		// }
        // else
        // {
		// 	$erreur = "la mise à jour a échoué.";
		// }
// Effectuer le calcul du salaire en utilisant les valeurs récupérées

// Vous pouvez ensuite effectuer les opérations supplémentaires nécessaires, telles que la mise à jour des valeurs dans la base de données ou l'affichage du résultat.
}
	}

  $month = $mois; // Example: June
  $year = $annee; // Example: 2023
  
  // Create a DateTime object with the given month and year
  $date = new DateTime();
  $date->setDate($year ,1,$month); // Set the day to 1 for the specified month and year
  
  
  
  // Format the date as desired (example: YYYY-MM-DD)
  $formattedDate = $date->format('Y-m-d');

  $req="INSERT INTO bulltin (matricule,dateAjout,date,CIMR,CNSS,AMO,IGR,ABSENCE,SALAIRENET,CONGE,HS,ALLOCATION) VALUES ('$matricule',NOW(),'$formattedDate',1000,200,674.98,123.56,-100,'$SALAIRENET',0,3000,'$ALLOCATION')";
  //execution de la requette
  $res = $bd->query($req);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salaire</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_profile.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
<div class="main-content">
    <!-- Top navbar -->
    <br><br><br><br>
    <a class="btn btn-info btn-edit-delete"
					href="../fpdf/page_document.php
					?id=<?php echo $user['matricule'] ?>
			  "> 
					<span class="fa fa-print"></span>
				</a>
<br><br><br><br><br><br><br>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Informations</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>

      

            <div class="card-body">
              <form action="" method="post">
                <h6 class="text-muted">Informations de l'utilisateur</h6>
                <div class="pl-lg-4">
               
          
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1">Salaire de base</label>
                        <input type="text" name="salaire" id="input-username" class="form-control form-control-alternative" placeholder="user@entreprise.com" value="<?php echo $salaire['salaireDeBase']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="text-center1" for="input-email">Remuneration des HS</label>
                        <input type="text" name="HS" id="input-email" class="form-control form-control-alternative" placeholder="Nom.prenom@gmail.com" value="3000" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name">CONGE</label>
                        <input type="text" name="CONGE" id="input-first-name" class="form-control form-control-alternative" placeholder="Prenom" value="0" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-last-name">ABSENCEs</label>
                        <input type="text" name="ABSENCE" id="input-last-name" class="form-control form-control-alternative" placeholder="Nom" value="-100" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">ALLOCATIONs Familiales</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-address">ALLOCATIONs Familiales</label>
                        <input id="input-address" name="ALLOCATION" class="form-control form-control-alternative" placeholder="Adress" value="<?php echo $ALLOCATION; ?>" type="text" disabled>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Elements Deductifs</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1">CNSS</label>
                        <input type="text" name="CNSS" id="input-username" class="form-control form-control-alternative" placeholder="user@entreprise.com" value="200" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="text-center1" for="input-email">AMO</label>
                        <input type="text" name="AMO" id="input-email" class="form-control form-control-alternative" placeholder="Nom.prenom@gmail.com" value="674.98" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-last-name">IGR</label>
                        <input type="text" name="IGR" id="input-last-name" class="form-control form-control-alternative" placeholder="Nom" value="123.56" disabled>
                      
                      </div>
                        
                       
                    </div>
                    <div id="condition-elements2" disabled>
                          <!-- Zone pour afficher les éléments de condition ajoutés -->
                     </div>
                     </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name"></label>
                        <input type="hidden" name="CIMR" id="CIMR" class="form-control form-control-alternative" placeholder="Prenom" value="1000" disabled>
                      </div>
                    </div>
                  
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name"></label>
                        <input type="hidden" name="SALAIRENET" id="NET" class="form-control form-control-alternative" placeholder="Prenom" value="11 000" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name"></label>
                        <div id="condition-elements" disabled>
                <!-- Zone pour afficher les éléments de condition ajoutés -->
                </div>     
                </div>
                    </div>
                  </div>
                </div>
              
                <hr class="my-4">
                <input class="button" type="submit" name="calculer" value="Calculer salaire" onclick="addCondition()">&nbsp &nbsp &nbsp<button class="button">Annuler</button>
               <br><br><br><br>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <!-- <button class="button" type="submit" name="update_profile">Modifier Profile</button>&nbsp &nbsp &nbsp<button class="button">Annuler</button> -->
<style>

</style>
<script>
  flatpickr("#date", {
    dateFormat: "d/m/Y",
    locale: "fr"
  });
</script>
    </div>
    
  </footer>
  <br><br><br><br>
  <div class="container-fluid mt--7">
     <div class="d-flex justify-content-between">
      
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Ajout</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
            <form action="" method="post">
                <h6 class="text-muted">Primes</h6>
                <div class="pl-lg-4">
                  <div class="row">
                  
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name">CIMR</label>
                        <button class="button" type="submit" name="CIMR" onclick="addCondition2()">Calculer CIMR</button>
                        <!-- <input type="text" name="CIMR" id="input-first-name" class="form-control form-control-alternative" placeholder="Prenom" value="<?php echo $r['prenom']; ?>" > -->
                      </div>
                    </div>
                  </div>
                  
                </div>

              </form>
                
            </div></div></div></div></div>

  <!-- <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center"> -->
       
<script>
  flatpickr("#date", {
    dateFormat: "d/m/Y",
    locale: "fr"
  });
var test=0;
  function addCondition()
        { 
          event.preventDefault();
          if(test==0){

            event.preventDefault();
            var conditionContainer = document.getElementById('condition-elements');
            var conditionContainer2 = document.getElementById('NET');
            var conditionInput = document.createElement('input');
            conditionInput.type = 'text';
            conditionInput.className = 'condition-input';
            conditionInput.name = 'salairNet';
            conditionInput.value = conditionContainer2.value;
            conditionInput.className="form-control form-control-alternative";
            conditionInput.disabled=true;

            var conditionLabel = document.createElement('label');
            conditionLabel.className = 'text-center1';
            conditionLabel.innerHTML = 'Salaire calculer :';
            
            var lineBreak = document.createElement('br');
            conditionContainer.appendChild(conditionLabel);
            conditionContainer.appendChild(conditionInput);
            
            conditionContainer.appendChild(lineBreak);
            //conditionContainer.appendChild(countInput);
            test=1;

          }
            
        }

test1=0;
        function addCondition2()
        { 
          event.preventDefault();
          if(test1==0){

            event.preventDefault();
            var conditionContainer = document.getElementById('condition-elements2');
            var conditionContainer2 = document.getElementById('CIMR');
            var conditionInput = document.createElement('input');
            conditionInput.type = 'text';
            conditionInput.className = 'condition-input';
            conditionInput.name = 'CIMR';
            conditionInput.value = conditionContainer2.value;
            conditionInput.className="form-control form-control-alternative";
            conditionInput.disabled=true;

            var conditionLabel = document.createElement('label');
            conditionLabel.className = 'text-center1';
            conditionLabel.innerHTML = 'CIMR :';
            
            var lineBreak = document.createElement('br');
            conditionContainer.appendChild(conditionLabel);
            conditionContainer.appendChild(conditionInput);
            
            conditionContainer.appendChild(lineBreak);
            //conditionContainer.appendChild(countInput);
            test1=1;

          }
            
        }

        function removeCondition() 
        {
            event.preventDefault();
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
    var conditionContainer = document.getElementById('condition-elements');
    var lastCondition = conditionContainer.lastElementChild;
    if (lastCondition) {
        conditionContainer.removeChild(lastCondition);
    }
}

        function submitRule() 
        {
           
            var formule = document.getElementById('formule').value;
            var rule = formule;
            // Envoyer la règle à la base de données pour l'ajouter
           // console.log('Règle à ajouter : ' + rule);
            
            
            document.forms[0].submit(); // Soumettre le formulaire pour effectuer l'insertion dans la base de données
        }
        

</script>
<?php 


$_SESSION['m']= $mois;
$_SESSION['a']=$annee;


echo $_SESSION['m']."ana moiiiiiiiiis";
echo $_SESSION['a']."ana annnee";

?>
    </div>
    
  </footer>
</body>
</html>