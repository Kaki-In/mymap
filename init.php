<?php

if (!isset($CONF)) {include "conf.php";}
if (!isset($MAPS)) {include "mapsinfo.php";}
if (!isset($USERS)) {include "userinfo.php";}
if (!isset($BLOCKS)) {include "blocksinfo.php";}
if (!isset($REQSTATES)) {include "requests.php";}
if (!isset($ACCOUNTS)) {include "accountinfo.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}
if (!isset($MAIL_SCRIPT_ACTIVED)) {include "mailsend.php";};

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<style>

main {
	position : fixed;
	top : 120px;
	bottom : 0;
	right : 0;
	left : 0;
	overflow-y : auto;
	overflow-wrap: break-word;
}

h3 {
	font-size : 30px;
}

header {
	position : fixed;
	top : 0;
	right : 0;
	left : 0;
	width : 100%;
	height : 70px;
	background : linear-gradient(0deg, rgba(128,103,0,1) 0%, rgba(255,206,0,1) 25%);
	padding : 25px;
	display : flex;
	justify-content: center;
	margin : auto;
	z-index : 100;
}

header a {
	text-decoration : none;
	background : #ffcf03;
	padding : 10px;
	margin : 5px;
	color : black;
	font-weight : bold;
	font-size : 20px;
	border-radius : 10px;
	text-align : middle;
	transition : 0.25s all ease-out;
}

header > a {
	border : 1px solid white;
}

header a:hover {
	background : #bf9b02;
}

header img {
	position : absolute;
	display : block;
	width : 120px;
	height : 120px;
	top : 0px;
	left : 0px;
	transition : 0.2s all ease-out;
	cursor:pointer;
}

header img:hover {
	width : 150px;
	height : 150px;
	top : -10px;
	left : -10px;
	transition : 0.2s all ease-in;
}

header ul {
	background : #ffcf03;
	margin : 5px;
	padding : 0;
	color : black;
	font-weight : bold;
	font-size : 20px;
	border-radius : 10px;
	border : 1px solid white;
	height : 58px;
	transition : 0.25s all ease-out;
	overflow : hidden;
	list-style : none;
}

header ul:hover {
	height : 120px;
}

header ul li:not(first-child) {
	padding-bottom : 10px;
}

header ul li {
	background : #ffcf03;
	padding-top : 10px;
	padding-left : 10px;
	transition : 0.25s all ease-out;
}

header ul li:hover {
	background : #bf9b02;
}

header ul li:hover a {
	background : #bf9b02;
}

header ul li a {
	position : relative;
	display:inline-block;
	padding : 0;
	margin : 0;
	width : 100%;
}

header * {
	flex-shrink : 0;
}

header > * {
	width : 250px;
}

table.mapedit {
	background: var(--back);
	display : flex;
	width : 500px;
	height : 500px;
	flex-direction : column;
	justify-content: space-evenly;
	padding : 1px;
}

table.blockedit tr {
	display : flex;
	flex-direction : row;
	justify-content: space-evenly;
	flex-grow: 1;
}

table.blockedit tr td {
	background: var(--back);
	margin : 1px;
	flex-grow: 1;
}


#mainzone {
	position : fixed;
	width : 100vh;
	height : 100vw;
	top : 0;
	left : 0px;
}

.mainzonefulldiv {
	background : black;
	position : fixed;
	width : 100%;
	top : 120px;
	left : 0px;
	bottom : 0px;
}

#mainmapzone{
	position : absolute;
	top : 0px;
	left : 0px;
	width : 100%;
	display: block;
}

i.fa {
	margin : 10px;
}

i.fa.fa-spinner {
        animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

a {
	color : #7f6701;
}

input[type="text"]:not(.nostyle), input[type="password"]:not(.nostyle), input[type="email"]:not(.nostyle), input[type="number"]:not(.nostyle), input:not([type]):not(.nostyle) {
	border : 1px solid #ffcf03;
	background : white;
	outline : none;
	padding : 10px;
	border-radius : 10px;
	display : block;
}

input[type="submit"]:not(.nostyle), button:not(.nostyle) {
	border : 1px solid #ffcf03;
	background : #ffcf03;
	outline : none;
	padding : 20px;
	border-radius : 10px;
	display : block;
	transition : 0.25s all ease-out;
	cursor : pointer;
	text-transform : uppercase;
	font-weight : bold;
}

input[type="submit"].disabled:not(.nostyle), button.disabled:not(.nostyle) {
	border : 1px solid #ccc;
	background : #ccc;
	pointer-events : none;
}

input[type="submit"]:not(.disabled):not(.nostyle), button:not(.disabled):hover:not(.nostyle) {
	background : #bf9b02;
}

#connectdiv {
	background : #ffcf03;
	padding : 20px;
	margin-top : 70px;
	text-align : center;
}

