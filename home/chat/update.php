<?php
	session_start();
	require_once("../../core/db.php");
	require_once("../../core/functions.php");
	$func = new myFunc;

	$previous = null;

	if(!isset($_SESSION['programme_id'])){
		exit();
	}

	$result = $func->myResult("SELECT * FROM messages WHERE programme_id = ? AND year = ? AND dateCreated >= (SELECT dateCreated FROM users_programmes WHERE user_id = ?) AND id NOT IN (SELECT message_id FROM deleted_messages WHERE user_id = ?)","iiii",array($_SESSION['programme_id'], $_SESSION['year'], $_SESSION['user_id'], $_SESSION['user_id']));

	while ($row = $result->fetch_assoc()) {
		$id = $row['id'];
		$user_id = $row['user_id'];
		$users = $func->myFetch("SELECT * FROM users WHERE id = ?", "i", array($user_id));
		$datetime = $row['dateCreated'];
		$time_sent = date("H:i", strtotime($datetime));

		$message = $row['message'];
		$reply = $func->trim($message, 300);

		$outputDate = (String)date("Y-m-d", strtotime($datetime));
			if($previous !== $outputDate)
				echo '<div class="message-date"><hr><p class="text-center text-muted small">'.date("jS M, Y", strtotime($datetime)).'</p></div>';
	    	$previous = $outputDate;

		if ($_SESSION['user_id'] == $user_id) {
?>
	<div class="me" id="<?php echo $id; ?>" data-index="<?php echo $id; ?>">
		<div class="message"><?php echo $message; ?></div>
		<p class="small text-right time-sent"><?php echo $time_sent; ?></p>
	</div>
<?php			
		}else{
?>
	<div class="others" id="<?php echo $id; ?>" data-index="<?php echo $id; ?>">
		<p class="small"><?php echo $users['name']; ?></p>
		<div class="message"><?php echo $message; ?></div>
		<p class="small text-right time-sent"><?php echo $time_sent; ?></p>
	</div>
<?php 				
		}
	}	
?>