<?php
	require('connect.php');
	include 'menu.php';
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
                    <h2>Filiales :</h2><br>
                    <form action="" method="post">
                    <table><tr>   <td>
        <select name="opt" class="form-control custom-select" id="CategorySelected">
        <option selected value="nom">nom</option>
                            <option selected value="prenom">prenom</option>
                            <option value="email">email</option>
                            <option value="matricule">matricule</option>
                            <option value="fl">nom filiale</option>
        </select></td> <td>
        <input type="text" name="search" required value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" class="form-control" placeholder="chercher par">
       </td> <td><button type="submit" class="button">Chercher</button></td>  <td>
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp <a href="consult.php" class="button">Ajouter un employe</a>
       </td> </tr></table>
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



if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
}

$filtervalues = mysqli_real_escape_string($conn2, $filtervalues);
$selectedOption = mysqli_real_escape_string($conn2, $selectedOption);

if($selectedOption=='fl')
$query = "SELECT * FROM utilisateur WHERE  matricule not IN (SELECT idUser FROM contrat WHERE poste ='RH' or poste='RP' ) and matricule IN (SELECT idUser FROM contrat WHERE poste LIKE '%$filtervalues%'')";
else
$query = "SELECT * FROM utilisateur WHERE  matricule not IN (SELECT idUser FROM contrat WHERE poste ='RH' or poste='RP' ) and `$selectedOption` LIKE '%$filtervalues%'";
$query_run = mysqli_query($conn2, $query);

}else
{
    
$query = "SELECT * FROM utilisateur where matricule not IN (SELECT idUser FROM contrat WHERE poste ='RH' or poste='RP' )";
$query_run = mysqli_query($conn2, $query);
}

if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
            ?>
          <tr>
          <td> <?php if($r['image'] == '')
                                    echo "<img src='images/"."user.png"."' width='50px' height='50px' style='border-radius: 200px'>";
	                            else
                                    echo "<img src='images/".$r['image']."' width='50px' height='50px' style='border-radius: 200px'>";
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
                    <a href="update.php?matricule=<?php echo  $r['matricule']; ?>&filiale=<?php echo $fetch2['idFiliale']; ?>" class="m-2">
        <i class="fa fa-edit fa-2x" style="color:blue"></i>
    </a>





    <i class="fa fa-trash fa-2x red-icon"
   onclick="showConfirmationModal('<?php echo $r['matricule']; ?>')"></i>

<div class="confirmation-alert" id="confirmationModal<?php echo  $r['matricule']; ?>" style="color:white;background: #0a5275">
   <p>Etes vous sûr de vouloir supprimer l'employe de matricule <?php echo $r['matricule']; ?> ?</p>
   <div class="btn-wrapper">
      <button class="button" onclick="hideConfirmationModal('<?php echo $r['matricule']; ?>')">Annuler</button>
      <a href="delete.php?matricule=<?php echo $r['matricule'];?>">
         <button class="button">Confirmer</button>
      </a>
   </div>
</div>

</td>
<style>
    .confirmation-alert {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .confirmation-alert p {
        margin: 0;
        font-size: 16px;
        text-align: center;
    }

    .confirmation-alert .btn-wrapper {
        margin-top: 20px;
        text-align: center;
    }

    .confirmation-alert .btn-wrapper button {
        margin-right: 10px;
    }
</style>
<script>
    function showConfirmationModal(id) {
        const modalId = `#confirmationModal${id}`;
        const modal = document.querySelector(modalId);
        modal.style.display = 'block';
    }

    function hideConfirmationModal(id) {
        const modalId = `#confirmationModal${id}`;
        const modal = document.querySelector(modalId);
        modal.style.display = 'none';
    }
</script>

				</tr>
            <?php
       
    }} else {
        ?>
        <tr>
            <td colspan="4">Aucun résultat</td>
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