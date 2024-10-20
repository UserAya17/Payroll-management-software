<?php
    require_once("sessionRh.php");
	require('connect.php');
	if (isset($_POST['duree']) && isset($_POST['type']) && isset($_POST['salaire']) && isset($_POST['poste']) 
	&& isset($_POST['dateEmbauche'])) 
	{
		$_SESSION['duree'] = $_POST['duree'];
		$_SESSION['type'] = $_POST['type'];
		$_SESSION['salaire'] = $_POST['salaire'];
		$_SESSION['poste'] = $_POST['poste'];
		$_SESSION['dateEmbauche'] = ($_POST['dateEmbauche']);
	}
	$username1 = $_SESSION['username'];
	$filiale = $_SESSION['filiale'];
	$matricule = $_SESSION['matricule'];
	$image = $_SESSION['image'];
	$nom = $_SESSION['nom'];
	$prenom = $_SESSION['prenom'];
	$cin = $_SESSION['cin'];
	$email = $_SESSION['email'];
	$dateNaissance = $_SESSION['dateNaissance'];
	$rib = $_SESSION['rib'];
	$numeroTel = $_SESSION['telephone'];
	$gender=$_SESSION['gender'];
	$situation = $_SESSION['situation'];
	$nbreEnfantsmalad = $_SESSION['nbreEnfantsmalad'];
	$nbreEnfantsinf21 = $_SESSION['nbreEnfantsinf21'];
	$adresse = $_SESSION['adresse'];
	$numeroAMO = $_SESSION['amo'];
	$numeroCIMR = $_SESSION['cimr'];
	$numeroCNSS = $_SESSION['cnss'];
	$numeroIGR = $_SESSION['igr'];
	//echo $nbreEnfantsinf21;
	$ReadSql = "SELECT * FROM `filiale` ";
    $reqet = $bd->query($ReadSql);
    $rows = $reqet->fetchAll(PDO::FETCH_ASSOC);
	function CreatePass($long_pass)
	{
		$consonnes = "bcdfghjklmnpqrstvwxz";
		$voyelles = "aeiouy";
		$mdp='';
		for ($i=0; $i < $long_pass; $i++)
		{
			if (($i % 2) == 0) $mdp = $mdp.substr ($voyelles, rand(0,strlen($voyelles)-1), 1);
		else $mdp = $mdp.substr ($consonnes, rand(0,strlen($consonnes)-1), 1);
	}
	return $mdp;
	}

	$password = CreatePass(8);
	$motdepasse = md5($password);
	if(isset($_POST['ajouter']))
    {
		$nbreEnfants = $nbreEnfantsinf21+$nbreEnfantsmalad;
        $aujourdhui = date("Y-m-d");
        $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
        $age = $diff->format('%y');
		$CreateSql = "INSERT INTO `utilisateur` (matricule, image, nom, prenom, cin, dateNaissance, adresse, email, login, password, sexe, age, rib, numeroTel, numeroCNSS, numeroAmo, numeroCimr, numeroIgr, situationFamiliale, nombreEnfants)  
		                                  VALUES('$matricule','$image','$nom', '$prenom', '$cin', '$dateNaissance', '$adresse', '$email', '$username1','$motdepasse', '$gender', '$age' , '$rib', '$numeroTel', '$numeroCNSS', '$numeroAMO', '$numeroCIMR', '$numeroIGR', '$situation', '$nbreEnfants') ";
		$res1 = $bd->query( $CreateSql);
        $sql= "SELECT * from `filiale` where nomFliale = '$filiale'";
		$i = $bd->query($sql);
		$idr = $i->fetch(PDO::FETCH_ASSOC);
		$id = $idr['idFiliale'];
        $duree = $_SESSION['duree'];
		$type = $_SESSION['type'];
		$salaire = $_SESSION['salaire'];
		$dateEmbauche = $_SESSION['dateEmbauche'];
		$poste = $_SESSION['poste'];
        $CreateSql2 = "INSERT INTO `contrat` (duree, typeContrat, salaireDeBase, poste,dateEmbauche, idUser, idFiliale)  VALUES('$duree', '$type', '$salaire', '$poste', '$dateEmbauche', '$matricule', '$id') ";
		$res2 = $bd->query( $CreateSql2);
		if ($res1) 
        {
			if($res2)
			{
				$header="MIME-Version:1.0\r\n";
				$header.='From:"PAYSMART.com"<paysmart1suppor@gmail.com>'."\n";
			    $header.='Content-Type:text/html; charset="utf-8"'."\n";
				$header.='Content-Transfer-Encoding: 8bit';
			  	$sujet = "Récupération de login et mot de passe- PAYSMART";
				$message = '
					  <html>
					   <head>
						<title>Récupération de login et mot de passe - PAYSMART</title>
						<meta charset="utf-8">
					   </head>
					   <body>
						<font >
						 <div align="center">
						  <table width="600px">
						   <tr>
							<td>
							 <div>
							  Bonjour <b>'.$nom.'</b> <b>'.$prenom.'</b>,<br>Bienvenue avec nous dans notre entreprise PAYSMART <b>. Vous trouverez ci-joint votre login et mot de passe pour pouvoir acceder a application PAYSMART:  </b><br>
							  login : <b> '.$username1.' </b> <br>
							  password : <b> '.$password.' </b> <br>.
							  Vous pouvez commencez a utiliser PAYSMART app.
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
						mail($email, $sujet, $message , $header);
				
				echo '<script>window.location.href = "view.php";</script>';
			}
			else
        {
			$erreur = "erreur d'insertion a la base";
		}
		}
		else
        {
			$erreur = "erreur d'insertion a la base";
		}
	}



	

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Ajouter Employe</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css" >

