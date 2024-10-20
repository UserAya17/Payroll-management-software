<?php
include "menu.php";
$id = $_GET['id'];
$conn1 = mysqli_connect('localhost', 'root', '', 'paysmart') or die('connection failed');

$select1 = mysqli_query($conn1, "SELECT * FROM `prime` WHERE idprime= '$id'") or die('query failed');
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
                  <h3 class="mb-0">Ajout d'une prime</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="text-muted">Ajout d'une prime</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label for="title" class="control-label">Filiale</label>
                                <select type="text" name="country" id="country" class="form-control form-control-sm rounded-0">
                                    <option>Choisir filiale</option>
                                </select>
                                    <label for="title" class="control-label">Matricule</label>
                                    <!-- <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required> -->
                                <select type="text" id="title" name="idUser" class="form-control form-control-sm rounded-0" ></select>
                       </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label class="text-center1">Designation :</label>
                         <input name="nom" type="text" id="input-username" class="form-control form-control-alternative" placeholder="prime" value="<?php echo $fetch1['nom']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label class="text-center1" for="input-first-name">Montant : </label>
                                                <input name="montant" type="number" id="input-first-name" class="form-control form-control-alternative" placeholder="montant" value="<?php echo $fetch1['montant']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label class="text-center1" for="input-first-name">Date :</label>
                                                <input name="date" type="date" id="input-first-name" class="form-control form-control-alternative" value="<?php echo $fetch1['date']; ?>"> 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label class="text-center1" for="input-first-name">Type  :</label>
                      <label>
							<input type="radio" name="type" id="input-first-name" value="H" <?php if($fetch1['type'] == '0'){ echo "checked";} ?>>
							Prime non imposable
						</label>
						<label>
							<input type="radio" name="type" id="input-first-name" value="F" <?php if($fetch1['type'] == '1'){ echo "checked";} ?>>
							Prime imposable
						</label>    
                      </div>
                    </div>
                  </div>
                </div>
  </div>
          </div>
        
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <button class="button" name="modif" type="submit">Ajouter prime</button>&nbsp &nbsp &nbsp  <a href="consulterEntreprise.php"> <button class="button" type="button">Annuler</button></a>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['modif'])) {
        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $montant = $_POST['montant'];
        $date = $_POST['date'];
        $type = $_POST['type'];
if($type=="imposable")  $type = "0";
else $type = "1";
        // Requête SQL pour mettre à jour les données de l'entreprise
        $requete = "UPDATE prime SET nom = :nom, montant = :montant, date = :date, type = :type WHERE idprime = :idprime";
        $stmt = $bdd->prepare($requete);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':idprime', $id);

        // Exécution de la requête
        if ($stmt->execute()) {
            // La modification a été effectuée avec succès
            echo '<script>window.location.href = "PrimeRp.php";</script>';
        } else {
            // Une erreur s'est produite lors de la modification
            echo "Une erreur s'est produite lors de la modification de la prime.";
        }
    }
}
?>



<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $('#country').change(function() {
                    loadState($(this).find(':selected').val())
                })
                $('#title').change(function() {
                    loadCity($(this).find(':selected').val())
                })


            });

			function loadCountry() {
    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: "get=country"
    }).done(function(result) {
        $("#country").empty(); // Supprime les options existantes

        $(result).each(function() {
            $("#country").append($(this)); // Ajoute chaque option individuellement
        });
    });
}
            function loadState(countryId) {
                $("#title").children().remove()
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: "get=title&countryId=" + countryId
                }).done(function(result) {

                    $("#title").append($(result));

                });
            }

            // init the countries

            loadCountry();


</script>