<?php  
	session_start();
	require_once("../core/db.php");
	require_once("../core/functions.php");
	$func = new myFunc;

	$name = $_POST['name'];
	$email = $_POST['email'];
	$year = $_POST['year'];
	$programme = $_POST['programme'];

	if($name == $_SESSION['user_name'] && $email == $_SESSION['user_email'] && $year == $_SESSION['year'] && $programme == $_SESSION['programme'] && (!file_exists($_FILES['img']['tmp_name']) || !is_uploaded_file($_FILES['img']['tmp_name'])))
		exit();

	if(!file_exists($_FILES['img']['tmp_name']) || !is_uploaded_file($_FILES['img']['tmp_name'])){
    	// update user table with new information
    	$stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, year = ? WHERE id = ?");
    	$stmt->bind_param("ssii",$name,$email,$year,$_SESSION['user_id']);
    	if($stmt->execute() === false){
    		echo $stmt->error;
			echo '<script>$("#myModal").modal("show")</script>';
    	}else{
    		$_SESSION['user_name'] = $name;  
    		$_SESSION['user_email'] = $email; 
    		$_SESSION['year'] = $year;		

    		goto myprogramme;
    	}

	}else{
		$img = basename($_FILES['img']['name']);
		$img_name = $_FILES['img']['name'];
		$tmp_name = $_FILES['img']['tmp_name'];  
		$size = $_FILES['img']['size'];

		// if image upload function returns true
		if($func->imgUpload("../assets/img/",$img_name,$tmp_name,$size) == true){
			// update user information with new information
			$stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, year = ?, img = ? WHERE id = ?");
	    	$stmt->bind_param("ssisi",$name,$email,$year, $img_name,$_SESSION['user_id']);
	    	if($stmt->execute() === false){
	    		echo $stmt->error;
				echo '<script>$("#myModal").modal("show")</script>';
    		}else{
    			$_SESSION['image'] = $img;
	    		$_SESSION['user_name'] = $name;  
	    		$_SESSION['user_email'] = $email; 		
    			$_SESSION['year'] = $year;	

    			goto myprogramme;
    		}
		}else{
			echo '<script>$("#myModal").modal("show")</script>';
		}
	}

	myprogramme: {
		if (strcmp($programme, $_SESSION['programme']) != 0) {
    		// get programme id
    		$row = $func->myFetch("SELECT id FROM programmes WHERE name = ?", "s", array($programme));
    		$programme_id = $row['id'];

    		// check whether user has an existing course
    		$row = $func->myFetch("SELECT id FROM users_programmes WHERE user_id = ?", "i", array($_SESSION['user_id']));
    		$user_programme_id = $row['id'];

    		// if user has course, update else insert
    		// check if typed programme exist
    		if (empty($programme_id)){
		    	echo '<p class="text-center lead red">Typed programme does not exist in the system!</p>';
				echo '<script>$("#myModal").modal("show")</script>';
    		}else
	    		if (!empty($user_programme_id)) {
	    			$stmt = $conn->prepare("UPDATE users_programmes SET programme_id = ? WHERE id = ?");
	    			$stmt->bind_param("ii",$programme_id,$user_programme_id);
	    			if($stmt->execute() === false){
			    		echo '<p class="text-center lead red">An unexpected error occured</p>';
						echo '<script>$("#myModal").modal("show")</script>';
			    	}else{
			    		$_SESSION['programme'] = $programme;  
	    				$_SESSION['programme_id'] = $programme_id;
    					echo '<script>window.location = "'.$_SESSION['url'].'"</script>';
			    	}
			    }else{
					$stmt = $conn->prepare("INSERT INTO users_programmes(user_id,programme_id) VALUES (?,?)");
	    			$stmt->bind_param("ii",$_SESSION['user_id'],$programme_id);
	    			if($stmt->execute() === false){
			    		echo '<p class="lead text-center red">An unexpected error occured</p>';
						echo '<script>$("#myModal").modal("show")</script>';
			    	}else{
			    		$_SESSION['programme'] = $programme; 		
	    				$_SESSION['programme_id'] = $programme_id;
    					echo '<script>window.location = "'.$_SESSION['url'].'"</script>';
			    	}
		    	
	    		}
    	}else{
    		echo '<script>window.location = "'.$_SESSION['url'].'"</script>';
    	}
	}
?>