#connectdiv div {
	display : inline-block;
	background : white;
	padding : 20px;
	border-radius : 20px;
	width : 20%;
	min-width : 350px;
}

#connectdiv div button {
	width : 100%;
	margin-top : 20px;
	height : 75px;
}

#connectdiv div input {
	box-sizing:border-box;
	display : block;
	width : 100%;
	margin-top : 5px;
	margin-bottom : 10px;
}

#connectdiv div p {
	display : block;
	margin-bottom : 20px;
}

#connectdiv div label {
	display:inline-block;
	text-align : left;
	font-weight : bold;
	width : 100%;
}

#connectdiv div h3 {
	display : block;
	margin-top : 20px;
	margin-bottom : 0px;
	font-size : 30px;
}

#connectdiv button:not(.loading) i.fa.fa-spinner {
        display : none;
}

#maintable {
	position : relative;
	width : 500px;
	height : 500px;
	display : flex;
	flex-direction : column;
	border : 1px solid black;
	background : var(--back);
}

#maintable tr {
	display : flex;
	flex-direction : row;
}

#maintable td {
	border : 1px solid black;
	margin : 0px;
	padding : 0px;
}

.errorinfo {
	color : red;
}

div.fullscreendivopt {
	position : fixed;
	top : 50%;
	left : 50%;
	right : 50%;
	bottom : 50%;
	background : #0008;
	z-index : 150;
	transition : all 0.75s ease-out;
	opacity : 0;
	overflow : hidden;
	display: flex;
	align-items: center;
	justify-content: center;
}

div.fullscreendivopt.shown {
	top : 0;
	left : 0;
	right : 0;
	bottom : 0;
	opacity : 1;
}

div.fullscreendivopt > div {
	display: inline-block;
	background : white;
	text-align: center;
	align-items: center;
	vertical-align: middle;
	margin-bottom : 400px;
	transition : all 1s ease-out;
}

div.fullscreendivopt div {
	padding : 20px;
}

div.fullscreendivopt.shown > div {
	margin-bottom : 0px;
}


.actionstyle input[type="text"], .actionstyle input[type="password"], .actionstyle input[type="email"], .actionstyle input[type="number"], .actionstyle input:not([type]) {
	border : 1px solid black;
	background : white;
	padding : 10px;
	display : inline-block;
	-moz-appearance: textfield;
}

.actionstyle input[type="submit"], .actionstyle button {
	border : 1px solid black;
	background : white;
	outline : none;
	padding : 10px;
	display : inline-block;
	cursor : pointer;
}

.actionstyle input[type="submit"].disabled, .actionstyle button.disabled {
	border : 1px solid #444;
	background : #eee;
	pointer-events : none;
	color : #444;
}

.actionstyle input[type="submit"]:not(.disabled):hover, .actionstyle button:not(.disabled):hover {
	background : lightgrey;
}

.actionstyle .numcode {
	display : inline-block;
}

.actionstyle .buttonschoicelist {
	display : block;
}

.actionstyle input[type="number"]::-webkit-outer-spin-button,
.actionstyle input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
  background : red;
}

div.blocklist {
	position : relative;
	display : flex;
	margin : 10px;
}

div.blocklist a {
	display : inline-block;
	width : 150px;
	overflow : hidden;
	border-radius : 20px 20px 0px 0px;
	border : 5px solid black;
	margin : 10px;
	text-decoration : none;
	transition : all 0.1s ease-out;
}

div.blocklist p {
	width : 100%;
	text-align : center;
	color : black;
	font-size : 20px;
	font-weight : bold;
}

