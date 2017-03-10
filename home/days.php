<?php
	session_start();
	require_once("../core/functions.php");
	$func = new myFunc; 

	$day = substr(lcfirst($_POST['id']), 0, 3);

	$result = $func->myResult("SELECT * FROM timetables WHERE user_id = ? and day = ? ORDER BY start_time ASC","is",array($_SESSION['user_id'], $day));

	include "content.php";

?>