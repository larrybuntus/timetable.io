<?php  
	// start of session
	session_start();

	$metadata = $func->myFetch("SELECT * FROM metadata WHERE id = ?", "i", array(1));
	// site information
	$author = $metadata['author'];
	$title = $metadata['title'];
	$url = $metadata['url'];
	$keywords = $metadata['keywords'];
	$email = $metadata['email'];
	$description = $metadata['description'];
	$number = $metadata['number'];
	$theme_color = $metadata['theme-color'];

	// session important variables
	$_SESSION['url'] = $url;
	$_SESSION['email'] = $email;
	$_SESSION['number'] = $number;
	$_SESSION['title'] = $title;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $title; ?></title>
	<!-- essential metadata -->
	<meta name="author" content="<?php echo $author; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<meta name="description" content="<?php echo $description; ?>">

	<!-- Mobile -->
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">

	<!-- Chrome / Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="theme-color" content="<?php echo $theme_color; ?>">

	<!-- Safari / iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $theme_color; ?>">

	<!-- site card information -->
	<meta property="og:title" content="<?php echo $title; ?>">
	<meta property="og:type" content="website">
	<meta property="og:image" content="">
	<meta property="og:image:secure_url" content="">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="600">
	<meta property="og:image:height" content="315">
	<meta property="og:description" content="<?php echo $description; ?>">
	<meta property="og:site_name" content="<?php echo $title ?>">
	<meta property="og:url" content="<?php echo $url; ?>">

	<!-- css -->
	<link rel="stylesheet" href="<?php echo $url ?>/assets/stylesheets/styles.min.css">

	<!-- js -->
	<script src="<?php echo $url; ?>/assets/js/jquery-2.1.4.min.js"></script>

</head>

<head>

