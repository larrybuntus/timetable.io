<?php  
	// database and class function
	require_once("core/db.php");
	require_once("core/functions.php");
	$func = new myFunc;

	if (isset($_POST['id'])) {
		session_start();
		include "home/index.php";
		exit();
	}

	include("layout/head.php");
	include("layout/nav.php");
?>
<div class="container-fluid inner-content">
	<?php include "home/index.php"; ?>
</div>
<?php  
	include("layout/foot.php");
?>