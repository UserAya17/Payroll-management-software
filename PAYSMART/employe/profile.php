<?php
      include "menuEmploye.php";
 $login=$_SESSION['login'];
// $login="A";
$conn1 = mysqli_connect('localhost','root','','paysmart') or die('connection failed');


$select1 = mysqli_query($conn1, "SELECT * FROM `utilisateur` WHERE login = '$login'") or die('query failed');
if(mysqli_num_rows($select1) > 0){
   $fetch1 = mysqli_fetch_assoc($select1);
}

$idu=$fetch1['matricule'];
$select2 = mysqli_query($conn1, "SELECT * FROM `contrat` WHERE idUser = '$idu'") or die('query failed');
if(mysqli_num_rows($select2) > 0){
   $fetch2 = mysqli_fetch_assoc($select2);
}
$idf=$fetch2['idFiliale'];
$select3 = mysqli_query($conn1, "SELECT * FROM `filiale` WHERE idFiliale = '$idf'") or die('query failed');
if(mysqli_num_rows($select3) > 0){
   $fetch3 = mysqli_fetch_assoc($select3);
}


$dateActuelle = new DateTime(); // Date actuelle
$dateMySQL = new DateTime($fetch2['dateEmbauche']); // Date à partir de MySQL
$diff = $dateActuelle->diff($dateMySQL);

 $dateN = new DateTime($fetch1['dateNaissance']);
?>



<?php


