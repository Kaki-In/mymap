<?php
set_include_path("../:.:/usr/share/php");
include "init.php";

foreach($BLOCKS as $block) {
	echo $block->creator;
}

?>
<?php include "end.php";?>
