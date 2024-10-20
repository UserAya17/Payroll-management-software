
<?php
	require_once ('connect.php');
	include 'menuEmploye.php';
	$url = "$_SERVER[REQUEST_URI]";
$_SESSION['url'] = $url;
    $mat=$_SESSION['matricule'];
    $conn2 = mysqli_connect("localhost","root","","paysmart");
 ?>
<title>Funda Of Web IT</title>

<br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Conge :</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">

                            <form action="" method="post">
                            <div class="input-group mb-3">
                            <select name="opt" class="form-control" class="custom-select" id="CategorySelected">
                            <option selected value="start_datetime">Debut date</option>
                            <option value="dateDemande">date Demande</option>
                            <option value="end_datetime">Fin date</option>
                            </select> &nbsp &nbsp
                                
                                    <input type="text" name="search" required value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>" class="form-control" placeholder="chercher par">
                                    <div class="input-group-append">

<!-- <button id="SearchBtn" class="btn btn-outline-primary ml-1" type="button">chercher</button> -->
</div>
                                    
                                    
                                    <button type="submit" class="btn btn-primary">Chercher</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>dateDebut</th>
					<th>dateFin</th>
					<th>dureeConge</th>
					<th>type</th>
					<th>etat</th>
					<th>dateDemande</th>
					<th>commentaire</th>
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

$query = "SELECT * FROM conge WHERE `$selectedOption` LIKE '%$filtervalues%' and idUser='$mat'";
$query_run = mysqli_query($conn2, $query);

}else
{
    
$query = "SELECT * FROM conge  WHERE idUser='$mat'";
$query_run = mysqli_query($conn2, $query);
}

if ($query_run) {
    $num_rows = mysqli_num_rows($query_run);
    if ($num_rows > 0) {
        while ($r = mysqli_fetch_assoc($query_run)) {
            ?>
           <tr>
					<th scope="row"><?php echo $r['start_datetime']; ?></th>
					<td><?php echo $r['end_datetime']; ?></td>
					<td><?php echo $r['dureeConge']; ?></td>
					<td><?php 
                    
                    if($r['type']==1)
                    echo "paye";
                    else echo "non paye"; 
                    ?></td>
					<td><?php echo $r['valide']; ?></td>
					<td><?php echo $r['dateDemande']; ?></td>
					<td><?php echo $r['description']; ?></td>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>