if(isset($_POST['update_profile']))
{
 

// $login=$_POST['login'];
$email=$_POST['email'];
$prenom=$_POST['prenom'];
$nom=$_POST['nom'];
$adresse=$_POST['adresse'];
$numeroTel=$_POST['numeroTel'];
$cin=$_POST['cin'];
$dateNaissance = date('d-m-Y', strtotime($_POST['dateNaissance']));
$sexe=$_POST['sexe'];
  mysqli_query($conn1, "UPDATE `utilisateur` SET email = '$email', prenom = '$prenom',nom = '$nom',adresse ='$adresse', numeroTel = '$numeroTel',cin = '$cin',dateNaissance = '$dateNaissance',sexe = '$sexe' WHERE login = '$login'") or die('query failed');

}
if(isset($_POST['modifier_password']))
{
  $Cpassword=$_POST['Cpassword'];
  $Apassword=$_POST['Apassword'];
  $Npassword=$_POST['Npassword'];

  // $Cpassword=md5($_POST['Cpassword']);
  // $Apassword=md5($_POST['Apassword']);
  // $Npassword=md5($_POST['Npassword']);

  if( $fetch1['password']== $Apassword)   
  {
    if($Npassword==$Cpassword)
    {
      mysqli_query($conn1, "UPDATE `utilisateur` SET password = '$Npassword' WHERE login = '$login'") or die('query failed');

    }

  }else 
  {
    echo "nooo";
  }

}
?>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="../css/style_profile.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
  .nav_trsp ul li{
    font-size: 17px; 
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>

  <div class="main-content">
    <!-- Top navbar -->
   
<br><br><br><br><br><br><br>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
              <br><br><br><br>
                <div class="card-profile-image">
                  <a href="#">

                 
                    <?php  
                    if($fetch1['image']=='')
                    echo "<img src='../responsableRH/images/user.png'>";
                    else
                    echo "<img src='../responsableRH/images/" . $fetch1['image'] . "'>";
                    
                     ?>
                  
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <!-- <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="text-center">
                <br><br><br><br><br>
                <h3>
                <?php echo $fetch1['prenom']; ?> <?php echo $fetch1['nom']; ?><span class="font-weight-light"><?php echo " ". $fetch1['age']; ?></span>
                </h3>
                <!-- <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>Mohammedia, Maroc
                </div> -->
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i> <?php echo $fetch2['poste']; ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i><?php echo $diff->y." ";?>ans d'ancienneté
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Salaire de base : <?php echo $fetch2['salaireDeBase']; ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Contrat : <?php echo $fetch2['typeContrat']; ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Nombre d'enfant inferieure 21 ans: <?php echo $fetch1['nombreEnfants']; ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Entreprise: <?php echo $fetch3['nomFliale']; ?>
                </div>
                <!-- <hr class="my-4"> -->
                <!-- <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                <a href="#">Show more</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Mes informations</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form action="profile.php" method="post">
                <h6 class="text-muted">Informations de l'utilisateur</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1">login</label>
                        <input type="text" name="login" id="input-username" class="form-control form-control-alternative" placeholder="user@entreprise.com" value="<?php echo $fetch1['login']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="text-center1" for="input-email">Email</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Nom.prenom@gmail.com" value="<?php echo $fetch1['email']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name">Prenom</label>
                        <input type="text" name="prenom" id="input-first-name" class="form-control form-control-alternative" placeholder="Prenom" value="<?php echo $fetch1['prenom']; ?>" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-last-name">Nom</label>
                        <input type="text" name="nom" id="input-last-name" class="form-control form-control-alternative" placeholder="Nom" value="<?php echo $fetch1['nom']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Adresse</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-address">Adress</label>
                        <input id="input-address" name="adresse" class="form-control form-control-alternative" placeholder="Adress" value="<?php echo $fetch1['adresse']; ?>" type="text">
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-city">Ville</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative"  placeholder="Ville"  value="New York">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-country">Pays</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Pays" value="United States">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="text-center1" for="input-country">Code Postal</label>
                        <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="code Postal">
                      </div>
                    </div> -->
                  <!-- </div> -->
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Information personnelle</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-address">Numero tel</label>
                        <input id="input-address" name="numeroTel" class="form-control form-control-alternative" value="<?php echo $fetch1['numeroTel']; ?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-city">Cin</label>
                        <input type="text" name="cin" id="input-city" class="form-control form-control-alternative" value="<?php echo $fetch1['cin']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-country">Date naissance</label>
                        <input type="date" class="form-control form-control-alternative" name="dateNaissance" value="<?php echo $fetch1['dateNaissance']?>" >
                    
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="text-center1" for="input-country">Sexe</label>
                        <br>
                        <?php 
                        if($fetch1['sexe']=='F')
                        {
                         echo " <label class='font-weight-light'> femme</label>&nbsp<input type='radio' name='sexe' value='F' checked>&nbsp
                          <label class='font-weight-light'> homme</label>&nbsp<input type='radio' name='sexe' value='M'>";
                        }
                        else {
                          echo " <label class='font-weight-light'> femme</label>&nbsp<input type='radio' name='sexe' value='F' >&nbsp
                          <label class='font-weight-light'> homme</label>&nbsp<input type='radio' name='sexe' value='M' checked>";
                        }
                        
                        ?>
                      
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <!-- <h6 class="heading-small text-muted mb-4">À propos de moi</h6>
                <div class="pl-lg-4">
                  <div class="form-group focused">
                    <label class="text-center1">À propos de moi</label>
                    <textarea rows="4" class="form-control form-control-alternative" placeholder="Quelques mots sur vous ..."></textarea>
                  </div>
                </div> -->
                <input class="btn" type="submit" name="update_profile" value="update_profile">&nbsp &nbsp &nbsp<button class="btn">Annuler</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <!-- <button class="button" type="submit" name="update_profile">Modifier Profile</button>&nbsp &nbsp &nbsp<button class="button">Annuler</button> -->
<style>

</style>
<script>
  flatpickr("#date", {
    dateFormat: "d/m/Y",
    locale: "fr"
  });
</script>
    </div>
    
  </footer>
  <br><br><br><br>
  <div class="container-fluid mt--7">
     <div class="d-flex justify-content-between">
      
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Mon compte</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
            <form action="profile.php" method="post">
                <h6 class="text-muted">Authentification</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1">Ancien mot de passe</label>
                        <input name="Apassword" type="password" id="input-username" class="form-control form-control-alternative" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="text-center1" for="input-email">Nouveau mot de passe</label>
                        <input name="Npassword" type="password"  id="input-email" class="form-control form-control-alternative" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="text-center1" for="input-first-name">Confirmer mot de passe</label>
                        <input name="Cpassword" type="password"  id="input-first-name" class="form-control form-control-alternative"  >
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn" type="submit" name="modifier_password">Modifier Password</button>&nbsp &nbsp &nbsp<button class="btn">Annuler</button>

              </form>
                
            </div></div></div></div></div>
<style>
   .btn{

  background: hsl(220, 68%, 54%); 
  color: #fff;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
}

.btn:hover{
  background: hsl(220, 100%, 54%);
  color: white;
}
</style>
        
  <!-- <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center"> -->
       
<script>
  flatpickr("#date", {
    dateFormat: "d/m/Y",
    locale: "fr"
  });
</script>
    </div>
    
  </footer>
</body>


