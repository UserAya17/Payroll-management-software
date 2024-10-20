<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "paysmart";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:');
        }
?>

<?php


$countryId = isset($_POST['countryId']) ? $_POST['countryId'] : 0;
$stateId = isset($_POST['stateId']) ? $_POST['stateId'] : 0;
$command = isset($_POST['get']) ? $_POST['get'] : "";

switch ($command) {
    case "country":
        $statement = "SELECT * FROM filiale";
        $dt = mysqli_query($conn, $statement);
        while ($result = mysqli_fetch_array($dt)) {
            echo $result1 = "<option value=" . $result['idFiliale'] . ">" . $result['nomFliale'] . "</option>";
        }
        break;

    case "title":
        $result1 = "<option>choisir matricule</option>";
        $statement = "SELECT matricule FROM utilisateur WHERE matricule in (select idUser from contrat where idFiliale='$countryId')";
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['matricule'] . ">" . $result['matricule'] . "</option>";
        }
        echo $result1;
        break;

}

exit();
?>