<?php

if (!isset($DATABASESTATUS)) {
	include "database.php";
}

function adduser() {
	$id=substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(256) )),1,256);
	$_COOKIE["id"]=$id;
	sendrequest("INSERT INTO `users` (id, account) values ('$id', null)", false, time()+86400*36500);
	setcookie("id", $id);
}

if (!isset($_COOKIE["id"])) {
	addUser();
}

$USER = [
	"id"=>$_COOKIE["id"]
];

?>
