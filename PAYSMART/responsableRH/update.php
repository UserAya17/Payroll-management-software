<?php
require('connect.php');
include "menu.php";

	$matricule = $_GET['matricule'];
	$id = $_GET['filiale'];

	$selSql = "SELECT * FROM `utilisateur` WHERE matricule= '$matricule'";
	$res = $bd->query($selSql);
	$r = $res->fetch(PDO::FETCH_ASSOC);

	
 	$selSql1 = "SELECT * FROM `contrat` WHERE idUser= '$matricule' and idFiliale = '$id'";
	$res1 = $bd->query($selSql1);
	$rr = $res1->fetch(PDO::FETCH_ASSOC);

	$ReadSql = "SELECT nomFliale FROM `filiale` ";
  $reqet = $bd->query($ReadSql);
  $rows = $reqet->fetchAll(PDO::FETCH_ASSOC);

	if(isset($_POST['modifier'])) 
	{
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['gender']) && isset($_POST['dateNaissance']) &&
			isset($_POST['cin']) && isset($_POST['rib']) && isset($_POST['adresse']) && isset($_POST['telephone']) && isset($_POST['dateEmbauche']) &&
			isset($_POST['duree']) && isset($_POST['type']) && isset($_POST['situation']) && isset($_POST['salaire']) && isset($_POST['poste']) &&
			isset($_POST['cimr']) && isset($_POST['cnss']) && isset($_POST['amo']) && isset($_POST['igr']) && isset($_POST['nbreEnfants']) ) 
	{
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $dateNaissance = $_POST['dateNaissance'];
    $adresse = $_POST['adresse'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
    $aujourdhui = date("Y-m-d");
    $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
    $age = $diff->format('%y');
		$rib = $_POST['rib'];
		$numeroTel = $_POST['telephone'];
    $cnss = $_POST['cnss'];
		$amo = $_POST['amo'];
		$cimr = $_POST['cimr'];
		$igr = $_POST['igr'];
		$situation = $_POST['situation'];
    $nbreEnfants = $_POST['nbreEnfants'];

    $sql = "UPDATE utilisateur SET nom=?,prenom=?, cin=?,dateNaissance=?, adresse=?, email=?, sexe=?, age=?, rib=? , numeroTel=?, numeroCNSS=?, numeroAmo=?, numeroCimr=?, numeroIgr=?,situationFamiliale=?,nombreEnfants=? WHERE matricule = ?";
		$req=$bd->prepare($sql);
		$req->execute(array( $nom, $prenom, $cin, $dateNaissance, $adresse, $email,  $gender, $age , $rib, $numeroTel, $cnss, $amo, $cimr, $igr, $situation,$nbreEnfants,  $matricule));

    $duree = $_POST['duree'];
		$type = $_POST['type'];
		$salaire = $_POST['salaire'];
    $poste = $_POST['poste'];
    $dateEmbauche = $_POST['dateEmbauche'];
		
		$sql2 = "UPDATE contrat SET duree=?, typeContrat=?, salaireDeBase=?, poste=?,dateEmbauche=? WHERE idUser = ? and idFiliale=? ";
		$req2=$bd->prepare($sql2);
		$req2->execute(array( $duree, $type, $salaire, $poste, $dateEmbauche, $matricule ,$id));
		
		
		if ($req) 
		{
			if($req2)
			{
				//header("location: view.php");
        echo '<script>window.location.href = "view.php";</script>';
			}
		}else{
			$erreur = "la mise à jour a échoué.";
		}
	}
	}

 ?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="css/style_profile.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<style>
  .nav_trsp ul li{
    font-size: 17px; 
  }
</style>
<body>
  <form action="" method="post">
  <div class="main-content">
    <!-- Top navbar -->
   
