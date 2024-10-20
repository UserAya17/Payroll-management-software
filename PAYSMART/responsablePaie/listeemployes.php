<?php
// require_once("session.php");
	require('connect.php');
    include 'menuRp.php';
	//include 'menu.php';
	$ReadSql = "SELECT DISTINCT * FROM contrat , utilisateur WHERE matricule=idUser";
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
                    <h2>Gestion de salaire :</h2><br>
                    <form action="" method="post">

                    <table>

                    <tr> <td>
   
        <select name="opt" class="form-control custom-select" id="CategorySelected">
        <option selected value="nom">nom</option>
                            <option selected value="prenom">prenom</option>
                            <option value="email">email</option>
                            <option value="matricule">matricule</option>
                            <option value="fl">nom filiale</option>
                            </select> &nbsp &nbsp
        </select></td>
        <td>
        <input type="text" name="search" required value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" class="form-control" placeholder="chercher par">
        </td><td>
        <button type="submit" class="button">Chercher</button>
        </td></tr>
                    </table>
</form>


<br><br><br><br>

   
                    <table class="table" style="color:black;">
                        <thead>
                        <tr>
                        <th>Photo </th>
					<th>Matricule</th>
					<th>Nom complet</th>
					<th>email</th>
					<th>Age</th>
					<th>genre</th>
                    <th>poste</th>
					<th>Actions</th>
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

if($selectedOption=='fl')
$query = "SELECT * FROM utilisateur WHERE matricule IN (SELECT idUser FROM contrat WHERE poste LIKE '%$filtervalues%'')";
else
$query = "SELECT * FROM utilisateur WHERE `$selectedOption` LIKE '%$filtervalues%'";
$query_run = mysqli_query($conn2, $query);

}else
{
    
$query = "SELECT * FROM utilisateur";
$query_run = mysqli_query($conn2, $query);
}

if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
            ?>
           <tr>
						
           <td> <?php if($r['image'] == '')
                                    echo "<img src='../responsableRH/images/"."user.png"."' width='50px' height='50px' style='border-radius: 200px'>";
	                            else
                                    echo "<img src='../responsableRH/images/".$r['image']."' width='50px' height='50px' style='border-radius: 200px'>";
?>
</td>
<td scope="row"><?php echo $r['matricule']; ?></td>
					<td><?php echo $r['prenom'] ." ". $r['nom']; ?></td>
					<td><?php echo $r['email']; ?></td>
					<td><?php echo $r['age']; ?></td>
					<td><?php echo $r['sexe']; ?></td>
                    <td>
                        <?php 
                     $mat=$r['matricule'];
                     $conn2 = mysqli_connect('localhost', 'root', '', 'paysmart') or die('connection failed');
                     $select2 = mysqli_query($conn2, "SELECT * FROM `contrat` WHERE idUser = '$mat'") or die('query failed');
                     if (mysqli_num_rows($select2) > 0) {
                     $fetch2 = mysqli_fetch_assoc($select2);
                     } 
                     echo $fetch2['poste'];
                     ?>
                     
                     </td>

                     <td>
						<a href="pageSalaire.php?matricule=<?php echo $r['matricule']; ?>" class="m-2">
                           <button type="button" class="button">Calculer Salaire</button>
						</a>
                        <a href="simulerSalaire.php?matricule=<?php echo $r['matricule']; ?>" class="m-2">
                        <button type="button" class="button">Simuler Salaire</button>
						</a>
						

						 
					</td>

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