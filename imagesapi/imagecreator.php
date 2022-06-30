<?php

$CONF = [
	'database-host'=>'localhost',
	'database-username'=>'root',
	'database-password'=>'Caribou!33',
	'database-name'=>'mymap',

	'pathname'=>'/games/',
];

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

$blocks = sendrequest("SELECT * from `blocks`", true);

if (isset($_REQUEST["dims"]) and isset($_REQUEST["blockid"])) {
	$w=(int)$_REQUEST["dims"];
	$f=false;
	foreach($blocks as $block) {
		if ($block['id']==$_REQUEST['blockid']) {
			$f=true;
			break;
		}
	}
	if (!$w) {
		echo "Invalid dimension!";
	}
	elseif (!$f) {
		echo "block non trouvé";
	} else {
		$block=["id"=>(int)$block['id'], "data"=>$block['data'], "cols"=>(int)$block['colnum'], "back"=>$block['background'], "canbewalked"=>(bool)$block['canbewalked'], "title"=>$block['title']];

		$img=imagecreatetruecolor($w,$w);
		imagesavealpha($img,false);
		imagealphablending($img,false);

		$color = substr($block["back"], 1, 6);
		$globalr = hexdec(substr($color, 0, 2));
		$globalg = hexdec(substr($color, 2, 2));
		$globalb = hexdec(substr($color, 4, 2));

		$colors = explode("x", $block["data"]);
		for($y=0;$y<$block["cols"];$y++){
		   for($x=0;$x<$block["cols"];$x++){
				$color = str_repeat("0", 8-strlen($colors[$x+$y*$block["cols"]])).$colors[$x+$y*$block["cols"]];
				$r = hexdec(substr($color, 0, 2));
				$g = hexdec(substr($color, 2, 2));
				$b = hexdec(substr($color, 4, 2));
				$a = hexdec(substr($color, 6, 2))/256;
				$color = imagecolorallocatealpha($img,$r*$a+$globalr*(1-$a),$g*$a+$globalg*(1-$a),$b*$a+$globalb*(1-$a),0);
				imagefilledrectangle($img,$x*$w/$block["cols"],$y*$w/$block["cols"],$x*$w/$block["cols"]+$w/$block["cols"],$y*$w/$block["cols"]+$w/$block["cols"],$color);
		   }
		}

		header("Content-type: ".image_type_to_mime_type(IMAGETYPE_PNG));
		imagepng($img,"/var/www/tmp/result{$_REQUEST['blockid']}.png");
		readfile("/var/www/tmp/result{$_REQUEST['blockid']}.png");
	}
}

