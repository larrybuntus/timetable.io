<?php  
	if (isset($_SESSION['logged'])) {
		include "table.php";
	}else{
		include "welcome.php";
	}
?>