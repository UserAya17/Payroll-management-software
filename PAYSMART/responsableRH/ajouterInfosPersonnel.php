<?php
// require_once("session.php");
include 'connect.php';
include 'menu.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (isset($_POST['matricule']))
	{
		require_once('connect.php');
		$req = $bd->prepare("SELECT * FROM utilisateur WHERE matricule = :mat");
		$req->bindValue("mat", $_POST['matricule'], PDO::PARAM_STR);
		$req->execute();
		if (!$req->rowCount()) 
		{
			if (isset($_POST['filiale']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['gender']) && 
			isset($_POST['dateNaissance']) && isset($_POST['telephone']) && isset($_POST['cin']) && isset($_POST['rib'])) 
			{
				$m = $_POST['matricule'];
				$_SESSION['matricule'] = $m;
				$f = $_POST['filiale'];
				$_SESSION['filiale'] = $f;
				$n = ($_POST['nom']);
				$_SESSION['nom'] = $n;
				$p = ($_POST['prenom']);
				$_SESSION['prenom'] = $p;
				$c = $_POST['cin'];
				$_SESSION['cin'] =$c;
				$e= ($_POST['email']);
				$_SESSION['email'] =$e ;
				$g = $_POST['gender'];
				$_SESSION['gender'] =$g;
				$d = $_POST['dateNaissance'];
				$_SESSION['dateNaissance'] =$d;
				$_SESSION['telephone']= $_POST['telephone'];
				$_SESSION['cin']= $_POST['cin'];
				$_SESSION['rib']= $_POST['rib'];
				$_SESSION['username'] = $m ."_". $f;
			}
        } 
		else 
		{
			header("location:consult.php");
		}	
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Ajouter Employe</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css" >
	<style>
		.form-required{
			color:red;
		}
	</style>

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

			<form action="ajouterInfoContrat.php" method="POST" class="form-horizontal col-md-6 pt-4">
				<h2>Ajouter</h2>
				

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Situation familiale <span class="form-required" title="Ce champ est requis."> *</span> :</label>
					<div class="col-sm-10">
						<select name="situation"  class="form-control" id="input1" required>
							<option value="">---Selectionnez---</option>
							<option value="celib">Celibataire</option>
							<option value="marie">Marie(e)</option>
							<option value="divorce">Divorce(e)</option>
							<option value="veuf">Veuf(ve)</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Nombre d'enfants <span class="form-required" title="Ce champ est requis.">(Inferieur a 21)</span> :</label>
					<div class="col-sm-10">
						
                    <input type="number" name="nbreEnfantsinf21" placeholder="Nombre d'enfants inferieur a 21" class="form-control" id="input1" value="0">
					</div>
				</div>

                <div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Nombre d'enfants <span class="form-required" title="Ce champ est requis.">(Malades)</span> :</label>
					<div class="col-sm-10">
						
                    <input type="number" name="nbreEnfantsmalad" placeholder="Nombre d'enfants ayant des maladies" class="form-control" id="input1" value="0">
					</div>
				</div>

                

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Adresse <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
					<input type="text" name="adresse" placeholder="Adresse" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Numero d'affiliation CNSS <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="cnss" placeholder="CNSS" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Numero d'affiliation AMO <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="amo" placeholder="AMO" class="form-control" id="input1" required>
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Numero d'affiliation CIMR :</label>
					<div class="col-sm-10">
						<input type="text" name="cimr" placeholder="CIMR" class="form-control" id="input1">
					</div>
				</div>


				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Numero d'affiliation IGR <span class="form-required" title="Ce champ est requis.">*</span> :</label>
					<div class="col-sm-10">
						<input type="text" name="igr" placeholder="IGR" class="form-control" id="input1" required>
					</div>
				</div>

				

				<div class="pt-4">
				<a href="consult.php">
						<button class="btn btn-success m-3" type="button">
							Retour
						</button>
				</a>
                <input type="submit" value="Suivant" name="suivant2" class="btn btn-primary m-3">
					
					
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
        {return n=Object.assign||function(n){for(var t=1;t<arguments.length;t++){var e=arguments[t];for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(n[i]=e[i])}return n},n.apply(this,arguments)}var t="undefined"!=typeof window,e=t&&!("onscroll"in window)||"undefined"!=typeof navigator&&/(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent),i=t&&"IntersectionObserver"in window,o=t&&"classList"in document.createElement("p"),a=t&&window.devicePixelRatio>1,r={elements_selector:".lazy",container:e||t?document:null,threshold:300,thresholds:null,data_src:"src",data_srcset:"srcset",data_sizes:"sizes",data_bg:"bg",data_bg_hidpi:"bg-hidpi",data_bg_multi:"bg-multi",data_bg_multi_hidpi:"bg-multi-hidpi",data_poster:"poster",class_applied:"applied",class_loading:"loading",class_loaded:"loaded",class_error:"error",class_entered:"entered",class_exited:"exited",unobserve_completed:!0,unobserve_entered:!1,cancel_on_exit:!0,callback_enter:null,callback_exit:null,callback_applied:null,callback_loading:null,callback_loaded:null,callback_error:null,callback_finish:null,callback_cancel:null,use_native:!1},c=function(t){return n({},r,t)},u=function(n,t){var e,i="LazyLoad::Initialized",o=new n(t);try{e=new CustomEvent(i,{detail:{instance:o}})}catch(n){(e=document.createEvent("CustomEvent")).initCustomEvent(i,!1,!1,{instance:o})}window.dispatchEvent(e)},l="src",s="srcset",f="sizes",d="poster",_="llOriginalAttrs",g="loading",v="loaded",b="applied",p="error",h="native",m="data-",E="ll-status",I=function(n,t){return n.getAttribute(m+t)},y=function(n){return I(n,E)},A=function(n,t){return function(n,t,e){var i="data-ll-status";null!==e?n.setAttribute(i,e):n.removeAttribute(i)}(n,0,t)},k=function(n){return A(n,null)},L=function(n){return null===y(n)},w=function(n){return y(n)===h},x=[g,v,b,p],O=function(n,t,e,i){n&&(void 0===i?void 0===e?n(t):n(t,e):n(t,e,i))},N=function(n,t){o?n.classList.add(t):n.className+=(n.className?" ":"")+t},C=function(n,t){o?n.classList.remove(t):n.className=n.className.replace(new RegExp("(^|\\s+)"+t+"(\\s+|$)")," ").replace(/^\s+/,"").replace(/\s+$/,"")},M=function(n){return n.llTempImage},z=function(n,t){if(t){var e=t._observer;e&&e.unobserve(n)}},R=function(n,t){n&&(n.loadingCount+=t)},T=function(n,t){n&&(n.toLoadCount=t)},G=function(n){for(var t,e=[],i=0;t=n.children[i];i+=1)"SOURCE"===t.tagName&&e.push(t);return e},D=function(n,t){var e=n.parentNode;e&&"PICTURE"===e.tagName&&G(e).forEach(t)},V=function(n,t){G(n).forEach(t)},F=[l],j=[l,d],P=[l,s,f],S=function(n){return!!n[_]},U=function(n){return n[_]},$=function(n){return delete n[_]},q=function(n,t){if(!S(n)){var e={};t.forEach((function(t){e[t]=n.getAttribute(t)})),n[_]=e}},H=function(n,t){if(S(n)){var e=U(n);t.forEach((function(t){!function(n,t,e){e?n.setAttribute(t,e):n.removeAttribute(t)}(n,t,e[t])}))}},B=function(n,t,e){N(n,t.class_loading),A(n,g),e&&(R(e,1),O(t.callback_loading,n,e))},J=function(n,t,e){e&&n.setAttribute(t,e)},K=function(n,t){J(n,f,I(n,t.data_sizes)),J(n,s,I(n,t.data_srcset)),J(n,l,I(n,t.data_src))},Q={IMG:function(n,t){D(n,(function(n){q(n,P),K(n,t)})),q(n,P),K(n,t)},IFRAME:function(n,t){q(n,F),J(n,l,I(n,t.data_src))},VIDEO:function(n,t){V(n,(function(n){q(n,F),J(n,l,I(n,t.data_src))})),q(n,j),J(n,d,I(n,t.data_poster)),J(n,l,I(n,t.data_src)),n.load()}},W=["IMG","IFRAME","VIDEO"],X=function(n,t){!t||function(n){return n.loadingCount>0}(t)||function(n){return n.toLoadCount>0}(t)||O(n.callback_finish,t)},Y=function(n,t,e){n.addEventListener(t,e),n.llEvLisnrs[t]=e},Z=function(n,t,e){n.removeEventListener(t,e)},nn=function(n){return!!n.llEvLisnrs},tn=function(n){if(nn(n)){var t=n.llEvLisnrs;for(var e in t){var i=t[e];Z(n,e,i)}delete n.llEvLisnrs}},en=function(n,t,e){!function(n){delete n.llTempImage}(n),R(e,-1),function(n){n&&(n.toLoadCount-=1)}(e),C(n,t.class_loading),t.unobserve_completed&&z(n,e)},on=function(n,t,e){var i=M(n)||n;nn(i)||function(n,t,e){nn(n)||(n.llEvLisnrs={});var i="VIDEO"===n.tagName?"loadeddata":"load";Y(n,i,t),Y(n,"error",e)}(i,(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_loaded),A(t,v),O(e.callback_loaded,t,i),o||X(e,i)}(0,n,t,e),tn(i)}),(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_error),A(t,p),O(e.callback_error,t,i),o||X(e,i)}(0,n,t,e),tn(i)}))},an=function(n,t,e){!function(n){n.llTempImage=document.createElement("IMG")}(n),on(n,t,e),function(n){S(n)||(n[_]={backgroundImage:n.style.backgroundImage})}(n),function(n,t,e){var i=I(n,t.data_bg),o=I(n,t.data_bg_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage='url("'.concat(r,'")'),M(n).setAttribute(l,r),B(n,t,e))}(n,t,e),function(n,t,e){var i=I(n,t.data_bg_multi),o=I(n,t.data_bg_multi_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage=r,function(n,t,e){N(n,t.class_applied),A(n,b),e&&(t.unobserve_completed&&z(n,t),O(t.callback_applied,n,e))}(n,t,e))}(n,t,e)},rn=function(n,t,e){!function(n){return W.indexOf(n.tagName)>-1}(n)?an(n,t,e):function(n,t,e){on(n,t,e),function(n,t,e){var i=Q[n.tagName];i&&(i(n,t),B(n,t,e))}(n,t,e)}(n,t,e)},cn=function(n){n.removeAttribute(l),n.removeAttribute(s),n.removeAttribute(f)},un=function(n){D(n,(function(n){H(n,P)})),H(n,P)},ln={IMG:un,IFRAME:function(n){H(n,F)},VIDEO:function(n){V(n,(function(n){H(n,F)})),H(n,j),n.load()}},sn=function(n,t){(function(n){var t=ln[n.tagName];t?t(n):function(n){if(S(n)){var t=U(n);n.style.backgroundImage=t.backgroundImage}}(n)})(n),function(n,t){L(n)||w(n)||(C(n,t.class_entered),C(n,t.class_exited),C(n,t.class_applied),C(n,t.class_loading),C(n,t.class_loaded),C(n,t.class_error))}(n,t),k(n),$(n)},fn=["IMG","IFRAME","VIDEO"],dn=function(n){return n.use_native&&"loading"in HTMLImageElement.prototype},_n=function(n,t,e){n.forEach((function(n){return function(n){return n.isIntersecting||n.intersectionRatio>0}(n)?function(n,t,e,i){var o=function(n){return x.indexOf(y(n))>=0}(n);A(n,"entered"),N(n,e.class_entered),C(n,e.class_exited),function(n,t,e){t.unobserve_entered&&z(n,e)}(n,e,i),O(e.callback_enter,n,t,i),o||rn(n,e,i)}(n.target,n,t,e):function(n,t,e,i){L(n)||(N(n,e.class_exited),function(n,t,e,i){e.cancel_on_exit&&function(n){return y(n)===g}(n)&&"IMG"===n.tagName&&(tn(n),function(n){D(n,(function(n){cn(n)})),cn(n)}(n),un(n),C(n,e.class_loading),R(i,-1),k(n),O(e.callback_cancel,n,t,i))}(n,t,e,i),O(e.callback_exit,n,t,i))}(n.target,n,t,e)}))},gn=function(n){return Array.prototype.slice.call(n)},vn=function(n){return n.container.querySelectorAll(n.elements_selector)},bn=function(n){return function(n){return y(n)===p}(n)},pn=function(n,t){return function(n){return gn(n).filter(L)}(n||vn(t))},hn=function(n,e){var o=c(n);this._settings=o,this.loadingCount=0,function(n,t){i&&!dn(n)&&(t._observer=new IntersectionObserver((function(e){_n(e,n,t)}),function(n){return{root:n.container===document?null:n.container,rootMargin:n.thresholds||n.threshold+"px"}}(n)))}(o,this),function(n,e){t&&window.addEventListener("online",(function(){!function(n,t){var e;(e=vn(n),gn(e).filter(bn)).forEach((function(t){C(t,n.class_error),k(t)})),t.update()}(n,e)}))}(o,this),this.update(e)};return hn.prototype={update:function(n){var t,o,a=this._settings,r=pn(n,a);T(this,r.length),!e&&i?dn(a)?function(n,t,e){n.forEach((function(n){-1!==fn.indexOf(n.tagName)&&function(n,t,e){n.setAttribute("loading","lazy"),on(n,t,e),function(n,t){var e=Q[n.tagName];e&&e(n,t)}(n,t),A(n,h)}(n,t,e)})),T(e,0)}(r,a,this):(o=r,function(n){n.disconnect()}(t=this._observer),function(n,t){t.forEach((function(t){n.observe(t)}))}(t,o)):this.loadAll(r)},destroy:function(){this._observer&&this._observer.disconnect(),vn(this._settings).forEach((function(n){$(n)})),delete this._observer,delete this._settings,delete this.loadingCount,delete this.toLoadCount},loadAll:function(n){var t=this,e=this._settings;pn(n,e).forEach((function(n){z(n,t),rn(n,e,t)}))},restoreAll:function(){var n=this._settings;vn(n).forEach((function(t){sn(t,n)}))}},hn.load=function(n,t){var e=c(t);rn(n,e)},hn.resetStatus=function(n){k(n)},t&&function(n,t){if(t)if(t.length)for(var e,i=0;e=t[i];i+=1)u(n,e);else u(n,t)}(hn,window.lazyLoadOptions),hn}));

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
