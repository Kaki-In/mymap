<?php

$DATABASESTATUS = [
	'DatabaseAvailable'=>true,
	'DatabaseError'=>null,
	'DatabaseErrorNumber'=>null,
];

try {
	$MAIN_SQLI_CONNECTION=new PDO("mysql:host={$CONF['database-host']};dbname={$CONF['database-name']}", $CONF['database-username'], $CONF['database-password']);
	$MAIN_SQLI_CONNECTION->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exc) {
	$DATABASESTATUS['DatabaseAvailable']=false;
	$DATABASESTATUS['DatabaseError']=$exc->getMessage();
	$DATABASESTATUS['DatabaseErrorNumber']=$exc->getMessage();
}


function sendrequest($request, $getresult) {
	global $MAIN_SQLI_CONNECTION;
	global $DATABASESTATUS;
	if ($DATABASESTATUS['DatabaseAvailable']) {
		$sth = $MAIN_SQLI_CONNECTION->prepare($request);
		$resultat = $sth->execute();
		if ($getresult) {$resultat = $sth->fetchAll(PDO::FETCH_ASSOC);}
		return $resultat;
	}
	else {
		return false;
#		throw new Exception($DATABASESTATUS['DatabaseError']);
	}
}

class SqlObject {
	private $id;
	private $database;

	function __construct($id, $database) {
		$this->id=$id;
		$this->database=$database;
	}

	function getId() {
		return $this->id;
	}

	function __get($attr) {
		try {return sendrequest("select `$attr` from `".$this->database."` where id=".json_encode($this->id).";", true)[0][$attr];}
		catch ( Exception $exc ) {}
	}

	function __set($attr, $value) {
		return sendrequest("update `".$this->database."` set `$attr`=".json_encode($value)." where id=".$this->id.";", false);
	}

};

function createBlock() {
	$r=sendrequest("INSERT INTO `blocks` (`data`) values ('".str_repeat('!', 256)."');", false);
	return end(sendrequest("SELECT * FROM `blocks`;", true))["id"];
}

?>
