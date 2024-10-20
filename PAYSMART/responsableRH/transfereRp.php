<?php

$conn1 = mysqli_connect('localhost','root','','paysmart') or die('connection failed');
?>
<?php
    $idrec = $_GET['id'];
    $updateQuery = "UPDATE `reclamation` SET valider = 'encours rp' WHERE idReclamation = '$idrec'";
    $result = mysqli_query($conn1, $updateQuery);

    $req2 = "INSERT INTO notification(etat,envoyeur,type,recepteur) VALUES ('0','Q0979','reclamation', 'A1234')";
    $res2 = $conn1->query( $req2);

    header("location:consulterReclamation.php");
   ?>


