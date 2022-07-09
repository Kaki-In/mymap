<?php

set_include_path("../../:.:/usr/share/php");
if (!isset($REQSTATES)) {include "requests.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}

if (isset($_REQUEST["login"]) and isset($_REQUEST["code"]) and isset($_REQUEST["password"])) {
	$id=sendrequest("SELECT * FROM `accounts` WHERE `login`='".$_REQUEST['login']."' and `password`='".hash('sha256', $_REQUEST['password'])."';", true);
	$id2=sendrequest("SELECT * FROM `accounts` WHERE `mail`='".$_REQUEST['login']."' and `password`='".hash('sha256', $_REQUEST['password'])."';", true);
	if (count($id)) {
		$mail=sendrequest("SELECT * FROM `mailverifycodes` WHERE `account`=".$id[0]["id"], true)[0];
		if ($mail["code"]==$_REQUEST["code"] and time()-strtotime($mail["expired"])<5*60*1000) {
			echo $REQSTATES["MailVerificationSuccess"];
			sendrequest("UPDATE `accounts` SET `verified`='1' WHERE `mail`='".$id[0]['mail']."';", false);
		} else {
			echo $REQSTATES["MailVerificationFailed"];
		}
	} else if (count($id2)) {
		$mail=sendrequest("SELECT * FROM `mailverifycodes` WHERE `accounts`=".$id2[0]["id"], true)[0];
		if ($mail["code"]==$_REQUEST["code"] and time()-strtotime($mail["expired"])<5*60*1000) {
			echo $REQSTATES["MailVerificationSuccess"];
			sendrequest("UPDATE `accounts` SET `verified`='1' WHERE `mail`='".$id2[0]['mail']."';", false);
		} else {
			echo $REQSTATES["MailVerificationFailed"];
		}
	} else {
		echo $REQSTATES["InvalidRequest"];
	}
} else {
	echo $REQSTATES["InvalidRequest"];
}

?>
