<?php 

if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Erreur: rien a enregistrer.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);


$date1 = new DateTime($start_datetime);
$date2 = new DateTime($end_datetime);
$conn = mysqli_connect('localhost','root','','paysmart') or die('connection failed');

if ($date1 > $date2) {
    echo "<script> alert('Date de début supérieure à date de fin'); location.replace('./') </script>";
}
else{
if(empty($id)){
    $sql = "INSERT INTO `table_absence` (`title`,`description`,`start_datetime`,`end_datetime`,`dateAjout`) VALUES ('$title','$description','$start_datetime','$end_datetime',NOW())";
}else{
    $sql = "UPDATE `table_absence` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
}
$save = $conn->query($sql);
if($save){
    echo "<script> alert('Absence enregistrer avec succes'); location.replace('./') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();
}
header("location:absence_calendrier.php");?>
?>