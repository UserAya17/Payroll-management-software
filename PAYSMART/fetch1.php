
<?php 
//connect.php;
$connect = mysqli_connect("localhost", "root", "", "paysmart");
?>


<?php
//fetch.php;
session_start();
$mat=$_SESSION['matricule'];
if(isset($_POST["view"]))
{

 if($_POST["view"] != '')
 {
  $update_query = "UPDATE notification SET etat=1 WHERE etat=0 and recepteur='$mat'";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT * FROM notification where recepteur='$mat' ORDER BY idNotification DESC LIMIT 3";
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {


    $mat=$row["envoyeur"];
                     $conn2 = mysqli_connect('localhost', 'root', '', 'paysmart') or die('connection failed');
                     $select2 = mysqli_query($conn2, "SELECT * FROM `utilisateur` WHERE matricule = '$mat'") or die('query failed');
                     if (mysqli_num_rows($select2) > 0) {
                     $fetch2 = mysqli_fetch_assoc($select2);
                     } 
                   

   $output .= '
   <li>
    <a href="#">
     <strong>'.$row['type'].'</strong><br />
     <small><em>'.$fetch2['nom']." ". $fetch2['prenom'].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">Aucune notification trouvée</a></li>';
 }
 
 $query_1 = "SELECT * FROM notification WHERE etat=0 and recepteur='$mat'";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>