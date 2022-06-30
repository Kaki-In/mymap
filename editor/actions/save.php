<?php

$CONF = [
	'database-host'=>'localhost',
	'database-username'=>'root',
	'database-password'=>'Caribou!33',
	'database-name'=>'mymap',
];

?>
<?php

$DATABASESTATUS = [
	'DatabaseAvailable'=>true,
	'DatabaseError'=>null,
	'DatabaseErrorNumber'=>null,
];

try {
	$MAIN_SQLI_CONNECTION=new PDO("mysql:host={$CONF['database-host']};dbname={$CONF['database-name']}", $CONF['database-username'], $CONF['database-password']);
	$MAIN_SQLI_CONNECTION->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exc) {
	$DATABASESTATUS['DatabaseAvailable']=false;
	$DATABASESTATUS['DatabaseError']=$exc->getMessage();
	$DATABASESTATUS['DatabaseErrorNumber']=$exc->getMessage();
}


function sendrequest($request, $getresult) {
	global $MAIN_SQLI_CONNECTION;
	global $DATABASESTATUS;
	if ($DATABASESTATUS['DatabaseAvailable']) {
		$sth = $MAIN_SQLI_CONNECTION->prepare($request);
		$resultat = $sth->execute();
		if ($getresult) {$resultat = $sth->fetchAll(PDO::FETCH_ASSOC);}
		return $resultat;
	}
	else {
		return false;
#		throw new Exception($DATABASESTATUS['DatabaseError']);
	}
}

function saveBlock($blockid, $blockdata, $blockcols, $blockback, $blockwalk, $blocktitle) {
	return sendrequest("UPDATE `blocks` SET `data`=".var_export($blockdata, true).", `colnum`='$blockcols', `title`=".var_export($blocktitle, true).", `background`='$blockback', `canbewalked`='$blockwalk' WHERE `id`='$blockid';", false);
}

if (isset($_REQUEST['saveblock']) and isset($_REQUEST['blockdata']) and isset($_REQUEST['blockcols']) and isset($_REQUEST['blockback']) and isset($_REQUEST['blockcanbewalked']) and isset($_REQUEST['blocktitle'])) {
	echo saveblock($_REQUEST['saveblock'], $_REQUEST['blockdata'], $_REQUEST['blockcols'], $_REQUEST['blockback'], $_REQUEST['blockcanbewalked'], $_REQUEST['blocktitle'])?1:0;
	var_dump($_REQUEST);
}

?>