div.blocklist a:hover {
	opacity : 0.5;
}

		</style>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 1.32/ssh+nano" />
		<meta name="description" content="Création de cartes interactives et pixellisées, ouverte au monde entier."/>
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffcf03">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffcf03">
		<script src="https://kit.fontawesome.com/d5396126f5.js" crossorigin="anonymous"></script>
		<script>

function init() {
	document.getElementById("verifymaildiv").onopen=function () {}
	document.getElementById("verifymaildiv").onclose=function (state)
	{
		if (state=='canceled') {
			document.getElementById("signupbtn").classList.remove("loading");
			document.getElementById("signupbtn").classList.remove("disabled");
		}
		else if (state=='accepted') {
			callScript("verifymail", {login:this.login, password:this.password, code:document.getElementById("mail1").value+document.getElementById("mail2").value+document.getElementById("mail3").value+document.getElementById("mail4").value+document.getElementById("mail5").value+document.getElementById("mail6").value}, onVerifyMailReceived);
		}
	}
	var elements = document.getElementsByClassName("verifycodenum");
	for (var i=0;i<elements.length;i++) {
		elements[i].onkeyup=function onNumberVerifycodeChange(event) {
			if (!Number.isNaN(parseInt(event.key))) {
				this.value=event.key;
				if (this.nextSibling.nextSibling) {this.nextSibling.nextSibling.focus();}
				else {
					if (this.parentElement.id=="mailcode") {document.getElementById("btnmailcode").onclick();}
				}
			} else {this.value="";}
		}
	}
}

setTimeout(init, 100);

function callScript(scriptname, scriptrequests, onload) {
	var script = new XMLHttpRequest();
	var formData = new FormData();
	for (var i=0;i<Object.keys(scriptrequests).length;i++) {
		formData.append(Object.keys(scriptrequests)[i], scriptrequests[Object.keys(scriptrequests)[i]]);
	}
	script.open("POST", "./actions/"+scriptname+".php", true);
	script.send(formData);
	script.overrideMimeType("text/plain; charset=x-user-defined");
	script.onload = onload;
}

function signin() {
	document.getElementById("connecterror").textContent="";
	if (!document.getElementById("connectlogin").value) {
		document.getElementById("connecterror").textContent="Le nom d'utilisateur est requis";
	} else if (!document.getElementById("connectpassword").value) {
		document.getElementById("connecterror").textContent="Le mot de passe est requis";
	} else {
		document.getElementById("signinbtn").classList.add("loading");
		document.getElementById("signinbtn").classList.add("disabled");
		callScript("signin", {login:document.getElementById("connectlogin").value, password:document.getElementById("connectpassword").value}, signedin);
	}
}

function signedin() {
	request=this;
	console.log(request.response);
	code = parseInt(request.response.substring(0, 3));
	info = unescape(request.response.substring(3));
	if (request.status==500) {
		document.getElementById("connecterror").textContent="Une erreur s'est produite. Si le problème persiste, réessayez plus tard.";
		document.getElementById("signinbtn").classList.remove("loading");
		document.getElementById("signinbtn").classList.remove("disabled");
	}
	else if (code==<?php echo $REQSTATES["LoginConnectionSuccess"]?>) {
		document.location.href="<?php echo $CONF["pathname"]; ?>/";
	}
	else if (code==<?php echo $REQSTATES["LoginPleaseVerifyYourMail"]?>) {
		document.getElementById("connecterror").textContent="Merci de vérifier votre adresse mail";
		document.getElementById("verifymaildiv").login=document.getElementById("connectlogin").value;
		document.getElementById("verifymaildiv").password=document.getElementById("connectpassword").value;
		verifyMailAdress();
	}
	else if (code==<?php echo $REQSTATES["LoginConnectionFailed"]?>) {
		document.getElementById("connecterror").textContent="Nom d'utilisateur ou mot de passe incorrect";
		document.getElementById("signinbtn").classList.remove("loading");
		document.getElementById("signinbtn").classList.remove("disabled");
	}
	else if (code==<?php echo $REQSTATES["ServerCrash"]?>) {
		document.getElementById("connecterror").textContent="Une erreur s'est produite. Veuillez rafraichir la page, si le problème persiste, réessayez plus tard.";
		document.getElementById("signinbtn").classList.remove("loading");
	}
	else if (code==<?php echo $REQSTATES["LoginActuallyUnavailable"]?>) {
		document.getElementById("connecterror").textContent="Le site n'est pas encore prêt à accueillir de nouvelles connexions";
		document.getElementById("signinbtn").classList.remove("loading");
	}
	else if (code==<?php echo $REQSTATES["InvalidRequest"]?>) {
		document.location.href=document.location.href;
	}
}

