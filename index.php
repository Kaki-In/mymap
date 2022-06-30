<?php include "init.php"?>

<?php
if (isset($_REQUEST["mapId"])) {
	foreach($MAPS as $amap) {
			if ($amap['id']==$_REQUEST["mapId"]) {
				$map=$amap;
				break;
			}
	}
	if (isset($map)) {
		include "mapzone.php";
	}
	echo "<a href='./' style='bottom:0;position:fixed'>Retour</a>";
}

else {
	echo "
<h1>Bienvenue sur MyMap!</h1>";
}

?>
