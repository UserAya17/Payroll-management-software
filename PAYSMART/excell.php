<?php  
session_start();

$mois=$_SESSION['m'];
$annee=$_SESSION['a'];
//export.php  
$connect = mysqli_connect("localhost", "root", "", "paysmart");
$output = '';
if(isset($_POST["export"]))
{


//$pdo = new PDO("mysql:host=localhost;dbname=ecoledb", "root", "");

if (isset($_GET['ids'])) {
    $matricule = $_GET['ids'];
  } else {
    $matricule = 1;
  }
  
  $matricule = 'Q0979';
  $select2 = mysqli_query($connect, "SELECT * FROM `utilisateur` WHERE matricule = '$matricule'") or die('query failed');
  if (mysqli_num_rows($select2) > 0) {
  $user = mysqli_fetch_assoc($select2);
  } 
  
  $select2 = mysqli_query($connect, "SELECT * FROM `contrat` WHERE idUser = '$matricule'") or die('query failed');
  if (mysqli_num_rows($select2) > 0) {
  $contrat= mysqli_fetch_assoc($select2);
  } 

  
  $salaireDeBase = $contrat['salaireDeBase'];
  $idfiliale = $contrat['idFiliale'];
  
  $select2 = mysqli_query($connect, "SELECT * FROM filiale WHERE idFiliale = '$idfiliale'") or die('query failed');
  if (mysqli_num_rows($select2) > 0) {
  $filiale= mysqli_fetch_assoc($select2);
  } 

  $query = "SELECT * FROM bulltin WHERE matricule='$matricule' && MONTH(date)=$mois && YEAR(date)=$annee ";
  $result = $connect->query($query);
  
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                    <th >matricule</th>
                    <th >Nom de Filiale</th>
                    <th >Nom de l\'employe</th>
                    <th >dateAjout</th>
                    
                    <th>date</th>
                    <th>CIMR</th>
                 
                    <th>SALAIRE DE BASE</th>
                    <th>CNSS</th>
                    <th>AMO</th>
                    <th>IGR</th> 
                    <th>ABSENCE</th>
                    <th>SALAIRENET</th>
                    <th>CONGE</th>
                    <th>HS</th>
                    <th>ALLOCATION</th>
      
                    </tr>
  ';
  $row = mysqli_fetch_array($result);
  
   $output .= '
    <tr>  
       <td>'.$row['matricule'].'</td>
       <td>'.$filiale['nomFliale'].'</td>
       <td>'.$user['nom']." ".$user['prenom'].'</td>
                    <td >'.$row['dateAjout'].'</td>
                    
                    <td>'.$row['date'].'</td>
                    <td>'.$row['CIMR'].'</td>
                 
                    <td>'.$salaireDeBase.'</td>
                    <td>'.$row['CNSS'].'</td>
                    <td>'.$row['AMO'].'</td>
                    <td>'.$row['IGR'].'</td> 
                    <td>'.$row['ABSENCE'].'</td>
                    <td>'.$row['SALAIRENET'].'</td>
                    <td>'.$row['CONGE'].'</td>
                    <td>'.$row['HS'].'</td>
                    <td>'.$row['ALLOCATION'].'</td>



                    </tr>
   ';
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=BulletinDePaie.xls');
  echo $output;
 }
}
?>