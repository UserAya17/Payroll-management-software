<?php
session_start();

if($_SESSION['auth']!=true || $_SESSION['type']!="rp")
header("location:../index.php");

?>