<?php
header('Content-type: text/html; charset=UTF-8');

set_include_path("../../:.:/usr/share/php");
if (!isset($ACCOUNTS)) {include "accountinfo.php";}
if (!isset($REQSTATES)) {include "requests.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}

if (isset($_REQUEST['mail']) and isset($_REQUEST['password']) and isset($_REQUEST['username'])) {
	$id=sendrequest("SELECT * FROM `accounts` WHERE `login`='".$_REQUEST['username']."';", true);
	$id2=sendrequest("SELECT * FROM `accounts` WHERE `mail`='".$_REQUEST['mail']."';", true);
	$mailwait=sendrequest("SELECT * FROM `mailverifycodes` WHERE `mail`='".$_REQUEST['mail']."';", true);
	if (count($mailwait)) {
		$mailverif = $mailwait[0];
		if ($mailverif["succeed"]) {
			echo $REQSTATES["SignUpCreationFailed"];
		}
		else {
			if (time()-strtotime($mailverif["expires"])<5*60) {
				echo $REQSTATES["SignUpCreationAlreadyWaiting"];
			} else {
				echo $REQSTATES["SignUpCreationWaiting"];
			}
		}
	} else if (count($id) or count($id2)) {
		echo $REQSTATES["SignUpCreationFailed"];
	} else {
		echo $REQSTATES["SignUpCreationWaiting"];
	}
	var_dump($id);
	var_dump($id2);
	var_dump($mailwait);
} else {
	echo $REQSTATES["InvalidRequest"];
}

?>
