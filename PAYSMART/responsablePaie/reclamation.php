<?php
include "menuRp.php";
?>
    <?php
    $idrec = $_GET['id'];
   

    $conn1 = mysqli_connect('localhost','root','','paysmart') or die('connection failed');
    $select1 = mysqli_query($conn1, "SELECT * FROM `reclamation` WHERE idReclamation = '$idrec'") or die('query failed');
    if(mysqli_num_rows($select1) > 0){
       $fetch1 = mysqli_fetch_assoc($select1);
    }
    $mat=$fetch1['idUser'];
       $conn2 = mysqli_connect('localhost','root','','paysmart') or die('connection failed');


       $select2 = mysqli_query($conn1, "SELECT * FROM `utilisateur`  WHERE matricule = '$mat'") or die('query failed');
       if(mysqli_num_rows($select2) > 0){
          $fetch2 = mysqli_fetch_assoc($select2);
       }
    if (isset($_POST['valider']) || isset($_POST['refuser'])) 
    {
        $commentaire = $_POST['commentaire'];
        if (!empty($commentaire)) 
        {
            if (isset($_POST['valider']))
            {
                $updateQuery = "UPDATE `reclamation` SET valider = 'valider rp',commentaire = '$commentaire' WHERE idReclamation = '$idrec'";
                $result = mysqli_query($conn1, $updateQuery);
                echo '<script>window.location.href = "ReclamationRp.php";</script>';
            }
            else{
                $updateQuery = "UPDATE `reclamation` SET valider = 'refuser rp',commentaire = '$commentaire' WHERE idReclamation = '$idrec'";
                $result = mysqli_query($conn1, $updateQuery);
                echo '<script>window.location.href = "ReclamationRp.php";</script>';
            }
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
                  <h3 class="mb-0">Reclamation</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form method="POST">
                <h6 class="text-muted">Reclamation</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Nom Prenom :</label>
                        <input name="fil" type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $fetch2['nom']." ".$fetch2['prenom']; ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Type Reclamation : </label>
                        <input name="adr" type="text" id="input-first-name" class="form-control form-control-alternative"  value="<?php echo $fetch1['typeReclamation']; ?>" readonly >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Reclamation</label>
                        <input name="tele" type="text" id="input-username" class="form-control form-control-alternative" placeholder="numero telephone" value="<?php echo $fetch1['reclamation']; ?>"readonly >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Commentaire</label>
                    <textarea placeholder="Saisissez ici..." id="input-first-name" class="form-control form-control-alternative" name="commentaire"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
  </div>
          </div>
        
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
      <button class="button" type="submit" name="valider">Valider </button>

<button class="button" type="submit" name="refuser">Refuser</button>
<a href="ReclamationRp.php"> <button class="button" type="button" >Annuler</button></a> 
      </div></div>
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

