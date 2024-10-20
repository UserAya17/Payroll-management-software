<?php
include "menu.php";
$id = $_GET['id'];


$conn1 = mysqli_connect('localhost', 'root', '', 'paysmart') or die('connection failed');

$select1 = mysqli_query($conn1, "SELECT * FROM `filiale` WHERE idFiliale = '$id'") or die('query failed');
if (mysqli_num_rows($select1) > 0) {
    $fetch1 = mysqli_fetch_assoc($select1);
}
?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="../css/style_profile.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<style>
  .nav_trsp ul li {
    font-size: 17px;
  }
</style>
<html>

<body>
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
                <h3 class="mb-0">Modification d'une filiale</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <h6 class="text-muted">Information de l'entreprise avant modification</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label for="input-username">Nom de filiale :</label>
                      <input type="text" id="input-username" name="fil" class="form-control form-control-alternative" placeholder="Nom de filiale" value="<?php echo $fetch1['nomFliale']; ?>" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label for="input-first-name">Adresse :</label>
                      <input type="text" id="input-first-name" name="adr" class="form-control form-control-alternative" placeholder="Adresse" value="<?php echo $fetch1['adresseFiliale']; ?>" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label for="input-username">Numero de telephone :</label>
                      <input type="text" id="input-username" name="tele" class="form-control form-control-alternative" placeholder="Numero de telephone" value="<?php echo $fetch1['telFiliale']; ?>" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group focused">
                      <label for="input-first-name">Adresse e-mail :</label>
                      <input type="text" id="input-first-name" name="mail" class="form-control form-control-alternative" placeholder="Adresse e-mail" value="<?php echo $fetch1['emailFiliale']; ?>" >
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" name="modif" class="btn btn-primary" >Modifier filiale</button>
                <a href="consulterEntreprise.php"> <button class="btn btn-primary" type="button">Annuler</button></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paysmart";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['modif'])) {
        // Récupération des données du formulaire
        $filiale = $_POST['fil'];
        $adresse = $_POST['adr'];
        $tel = $_POST['tele'];
        $email = $_POST['mail'];

        // Requête SQL pour mettre à jour les données de l'entreprise
        $requete = "UPDATE filiale SET nomFliale = :nom, adresseFiliale = :adresse, emailFiliale = :mail, telFiliale = :tele WHERE idFiliale = :idFiliale";
        $stmt = $bdd->prepare($requete);
        $stmt->bindParam(':nom', $filiale);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':tele', $tel);
        $stmt->bindParam(':idFiliale', $id);

        // Exécution de la requête
        if ($stmt->execute()) {
            // La modification a été effectuée avec succès
            //echo "La filiale a été modifiée avec succès.";
            //header("location:consulterEntreprise.php");
            echo '<script>window.location.href = "consulterEntreprise.php";</script>';
        } else {
            // Une erreur s'est produite lors de la modification
            echo "Une erreur s'est produite lors de la modification de la filiale.";
        }
    }
}
?>
