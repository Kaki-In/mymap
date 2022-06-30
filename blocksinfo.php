<?php

$_ = sendrequest("SELECT `id` from `blocks`", true);

$BLOCKS=[];
foreach($_ as $block) {
	$BLOCKS[$block["id"]]=new SqlObject($block["id"], "blocks");
}

?>
