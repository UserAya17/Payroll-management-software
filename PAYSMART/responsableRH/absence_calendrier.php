<?php 

//require_once('db-connect.php');
include "menu.php";

$url = "$_SERVER[REQUEST_URI]";
$_SESSION['url'] = $url;
$_SESSION['this_page'] = $url;
$_SESSION['image_src']="user.png";
// $_SESSION['prenom']="Prenom"; 
// $_SESSION['nom']="a";
// $_SESSION['id_user']="103";
$bdd = new PDO("mysql:host=localhost;dbname=paysmart;charset=UTF8","root","");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    
    
    <style>

   
</style>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
           
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        .sidebar header{
            color: white;
            padding: 18px;
    margin: 0px;
        }

  .sidebar ul {
    padding: 0;
    margin: 0;
    list-style: none;
  }
  .sidebar ul li a {
  text-decoration: none;
}
.sidebar ul li a:hover {
    text-decoration: none;
}

  .nav_trsp ul li{
    font-size: 17px; 
  }


    </style>
</head>

<body class="bg-light">
    <br><br><br>
    <div class="container py-5" id="page-container">

        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Formulaire d'absence</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                
                                <label for="title" class="control-label">Filiale</label>
                                <select type="text" name="country" id="country" class="form-control form-control-sm rounded-0">
                                    <option>Choisir filiale</option>
                                </select>

                                    <label for="title" class="control-label">Matricule</label>
                                    <!-- <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required> -->
                                <select type="text" id="title" name="title" class="form-control form-control-sm rounded-0" ></select>
                               
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Justification</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description"></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Date debut</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">Date Fin</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Enregistrer</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i>Annuler</button>
                        </div>
                    </div>
                    
                    
                </div>
                <br>
            &nbsp &nbsp &nbsp &nbsp &nbsp  <a href="consulter_Absence.php" class="btn btn-primary btn-sm rounded-0">Absence sous forme tableau</a>
            <br>
        
            <br><br>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Absence Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Matricule</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Justification</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Date debut</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Date Fin</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Modifier</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Supprimer</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
              
            </div>
        </div>
      
    </div>

    
    <!-- Event Details Modal -->

<?php 
$conn = mysqli_connect('localhost','root','','paysmart') or die('connection failed');
$schedules = $conn->query("SELECT * FROM `table_absence`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
?>
<?php 
if(isset($conn)) $conn->close();
?>


<style>
    
</style>

</body>
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
</html>