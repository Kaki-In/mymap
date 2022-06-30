<?php

$_ = sendrequest("SELECT `id` from `blocks`", true);

class Block {
	private $id;

	function __construct($id) {
		$this->id=$id;
	}

	function getId() {
		return $this->id;
	}

	function __get($attr) {
		return sendrequest("select `$attr` from `blocks` where id=".json_encode($this->id).";")[0][$attr];
	}

	function __set($attr, $value) {
		return sendrequest("update `blocks` set `$attr`=".json_encode($value)." where id=".$this->id.";", true);
	}

};

$BLOCKS=[];
foreach($_ as $block) {
	$BLOCKS[$block["id"]]=new Block($block["id"]);
}

?>
