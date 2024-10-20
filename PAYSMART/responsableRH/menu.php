<?php  
include "sessionRh.php";

?>  
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Espace RH</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="../css/menu.css">
  </head>
  <body>

    <input type="checkbox" id="check" checked>
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
    <header><a href="profile.php">   
    <?php  
  if($_SESSION['image']=='')
  echo "<img src='../responsableRH/images/user.png' width='100px' height='100px' style='border-radius: 200px'>";
  else
  echo "<img src='../responsableRH/images/" . $_SESSION['image'] . "' width='100px' height='100px' style='border-radius: 200px'>";
?>
    <br>
    <?php
    echo $_SESSION['prenom1']." ".$_SESSION['nom1'];
    ?>
  </header>
    <ul>
     <li><a href="rh_home.php"><i class="fas fa-home"></i></i>Page d'acceuil</a></li>
     <li><a href="consulterEntreprise.php"><i class="fas fa-building"></i>Gestion entreprise</a></li>
     <li><a href="view.php"><i class="fas fa-users"></i>Gestion employe</a></li>
     <li><a href="absence_calendrier.php"><i class="fas fa-calendar-minus"></i>Gestion d'absence</a></li>
     <li><a href="consulterReclamation.php"><i class="fas fa-exclamation-circle"></i>Reclamation</a></li>
     <li><a href="conge_calendrier.php"><i class="fas fa-calendar-check"></i>Congés</a></li>
     <li><a href="consulterHS.php"><i class="fas fa-stopwatch"></i>Heures supp</a></li>
     <li><a href="PrimeRp.php"><i class="fas fa-exclamation-circle"></i>Primes</a></li>
    </ul>
   </div>
    <nav class="nav_trsp">
        <ul>
        <ul class="nav navbar-nav">
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:1px;"></span> <span class="fas fa-bell icon_size" style="font-size:28px;"></span></a>
       <ul class="dropdown-menu"></ul>
      </li>
     </ul>
            <!-- <li><a href="#">Discover</a></li> -->
            <li><a href="../employe/demandeConge.php">Mon Espace</a></li>
            <li><a href="../deconnexion.php"><i class="fas fa-sign-out-alt icon_size"></i></a></li>
        </ul>
    </nav>
   
   <section>
 
<style>
*{
  padding: 0;
  margin: 0;
  list-style: none;
  text-decoration: none;
}
.nav_trsp {
  top: 0; /* Ajoutez cette ligne pour positionner le menu en haut de la page */
  left: 0; /* Ajoutez cette ligne pour aligner le menu à gauche de la page */
  margin: 0; /* Ajoutez cette ligne pour supprimer les marges */
}

.nav_trsp ul {
  float: right;
  margin: 0; /* Ajoutez cette ligne pour supprimer les marges */
  font-weight: bold;
}

@import url('https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500');
*{
  padding: 0;
  margin: 0;
  list-style: none;
  text-decoration: none;
 
}

/* menu----------------------------------------------------------------- */


  .nav_trsp{
    width: 100%;
    height: 50px;
    background-color: #0005;
    line-height: 50px;
    position: fixed;
    z-index: 40;
  }
  .nav_trsp ul{
    float: right;
    margin-right: 100px;
    font-weight: bold;
  }
  .nav_trsp ul li{
    list-style-type: none;
    display: inline-block;
    transition: 0.7s all;
    font-size: 20px; 
  }
  .nav_trsp ul li:hover{
    background-color:#0a5275;
  }
  .nav_trsp ul li a{
    text-decoration: none;
    color:#063146;
    padding: 30px;
  }
  .icon_size
  {
    font-size: 30px;
  }



