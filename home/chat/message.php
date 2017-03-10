<?php  
	session_start();
	require_once("../../core/db.php");
	require_once("../../core/functions.php");
	$func = new myFunc;

	$message = $func->auto_link(nl2br(trim($_POST['message'])));
	$stmt = $conn->prepare("INSERT INTO messages (message, user_id, programme_id, year) VALUES (?,?,?,?)");
	$stmt->bind_param("siii", $message, $_SESSION['user_id'], $_SESSION['programme_id'], $_SESSION['year']);

	$error = null;
	if ($stmt->execute() === false) {
		$error = '<script type="text/javascript">for ($i = 1; $i <= 1000; $i++) clearInterval($i); </script><p class="red"><i class="fa fa-exclamation-circle fa-fw"></i> Could not send message</p>';
	}
	$stmt->close();
	$conn->close();

?>
<div class="me">
	<div class="message"><?php echo $error.' '.$message; ?></div>
	<p class="small text-right time-sent"><?php echo date("H:i") ?></p>
</div>