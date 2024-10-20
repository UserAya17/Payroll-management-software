<?php
session_start();

if($_SESSION['auth']!=true)
header("location:../index.php");
?>