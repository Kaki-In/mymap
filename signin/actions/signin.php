<?php
header('Content-type: text/html; charset=UTF-8');

set_include_path("../../:.:/usr/share/php");
if (!isset($ACCOUNTS)) {include "accountinfo.php";}
if (!isset($REQSTATES)) {include "requests.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}

if (isset($_REQUEST['login']) and isset($_REQUEST['password'])) {
	$id=sendrequest("SELECT * FROM `accounts` WHERE `login`='".$_REQUEST['login']."' and `password`='".hash('sha256', $_REQUEST['password'])."';", true);
	$id2=sendrequest("SELECT * FROM `accounts` WHERE `mail`='".$_REQUEST['login']."' and `password`='".hash('sha256', $_REQUEST['password'])."';", true);
	if (count($id)) {
		echo $REQSTATES["LoginConnectionSuccess"];
		connectUserToAccount($ACCOUNTS[$id[0]['id']]);
	} else if (count($id2)) {
		echo $REQSTATES["LoginConnectionSuccess"];
		connectUserToAccount($ACCOUNTS[$id2[0]['id']]);
	} else {
		echo $REQSTATES["LoginConnectionFailed"];
	}
} else {
	echo $REQSTATES["InvalidRequest"];
}

?>
