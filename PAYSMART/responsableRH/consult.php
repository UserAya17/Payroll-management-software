<?php
    // require_once("session.php");
	
    try {
        $bd = new PDO('mysql:host=localhost;dbname=paysmart;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
	include "menu.php";

    $ReadSql = "SELECT * FROM `filiale`";
    $req = $bd->query($ReadSql);
    
    if ($req === false) {
        die('Erreur lors de l\'exécution de la requête.');
    }
    
    $rows = $req->fetchAll(PDO::FETCH_ASSOC);
	


?>


<!DOCTYPE html>
<html>
<head>
	<title>Ajouter Employe</title>
	<link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/style.css" >
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

			<form action="ajouterInfosPersonnel.php" method="POST" enctype="multipart/form-data">
				<h2>Ajouter</h2>
				
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Filiale <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						
						<select name="filiale" class="form-control" id="input1" required>
							<option value="">--Selectionnez--</option>
						<?php foreach($rows as $row): ?>

                            <option value="<?php echo $row['nomFliale'] ?>"><?php echo $row['nomFliale'] ?></option>
                		<?php endforeach; ?>
						</select>
					</div>
				</div>

                <div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Matricule <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="matricule" placeholder="Matricule" class="form-control" id="input1" required>
					</div>
				</div>
				<label >Photo matricule:</label><br>
         <input type="file" name="image" ><br>
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Nom <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="nom" placeholder="Nom" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Prenom <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="prenom" placeholder="prenom" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">CIN <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="cin" placeholder="CIN" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Email <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="email" name="email" placeholder="e-mail" class="form-control" id="input1" required>
					</div>
				</div>

                <div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Date de Naissance <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="date" name="dateNaissance" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Numero de telephone <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="telephone" placeholder="Numero du telephone portable" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Numero du Compte bancaire <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="rib" placeholder="RIB" class="form-control" id="input1" required>
					</div>
				</div>
                
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Sexe <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<label>
							<input type="radio" name="gender" id="optionsRadios" value="h" checked>
							H
						</label>
						<label>
							<input type="radio" name="gender" id="optionsRadios" value="f" checked>
							F
						</label>
					</div>
				</div>

				<div class="pt-4">
				<a href="view.php">
						<button class="btn btn-success m-3" type="button">
							Retour
						</button>
					</a>
				
					<input type="submit" value="Suivant" name="suivant1" class="btn btn-primary m-3">
				
					
					
				</div>
			</form>
		</div>
	</div>


</body>
</html>
