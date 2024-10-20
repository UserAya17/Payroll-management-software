<?php  
include "sessionEmploye.php";
$url = "$_SERVER[REQUEST_URI]";
$_SESSION['url'] = $url;

$conn2 = mysqli_connect("localhost","root","","paysmart");


?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== REMIXICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <!--=============== CSS ===============-->
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/menuemploye.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    

        <style>
    #id1{
  padding: 0;
  margin: 0;
  list-style: none;
  text-decoration: none;
 
}
</style>
    </head>
    <body >
        <!--=============== HEADER ===============-->
        <header class="header" id="id1">
            <nav class="nav container">
                <div class="nav__data">
                    <a href="profile.php" class="nav__logo" id="id1">
                       
                        
                        <?php
                        
                        if($_SESSION['image']=='')
                        echo "<img src='../responsableRH/images/user.png' width='50px' height='50px' style='border-radius: 200px'>";
                        else
                        echo "<img src='../responsableRH/images/" . $_SESSION['image'] . "'width='50px' height='50px' style='border-radius: 200px'>";
                        echo $_SESSION["nom1"] ." ".$_SESSION["prenom1"];?>
                    </a>
    
                    <div class="nav__toggle" id="nav-toggle">
                        <i class="ri-menu-line nav__toggle-menu"></i>
                        <i class="ri-close-line nav__toggle-close"></i>
                    </div>
                </div>

                <!--=============== NAV MENU ===============-->
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <!--=============== DROPDOWN 1 ===============-->
                        <li class="dropdown__item">                      
                            <div class="nav__link dropdown__button">
                                Demande et  Consultation <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                            </div>

                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i  class="fas fa-calendar-check"></i>
                                        </div>
    
                                        <span class="dropdown__title">Conge</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="demandeConge.php" class="dropdown__link" id="id1">Demander Conge</a>
                                            </li>
                                            <li>
                                                <a href="consultConge.php" class="dropdown__link" id="id1">Consulter Conge</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="fas fa-stopwatch"></i>
                                        </div>
    
                                        <span class="dropdown__title">Heure sup</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="demandeHeuresup.php" class="dropdown__link" id="id1">Demande heure sup</a>
                                            </li>
                                            <li>
                                                <a href="consultHeureSup.php" class="dropdown__link" id="id1">Consulter heure sup</a>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
    
                                        <span class="dropdown__title">Reclamation</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="envoyerReclamation.php" class="dropdown__link" id="id1">Ajouter reclamation</a>
                                            </li>
                                            <li>
                                                <a href="consulterReclamation.php" class="dropdown__link" id="id1">consulter reclamation</a>
                                            </li>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="ri-file-paper-2-line"></i>
                                        </div>
    
                                        <span class="dropdown__title">Prime et Absence</span>
    
                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="#" class="dropdown__link" id="id1">Consulter Prime</a>
                                            </li>
                                            <li>
                                                <a href="consulterAbsence.php" class="dropdown__link" id="id1">Consulter Absence</a>
                                            </li>
                                        </ul>
                                    </div>


                                    


                                </div>
                            </div>
                        </li>

                        <!--=============== DROPDOWN 2 ===============-->
                        <li>
                            <a href="consulterBultin.php" class="nav__link" id="id1">Bulletin</a>
                        </li>

                        <li>
                            <a href="profile.php" class="nav__link" id="id1">Profile</a>
                        </li>

                        <?php
if($_SESSION['type']=="rh")
echo "  <li>
<a href='../responsableRH/rh_home.php' class='nav__link' id='id1'>Espace RH</a>
</li>";

else if($_SESSION['type']=="rp")
echo "  <li>
<a href='../responsablePaie/rp_home.php' class='nav__link' id='id1'>Espace RP</a>
</li>";
                      
                        ?>
                        <li>
                            <a href="../deconnexion.php" class="nav__link" id="id1"><i class="fas fa-sign-out-alt icon_size"></i></a>
                        </li>
                        
                                    </div>
    
                                   
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <style>
          .icon_size{
       font-size: 25px;
          }
        </style>
        
        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>
</html>














<!-- <div class="nav_trsp">

<ul class="nav navbar-nav">
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:1px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:28px;"></span></a>
       <ul class="dropdown-menu"></ul>
      </li>
     </ul>
     </div> -->

