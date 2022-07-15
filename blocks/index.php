<?php
set_include_path("../:.:/usr/share/php");
if (!isset($USERINFO)) {include "userinfo.php";}
if (!isset($CONF)) {include "conf.php";}

if (is_null($USERINFO["user"]->account)) {
	header("Location: {$CONF['pathname']}/signup", true, 302);
	die();
}

include "init.php";
echo "<main>";

if (isset($_REQUEST["blockid"])) {
	var_dump($BLOCKS[$_REQUEST["blockid"]]);
} else {
	echo "
<div class='blockdiv'><h3><i class='fa fa-cubes'></i>Mes blocks</h3><div class='blocklist'>";
	foreach($BLOCKS as $block) {
		if ($block->creator==$USERINFO["user"]->account) {
			echo "<a href='./?blockid=".$block->id."'><img src='{$CONF["pathname"]}/imagesapi/imagecreator.php?blockid=".$block->id."&dims=150='><p>".$block->title."</p></a>";
		}
	}
	echo "<a href='{$CONF["pathname"]}/creator'><i class='fa fa-plus'></i><p><i>Créer...</i></p></a>";
	echo "</div></div>";
	echo "
<div class='blockdiv'><h3><i class='fa fa-cubes-stacked'></i>Mon sac à blocks</h3><div class='blocklist'>";
	$kblocks = getBlocksBag($ACCOUNTS[$USERINFO["user"]->account]);
	foreach($kblocks as $block) {
		echo "<a href='./?blockid=".$block->id."'><img src='{$CONF["pathname"]}/imagesapi/imagecreator.php?blockid=".$block->id."&dims=150='><p>".$block->title."</p></a>";
	}
	echo "<a href='{$CONF["pathname"]}/creator'><i class='fa fa-search'></i><p><i>Ajouter...</i></p></a>";
	echo "</div></div>";

	echo "<a href='{$CONF['pathname']}/editor'>Accéder à l'éditeur</a>";
}
?>
<?php include "end.php";?>
