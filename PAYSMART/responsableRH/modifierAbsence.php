
<?php
include "menu.php";
 $idabsence = $_GET['id'];

 $conn1 = mysqli_connect('localhost', 'root', '', 'paysmart') or die('connection failed');

 $select1 = mysqli_query($conn1, "SELECT * FROM `table_absence` WHERE id = ' $idabsence'") or die('query failed');
 if (mysqli_num_rows($select1) > 0) {
     $fetch1 = mysqli_fetch_assoc($select1);
 }
 $mat=$fetch1['title'];
     $conn2 = mysqli_connect('localhost', 'root', '', 'paysmart') or die('connection failed');
     $select2 = mysqli_query($conn2, "SELECT * FROM `utilisateur` WHERE matricule = '$mat'") or die('query failed');
     if (mysqli_num_rows($select2) > 0) {
         $fetch2 = mysqli_fetch_assoc($select2);
     }
 
 
 if (isset($_POST['modifier'])) {
    $jus = $_POST['jus'];
    $debut = $_POST['debut'];
    $fin= $_POST['fin'];

    if (!empty($debut) && !empty($fin)) {
            $updateQuery = "UPDATE `table_absence` SET `description` = '$jus', `start_datetime` = '$debut', `end_datetime` = '$fin' WHERE id = '$idabsence'";
            $result = mysqli_query($conn1, $updateQuery);
            echo '<script>window.location.href = "absence_calendrier.php";</script>';
     
    } else {
        echo "il manque des champs a inserer.";
    }
}
 
    ?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="../css/style_profile.css">

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
                  <h3 class="mb-0">Absence</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="text-muted">Absence</h6>
                <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Matricule : </label>
                        <input name="matr" type="text" id="input-first-name" class="form-control form-control-alternative"  value="<?php echo $fetch1['title']; ?>"readonly >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Date Debut : </label>
                        <input name="debut"  type="datetime-local" id="input-first-name" class="form-control form-control-alternative"  value="<?php echo $fetch1['start_datetime']; ?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Date Fin :</label>
                        <input name="fin"  type="datetime-local" id="input-username" class="form-control form-control-alternative" value="<?php echo $fetch1['end_datetime']; ?>"  >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Justification :</label>
                        <input name="jus" type="text" id="input-first-name" class="form-control form-control-alternative"  value="<?php echo $fetch1['description']; ?>";   >
                      </div>
                    </div>
                  </div>
                </div>
               
          </div>
        
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
      <button class="button" type="submit" name="modifier">Modifier </button>
<a href="consulter_Absence.php"> <button class="button" type="button" >Annuler</button></a> 
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

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paysmart";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion à la base de données réussie";
} catch(PDOException $e) {
    // echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
