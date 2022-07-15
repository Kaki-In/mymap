<?php

if (!isset($CONF)) {include "conf.php";}
if (!isset($DATABASESTATUS)) {include "database.php";}

function adduser() {
	global $CONF;
	$id=substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(256) )),1,256);
	$_COOKIE["id"]=$id;
	sendrequest("INSERT INTO `users` (id, account) values ('$id', null)", false);
	setcookie("id", $id, time()+86400*36500, $CONF["pathname"]."/");
}

if (!isset($_COOKIE["id"])) {
	addUser();
}

$_ = sendrequest("SELECT `id` from `users`", true);

$USERS=[];
foreach($_ as $user) {
	$USERS[$user["id"]]=new SqlObject($user["id"], "users");
}

$USERINFO = [
	'id'=>$_COOKIE["id"],
	'user'=>$USERS[$_COOKIE["id"]],
	'mobile'=>preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]),
];

?>
