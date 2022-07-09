<?php

if(!isset($CONF)){
	include "conf.php";
};

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$MAIL_SCRIPT_ACTIVED = true;

function getRandomizedCode($length) {
	$code='';
	for ($i=0;$i<$length;$i++) {
		$code.=['0','1','2','3','4','5','6','7','8','9'][rand(0,9)];
	}
	return $code;
}

function sendMailTo($adress,$subject,$body){
	global $CONF;

	$mail=new PHPMailer;
	$mail->isSMTP();
	$mail->Host=$CONF['mail-host'];
	$mail->SMTPAuth=$CONF['mail-smtpauth'];
	$mail->Username=$CONF['mail-user'];
	$mail->Password=$CONF['mail-password'];
	$mail->SMTPSecure=$CONF['mail-secure'];
	$mail->Port=$CONF['mail-port'];
	$mail->From='no-reply.mymap@'.$_SERVER["HTTP_HOST"];
	$mail->FromName='My Map Mails';
	$mail->addAddress($adress);
	$mail->WordWrap=50;
	$mail->isHTML(true);
	$mail->CharSet="utf-8";
	$mail->Subject=$subject;
	$mail->Body=$body;
	$mail->AltBody='Email automatique de mymap';

	if(!$mail->send()){
		return $mail->ErrorInfo;
	} else {
		return true;
	}
}

function getVerificationCode($mail) {
	$code = getRandomizedCode(6);
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
	sendMailTo($mail, "Code de validation pour MyMap", $body);
	return $code;
}
?>
