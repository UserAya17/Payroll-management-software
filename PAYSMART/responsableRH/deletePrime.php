<?php

    require_once ('connect.php');

	$id = $_GET['id'];
	$DelSql = "DELETE FROM prime WHERE idprime='$id'";

	$res = $bd->query($DelSql);
    echo $id;
	if ($res) {
		header("Location: PrimeRp.php");
	}else{
		echo "Failed to delete";
	}

 ?>