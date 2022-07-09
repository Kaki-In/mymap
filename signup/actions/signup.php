<?php
header('Content-type: text/html; charset=UTF-8');

set_include_path("../../:.:/usr/share/php");
if (!isset($REQSTATES)) {include "requests.php";}
if (!isset($ACCOUNTS)) {include "accountinfo.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}
if (!isset($MAIL_SCRIPT_ACTIVED)) {include "mailsend.php";};

if (isset($_REQUEST['mail']) and isset($_REQUEST['password']) and isset($_REQUEST['username'])) {
	$id=sendrequest("SELECT * FROM `accounts` WHERE `login`='".$_REQUEST['username']."';", true);
	$id2=sendrequest("SELECT * FROM `accounts` WHERE `mail`='".$_REQUEST['mail']."';", true);
	$mailwait=sendrequest("SELECT * FROM `mailverifycodes` WHERE `mail`='".$_REQUEST['mail']."';", true);
	if (count($mailwait)) {
		$mailverif = $mailwait[0];
		if ($ACCOUNTS[$mailverif["account"]]->verified) {
			echo $REQSTATES["SignUpCreationFailed"];
		}
		else {
			if (time()-strtotime($mailverif["expired"])<5*60) {
				echo $REQSTATES["SignUpCreationAlreadyWaiting"];
			} else {
				echo $REQSTATES["SignUpCreationWaiting"];
				sendrequest("UPDATE `mailverifycodes` SET `code`='".getVerificationCode($_REQUEST['mail'])."' WHERE `mail`='".$_REQUEST['mail']."';", false);
			}
		}
	} else if (count($id) or count($id2)) {
		echo $REQSTATES["SignUpCreationFailed"];
		sendrequest("UPDATE `mailverifycodes` SET `code`='".getVerificationCode($_REQUEST['mail'])."' WHERE `mail`='".$_REQUEST['mail']."';", false);
	} else {
		echo $REQSTATES["SignUpCreationWaiting"];
		sendrequest("INSERT INTO `accounts` (`login`, `mail`, `password`) VALUES (".json_encode($_REQUEST['username']).", ".json_encode($_REQUEST['mail']).", '".hash('sha256', $_REQUEST['password'])."');", false);
		$result=sendrequest("SELECT * FROM `accounts` WHERE `login`=".json_encode($_REQUEST['username'])." and `mail`=".json_encode($_REQUEST['mail'])." and `password`='".hash('sha256', $_REQUEST['password'])."';", true)[0];
		sendrequest("INSERT INTO `mailverifycodes` (`code`, `mail`, `account`) VALUES ('".getVerificationCode($_REQUEST['mail'])."', '{$_REQUEST['mail']}', '{$result["id"]}');", false);
	}
} else {
	echo $REQSTATES["InvalidRequest"];
}

?>
