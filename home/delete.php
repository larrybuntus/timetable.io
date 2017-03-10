<?php  
	session_start();
	require_once("../core/db.php");


	if (isset($_POST['submit'])) {
		$schedules = $_POST['schedule'];

		foreach ($schedules as $schedule => $value) {
			$stmt = $conn->prepare("DELETE FROM timetables WHERE id = ?");
			$stmt->bind_param("i", $schedules[$schedule]);
			if($stmt->execute() === false){
				echo '<p class="lead text-center">Something wicked happened</p>';
				echo '<script>$("#myModal"),modal("show");</script>';
				exit();
			}
		}

		exit();
	}

	$id = (int)$_POST['id'];

	$stmt = $conn->prepare("DELETE FROM timetables WHERE id = ?");
	$stmt->bind_param("i", $id);
	if($stmt->execute() === false){
		echo 'something wicked happened';
	}
	$stmt->close();
	$conn->close();
?>