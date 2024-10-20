<?php  
  require("connect.php");
  session_start();
  if (isset($_GET['section'])) 
 {
   $section = htmlspecialchars($_GET['section']);
 }
 else {
  $section = "";
 }
 if (isset($_POST['submit'])) 
 {
  if (isset($_POST['mail'])) 
  {
    if (!empty($_POST['mail'])) 
    {
      $recup_mail = htmlspecialchars($_POST['mail']);
      
      if (filter_var($recup_mail, FILTER_VALIDATE_EMAIL)) 
      {
        $sql = " SELECT email, nom,prenom FROM utilisateur WHERE email = ? ";
        $mailexist = $bd->prepare($sql);
        $mailexist->execute(array($recup_mail));
        $mailexist_count = $mailexist->rowCount();
        if ($mailexist_count == 1) 
        {
          $pseudo = $mailexist->fetch(PDO::FETCH_ASSOC);
          $pseudo1 = $pseudo['nom'];
          $pseudo2 = $pseudo['prenom'];
          $_SESSION['recup_mail'] = $recup_mail;
          $recup_code = "";
          for ($i=0; $i < 8; $i++) 
          { 
            $recup_code .= mt_rand(0,9);
          }
          $_SESSION['recup_code'] = $recup_code;
          $header="MIME-Version:1.0\r\n";
          $header.='From:"PAYSMART.com"<ayamoufid6@gmail.com>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
          $header.='Content-Transfer-Encoding: 8bit';
        $sujet = "Récupération de mot de passe - PAYSMART";
        //$header="From:ayamoufid6@gmail.com";
          $message = '
                <html>
                 <head>
                  <title>Récupération de mot de passe - PAYSMART</title>
                  <meta charset="utf-8">
                 </head>
                 <body>
                  <font >
                   <div align="center">
                    <table width="600px">
                     <tr>
                      <td>
                       <div>
                        Bonjour <b>'.$pseudo1.'</b> <b>'.$pseudo2.'</b>,<br>Voici votre code de recuperation: <b> '.$recup_code.' </b><br>
                       </div>
                      </td>
                     </tr>
                     <tr>
                      <td align="center">
                       <font size="2">
                        Ceci est un email automatique, Merci de ne pas y repondre.
                       </font>
                      </td>
                     </tr>
                    </table>
                   </div>
                  </font>
                 </body>
                  </html>';
                  //$recup_mail = "moufidaya518@gmail.com";
                  mail($recup_mail, $sujet, $message , $header);
                  header("location:mdpOublie.php?section=code");
        }
        else
          $error = "Cette adresse mail est invalide";
      }
      else
        $error = " Adresse mail invalide";
    }
    else
      $error = "Veuillez saisir votre adresse mail ";
  }
 }
 if (isset($_POST['verif_submit']) and isset($_POST['verif_code'])) 
 {
   if(!empty($_POST['verif_code']))
   {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      if($verif_code == $_SESSION['recup_code']) header('location:mdpOublie.php?section=changeMdp');
      else
        $error = "Code invalide";
   }
   else
     $error = "Veuillez entrez votre code de confirmation";
 }
 if (isset($_POST['change_submit']))
 {
   if (isset($_POST['nvmdp']) and isset($_POST['nvmdp1']))
   {
  
       $nvmdp = htmlspecialchars($_POST['nvmdp']);
       $nvmdp1 = htmlspecialchars($_POST['nvmdp1']);
       if (!empty($nvmdp) and !empty($nvmdp1))
      {
         if ($nvmdp == $nvmdp1)
         {
           $ins_mdp = $bd->prepare('UPDATE utilisateur SET password = ? WHERE email = ?');
           $ins_mdp->execute(array($nvmdp, $_SESSION['recup_mail']));
       
           header("location:index.php");
         }
         else
          $error = "Vos mots de passes ne correspondent pas";
      }
      else
       $error = "Veuillez remplir tous les champs";
   }
   else
       $error = "Veuillez remplir tous les champs";
  }
?>


<!doctype html>
<html lang="fr">
  <head>
  	<title>Récupération du mot de passe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
	<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
	<meta name="theme-color" content="#712cf9">
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">   
	 <header>
		<br><br><br><br>
		<div class="container-fluid">
		 <div class="row">
		  <div class="col-md-3"></div>
		  <div class="col-md-6">
       <?php if($section == 'code') { ?>
       Un code de vérification vous a été envoye Récupération de mot de passe pour <?=  $_SESSION['recup_mail'] ?>.Merci de vérifier le dossier spam aussi.
       <br>


        <form method="POST" action="">
          <b><p>Récupération du mot de passe</p></b>
          <div class="mb-3">
           <label for="exampleInputEmail1" class="form-label">Code de vérification</label>
           <input type="text" name="verif_code" class="form-control" placeholder="code de verification" required>
          </div>
          <input type="submit" name="verif_submit" class="btn btn-primary" value="Valider">
         </form>

         
       <?php } elseif($section == "changeMdp") { ?>


        <form method="POST" action="">
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Nouveau mot de passe</label>
          <input type="password" name="nvmdp" class="form-control" placeholder="Nouveau mot de passe">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Confirmation du nouveau mot de passe</label>
          <input type="password" name="nvmdp1" class="form-control" placeholder="Confirmation de mot de passe">
        </div>
        <input type="submit" name="change_submit" class="btn btn-primary" value="Changer mon mot de passe">
      </form>


        <?php } else { ?>


  		   <form method="POST" action="">
  		  	<b><p>Récupération du mot de passe</p></b>
  				<div class="mb-3">
  				 <label for="exampleInputEmail1" class="form-label">Votre Adresse Email</label>
  				 <input type="email" name="mail" class="form-control" placeholder="name@example.com" required>
  				</div>
  				<input type="submit" name="submit" class="btn btn-primary" value="Envoyer">
  			 </form>


        <?php } ?>
			 <?php if(isset($error)) { echo '<u><i><b><span style="color:red">'.$error.'</span></b></i></u> ';} ?>
		  </div>
  		<div class="col-md-3"></div>
  	 </div>
  	</div>
	 </header>
  </body>
</html>



