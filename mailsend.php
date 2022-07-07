<?php

if(!isset($CONF)){
	include "conf.php";
};

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$MAIL_SCRIPT_ACTIVED = true;

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
?>
