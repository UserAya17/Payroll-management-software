<?php
	include("../fonctions.php");
	
	if(isset($_GET['id']))
		$ids=$_GET['id'];
	else
		$ids=0;
	

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>  Bulltin de paie </title> 
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	</head>				
	<body>
		<br><br><br>
		<div class="container col-md-6 col-md-offset-3">
			<h2>le document à imprimer</h2>
			<div class="panel panel-primary">
				<div class="panel-body text-center">
					
					
					
					<a class="btn btn-success" href="att_scolarite.php?ids=<?php echo $ids ?>">
						Attestation de Bulltin de paie en pdf
					</a>
					<br><br>
					<form method="post" action="../excell.php?ids=<?php echo $ids ?>">
     <input type="submit" name="export" class="btn btn-success" value="Exporter" />
    </form>

					
				
				</div>
			</div>			
		</div>
	</body>	
</html>