/* sidebar----------------------------------------------------------------- */
body {
  font-family: 'Roboto', sans-serif;
}
.sidebar {
  z-index: 50;
  position: fixed;
  left: -250px;
  width: 250px;
  height: 100%;
  background: #042331;
  transition: all .5s ease;
}
.sidebar header {
  font-size: 22px;
  color: white;
  line-height: 70px;
  text-align: center;
  background: #063146;
  user-select: none;
}
.sidebar ul a{
  display: block;
  height: 100%;
  width: 100%;
  line-height: 65px;
  font-size: 15px;
  color: white;
  padding-left: 40px;
  box-sizing: border-box;
  border-bottom: 1px solid black;
  border-top: 1px solid rgba(255,255,255,.1);
  transition: .4s;
}
ul li:hover a{
  padding-left: 50px;
}
.sidebar ul a i{
  margin-right: 16px;
}
#check{
  display: none;
}
label #btn,label #cancel{
  position: absolute;
  background: #042331;
  border-radius: 3px;
  cursor: pointer;
}
label #btn{
  left: 40px;
  font-size: 35px;
  color: white;
  padding: 6px 12px;
  transition: all .5s;
  position: absolute;
  z-index: 50;
}
label #cancel{
  z-index: 1111;
  left: -195px;
  top: 17px;
  font-size: 30px;
  color: #0a5275;
  padding: 4px 9px;
  transition: all .5s ease;
  position: fixed;
}
#check:checked ~ .sidebar{
  left: 0;
  position: fixed;
}
#check:checked ~ label #btn{
  left: 250px;
  opacity: 0;
  pointer-events: none;
  position: fixed;
}
#check:checked ~ label #cancel{
  left: 195px;
  position: fixed;
}
#check:checked ~ section{
  margin-left: 250px;
}
section{
  background: url(bg.jpeg) no-repeat;
  background-position: center;
  background-size: cover;
  height: 100vh;
  transition: all .5s;
}



/*card border ---------------------------------------------------------------------------------------------------*/
.box_number{
  /* overflow:auto; */
  width: 200px;
  height: 200px;
  background-color: white;
  padding: 20px;
  /* margin: 30px auto; */
  border-style: solid;
  border-color: #0a5275;

  border-width: 4px;
   /* is the ta9am9om if its just 2 value is the first value for the 1 and the 3 and the second for the 2 and 4 */
   border-radius: 40px;
   box-shadow: 1px 1px 15px #0a5275;
}
.user-count1 {
  font-family: Arial, sans-serif;
  font-size: 18px;
  color: #0a5275; /* Pink color for "Nombre d'utilisateurs" */
  margin-bottom: 10px;
  font-weight: bold;
}

.user-count1 strong {
  font-weight: bold;
  font-size: 24px; /* Larger font size for the number */
  color: black; /* Black color for the number */
}

/*date input*/


.date-input {
  position: relative;
}

.date-input input {
  padding-right: 30px; /* Ajustez la valeur selon vos besoins */
}

.date-input i {
  position: absolute;
  top: 50%;
  right: 10px; /* Ajustez la valeur selon vos besoins */
  transform: translateY(-50%);
  font-size: 16px; /* Ajustez la taille de l'icône selon vos besoins */
  color: #999; /* Ajustez la couleur de l'icône selon vos besoins */
  cursor: pointer;

}
/* button modifier profile css*/
.button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #0a5275;
  /* background-color: #5e72e4; */
  color: white;
  text-align: center;
  text-decoration: none;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-size: 16px;
}

/* Style au survol du bouton */
.button:hover {
  background-color: #5e72e4;
}



</style>




<style>
*{
  padding: 0;
  margin: 0;
  list-style: none;
  text-decoration: none;
}
.nav_trsp {
  top: 0; /* Ajoutez cette ligne pour positionner le menu en haut de la page */
  left: 0; /* Ajoutez cette ligne pour aligner le menu à gauche de la page */
  margin: 0; /* Ajoutez cette ligne pour supprimer les marges */
}

.nav_trsp ul {
  float: right;
  margin: 0; /* Ajoutez cette ligne pour supprimer les marges */
  font-weight: bold;
}


/* ////////////////////////////////////// */

.nav_trsp ul li{
  padding: 0px;
  right:380px;
  bottom:20px;
}





</style>



   
<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"../fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
