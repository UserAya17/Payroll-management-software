<?php
//require_once("session.php");
require('connect.php');
include 'menuRp.php';
$matricule="Q0979";
//$matricule=$_GET['id'];
$_SESSION['mat']=$matricule;
?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="../css/style_profile.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<style>
  .nav_trsp ul li{
    font-size: 17px; 
  }
</style>
<form action="calculerSalaire.php" method="post">
  <br><br>
                <h6 class="text-muted">Informations de l'utilisateur</h6>
                <div class="pl-lg-4">
                <div class="row">
                <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name" >Mois</label>
                        <input type="number" name="m"  class="form-control form-control-alternative" placeholder="Mois" >
                      </div>
                </div>
               <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name">Annee</label>
                        <input type="number" name="a"  class="form-control form-control-alternative" placeholder="Annees" >
                      </div>
                </div>
                    </div>
                    </div>
                    <hr class="my-4">
                <input class="button" type="submit" name="submit" value="Calculer" ">&nbsp &nbsp &nbsp<button class="button">Annuler</button>
               <br><br><br><br>
            </form>