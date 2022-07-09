<?php
set_include_path("../:.:/usr/share/php");
include "conf.php";
include "userinfo.php";

if (is_null($USERINFO["user"]->account)) {
	header("Location: {$CONF['pathname']}/signup", true, 302);
	die();
}

include "init.php";
echo "<main>";

if (isset($_REQUEST["blockid"])) {
	var_dump($BLOCKS[$_REQUEST["blockid"]]);
} else {
	echo "<h3>Mes blocks</h3>
<ul class='blocklist'>";
	$n=0;
	foreach($BLOCKS as $block) {
		if ($block->creator==$USERINFO["user"]->account) {
			echo "<li href='./?blockid=".$block->id."'>".$block->title."</li>";
		}
	}
	if (!$n) {echo "<i>Vous n'avez encore créé aucun block.</i>";}
	echo "</ul>
<h3>Mon sac à blocks</h3>
<div class='blocklist'>";
	$kblocks = getBlocksBag($ACCOUNTS[$USERINFO["user"]->account]);
	foreach($kblocks as $block) {
		echo "<a href='./?blockid=".$block->id."'><img src='{$CONF["pathname"]}/imagesapi/imagecreator.php?blockid=".$block->id."&dims=150='><p>".$block->title."</p></a>";
	}
	echo "</div>";

	echo "<a href='{$CONF['pathname']}/editor'>Accéder à l'éditeur</a>";
}
?>
<?php include "end.php";?>
