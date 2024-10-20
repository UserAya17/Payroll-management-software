<?php
//require_once("session.php");
require('connect.php');
include 'menuRp.php';
	$matricule = $_GET['matricule'];
	$filiale = $_GET['filiale'];
	$selSql = "SELECT * FROM `utilisateur` WHERE matricule= '$matricule'";
	$res = $bd->query($selSql);
	$r = $res->fetch(PDO::FETCH_ASSOC);

	$sql1= "SELECT * from filiale where idFiliale = '$filiale'";
	$i = $bd->query($sql1);
	$id = $i->fetch(PDO::FETCH_ASSOC);

	$selSql1 = "SELECT * FROM `contrat` WHERE idUser= '$matricule' && idFiliale = '$id'";
	$res1 = $bd->query($selSql1);
	$rr = $res1->fetch(PDO::FETCH_ASSOC);

	$ReadSql = "SELECT nomFliale FROM `filiale` ";
    $reqet = $bd->query($ReadSql);
    $rows = $reqet->fetchAll(PDO::FETCH_ASSOC);

	if(isset($_POST['calculer'])) 
	{
		if (isset($_POST['salaire']) && isset($_POST['allocation']) && isset($_POST['hs']) && isset($_POST['conge']) && isset($_POST['absence']) &&
			isset($_POST['cimr']) && isset($_POST['cnss']) && isset($_POST['amo']) && isset($_POST['igr']) ) 
	{
		$hs = $_POST['hs'];
		$allocation = $_POST['allocation'];
		$conge = $_POST['conge'];
		$salaire = $_POST['salaire'];
		$amo = $_POST['amo'];
		$cnss = $_POST['cnss'];
		$igr = $_POST['igr'];
		$cimr = $_POST['cimr'];

		// $sql = "UPDATE utilisateur SET nom=?,prenom=?, cin=?,dateNaissance=?, adresse=?, email=?, sexe=?, age=?, rib=? , numeroTel=?, numeroCNSS=?, numeroAmo=?, numeroCimr=?, numeroIgr=?,situationFamiliale=? WHERE matricule = ?";
		// $req=$bd->prepare($sql);
		// $req->execute(array( $nom, $prenom, $cin, $dateNaissance, $adresse, $email,  $gender, $age , $rib, $numeroTel, $cnss, $amo, $cimr, $igr, $situation,  $matricule));
		
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
	}
	}

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
   
<br><br><br><br><br><br><br>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
       
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Mes informations</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form action="profile.php" method="post">
                <h6 class="text-muted">Informations de l'utilisateur</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1">Salaire de base</label>
                        <input type="text" name="salaire" id="input-username" class="form-control form-control-alternative" placeholder="user@entreprise.com" value="<?php echo $rr['salaireDeBase']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="text-center1" for="input-email">Remuneration des HS</label>
                        <input type="text" name="hs" id="input-email" class="form-control form-control-alternative" placeholder="Heures sup">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name">Conge</label>
                        <input type="text" name="conge" id="input-first-name" class="form-control form-control-alternative" placeholder="Conge">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-last-name">Absences</label>
                        <input type="text" name="absence" id="input-last-name" class="form-control form-control-alternative" placeholder="Absences">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Allocations Familiales</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-address">Allocations Familiales</label>
                        <input id="input-address" name="allocation" class="form-control form-control-alternative" placeholder="Allocations familiales" type="text">
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
                        <input type="text" name="cnss" id="input-username" class="form-control form-control-alternative" placeholder="CNSS" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="text-center1" for="input-email">AMO</label>
                        <input type="email" name="amo" id="input-email" class="form-control form-control-alternative" placeholder="AMO" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-last-name">IGR</label>
                        <input type="text" name="igr" id="input-last-name" class="form-control form-control-alternative" placeholder="IGR" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name"></label>
                        <input type="hidden" name="cimr" id="input-first-name" class="form-control form-control-alternative" placeholder=""  >
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <input class="button" type="submit" name="calculer" value="Calculer salaire">&nbsp &nbsp &nbsp<button class="button">Annuler</button>
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
                        <label class="text-center1">Primes</label>
                        <select name="primes" class="form-control" id="input1" required>
							<option value="">--Selectionnez--</option>
                            <option value="Anciennete">Prime d'anciennete</option>
                            <option value="13emeMois">Prime de fin d'annee</option>
                            <option value="accouchement">Prime d'accouchement</option>
                            <option value="scolaire">Prime de rentree scolaire</option>
                            <option value="adha">Aïd el-Adha</option>
                            <option value="fitr">Aïd el-Fitr</option>
						</select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name">CIMR</label>
                        <button class="button" type="submit" name="cimr">Calculer CIMR</button>
                        <!-- <input type="text" name="cimr" id="input-first-name" class="form-control form-control-alternative" placeholder="Prenom" value="<?php echo $fetch1['prenom']; ?>" > -->
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
</script>
    </div>
    
  </footer>
</body>
</html>