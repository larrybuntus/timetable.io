<?php 
	session_start();	

	require("../core/db.php");
	require("../core/functions.php");
	$func = new myFunc;
	
	if(isset($_POST['login'])){
		$email = (String)$conn->real_escape_string($_POST['email']);
		$password = (String)$conn->real_escape_string($_POST['password']);

		$row = $func->myFetch("SELECT * FROM users WHERE email = ?", "s", array($email));

		$dbEmail = $row['email'];

		if(empty($dbEmail)){
			echo "no such email exists";
			return false;
		}else{
			$dbPass = $row['password'];
			if(hash_equals($dbPass, crypt($password, $dbPass))){
				// get user information
				$id = $row['id'];
				$name = $row['name'];
				$email = $row['email'];
				$img = $row['img'];
				$year = $row['year'];

				// get user programme name
				$programmes = $func->myFetch("SELECT * FROM programmes WHERE id = (SELECT programme_id FROM users_programmes WHERE user_id = ?)", "i", array($id));
				$programme = $programmes['name'];
				$programme_id = $programmes['id'];

				// session user information
				$_SESSION['user_id'] = $id;
	    		$_SESSION['user_email'] = $email;
	    		$_SESSION['user_name'] = $name;
	    		$_SESSION['image'] = $img;
	    		$_SESSION['year'] = $year;
	    		$_SESSION['programme'] = $programme;
	    		$_SESSION['programme_id'] = $programme_id;
	    		$_SESSION['logged'] = "logged";
		    	
	    		echo '<script>window.location="'.$_SESSION['url'].'"</script>';
			}else{
				echo "incorrect password";
				return false;
			}
		}
	}

	if (isset($_POST['signup'])) {
		$name = $conn->real_escape_string($_POST['name']);
		$email = $conn->real_escape_string($_POST['email']);

	    $password = $conn->real_escape_string($_POST['password']);
	    $rpassword = $conn->real_escape_string($_POST['retypePassword']);

		$row = $func->myFetch("SELECT * FROM users WHERE email = ?", "s", array($email));

	    if($password !== $rpassword){
	    	echo "passwords not match";
	    }else if(!empty($row['email'])){
	    	echo "oops, that email already exists";
		}else{

			$password = $func->cryptPass($password);
		    
		    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)");
			$stmt->bind_param("sss",$name,$email,$password);


			if($stmt->execute() === false){
				echo "Something wicked happened".$stmt->error;
			}else{
				$row = $func->myFetch("SELECT * FROM users WHERE email = ?", "s", array($email));

				$id = $row['id'];
				$name = $row['name'];
				$email = $row['email'];
				$img = $row['img'];

				$_SESSION['user_id'] = $id;
	    		$_SESSION['user_email'] = $email;
	    		$_SESSION['user_name'] = $name;
	    		$_SESSION['image'] = $img;
	    		$_SESSION['logged'] = "logged";
		    	
	    		echo '<script>window.location="'.$_SESSION['url'].'"</script>';
				
			}
			$stmt->close();
			$conn->close();
		}
	}
?>