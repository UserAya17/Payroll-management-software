<?php
    require_once ('connect.php');
	$id = $_GET['id'];
	$idfil = isset($_GET['idfil']) ? $_GET['idfil'] : '';
	if(isset($_GET['idfil']))
	{
		$DelSql1 = "DELETE FROM affectation WHERE idRub='$id' and idFiliale ='$idfil'";
		$res1 = $bd->query($DelSql1);
		if ($res1) 
			{
			header("Location: viewRubr.php");
			}
	}
	else {
		$DelSql1 = "DELETE FROM affectation WHERE idRub='$id'";
		$res1 = $bd->query($DelSql1);
		$DelSql2 = "DELETE FROM rubrique WHERE idRubrique='$id'";
		$res2 = $bd->query($DelSql2);
		if ($res1) 
		{
			if($res2) echo '<script>window.location.href = "rubriEnreprise.php";</script>';
			
		}
		else
		{
			echo "Failed to delete";
		}
	}
	
 ?>