<style>
  @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');


body{
  /* background: #8ccadb; */

}
.wrapper{
  max-width: 500px;
  width: 100%;
  background: #fff;
  margin: 20px auto;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.125);
  padding: 30px;
}

.wrapper .title{
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 25px;
  color: hsl(220, 60%, 54%);
  text-transform: uppercase;
  text-align: center;
}

.wrapper .form{
  width: 100%;
}

.wrapper .form .inputfield{
  margin-bottom: 15px;
  display: flex;
  align-items: center;
}

.wrapper .form .inputfield label{
   width: 200px;
   color: #757575;
   margin-right: 10px;
  font-size: 14px;
}

.wrapper .form .inputfield .input,
.wrapper .form .inputfield .textarea{
  width: 100%;
  outline: none;
  border: 1px solid #d5dbd9;
  font-size: 15px;
  padding: 8px 10px;
  border-radius: 3px;
  transition: all 0.3s ease;
}

.wrapper .form .inputfield .textarea{
  width: 100%;
  height: 125px;
  resize: none;
}

.wrapper .form .inputfield .custom_select{
  position: relative;
  width: 100%;
  height: 37px;
}

.wrapper .form .inputfield .custom_select:before{
  content: "";
  position: absolute;
  top: 12px;
  right: 10px;
  border: 8px solid;
  border-color: #d5dbd9 transparent transparent transparent;
  pointer-events: none;
}

.wrapper .form .inputfield .custom_select select{
  -webkit-appearance: none;
  -moz-appearance:   none;
  appearance:        none;
  outline: none;
  width: 100%;
  height: 100%;
  border: 0px;
  padding: 8px 10px;
  font-size: 15px;
  border: 1px solid #d5dbd9;
  border-radius: 3px;
}


.wrapper .form .inputfield .input:focus,
.wrapper .form .inputfield .textarea:focus,
.wrapper .form .inputfield .custom_select select:focus{
  border: 1px solid #fec107;
}

.wrapper .form .inputfield p{
   font-size: 14px;
   color: #757575;
}
.wrapper .form .inputfield .check{
  width: 15px;
  height: 15px;
  position: relative;
  display: block;
  cursor: pointer;
}
.wrapper .form .inputfield .check input[type="checkbox"]{
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.wrapper .form .inputfield .check .checkmark{
  width: 15px;
  height: 15px;
  border: 1px solid hsl(220, 100%, 54%);
  display: block;
  position: relative;
}
.wrapper .form .inputfield .check .checkmark:before{
  content: "";
  position: absolute;
  top: 1px;
  left: 2px;
  width: 5px;
  height: 2px;
  border: 2px solid;
  border-color: transparent transparent #fff #fff;
  transform: rotate(-45deg);
  display: none;
}
.wrapper .form .inputfield .check input[type="checkbox"]:checked ~ .checkmark{
  background: hsl(220, 100%, 54%);
}

.wrapper .form .inputfield .check input[type="checkbox"]:checked ~ .checkmark:before{
  display: block;
}

.wrapper .form .inputfield .btn{
  width: 100%;
   padding: 8px 10px;
  font-size: 15px; 
  border: 0px;
  background: hsl(220, 68%, 54%); 
  color: #fff;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
}

.wrapper .form .inputfield .btn:hover{
  background: hsl(220, 100%, 54%);;
}

.wrapper .form .inputfield:last-child{
  margin-bottom: 0;
}

@media (max-width:420px) {
  .wrapper .form .inputfield{
    flex-direction: column;
    align-items: flex-start;
  }
  .wrapper .form .inputfield label{
    margin-bottom: 5px;
  }
  .wrapper .form .inputfield.terms{
    flex-direction: row;
  }
}




.nav_trsp {
  background-color: #f1f1f1;
  padding: 10px;
  z-index: 100;
}

.nav_trsp ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.nav_trsp ul li {
  display: inline-block;
}

.nav_trsp ul li a {
  display: block;
  padding: 10px;
  text-decoration: none;
  color: #333;
}

.nav_trsp ul li a:hover {
  background-color: #ddd;
}

.dropdown {
  position: relative;
}

.dropdown .dropdown-menu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #f1f1f1;
  padding: 10px;
  border-radius: 4px;
}

.dropdown:hover .dropdown-menu {
  display: block;
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
