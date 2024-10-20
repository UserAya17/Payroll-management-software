<?php
	
	require('connect.php');
	$id = $_GET['matricule'];
	$DelSql = "DELETE FROM utilisateur WHERE matricule='$id'";

	$DelSql2 = "DELETE FROM contrat WHERE idUser='$id'";

	$res = $bd->query($DelSql);
	$res2 = $bd->query($DelSql2);
	if ($res) 
	{
		if($res2) header("Location: view.php");
	}else{
		echo "Failed to delete";
	}

 ?>