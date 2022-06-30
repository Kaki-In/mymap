<?php
set_include_path("../:.:/usr/share/php");
include "init.php"
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<style>

table {
	background: var(--back);
	display : flex;
	width : 500px;
	height : 500px;
	flex-direction : column;
	justify-content: space-evenly;
	padding : 1px;
}

table tr {
	display : flex;
	flex-direction : row;
	justify-content: space-evenly;
	flex-grow: 1;
}

table tr td {
	background: var(--back);
	margin : 1px;
	flex-grow: 1;
}

		</style>
	</head>
	<body>
		<h1>Editor</h1>
<?php

$blocks = sendrequest("SELECT * from `blocks`", true);
if (isset($_REQUEST['blockid'])) {
	$f=false;
	foreach($blocks as $block) {
		if ($block['id']==$_REQUEST['blockid']) {
			$f=true;
			break;
		}
	}
	if ($f) {
		$block=["id"=>(int)$block['id'], "data"=>$block['data'], "cols"=>$block['colnum'], "back"=>$block['background'], "canbewalked"=>(bool)$block['canbewalked'], "title"=>$block['title']];
		include 'block_creator.php';
	}
	else {
		echo "block non trouvé";
	}
} elseif (isset($_REQUEST['newblock'])) {
	$id=createBlock();
	$block=["id"=>(int)$id, "data"=>str_repeat('!', 256), "cols"=>16, "back"=>"#008800", "canbewalked"=>true, "title"=>"NewBlock"];
	include 'block_creator.php';
} else {
	foreach($blocks as $block) {
			echo "<a href='./?blockid={$block['id']}'>{$block['title']}</a><br>";
	}
	echo "<br><a href='./?newblock'>Créer un nouveau block</a>";
	echo "<a href='../' style='bottom:0;position:fixed'>Retour</a>";
}
?>
	</body>
</html>
