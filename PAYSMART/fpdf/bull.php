<?php
// require_once("session.php");

    include '../responsablePaie/menuRp.php';
try
{
    $bd = new PDO('mysql:host=localhost;dbname=paysmart;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
	//include 'menuRp.php';
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
                            <option value="matricule">matricule</option>
                            <option value="date">date</option>
                            <option value="fl">filiale</option>
        </select></td> <td>
        <input type="text" name="search" value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" class="form-control" placeholder="chercher par">
       </td> <td><button type="submit" class="button">Chercher</button></td>  <td>
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       </td> </tr></table>
</form>


<br><br><br><br>

   
                    <table class="table" style="color:black;">
                        <thead>
                        <tr>
					<th>Matricule</th>
                    <th>date de bulltin</th>
                    <th>date d'ajout</th>
					<th>bulltin</th>
					
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
$query = "SELECT * FROM bulltin WHERE matricule IN (SELECT idUser FROM contrat WHERE poste LIKE '%$filtervalues%'')";
else

$query = "SELECT * FROM bulltin where `$selectedOption` LIKE '%$filtervalues%'";
$query_run = mysqli_query($conn2, $query);

}else
{
    
$query = "SELECT * FROM bulltin ";
$query_run = mysqli_query($conn2, $query);
}

if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
            ?>
          <tr>
					<td scope="row"><?php echo $r['matricule']; ?></td>
                    <td scope="row"><?php echo $r['date']; ?></td>
                    <td scope="row"><?php echo $r['dateAjout']; ?></td>
                    <td>
                    <a class="button" href="att_scolarite1.php?ids=<?php echo $r['matricule'] ?>&m=<?php echo date('m', strtotime($r['date'])) ?>&a=<?php echo date('Y', strtotime($r['date'])) ?>">
  
                    <button class="button"> pdf</button>
</a>
<a class="button" href="../excel1.php?id=<?php echo $r['matricule'] ?>&m=<?php echo date('m', strtotime($r['date'])) ?>&a=<?php echo date('Y', strtotime($r['date'])) ?>">
  
  <button class="button"> Excel</button>
</a>

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