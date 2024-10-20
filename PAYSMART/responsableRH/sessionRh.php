<?php
session_start();
if($_SESSION['auth'] != true || $_SESSION['type']!="rh")  header("location:../index.php");

?>