<?php
	require_once ('../connect.php');
	//include '../session.php';
   
    include 'menuRp.php';
	$url = "$_SERVER[REQUEST_URI]";
    $_SESSION['url'] = $url;
	$ReadSql = "SELECT * FROM `filiale` ";
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

                    <table>

                    <tr> <td>
   
        <select name="opt" class="form-control custom-select" id="CategorySelected">
       <option selected value="nomFliale">nom</option>
                                            <option value="emailFiliale">email</option>
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
                        <th>nomFliale</th>
					<th>adresseFiliale</th>
					<th>emailFiliale</th>
					<th>telFiliale</th>
					<th>les rubrique</th>
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
    
    $query = "SELECT * FROM filiale WHERE `$selectedOption` LIKE '%$filtervalues%'";
    $query_run = mysqli_query($conn2, $query);
    
    }else
    {
        
    $query = "SELECT * FROM filiale";
    $query_run = mysqli_query($conn2, $query);
    }
if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
            ?>
           <tr>
           <td scope="row"><?php echo $r['nomFliale']; ?></td>
					<td><?php echo $r['adresseFiliale']; ?></td>
					<td><?php echo $r['emailFiliale']; ?></td>
					<td><?php echo $r['telFiliale']; ?></td>
					<td>
                        <a href="rubriEnreprise.php?id=<?php echo $r['idFiliale']; ?>" class="m-2">
                        <i class="fa fa-info-circle fa-2x red-icon"></i>
						</a>
					</td>

				</tr>
              
            <?php
       
    }} else {
        ?>
        <tr>
            <td colspan="5">Aucun résultat</td>
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