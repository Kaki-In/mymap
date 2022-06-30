<?php

include "conf.php";
include "database.php";
include "mapsinfo.php";
include "userinfo.php";
include "blocksinfo.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<style>

main {
	position : relative;
}

header {
	position : fixed;
	top : 0;
	right : 0;
	left : 0;
	width : 100%;
	height : 50px;
	background : linear-gradient(0deg, rgba(128,103,0,1) 0%, rgba(255,206,0,1) 25%);
	padding : 25px;
	display : flex;
	align-items : center;
	justify-content: center;
	margin : auto;
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
	border : 1px solid white;
	transition : 0.25s all ease-out;
}

header a:hover {
	text-decoration : None;
	background : #bf9b02;
}

header img {
	position : absolute;
	display : block;
	width : 100px;
	height : 100px;
	top : 0px;
	left : 0px;
	transition : 0.2s all ease-out;
	cursor:pointer;
}

header img:hover {
	width : 120px;
	height : 120px;
	top : -10px;
	left : -10px;
	transition : 0.2s all ease-in;
}

header * {
	flex-shrink : 0;
}

main {
	position : fixed;
	top : 100px;
	bottom : 0;
	right : 0;
	left : 0;
	width : 100%;
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

table.mapedit tr {
	display : flex;
	flex-direction : row;
	justify-content: space-evenly;
	flex-grow: 1;
}

table.mapedit tr td {
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

#mainmapzone{
	position : absolute;
	top : 0px;
	left : 0px;
	display: block;
}

i.fa {
	margin : 10px;
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
	</head>
	<body>
		<header>
			<img src="/favicon-256x256.png" onclick="document.location.href='<?php echo $CONF["pathname"]; ?>'"></img>
			<a href="<?php echo $CONF["pathname"]; ?>/create"><i class="fa fa-plus"></i>Nouvelle carte</a>
			<a href="<?php echo $CONF["pathname"]; ?>/blocks"><i class="fa fa-cubes"></i>Mes blocs</a>
			<a href="<?php echo $CONF["pathname"]; ?>/maps"><i class="fa fa-map"></i>Mes cartes</a>
			<a href="<?php echo $CONF["pathname"]."/"; ?>"><i class="fa fa-user"></i>Se connecter</a>
		</header>
		<main>
