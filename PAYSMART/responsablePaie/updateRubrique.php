<?php
//require_once("session.php");
require('connect.php');
//include "menu.php";
include 'menuRp.php';
	//$matricule = $_GET['matricule'];
	$id = $_GET['id'];
	$selSql = "SELECT * FROM `rubrique` WHERE idRubrique= '$id'";
	$res = $bd->query($selSql);
	$r = $res->fetch(PDO::FETCH_ASSOC);

	if(isset($_POST['modifier'])) 
	{
        
		if (isset($_POST['nom']) ) 
	    {
           
		    $nom = $_POST['nom'];
            $sql = "UPDATE rubrique SET nomRubrique=? WHERE idRubrique = ?";
            
            $req=$bd->prepare($sql);
            
            $req->execute(array( $nom,$id));
            
			if($req)
			{
				//header("location: viewRubr.php");
        echo '<script>window.location.href = "viewRubr.php";</script>';
			}
		    else
            {
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
                  <h3 class="mb-0">Modifier Rubrique</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="text-muted">Modifier Rubrique</h6>
                <div class="pl-lg-4">

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Nom </label>
                        <input name="nom" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $r['nomRubrique'] ?>">
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

 <a href="viewRubr.php"><button class="button" type="button" >Annuler</button></a>
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


