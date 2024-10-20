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
                         <input name="nom" type="text" id="input-username" class="form-control form-control-alternative" placeholder="prime">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label class="text-center1" for="input-first-name">Montant : </label>
                                                <input name="montant" type="number" id="input-first-name" class="form-control form-control-alternative" placeholder="montant">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label class="text-center1" for="input-first-name">Date :</label>
                                                <input name="date" type="date" id="input-first-name" class="form-control form-control-alternative" placeholder="@mail">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                      <label class="text-center1" for="input-first-name">Type  :</label>
                                                <select name="type" id="" class="form-control form-control-alternative">
                                                    <option value="0">prime non imposable</option>
                                                    <option value="1">prime imposable</option>
                                                </select>
                      </div>
                    </div>
                  </div>
                </div>
  </div>
          </div>
        
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <button class="button" name="ajouter" type="submit">Ajouter prime</button>&nbsp &nbsp &nbsp  <a href="consulterEntreprise.php"> <button class="button" type="button">Annuler</button></a>
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
ob_start(); // Start output buffering

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['ajouter'])) 
    {
        require('connect.php');
        // récupérer les données
        $nnn = $_POST['nom'];
        $ppp = $_POST['montant'];
        $ddd = $_POST['date'];
        $ttt = $_POST['type'];
        $r = $_POST['idUser'];
        // la requête d'insertion
        $req = "INSERT INTO prime (nom, montant, date, type,idUser) VALUES ('$nnn', '$ppp', '$ddd', '$ttt','$r')";
        // exécution de la requête
        $bd->exec($req);
    } 
}

ob_end_flush(); // End output buffering and send the output to the browser
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