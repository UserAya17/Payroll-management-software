<?php
    require_once("../connect.php");
	include 'menuRp.php';
	if(isset($_POST['ajouter']))
    {
		
		if(isset($_POST['nom']))
		{
            $nom = $_POST['nom'];
            $CreateSql = "INSERT INTO `rubrique` (nomRubrique)  VALUES('$nom') ";
		$res1 = $bd->query( $CreateSql);

		if ($res1) 
        {
            $message = "insertion reussi avec succès";
            //header("location:viewRubr.php");
			echo '<script>window.location.href = "viewRubr.php";</script>';
		}
		else
        {
			$erreur = "erreur d'insertion a la base";
		}
        }
	}
	


?>


<!DOCTYPE html>
<html>
<head>
	<title>Ajouter Rubrique</title>
	<link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css" >
	<style>
		.form-required{
			color:red;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row pt-4">
			<?php if (isset($message)) { ?>
				<div class="alert alert-success" role="alert">
					<?php echo $message; ?>
				</div> <?php } ?>

				<?php if (isset($erreur)) { ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $erreur; ?>
				</div> <?php } ?>

			<form action="" method="POST" enctype="multipart/form-data">
				<h2>Ajouter</h2>
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Nom <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="nom" placeholder="Nom" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="pt-4">
				<a href="view.php">
						<button class="btn btn-success m-3" type="button">
							Retour
						</button>
					</a>
				
					<input type="submit" value="Ajouter" name="ajouter" class="btn btn-primary m-3">
				
					
					
				</div>
			</form>
		</div>
	</div>


</body>
</html>
