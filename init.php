<?php

if (!isset($CONF)) {include "conf.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}
if (!isset($MAPS)) {include "mapsinfo.php";}
if (!isset($USERS)) {include "userinfo.php";}
if (!isset($BLOCKS)) {include "blocksinfo.php";}
if (!isset($ACCOUNTS)) {include "accountinfo.php";}

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
	text-decoration : None;
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

input[type="text"], input[type="password"], input:not([type]) {
	border : 1px solid #ffcf03;
	background : white;
	outline : none;
	padding : 10px;
	border-radius : 10px;
	display : block;
}

input[type="submit"], button {
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

input[type="submit"]:hover, button:hover {
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
}

#connectdiv div button {
	width : 100%;
	margin-top : 20px;
}

#connectdiv div input {
	box-sizing:border-box;
	display : block;
	width : 100%;
	margin-top : 5px;
	margin-bottom : 10px;
}

#connectdiv div label {
	display:inline-block;
}

#connectdiv div h3 {
	display : block;
	margin-top : 20px;
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

		</script>
	</head>
	<body>
		<header>
			<img src="/favicon-256x256.png" onclick="document.location.href='<?php echo $CONF["pathname"]; ?>'"></img>
			<a href="<?php echo $CONF["pathname"]; ?>/create"><i class="fa fa-plus"></i>Nouvelle carte</a>
			<a href="<?php echo $CONF["pathname"]; ?>/blocks"><i class="fa fa-cubes"></i>Mes blocs</a>
			<a href="<?php echo $CONF["pathname"]; ?>/maps"><i class="fa fa-map"></i>Mes cartes</a>
			<ul href="<?php echo $CONF["pathname"]."/"; ?>">
				<li><a href="<?php echo $CONF["pathname"]; ?>/signin"><i class="fa fa-user"></i>Se connecter</a></li>
				<li><a href="<?php echo $CONF["pathname"]; ?>/signup"><i class="fa fa-user-plus"></i>Créer un compte</a></li>
			</ul>
		</header>
