<?php  
	session_start();
	require_once("../../core/db.php");
	require_once("../../core/functions.php");
	$func = new myFunc;

	foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $file_size=$_FILES["files"]["size"][$key];

        $target_file = "../../assets/files/" . basename($file_name);
        $file_type = pathinfo($target_file,PATHINFO_EXTENSION);
        $file_type = strtolower($file_type);

        if($func->fileUpload("../../assets/files/", $file_name,$file_tmp,$file_size) === true ){

	        $stmt = $conn->prepare("INSERT INTO repositories(name,type,year,programme_id,user_id) VALUES (?,?,?,?,?)");
	        $stmt->bind_param("ssiii",$file_name,$file_type,$_SESSION['year'],$_SESSION['programme_id'],$_SESSION['user_id']);
	        
	        if($stmt->execute() === false)
	        	echo '<p>An unexpected error occured</p>';
    	}else{
    		echo 'Problem cause by a(n) '.$file_type.' file';
    	}
	}
	echo '<p class="lead text-center">Process completed</p>';
?>