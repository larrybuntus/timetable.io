<?php  
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'rudyflex39';
	$dbname = 'timetable';

	$conn = new mysqli ($dbhost, $dbuser, $dbpass, $dbname);

	if($conn->connect_error){
		die("connection failure: something wicked happened");
	}
?>