<?php
set_include_path("../:.:/usr/share/php");
include "init.php"
?>
<main>
	<h1>Editor</h1>
<?php

if (isset($_REQUEST['blockid'])) {
	$f=false;
	foreach($BLOCKS as $block) {
		if ($block->id==$_REQUEST['blockid']) {
			$f=true;
			break;
		}
	}
	if ($f) {
		$block=["id"=>(int)$block->id, "data"=>$block->data, "cols"=>$block->colnum, "back"=>$block->background, "canbewalked"=>(bool)$block->canbewalked, "title"=>$block->title];
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
	echo "<br><a href='./?newblock'>Créer un nouveau block</a>";
	echo "<a href='../' style='bottom:0;position:fixed'>Retour</a>";
}
?>
	</body>
</html>
