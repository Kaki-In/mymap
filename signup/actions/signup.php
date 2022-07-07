<?php
header('Content-type: text/html; charset=UTF-8');

set_include_path("../../:.:/usr/share/php");
if (!isset($REQSTATES)) {include "requests.php";}
if (!isset($ACCOUNTS)) {include "accountinfo.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}
if (!isset($MAIL_SCRIPT_ACTIVED)) {include "mailsend.php";};

function getRandomizedCode($length) {
	$code='';
	for ($i=0;$i<$length;$i++) {
		$code.=['0','1','2','3','4','5','6','7','8','9'][rand(0,9)];
	}
	return $code;
}

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
				$code = getRandomizedCode(6);
				sendrequest("UPDATE `mailverifycodes` SET `code`='".$code."' WHERE `mail`='".$_REQUEST['mail']."';", false);
				$body = "
<html>
	<head>
		<style>

.emphased, h1 {
	color : #ffcf03;
	font-weight : bold;
}

		</style>
	</head>
	<body>
		<h1>Code de validation </h1>
		<p>Votre code de validation : <text class='emphased'>$code</text></p>
	</body>
</html>";
				mailSendTo($_REQUEST['mail'], "Code de validation pour MyMap", $body);
			}
		}
	} else if (count($id) or count($id2)) {				$code = getRandomizedCode(6);
				sendrequest("UPDATE `mailverifycodes` SET `code`='".$code."' WHERE `mail`='".$_REQUEST['mail']."';", false);
				$body = "
<html>
	<head>
		<style>

.emphased, h1 {
	color : #ffcf03;
	font-weight : bold;
}

		</style>
	</head>
	<body>
		<h1>Code de validation </h1>
		<p>Votre code de validation : <text class='emphased'>$code</text></p>
	</body>
</html>";
				mailSendTo($_REQUEST['mail'], "Code de validation pour MyMap", $body);

		echo $REQSTATES["SignUpCreationFailed"];
	} else {
		echo $REQSTATES["SignUpCreationWaiting"];
		$code = getRandomizedCode(6);
/*		sendrequest("INSERT INTO `accounts` (`login`, `mail`, `password`) VALUES (".json_encode($_REQUEST['username']).", ".json_encode($_REQUEST['mail']).", '".hash('sha256', $_REQUEST['password'])."');", false);
		$result=sendrequest("SELECT * FROM `accounts` WHERE `login`=".json_encode($_REQUEST['username'])." and `mail`=".json_encode($_REQUEST['mail'])." and `password`='".hash('sha256', $_REQUEST['password'])."';", true)[0];
		sendrequest("INSERT INTO `mailverifycodes` (`code`, `mail`, `account`) VALUES ('$code', '{$_REQUEST['mail']}', '{$result["id"]}');", false);*/
		$body = "
<html>
	<head>
		<style>

.emphased, h1 {
color : #ffcf03;
font-weight : bold;
}

		</style>
	</head>
	<body>
		<h1>Code de validation </h1>
		<p>Votre code de validation : <text class='emphased'>$code</text></p>
	</body>
</html>";
		sendMailTo($_REQUEST['mail'], "Code de validation pour MyMap", $body);
	}
} else {
	echo $REQSTATES["InvalidRequest"];
}

?>