function signup() {
	document.getElementById("connecterror").textContent="";
	document.getElementById("verifymaildiv").mail=document.getElementById("createmail").value;
	if (!document.getElementById("createlogin").value) {
		document.getElementById("connecterror").textContent="Le nom d'utilisateur est requis";
	} else if (!document.getElementById("createmail").value) {
		document.getElementById("connecterror").textContent="L'adresse mail est requise";
	} else if (!document.getElementById("createpassword").value) {
		document.getElementById("connecterror").textContent="Le mot de passe est requis";
	} else if (!document.getElementById("createpasswordagain").value) {
		document.getElementById("connecterror").textContent="Veuillez confirmer le mot de passe";
	} else if (!(document.getElementById("createpasswordagain").value==document.getElementById("createpassword").value)) {
		document.getElementById("connecterror").textContent="Les mots de passe ne correspondent pas";
	} else {
		document.getElementById("signupbtn").classList.add("loading");
		document.getElementById("signupbtn").classList.add("disabled");
		callScript("signup", {mail:document.getElementById("createmail").value, password:document.getElementById("createpassword").value, username:document.getElementById("createlogin").value}, signedup);
	}
}

function signedup() {
	request=this;
	console.log(request.response);
	code = parseInt(request.response.substring(0, 3));
	info = unescape(request.response.substring(3));
	if (request.status==500) {
		document.getElementById("connecterror").textContent="Une erreur s'est produite. Si le problème persiste, réessayez plus tard.";
		document.getElementById("signupbtn").classList.remove("loading");
		document.getElementById("signupbtn").classList.remove("disabled");
	}
	else if (code==<?php echo $REQSTATES["SignUpCreationWaiting"]?>) {
		document.getElementById("connecterror").textContent="Merci de vérifier votre adresse mail";
		document.getElementById("verifymaildiv").login=document.getElementById("createlogin").value;
		document.getElementById("verifymaildiv").password=document.getElementById("createpassword").value;
		verifyMailAdress();
	}
	else if (code==<?php echo $REQSTATES["SignUpCreationAlreadyWaiting"]?>) {
		document.getElementById("connecterror").textContent="Un mail de confirmation vous a été renvoyé.";
		document.getElementById("verifymaildiv").login=document.getElementById("createlogin").value;
		document.getElementById("verifymaildiv").password=document.getElementById("createpassword").value;
		verifyMailAdress();
	}
	else if (code==<?php echo $REQSTATES["SignUpCreationSuccess"]?>) {
		document.location.href="<?php echo $CONF["pathname"]; ?>/";
	}
	else if (code==<?php echo $REQSTATES["SignUpCreationFailed"]?>) {
		document.getElementById("connecterror").textContent="Nom d'utilisateur ou adresse mail déjà existant(e)";
		document.getElementById("signupbtn").classList.remove("loading");
		document.getElementById("signupbtn").classList.remove("disabled");
	}
	else if (code==<?php echo $REQSTATES["ServerCrash"]?>) {
		document.getElementById("connecterror").textContent="Une erreur s'est produite. Veuillez rafraichir la page, si le problème persiste, réessayez plus tard.";
		document.getElementById("signupbtn").classList.remove("loading");
	}
	else if (code==<?php echo $REQSTATES["SignUpActuallyUnavailable"]?>) {
		document.getElementById("connecterror").textContent="Le site n'est pas encore prêt à accueillir de nouvelles connexions";
		document.getElementById("signupbtn").classList.remove("loading");
	}
	else if (code==<?php echo $REQSTATES["InvalidRequest"]?>) {
		document.location.href=document.location.href;
	}
}

function verifyMailAdress () {
	openFullscreenDiv(document.getElementById("verifymaildiv"));
}

function openFullscreenDiv(div) {
	div.classList.add("shown");
	div.onopen();
}

