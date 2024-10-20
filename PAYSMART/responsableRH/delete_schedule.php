<?php 

if(!isset($_GET['id'])){
    echo "<script> alert('Ce absence n'existe pas ID.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
$conn = mysqli_connect('localhost','root','','paysmart') or die('connection failed');
$delete = $conn->query("DELETE FROM `table_absence` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> alert('Ce absence supprimer avec succes.'); location.replace('./') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();

header("location:absence_calendrier.php");?>