<?php
include "menu.php";

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
                  <h3 class="mb-0">Ajout d'une filiale</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="text-muted">Ajout d'une filiale</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Nom de filiale :</label>
                        <input name="fil" type="text" id="input-username" class="form-control form-control-alternative" placeholder="filiale">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Adresse : </label>
                        <input name="adr" type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="adresse" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" >Numero de telephone :</label>
                        <input name="tele" type="text" id="input-username" class="form-control form-control-alternative" placeholder="numero telephone" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Adresse e-mail :</label>
                        <input name="mail" type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="@mail" >
                      </div>
                    </div>
                  </div>
                </div>
  </div>
          </div>
        
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <button class="button" name="ajouter" type="submit">Ajouter filiale</button>&nbsp &nbsp &nbsp  <a href="consulterEntreprise.php"> <button class="button" type="button">Annuler</button></a>
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
<?php
    if($_SERVER['REQUEST_METHOD']=='POST')
   { if(isset($_POST['ajouter']))
        require('connect.php');
        //recuperer les donnees 
        $nnn=$_POST['fil'];
        $ppp=$_POST['adr'];
        $ccc=$_POST['tele'];
        $ddd=$_POST['mail'];
        //la requette d'insertion
        $req="INSERT INTO filiale (nomFliale,adresseFiliale,telFiliale,emailFiliale) VALUES ('$nnn','$ppp','$ccc','$ddd')";
        //execution de la requette
        $bdd->exec($req); 
        //retourner a la page 
        //header('location:consulterEntreprise.php');
        echo '<script>window.location.href = "consulterEntreprise.php";</script>';
   }
?>