</head>
<body>


	<div class="container">
		<div class="row pt-4">
			<?php if (isset($message)) { ?>
				<div class="alert alert-success" role="alert">
					<?php echo $message; ?>
				</div> <?php } ?>

				<?php if (isset($erreur)) { ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $erreur; ?>
				</div> <?php } ?>

			<form action="" method="POST" class="form-horizontal col-md-6 pt-4">
				<h2>Ajouter</h2>
				
                <div class="form-group">
					<label for="input1" class="col-sm-2 control-label"> Login <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="username"  class="form-control" id="input1" value="<?php echo $username1; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label"> Mot de passe <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="password"  class="form-control" id="input1" value="<?php echo $password; ?>">
					</div>
				</div>

				

				

				<div class="pt-4">
				<a href="ajouterInfoContrat.php">
						<button class="btn btn-success m-3" type="button">
							Retour
						</button>
				</a>
				<input type="submit" value="Ajouter employe" name="ajouter" class="btn btn-primary m-3">	
				</div>
			</form>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script type='text/javascript' id="soledad-pagespeed-header" data-cfasync="false">
!function(n,t){
    "object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(n="undefined"!=typeof globalThis?globalThis:n||self).LazyLoad=t()}
    (this,(function(){"use strict";function n()
        {return n=Object.assign||function(n){for(var t=1;t<arguments.length;t++){var e=arguments[t];for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(n[i]=e[i])}return n},n.apply(this,arguments)}var t="undefined"!=typeof window,e=t&&!("onscroll"in window)||"undefined"!=typeof navigator&&/(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent),i=t&&"IntersectionObserver"in window,o=t&&"classList"in document.createElement("p"),a=t&&window.devicePixelRatio>1,r={elements_selector:".lazy",container:e||t?document:null,threshold:300,thresholds:null,data_src:"src",data_srcset:"srcset",data_sizes:"sizes",data_bg:"bg",data_bg_hidpi:"bg-hidpi",data_bg_multi:"bg-multi",data_bg_multi_hidpi:"bg-multi-hidpi",data_poster:"poster",class_applied:"applied",class_loading:"loading",class_loaded:"loaded",class_error:"error",class_entered:"entered",class_exited:"exited",unobserve_completed:!0,unobserve_entered:!1,cancel_on_exit:!0,callback_enter:null,callback_exit:null,callback_applied:null,callback_loading:null,callback_loaded:null,callback_error:null,callback_finish:null,callback_cancel:null,use_native:!1},c=function(t){return n({},r,t)},u=function(n,t){var e,i="LazyLoad::Initialized",o=new n(t);try{e=new CustomEvent(i,{detail:{instance:o}})}catch(n){(e=document.createEvent("CustomEvent")).initCustomEvent(i,!1,!1,{instance:o})}window.dispatchEvent(e)},l="src",s="srcset",f="sizes",d="poster",="llOriginalAttrs",g="loading",v="loaded",b="applied",p="error",h="native",m="data-",E="ll-status",I=function(n,t){return n.getAttribute(m+t)},y=function(n){return I(n,E)},A=function(n,t){return function(n,t,e){var i="data-ll-status";null!==e?n.setAttribute(i,e):n.removeAttribute(i)}(n,0,t)},k=function(n){return A(n,null)},L=function(n){return null===y(n)},w=function(n){return y(n)===h},x=[g,v,b,p],O=function(n,t,e,i){n&&(void 0===i?void 0===e?n(t):n(t,e):n(t,e,i))},N=function(n,t){o?n.classList.add(t):n.className+=(n.className?" ":"")+t},C=function(n,t){o?n.classList.remove(t):n.className=n.className.replace(new RegExp("(^|\\s+)"+t+"(\\s+|$)")," ").replace(/^\s+/,"").replace(/\s+$/,"")},M=function(n){return n.llTempImage},z=function(n,t){if(t){var e=t._observer;e&&e.unobserve(n)}},R=function(n,t){n&&(n.loadingCount+=t)},T=function(n,t){n&&(n.toLoadCount=t)},G=function(n){for(var t,e=[],i=0;t=n.children[i];i+=1)"SOURCE"===t.tagName&&e.push(t);return e},D=function(n,t){var e=n.parentNode;e&&"PICTURE"===e.tagName&&G(e).forEach(t)},V=function(n,t){G(n).forEach(t)},F=[l],j=[l,d],P=[l,s,f],S=function(n){return!!n[]},U=function(n){return n[]},$=function(n){return delete n[]},q=function(n,t){if(!S(n)){var e={};t.forEach((function(t){e[t]=n.getAttribute(t)})),n[]=e}},H=function(n,t){if(S(n)){var e=U(n);t.forEach((function(t){!function(n,t,e){e?n.setAttribute(t,e):n.removeAttribute(t)}(n,t,e[t])}))}},B=function(n,t,e){N(n,t.class_loading),A(n,g),e&&(R(e,1),O(t.callback_loading,n,e))},J=function(n,t,e){e&&n.setAttribute(t,e)},K=function(n,t){J(n,f,I(n,t.data_sizes)),J(n,s,I(n,t.data_srcset)),J(n,l,I(n,t.data_src))},Q={IMG:function(n,t){D(n,(function(n){q(n,P),K(n,t)})),q(n,P),K(n,t)},IFRAME:function(n,t){q(n,F),J(n,l,I(n,t.data_src))},VIDEO:function(n,t){V(n,(function(n){q(n,F),J(n,l,I(n,t.data_src))})),q(n,j),J(n,d,I(n,t.data_poster)),J(n,l,I(n,t.data_src)),n.load()}},W=["IMG","IFRAME","VIDEO"],X=function(n,t){!t||function(n){return n.loadingCount>0}(t)||function(n){return n.toLoadCount>0}(t)||O(n.callback_finish,t)},Y=function(n,t,e){n.addEventListener(t,e),n.llEvLisnrs[t]=e},Z=function(n,t,e){n.removeEventListener(t,e)},nn=function(n){return!!n.llEvLisnrs},tn=function(n){if(nn(n)){var t=n.llEvLisnrs;for(var e in t){var i=t[e];Z(n,e,i)}delete n.llEvLisnrs}},en=function(n,t,e){!function(n){delete n.llTempImage}(n),R(e,-1),function(n){n&&(n.toLoadCount-=1)}(e),C(n,t.class_loading),t.unobserve_completed&&z(n,e)},on=function(n,t,e){var i=M(n)||n;nn(i)||function(n,t,e){nn(n)||(n.llEvLisnrs={});var i="VIDEO"===n.tagName?"loadeddata":"load";Y(n,i,t),Y(n,"error",e)}(i,(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_loaded),A(t,v),O(e.callback_loaded,t,i),o||X(e,i)}(0,n,t,e),tn(i)}),(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_error),A(t,p),O(e.callback_error,t,i),o||X(e,i)}(0,n,t,e),tn(i)}))},an=function(n,t,e){!function(n){n.llTempImage=document.createElement("IMG")}(n),on(n,t,e),function(n){S(n)||(n[]={backgroundImage:n.style.backgroundImage})}(n),function(n,t,e){var i=I(n,t.data_bg),o=I(n,t.data_bg_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage='url("'.concat(r,'")'),M(n).setAttribute(l,r),B(n,t,e))}(n,t,e),function(n,t,e){var i=I(n,t.data_bg_multi),o=I(n,t.data_bg_multi_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage=r,function(n,t,e){N(n,t.class_applied),A(n,b),e&&(t.unobserve_completed&&z(n,t),O(t.callback_applied,n,e))}(n,t,e))}(n,t,e)},rn=function(n,t,e){!function(n){return W.indexOf(n.tagName)>-1}(n)?an(n,t,e):function(n,t,e){on(n,t,e),function(n,t,e){var i=Q[n.tagName];i&&(i(n,t),B(n,t,e))}(n,t,e)}(n,t,e)},cn=function(n){n.removeAttribute(l),n.removeAttribute(s),n.removeAttribute(f)},un=function(n){D(n,(function(n){H(n,P)})),H(n,P)},ln={IMG:un,IFRAME:function(n){H(n,F)},VIDEO:function(n){V(n,(function(n){H(n,F)})),H(n,j),n.load()}},sn=function(n,t){(function(n){var t=ln[n.tagName];t?t(n):function(n){if(S(n)){var t=U(n);n.style.backgroundImage=t.backgroundImage}}(n)})(n),function(n,t){L(n)||w(n)||(C(n,t.class_entered),C(n,t.class_exited),C(n,t.class_applied),C(n,t.class_loading),C(n,t.class_loaded),C(n,t.class_error))}(n,t),k(n),$(n)},fn=["IMG","IFRAME","VIDEO"],dn=function(n){return n.use_native&&"loading"in HTMLImageElement.prototype},_n=function(n,t,e){n.forEach((function(n){return function(n){return n.isIntersecting||n.intersectionRatio>0}(n)?function(n,t,e,i){var o=function(n){return x.indexOf(y(n))>=0}(n);A(n,"entered"),N(n,e.class_entered),C(n,e.class_exited),function(n,t,e){t.unobserve_entered&&z(n,e)}(n,e,i),O(e.callback_enter,n,t,i),o||rn(n,e,i)}(n.target,n,t,e):function(n,t,e,i){L(n)||(N(n,e.class_exited),function(n,t,e,i){e.cancel_on_exit&&function(n){return y(n)===g}(n)&&"IMG"===n.tagName&&(tn(n),function(n){D(n,(function(n){cn(n)})),cn(n)}(n),un(n),C(n,e.class_loading),R(i,-1),k(n),O(e.callback_cancel,n,t,i))}(n,t,e,i),O(e.callback_exit,n,t,i))}(n.target,n,t,e)}))},gn=function(n){return Array.prototype.slice.call(n)},vn=function(n){return n.container.querySelectorAll(n.elements_selector)},bn=function(n){return function(n){return y(n)===p}(n)},pn=function(n,t){return function(n){return gn(n).filter(L)}(n||vn(t))},hn=function(n,e){var o=c(n);this._settings=o,this.loadingCount=0,function(n,t){i&&!dn(n)&&(t._observer=new IntersectionObserver((function(e){_n(e,n,t)}),function(n){return{root:n.container===document?null:n.container,rootMargin:n.thresholds||n.threshold+"px"}}(n)))}(o,this),function(n,e){t&&window.addEventListener("online",(function(){!function(n,t){var e;(e=vn(n),gn(e).filter(bn)).forEach((function(t){C(t,n.class_error),k(t)})),t.update()}(n,e)}))}(o,this),this.update(e)};return hn.prototype={update:function(n){var t,o,a=this._settings,r=pn(n,a);T(this,r.length),!e&&i?dn(a)?function(n,t,e){n.forEach((function(n){-1!==fn.indexOf(n.tagName)&&function(n,t,e){n.setAttribute("loading","lazy"),on(n,t,e),function(n,t){var e=Q[n.tagName];e&&e(n,t)}(n,t),A(n,h)}(n,t,e)})),T(e,0)}(r,a,this):(o=r,function(n){n.disconnect()}(t=this._observer),function(n,t){t.forEach((function(t){n.observe(t)}))}(t,o)):this.loadAll(r)},destroy:function(){this._observer&&this._observer.disconnect(),vn(this._settings).forEach((function(n){$(n)})),delete this._observer,delete this._settings,delete this.loadingCount,delete this.toLoadCount},loadAll:function(n){var t=this,e=this._settings;pn(n,e).forEach((function(n){z(n,t),rn(n,e,t)}))},restoreAll:function(){var n=this._settings;vn(n).forEach((function(t){sn(t,n)}))}},hn.load=function(n,t){var e=c(t);rn(n,e)},hn.resetStatus=function(n){k(n)},t&&function(n,t){if(t)if(t.length)for(var e,i=0;e=t[i];i+=1)u(n,e);else u(n,t)}(hn,window.lazyLoadOptions),hn}));

(function () {

    var PenciLazy = new LazyLoad({
        elements_selector: '.penci-lazy',
        data_bg: 'bgset',
        class_loading: 'lazyloading',
        class_entered: 'lazyloaded',
        class_loaded: 'pcloaded',
        unobserve_entered: true
    });

    MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

    var observer = new MutationObserver(function(mutations, observer) {
        PenciLazy.update();
    });

    observer.observe(document, {
        subtree: true,
        attributes: true
    });
})();
</script>
</body>
</html>