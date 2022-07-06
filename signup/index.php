<?php
set_include_path("../:.:/usr/share/php");
include "init.php";
?>
<main>
	<div id="connectdiv">
		<div>
			<h3> Créer un compte </h3>
			<p>Cherchez-vous à vous <a href="<?php echo $CONF["pathname"]; ?>/signin">connecter</a>?</p>
			<label id="connecterror" class="errorinfo"></label>
			<label>Nom d'utilisateur : </label><input type="text" id="createlogin">
			<label>Adresse email : </label><input type="email" id="createmail">
			<label>Mot de passe : </label><input type="password" id="createpassword">
			<label>Veuillez confirmer le mot de passe : </label><input type="password" id="createpasswordagain">
			<button onclick="signup();" id="signupbtn"><i class="fa fa-spinner"></i>Créer un compte</button>
		</div>
	</div>
