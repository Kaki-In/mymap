<?php

if (!isset($USERS)) {include "userinfo.php";}
if (!isset($BLOCKS)) {include "blocksinfo.php";}

$_ = sendrequest("SELECT `id` from `accounts`", true);

function getBlocksBag($account) {
	global $BLOCKS;
	$a = sendrequest("SELECT * FROM `blockkeeps` WHERE `account`='".$account->id."'", true);
	$blocks = [];
	foreach($a as $block) {
		$blocks[]=$BLOCKS[$block["block"]];
	}
	return $blocks;
}

function connectUserToAccount($account) {
	global $USERINFO;
	$USERINFO["user"]->account=$account->id;
}

$ACCOUNTS=[];
foreach($_ as $account) {
	$ACCOUNTS[$account["id"]]=new SqlObject($account["id"], "accounts");
}

?>
