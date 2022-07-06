<?php

if (!isset($DATABASESTATUS)) {include "database.php";}

$_ = sendrequest("SELECT `id` from `maps`", true);

$MAPS=[];
foreach($_ as $map) {
	$MAPS[$map["id"]]=new SqlObject($map["id"], "maps");
}

?>
