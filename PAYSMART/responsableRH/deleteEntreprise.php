<?php
    require_once ('connect.php');
    session_start();
	$id = $_GET['id'];
	$req = $bd->prepare("SELECT idFiliale FROM contrat WHERE idFiliale = :l");
	$req->bindValue("l", $id, PDO::PARAM_STR);
    $req->execute();
	echo $req->rowCount();
	if(!$req->rowCount())  
	{
		$DelSql = "DELETE FROM filiale WHERE idFiliale='$id'";
		$res = $bd->query($DelSql);
		$_SESSION['delete'] = 1;
	}
	header("Location: consulterEntreprise.php");

 ?>