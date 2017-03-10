<?php  
	session_start();
	require_once("../../core/db.php");
	$delete_messages_ids = explode(", ", $_POST['id']);
	$id = null;

	$stmt = $conn->prepare("INSERT INTO deleted_messages(message_id, user_id) VALUES (?,?)");
	$stmt->bind_param("ii", $id ,$_SESSION['user_id']);
	foreach ($delete_messages_ids as $id) {
		$stmt->execute();
	}
?>