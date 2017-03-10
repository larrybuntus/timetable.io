<?php  
	session_start();

	require_once("../core/db.php");
	require_once("../core/functions.php");
	$func = new myFunc;

	if (isset($_POST['submit'])) {
		$cpass = $_POST['cpass'];
		$npass = $_POST['npass'];
		$rpass = $_POST['rpass'];

		$result = $conn->query("SELECT password FROM users WHERE id = ".$_SESSION['user_id']);
		$row = $result->fetch_assoc();
		$pass = $row['password'];

		if($npass != $rpass){
			echo '<p>Passwords don\'t match</p>';
			exit();
		}


		if (hash_equals($pass, crypt($cpass, $pass))) {
			if ($npass === $rpass) {
				$newPass = $func->cryptPass($rpass);

				$stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
				$stmt->bind_param("si",$newPass,$_SESSION['user_id']);

				if ($stmt->execute() === false) {
					echo '<p class="lead cabin text-center">Something wicked happened</p>';
				}else{
					echo '<p class="lead cabin text-center">Password successfully updated</p>';
				}
				$stmt->close();

			}
		}else{
			echo '<p class="lead cabin text-center">Current password is wrong</p>';
		}

		exit();

	}else{

?>

<div class="container-fluid">
	<div class="row">
		<form class="form" dest="<?php echo $_SESSION['url'] ?>/home/password.php" output="#ajaxContent">
			<p class="lead cabin">Change Password</p>
			<div class="form-group">
				<label for="" class="cabin">Current Password: </label>
				<input type="password" class="form-control" name="cpass" required="required">
			</div>
			<hr>
			<div class="form-group">
				<label for="" class="cabin">New Password: </label>
				<input type="password" class="form-control" name="npass" required="required">
			</div>
			<div class="form-group">
				<label for="" class="cabin">Retype Password: </label>
				<input type="password" class="form-control" name="rpass" required="required">
			</div>
			<div class="form-group">
				<input type="hidden" name="submit" value="submit">
				<input type="submit" class="form-control btn btn-primary" value="Update" name="click"></div>
		</form>
	</div>
</div>

<?php } ?>