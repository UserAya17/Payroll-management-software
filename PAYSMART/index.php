<?php
session_start();

$_SESSION['auth']=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['seconnecter'])) 
	{
        if(isset($_POST['g-recaptcha-response']))
		{
			$secretkey = "6Leber8mAAAAACvnjrrwv2xlcUSd4kVW-1aHIgBj";
			$ip = $_SERVER['REMOTE_ADDR'];
			$response = $_POST['g-recaptcha-response'];
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
			$fire = file_get_contents($url);	
			$data = json_decode($fire);	
			if($data->success == true)
			{
				if (isset($_POST['username']) && isset($_POST['password'])) 
				{
					require_once('connect.php');
					//$motdepass = $_POST['password'];
					$motdepasse = md5($_POST['password']);
					$req = $bd->prepare("SELECT * FROM utilisateur WHERE login = :lg AND password = :ps");
					$req->bindValue("lg", $_POST['username'], PDO::PARAM_STR);
					$req->bindValue("ps", $motdepasse, PDO::PARAM_STR);
					$req->execute();
					$_SESSION['login']=$_POST['username'];
					if (!$req->rowCount()) $_SESSION['erreur']="login ou mot de passe incorrect!";
					else 
					{
						$_SESSION['auth'] = true;
						$row = $req->fetch(PDO::FETCH_ASSOC);
						$_SESSION['login'] = $row['login'];
						$_SESSION['nom1'] = $row['nom'];
						$_SESSION['prenom1'] = $row['prenom'];
						$_SESSION['matricule'] = $row['matricule'];
						$_SESSION['image'] = $row['image'];
						$req2 = $bd->prepare("SELECT * FROM contrat WHERE idUser = :mat");
						$req2->bindValue("mat", $row['matricule'], PDO::PARAM_STR);
						$req2->execute();
						$postes=$req2->fetch(PDO::FETCH_ASSOC);
						if($postes['poste']=="RH")
						{
							$_SESSION['type']="rh";
							header("location:responsableRH/rh_home.php");
						}
						else if($postes['poste']=="RP")
								{
									$_SESSION['type']="rp";
									header("location:responsablePaie/rp_home.php");
								}
							else
							{
								$_SESSION['type']="emp";
								header("location:employe/demandeConge.php");
							}  
					}
				}
			}
			else $_SESSION['erreur'] = "Remplissez le captcha correctement. ";
		}
		else $_SESSION['erreur'] = "Remplissez le captcha correctement. ";
    }
}

?>
<!DOCTYPE html>
<html class="ltr" dir="ltr" lang="fr-FR">
<head>
	<title>PAY SMART</title>
	<meta content="initial-scale=1.0, width=device-width" name="viewport" />
    <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
    <script data-senna-track="permanent" src="/combo?browserId=other&minifierType=js&languageId=fr_FR&b=7201&t=1682808428503&/o/frontend-js-jquery-web/jquery/jquery.min.js&/o/frontend-js-jquery-web/jquery/bootstrap.bundle.min.js&/o/frontend-js-jquery-web/jquery/collapsible_search.js&/o/frontend-js-jquery-web/jquery/fm.js&/o/frontend-js-jquery-web/jquery/form.js&/o/frontend-js-jquery-web/jquery/popper.min.js&/o/frontend-js-jquery-web/jquery/side_navigation.js" type="text/javascript"></script>
    <link charset="utf-8" data-senna-track="permanent" href="/o/frontend-theme-font-awesome-web/css/main.css" rel="stylesheet"></script>
    <link href="https://www.portnet.ma/o/classic-theme/images/liferay2.ico" rel="icon" />
	<link class="lfr-css-file" data-senna-track="temporary" href="https://www.portnet.ma/o/classic-theme/css/main.css?browserId=other&amp;themeId=classic_WAR_classictheme&amp;languageId=fr_FR&amp;b=7201&amp;t=1656630770000" id="liferayThemeCSS" rel="stylesheet" type="text/css" />
    <link data-senna-track="temporary" href="https://www.portnet.ma/web/guichet-unique" rel="canonical" />
	<link rel="stylesheet" href="css/index.css">
	<link class="lfr-css-file" data-senna-track="temporary" href="https://www.portnet.ma/o/classic-theme/css/clay.css?browserId=other&amp;themeId=classic_WAR_classictheme&amp;languageId=fr_FR&amp;b=7201&amp;t=1656630770000" id="liferayAUICSS" rel="stylesheet" type="text/css" />
    <link data-senna-track="temporary" href="/o/frontend-css-web/main.css?browserId=other&amp;themeId=classic_WAR_classictheme&amp;languageId=fr_FR&amp;b=7201&amp;t=1656630656467" id="liferayPortalCSS" rel="stylesheet" type="text/css" />
    <style data-senna-track="temporary" type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Poppins:300,400, 500,600,700');
		@import url('https://fonts.googleapis.com/css?family=Sora::300,400, 500,600, 700');
	</style>
</head>
<body class=" controls-visible  yui3-skin-sam signed-out public-page site">
	<div class="pt-0" id="wrapper">
		<section class="" id="content">
			<h2 class="sr-only" role="heading" aria-level="1">Accueil</h2>
			<div class="layout-content portlet-layout" id="main-content" role="main">
        		<section class="bg-">
					<div class="container-fluid  py-0">
						<div class="row ">
                    		<div class="col-md-12">
                        		<div id="fragment-54429-faod" >
                            		<div class="fragment_54429" id="toPage">
                                		<header class="bg-white border-bottom border-light navbar navbar-light py-4 section-header">
	                                		<div class="container flex-column flex-lg-row justify-content-between text-break Gu-Menu">
		                                		<p><span>PAY</span>SMART</p>
											</div>
										</header>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!--style="background-image: url(gestion_paie.png); background-position: 50% 50%; background-repeat: no-repeat; background-size: cover;"-->
				<section class="bg-white" >
					<div class="container  py-3">
						<div class="row ">
						    <div class="col-md-8">
								<div id="fragment-0-gtxy" >
									<div class="pb-3">
										<div>
											<div class="mainBanner">
												<h1>Nous vous <b> facilitons </b>toutes<br>vos <b>démarches</b> à <b>la paie</b></h1>
												<h3>pour vous assurer une gestion de la paie 100% Digitale.</h3><br><br>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="col-md-4">
								<div class="portlet-body">
									<br><br>
									<script src="https://www.google.com/recaptcha/api.js" async defer></script>
									<?php if(isset($_SESSION['erreur'])) {?>
									<div class="alert alert-danger" role="alert">
									<?php echo $_SESSION['erreur'];
									 unset($_SESSION['erreur']); }
									?>
									</div>
									<div class="authGU">
										<form action="index.php" method="POST" class="formGUAuth" >
											<h3 class="labelConnexionGU">Connexion</h3>
											<div class="sec1">
												<input type="text" name="username" placeholder="Nom d'utilisateur" class="userGU"><br><br>
												<input type="password" name="password" placeholder="Mot de passe" class="passwdGU"><br><br>
											</div>
											
											<div class="sec1">
											<div class="g-recaptcha" data-sitekey="6Leber8mAAAAAERG5jATfVDnBNI1cp2f8eMK3bFB"></div><br>
											</div>
											<div class="sec2">
												<a href="mdpOublie.php" target="_blank">Mot de passe oublié</a><br>
											</div>
											
											<div class="sec4">
												<input type="submit" name="seconnecter" value="Se connecter" class="submitGU btn btn-primary"><br><br>
											</div>	
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</section>
	</div>
</body>
</html>