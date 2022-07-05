<?php
set_include_path("../:.:/usr/share/php");
include "init.php";
?>
<main>
	<div id="connectdiv">
		<div>
			<h3> Connexion au compte </h3>
			<p>Cherchez-vous à vous <a href="<?php echo $CONF["pathname"]; ?>/signup">créer un compte</a>?</p>
			<label id="connecterror" class="errorinfo"></label>
			<label>Nom d'utilisateur ou adresse mail : </label><input type="text" id="connectlogin">
			<label>Mot de passe : </label><input type="password" id="connectpassword">
			<button onclick="signin();" id="signinbtn"><i class="fa fa-spinner"></i>Se connecter</button>
		</div>
	</div>
