<div class="repo-container">
	<div class="repo-header">
		<p><a href="" class="repo-toggle" dest="<?php echo $_SESSION['url'] ?>/home/repo/update.php"><?php echo $func->trim($_SESSION['programme'], 20).' '.$_SESSION['year']; ?> Repo</a></p>
	</div>
	<div class="repo-body">

	</div>
	<div class="repo-footer">
		<form class="form" enctype="multipart/form-data" dest="<?php echo $_SESSION['url'] ?>/home/repo/upload.php" output="#ajaxContent" modal="true">
			<div class="file-body">
				<input type="file" name="files[]" accept="image/*;capture=camera" required="true" class="form-control filter-input" multiple="true">
			</div>
			<div class="send-button">
				<button type="submit" class="btn btn-primary" id="send-button"><i class="fa fa-send fa-fw"></i></button>
			</div>	
		</form>
	</div>
</div>