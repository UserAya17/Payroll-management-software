<?php 

//require_once('db-connect.php');
include "menu.php";
$url = "$_SERVER[REQUEST_URI]";
$_SESSION['url'] = $url;
$_SESSION['this_page'] = $url;
$_SESSION['image_src']="user.png";
$_SESSION['prenom']="Prenom"; 
$_SESSION['nom']="a";
$_SESSION['id_user']="103";
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
                <div >
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
                <center><a href="consulterDemandeConge.php"><button class="button">Valide conge</button></a></center>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Conge Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <!-- <dt class="text-muted">Titre</dt>
                            <dd id="title" class="fw-bold fs-4"></dd> -->
                            <dt class="text-muted">Commentaire</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Date Debut</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Date Fin</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
              
            </div>
        </div>
      
    </div>

    
    <!-- Event Details Modal -->

<?php 
$conn = mysqli_connect('localhost','root','','paysmart') or die('connection failed');
$schedules = $conn->query("SELECT * FROM `conge` where valide ='valider'");
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
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

</html>