<?php
set_include_path("../:.:/usr/share/php");
include "conf.php";
include "userinfo.php";

if (is_null($USERINFO["user"]->account)) {
	header("Location: {$CONF['pathname']}/signup", true, 302);
	die();
}

include "init.php";

echo "<main>
<h3>Mes blocks</h3>
<ul class='blocklist'>";
	foreach($BLOCKS as $block) {
		if ($block->creator==$USERINFO["user"]->account) {
			echo "<li href='./?blockid=".$block->id."'>".$block->title."</li>";
		}
	}
	echo "</ul>
<h3>Mon sac à blocks</h3>
<ul class='blocklist'>";
	$kblocks = getBlocksBag($ACCOUNTS[$USERINFO["user"]->account]);
	foreach($kblocks as $block) {
		echo "<li href='./?blockid=".$block->id."'>".$block->title."</li>";
	}
	echo "</ul>";

echo "<a href='{$CONF['pathname']}/editor'>Accéder à l'éditeur</a>";

?>
<?php include "end.php";?>
