 <?php
	session_start();
	require_once("../../core/db.php");
	require_once("../../core/functions.php");
	$func = new myFunc;

	$result = $func->myResult("SELECT * FROM repositories WHERE programme_id = ? AND year = ? AND dateCreated >= (SELECT dateCreated FROM users_programmes WHERE user_id = ?)","iii",array($_SESSION['programme_id'], $_SESSION['year'], $_SESSION['user_id']));

	while ($row = $result->fetch_assoc()) {
		$user_id = $row['user_id'];
		$users = $func->myFetch("SELECT * FROM users WHERE id = ?", "i", array($user_id));
		$time_sent = date("jS-M-Y @ H:i", strtotime($row['dateCreated']));
		$time_sent .= ' GMT';
		
		$file = $row['name'];
		$type = $row['type'];

		$info = 'sent by me';

		if ($user_id != $_SESSION['user_id'])
			$info = 'sent by '.$users['name'];

		if ($type == 'jpeg' || $type == 'jpg' || $type == 'gif' || $type == 'png') {
?>
		<div class="repo-item">
			<div class="item">
				<p class="small repo-item-caption"><?php echo $info ?></p>
				<img src="<?php echo $_SESSION['url']."/assets/files/".$file;?>" alt="<?php echo $file ?>" class="img-responsive spec-ajax" dest="<?php echo $_SESSION['url'] ?>/home/repo/viewer.php" value="<?php echo $_SESSION['url']."/assets/files/".$file ?>" modal="true" output="#ajaxContent" query="img">
				<p class="small text-right"><?php echo $time_sent; ?></p>
			</div>
		</div>
<?php
		}elseif($type == 'mp3' || $type == 'm4a'){
?>
		<div class="repo-item">
			<div class="item">
				<p class="small repo-item-caption"><?php echo $info; ?></p>
				<audio controls>
					<source src="<?php echo $_SESSION['url']."/assets/files/".$file ?>" type="audio/mpeg">
					Your browser does not support the audio element.
				</audio>
				<p class="small text-right"><?php echo $time_sent; ?></p>
			</div>
		</div>
<?php
		}elseif($type == 'mp4' || $type == 'webm' || $type == 'ogg'){
?>
		<div class="repo-item">
			<div class="item">
				<p class="small repo-item-caption"><?php echo $info; ?></p>
				<video controls>
				  	<source src="<?php echo $_SESSION['url']."/assets/files/".$file ?>" type="video/<?php echo $type; ?>">
					Your browser does not support the video tag.
				</video>
				<p class="small text-right"><?php echo $time_sent; ?></p>
			</div>
		</div>
<?php  
	}elseif($type == 'pdf'){
?>
		<div class="repo-item">
			<div class="item">
				<p class="small repo-item-caption"><?php echo $info; ?></p>
				<p class="hidden-xs"><a href="<?php echo $_SESSION['url']."/assets/files/".$file ?>" class="spec-ajax" dest="<?php echo $_SESSION['url'] ?>/home/repo/viewer.php" value="<?php echo $_SESSION['url']."/assets/files/".$file ?>" modal="true" output="#ajaxContent" query="pdf"><?php echo $file; ?></a></p>
				<p class="visible-xs"><a href="<?php echo $_SESSION['url']."/assets/files/".$file ?>" target="_blank"><?php echo $file; ?></a></p>
				<p class="small text-right"><?php echo $time_sent; ?></p>
			</div>
		</div>
<?php
		}else{
?>
		<div class="repo-item">
			<div class="item">
				<p class="small repo-item-caption"><?php echo $info; ?></p>
				<p><a href="<?php echo $_SESSION['url']."/assets/files/".$file ?>" target="_blank"><?php echo $file; ?></a></p>
				<p class="small text-right"><?php echo $time_sent; ?></p>
			</div>
		</div>
<?php
		} 
	}
?>