function closeFullscreenDiv(div, state) {
	div.classList.remove("shown");
	div.onclose(state);
}

function onVerifyMailReceived() {
	try {
		document.getElementById("signupbtn").classList.remove("loading");
		document.getElementById("signupbtn").classList.remove("disabled");
	} catch {
		document.getElementById("signinbtn").classList.remove("loading");
		document.getElementById("signinbtn").classList.remove("disabled");
	}
	request=this;
	console.log(request.response);
	code = parseInt(request.response.substring(0, 3));
	info = unescape(request.response.substring(3));
	if (request.status==500) {
		document.getElementById("connecterror").textContent="Une erreur s'est produite. Si le problème persiste, réessayez plus tard.";
	}
	else if (code==<?php echo $REQSTATES["MailVerificationSuccess"]?>) {
		document.getElementById("connecterror").textContent="Vous pouvez à présent vous connecter.";
	}
	else if (code==<?php echo $REQSTATES["MailVerificationFailed"]?>) {
		document.getElementById("connecterror").textContent="La vérification à échoué.";
	}
	else if (code==<?php echo $REQSTATES["ServerCrash"]?>) {
		document.getElementById("connecterror").textContent="Une erreur s'est produite. Veuillez rafraichir la page, si le problème persiste, réessayez plus tard.";
	}
	else if (code==<?php echo $REQSTATES["MailVerificationUnavailable"]?>) {
		document.getElementById("connecterror").textContent="Le site n'est pas encore prêt à accueillir de nouvelles connexions";
	}
	else if (code==<?php echo $REQSTATES["InvalidRequest"]?>) {
		document.getElementById("connecterror").textContent="Une erreur est intervenue.";
	}
}

		</script>
	</head>
	<body>
		<header>
			<img src="/favicon-256x256.png" onclick="document.location.href='<?php echo $CONF["pathname"]; ?>'"></img>
<?php

if (is_null($USERINFO["user"]->account)) {
	echo "<a href='{$CONF["pathname"]}/signin'><i class='fa fa-user'></i>Se connecter</a>
	<a href='{$CONF["pathname"]}/signup'><i class='fa fa-user'></i>Créer un compte</a>";
} else {
	echo "
<a href='{$CONF["pathname"]}/create'><i class='fa fa-plus'></i>Nouvelle carte</a>
<a href='{$CONF["pathname"]}/blocks'><i class='fa fa-cubes'></i>Mes blocs</a>
<a href='{$CONF["pathname"]}/maps'><i class='fa fa-map'></i>Mes cartes</a>
<ul>
	<li><a href='{$CONF["pathname"]}/account'><i class='fa fa-user'></i>".$ACCOUNTS[$USERINFO["user"]->account]->login."</a></li>
	<li><a href='{$CONF["pathname"]}/'><i class='fa fa-user'></i>".""."</a></li>
</ul>";
}
?>		</header>
		<div class="fullscreendivopt actionstyle" id="verifymaildiv">
			<div>
				<h3>Vérification de l'adresse mail</h3>
				<div>
					Un code de vérification vous a été envoyé par voie email.
				</div>
				<label>
					Code de vérification :
				</label>
				<div class='numcode' id="mailcode">
					<input type="number" class="verifycodenum nostyle" min="0" max="9" value="0" id="mail1">
					<input type="number" class="verifycodenum nostyle" min="0" max="9" value="0" id="mail2">
					<input type="number" class="verifycodenum nostyle" min="0" max="9" value="0" id="mail3">
					<input type="number" class="verifycodenum nostyle" min="0" max="9" value="0" id="mail4">
					<input type="number" class="verifycodenum nostyle" min="0" max="9" value="0" id="mail5">
					<input type="number" class="verifycodenum nostyle" min="0" max="9" value="0" id="mail6">
				</div>
				<div class='buttonschoicelist'>
					<button class="nostyle" onclick="closeFullscreenDiv(document.getElementById('verifymaildiv'), 'accepted')" id="btnmailcode">Valider</button>
					<button class="nostyle" onclick="closeFullscreenDiv(document.getElementById('verifymaildiv'), 'canceled')">Annuler</button>
				</div>
			</div>
		</div>
