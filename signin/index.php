<?php
set_include_path("../:.:/usr/share/php");
include "init.php";
?>
<main>
	<div id="connectdiv">
		<div>
			<h3> Connexion au compte </h3>
			<label>Nom d'utilisateur ou adresse mail : </label><input type="text" id="connectlogin">
			<label>Mot de passe : </label><input type="password" id="connectpassword">
			<button onclick="singin()">Se connecter</button>
		</div>
	</div>