<br><br><br><br><br><br><br>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Modifier Employe</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="text-muted">Modifier Employe</h6>
                <div class="pl-lg-4">

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Nom </label>
                        <input name="nom" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['nom'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Prenom : </label>
                        <input name="prenom" type="text" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $r['prenom'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >CIN :</label>
                        <input name="cin" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['cin'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Adresse e-mail :</label>
                        <input name="email" type="email" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $r['email'] ?>">
                      </div>
                    </div>
                  </div>

				  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Date de naissance </label>
                        <input name="dateNaissance" type="date" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['dateNaissance'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Numero de telephone : </label>
                        <input name="telephone" type="text" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $r['numeroTel'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Numero du Compte bancaire :</label>
                        <input name="rib" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['rib'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Genre :</label>
						<label>
							<input type="radio" name="gender" id="input-first-name" value="H" <?php if($r['sexe'] == 'H'  || $r['sexe'] == 'h' ){ echo "checked";} ?>>
							H
						</label>
						<label>
							<input type="radio" name="gender" id="input-first-name" value="F" <?php if($r['sexe'] == 'F' || $r['sexe'] == 'f'){ echo "checked";} ?>>
							F
						</label>
                      </div>
                    </div>
                  </div>


				  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Situation familiale: </label>
						<select name="situation" id="input-first-name" >
							<option value="" >---Selectionnez---</option>
							<option value="celib" <?php if($r['situationFamiliale'] == 'celib'){ echo "selected";} ?>>Celibataire</option>
							<option value="marie" <?php if($r['situationFamiliale'] == 'marie'){ echo "selected";} ?>>Marie(e)</option>
							<option value="divorce" <?php if($r['situationFamiliale'] == 'divorce'){ echo "selected";} ?>>Divorce(e)</option>
							<option value="veuf" <?php if($r['situationFamiliale'] == 'veuf'){ echo "selected";} ?>>Veuf(ve)</option>
						</select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Nombre d'enfants : </label>
                        <input name="nbreEnfants" type="text" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $r['nombreEnfants'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Adresse :</label>
                        <input name="adresse" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['adresse'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Numero d'affiliation CNSS :</label>
                        <input name="cnss" type="text" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $r['numeroCNSS'] ?>">
                      </div>
                    </div>
                  </div>

				  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Numero d'affiliation AMO : </label>
                        <input name="amo" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['numeroAmo'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Numero d'affiliation CIMR : </label>
                        <input name="cimr" type="text" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $r['numeroCimr'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Numero d'affiliation IGR :</label>
                        <input name="igr" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['numeroIgr'] ?>">
                      </div>
                    </div>
                  </div>


				  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Type Contrat </label>
						<select name="type" id="input-first-name" >
							<option value="" >---Selectionnez---</option>
							<option value="ctt" <?php if($rr['typeContrat'] == 'ctt' || $rr['typeContrat'] == 'CTT'){ echo "selected";} ?>>CTT</option>
                            <option value="cdd" <?php if($rr['typeContrat'] == 'cdd' || $rr['typeContrat'] == 'CDD'){ echo "selected";} ?> >CDD</option>
                            <option value="cdi" <?php if($rr['typeContrat'] == 'cdi' || $rr['typeContrat'] == 'CDI'){ echo "selected";} ?>>CDI</option>
						</select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Duree du contrat : </label>
                        <input name="duree" type="text" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $rr['duree'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Poste :</label>
                        <input name="poste" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $rr['poste'] ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Salaire de base :</label>
                        <input name="salaire" type="number" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $rr['salaireDeBase'] ?>">
                      </div>
                    </div>
                  </div>

				  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Date d'embauche : </label>
                        <input name="dateEmbauche" type="date" id="input-username" class="form-control form-control-alternative" value="<?php echo $rr['dateEmbauche'] ?>" >
                      </div>
                    </div>
                  </div>

                  

				 

                </div>
  </div>
          </div>
        
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <button class="button" name="modifier" type="submit">Modifier</button>&nbsp &nbsp &nbsp;

 <a href="view.php"><button class="button" type="button" >Annuler</button></a>
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


