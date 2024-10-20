<?php
	require_once ('../connect.php');
    include 'menuRp.php';
	//include '../responsableRH/menu.php';
	$url = "$_SERVER[REQUEST_URI]";
$_SESSION['url'] = $url;
	$ReadSql = "SELECT * FROM `filiale` ";
    $res = $bd->query($ReadSql);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    $conn2 = mysqli_connect("localhost","root","","paysmart");
    
 ?>
 <html>
    <head>
 <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    

<div class="container">
    <div class="row pt-4">
		<!-- <a href="ajouter_entreprise.php">
			<button class="btn btn-primary" type="">Ajouter Rubrique</button>
		</a> -->
	</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header"> <h4>Filiales :</h4></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <form action="" method="post">
                                    <div class="input-group mb-3">
                                        <select name="opt" class="form-control" class="custom-select" id="CategorySelected">
                                            <option selected value="nomFliale">nom</option>
                                            <option value="emailFiliale">email</option>
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
					<th>nomFliale</th>
					<th>adresseFiliale</th>
					<th>emailFiliale</th>
					<th>telFiliale</th>
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
					<th scope="row"><?php echo $r['nomFliale']; ?></th>
					<td><?php echo $r['adresseFiliale']; ?></td>
					<td><?php echo $r['emailFiliale']; ?></td>
					<td><?php echo $r['telFiliale']; ?></td>
					<td>
                        <a href="listeemployes.php?id=<?php echo $r['idFiliale']; ?>" class="m-2">
                        <i class="fa fa-trash fa-2x red-icon"></i>
						</a>
						
						
                        
			
					</td>
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