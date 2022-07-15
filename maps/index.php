<?php
set_include_path("../:.:/usr/share/php");
include "init.php";

echo "<main>";
if (isset($_REQUEST["mapid"])) {
	$f = false;
	foreach($MAPS as $map) {
		if ($map->id==$_REQUEST["mapid"]) {
			$f=true;
			break;
		}
	}
	if ($f) {
		echo "<div class='mainzonefulldiv'>";
		include "mapzone.php";
		echo "</div>";
	} else {
		echo "<main><p>Carte non trouvée!</p>< href='./'>Retour</a>";
	}
} else {
	echo "<main><div id='mapsdiv'>
<h1>Mes cartes</h1>
<ul class='maplist'>";
	foreach ($MAPS as $map) {
		echo "<li><a href='./?mapid=".$map->id."'>".$map->name."</a></li>";
	}
	echo "</ul>
</div>";
}
?>
<?php include "end.php";?>
