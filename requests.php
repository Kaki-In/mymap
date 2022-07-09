<?php

$REQSTATES = [
	"ServerCrash"=>500,
	"InvalidRequest"=>400,

	"LoginConnectionSuccess"=>200,
	"LoginPleaseVerifyYourMail"=>401,
	"LoginConnectionFailed"=>403,
	"LoginActuallyUnavailable"=>501,

	"SignUpCreationFailed"=>403,
	"SignUpCreationWaiting"=>200,
	"SignUpCreationAlreadyWaiting"=>201,
	"SignUpCreationSuccess"=>202,
	"SignUpActuallyUnavailable"=>501,

	"MailVerificationSuccess"=>200,
	"MailVerificationFailed"=>403,
	"MailVerificationUnavailable"=>501,
]

?>
