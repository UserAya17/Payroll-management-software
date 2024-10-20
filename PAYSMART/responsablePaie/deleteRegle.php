<?php
    require_once ('connect.php');
	$id = $_GET['id'];
	$DelSql1 = "DELETE FROM affectation WHERE idRegle='$id'";
	$res1 = $bd->query($DelSql1);

    $DelSql3 = "DELETE FROM condition_regle WHERE idRegle='$id'";
	$res3 = $bd->query($DelSql3);

	$DelSql2 = "DELETE FROM regle WHERE idRegle='$id'";
	$res2 = $bd->query($DelSql2);
	if ($res1) 
	{
		if($res2)  header("Location: gestionRegle.php");
	}
	else
	{
		echo "Failed to delete";
	}
 ?>