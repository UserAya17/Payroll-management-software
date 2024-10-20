<?php
	require_once ('connect.php');
	include 'menu.php';
	$url = "$_SERVER[REQUEST_URI]";
$_SESSION['url'] = $url;
	$ReadSql = "SELECT * FROM `reclamation` where valider='en_cours' or valider='refuser' or valider='valider'";
    $res = $bd->query($ReadSql);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    $conn2 = mysqli_connect("localhost","root","","paysmart");
    
 ?>
 <link rel="stylesheet" href="../css/style_table.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<style>
   
    .table{
        color: black;
    }
    .table th
    {
	background-color: #0a5275;
	color:#ffffff;
}

</style>
<style>
    /* Styles pour le champ select */
    select.form-control {
        border-radius: 10px;
        background-color: #f5f5f5;
        border: none;
        padding: 8px;
        width: 200px;
        margin-right: 10px;
    }

    /* Styles pour le champ input */
    input.form-control {
        border-radius: 10px;
        background-color: #f5f5f5;
        border: none;
        padding: 8px;
        width: 200px;
        margin-right: 10px;
    }

    /* Styles pour le bouton */
    button.button {
        border-radius: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
    }

    button.button:hover {
        background-color: #0056b3;
    }
</style>



<br><br>
                    <h2>Reclamation :</h2><br>
                    <form action="" method="post">
   

    <table><tr>   <td>  <select name="opt" class="form-control custom-select" id="CategorySelected">
        <option selected value="dateReclamation">date Reclamation</option>
                            <option value="typeReclamation">type Reclamation</option>
                            <option value="idUser">matricule</option>
        </select></td> 
        <td> <input type="text" name="search" required value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" class="form-control" placeholder="chercher par"></td>  
        <td>   <button type="submit" class="button">Chercher</button></td> </tr></table>
</form>


<br><br><br><br>

   
                    <table class="table" style="color:black;">
                        <thead>
                        <tr>
						<th>typeReclamation</th>
					<th>reclamation</th>
					<th>dateReclamation</th>
					<th>etat</th>
					<th>commentaire</th>
                    <th>Matricule</th>
                    <th>envoyer par</th>
					<th>Actions</th>
                    <th>Transferer RP</th>
				</tr>
                        </thead>
                        <tbody>
                        <?php
if (isset($_POST['search'])) {
$filtervalues = $_POST['search'];
$selectedOption = $_POST["opt"];
echo $filtervalues . " " . $selectedOption;



// Establish the database connection
if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}

$filtervalues = mysqli_real_escape_string($conn2, $filtervalues);
$selectedOption = mysqli_real_escape_string($conn2, $selectedOption);

$query = "SELECT * FROM reclamation WHERE (valider='en_cours' or valider='refuser' or valider='valider') and `$selectedOption` LIKE '%$filtervalues%' ";
$query_run = mysqli_query($conn2, $query);

}else
{
    
$query = "SELECT * FROM reclamation where valider='en_cours' or valider='refuser' or valider='valider' ";
$query_run = mysqli_query($conn2, $query);
}
if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
            ?>
          <tr>
          <td scope="row"><?php echo $r['typeReclamation']; ?></td>
					<td><?php echo $r['reclamation']; ?></td>
					<td><?php echo $r['dateReclamation']; ?></td>
					<td><?php echo $r['valider']; ?></td>
					<td><?php echo $r['commentaire']; ?></td>
                    <td><?php echo $r['idUser']; ?></td>
                    <td>
                        <?php 
                     $mat=$r['idUser'];
                     $conn2 = mysqli_connect('localhost', 'root', '', 'paysmart') or die('connection failed');
                     $select2 = mysqli_query($conn2, "SELECT * FROM `utilisateur` WHERE matricule = '$mat'") or die('query failed');
                     if (mysqli_num_rows($select2) > 0) {
                     $fetch2 = mysqli_fetch_assoc($select2);
                     } 
                     echo $fetch2['nom']." ". $fetch2['prenom'];
                     ?>
                     
                     </td>
					<td>
                  <?php   if($r['valider']=="en_cours") {  ?>
						<a href="reclamation.php?id=<?php echo $r['idReclamation']; ?>" class="m-2">
                        <i class="fa fa-check fa-2x" style="color:blue"></i>
						</a>
                    <?php  }?>
					</td>

                    <td>   <?php   if($r['valider']=="en_cours") {  ?>
						<a href="transfereRp.php?id=<?php echo $r['idReclamation']; ?>" class="m-2">
                        <i class="fas fa-exchange-alt fa-2x" style="color:blue"></i>
						</a>
                    <?php  }?></td>
				</tr>
              
            <?php
       
    }} else {
        ?>
        <tr>
            <td colspan="9">Aucun résultat</td>
        </tr>
        <?php
    }
} else {
    echo "Error: " . mysqli_error($conn2);
}
?>

                        </tbody>
                    </table>
                    <br><br>
</body>
</html>