<?php 


include "menu.php";
$url = "$_SERVER[REQUEST_URI]";
$_SESSION['url'] = $url;
// $_SESSION['image_src']="user.png";
// $_SESSION['prenom']="Prenom"; 
// $_SESSION['nom']="a";
// $_SESSION['id_user']="103";
$con = mysqli_connect('localhost','root','','paysmart') or die('connection failed');
?>

<style>
    .box_number{
  /* overflow:auto; */
  width: 220px;
  height: 200px;
  background-color: white;
  padding: 20px;
  /* margin: 30px auto; */
  border-style: solid;
  border-color: #0a5275;

  border-width: 4px;
   /* is the ta9am9om if its just 2 value is the first value for the 1 and the 3 and the second for the 2 and 4 */
   border-radius: 40px;
   box-shadow: 1px 1px 15px #0a5275;
   right:0;
   z-index: 30;
}

  .op{
    z-index: 0;
  }
</style>


    <!-- Custom CSS -->
 
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/styles_home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

  </head>
  <body>
    <div class="grid-container">
      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
        </div>
        <style>
        .size1 {
  font-size: 34px; /* Changer la taille de l'icône en pixels selon vos besoins */
}
</style>
        <div class="main-cards">

          <div class="card" style="background-color: #1772b7;">
            <div class="card-inner">
              <h3>Reclamation dans ce mois</h3>
              <span class="fas fa-exclamation-circle size1"></span>
            </div><h1>
            <?php
$moisCourant = date('m');
$anneeCourante = date('Y');
// echo " ".$moisCourant ." ". $anneeCourante." ";

$sql5 = "SELECT * FROM reclamation WHERE MONTH(dateReclamation) = '$moisCourant' AND YEAR(dateReclamation) = '$anneeCourante'";
$result5 = mysqli_query($con, $sql5);

if ($result5) {
    $rowcount5 = mysqli_num_rows($result5);
    if ($rowcount5 > 0) {
        echo $rowcount5;
    } else {
        echo "0";
    }
} else {
    echo "Erreur lors de l'exécution de la requête.";
}
?></h1>
          </div>

          <div class="card" style="background-color: #1772b7;">
            <div class="card-inner">
              <h3>Nombre des filiales</h3>
              <span class="fas fa-building size1"></span>
            </div>
            <h1>
            <?php

$sql5 = "SELECT * FROM filiale";
$result5 = mysqli_query($con, $sql5);

if ($result5) {
    $rowcount6 = mysqli_num_rows($result5);
    if ($rowcount6 > 0) {
        echo $rowcount6;
    } else {
        echo "0";
    }
} else {
    echo "Erreur lors de l'exécution de la requête.";
}
?></h1>
          </div>

          <div class="card" style="background-color: #1772b7;">
            <div class="card-inner">
              <h3>Nombre des employes</h3>
              <span class="fas fa-users size1"></span>
            </div>
            <h1>            <?php

$sql5 = "SELECT * FROM utilisateur";
$result5 = mysqli_query($con, $sql5);

if ($result5) {
    $rowcount7 = mysqli_num_rows($result5);
    if ($rowcount7 > 0) {
        echo $rowcount7;
    } else {
        echo "0";
    }
} else {
    echo "Erreur lors de l'exécution de la requête.";
}?></h1>
          </div>

          <div class="card" style="background-color: #1772b7;">
            <div class="card-inner">
              <h3>Nombre des conges dans ce mois</h3>
              <span class="fas fa-calendar-check size1"></span>
            </div>
            <h1> <?php
$moisCourant = date('m');
$anneeCourante = date('Y');
// echo " ".$moisCourant ." ". $anneeCourante." ";

$sql5 = "SELECT * FROM conge WHERE MONTH(start_datetime) = '$moisCourant' AND YEAR(start_datetime) = '$anneeCourante' or MONTH(end_datetime) = '$moisCourant' AND YEAR(end_datetime) = '$anneeCourante' ";
$result5 = mysqli_query($con, $sql5);

if ($result5) {
    $rowcount8 = mysqli_num_rows($result5);
    if ($rowcount8 > 0) {
        echo $rowcount8;
    } else {
        echo "0";
    }
} else {
    echo "Erreur lors de l'exécution de la requête.";
}
?></h1>
          </div>

        </div>

        <div class="charts">

          <div >
            <!-- <h2 class="chart-title">pourcentage des employes selon leur poste</h2> -->

            <?php
               
                 $query = "SELECT poste, count(*) as number FROM contrat  GROUP BY poste";  
                 $result = mysqli_query($con, $query);  
                ?>
            <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['poste', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["poste"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: "Pourcentage des employes selon leur poste",  
                      is3D:true,  
                      titleTextStyle: {
    fontSize: 24 // Changer la taille du titre en pixels selon vos besoins
  },  
                      pieHole: 0  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>  
               <div style="width:500px;">  
                <!-- <h3 >Make Simple Pie Chart by Google Chart API with PHP Mysql</h3>   -->
                <br />  
                <div id="piechart" style="width: 600px; height: 500px;"></div>  
           </div>  
         
          </div>

          <div >
          <!-- <h2 class="chart-title">JGJGJGJ</h2> -->
          <?php
            $query = "SELECT typeContrat, count(*) as number FROM contrat  GROUP BY typeContrat";  
            $result = mysqli_query($con, $query);  
            ?>
            <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['typeContrat', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["typeContrat"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: "Pourcentage des contrats",
                      titleTextStyle: {
    fontSize: 24 // Changer la taille du titre en pixels selon vos besoins
  },  
                      is3D:true,  
                      pieHole: 0
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));  
                chart.draw(data, options);  
           }  
           </script>  
           
           <div style="width:500px;">  
                <!-- <h3 >Make Simple Pie Chart by Google Chart API with PHP Mysql</h3>   -->
                <br />  
                <div id="piechart2" style="width: 600px; height: 500px;"></div>  
           </div> 
          </div>

        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->

    <style>
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
  </body>
</html>