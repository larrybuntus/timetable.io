<header>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
		  	<div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			      	<span class="icon-bar"></span>
			      	<span class="icon-bar"></span>
			      	<span class="icon-bar"></span> 
			    </button>
		    	<a href="" class="navbar-brand"><?php echo $_SESSION['title'] ?></a>
		  	</div>
		  	<div class="collapse navbar-collapse" id="myNavbar">
		    	<ul class="nav navbar-nav navbar-right nav-pills">
		    		<?php if (!isset($_SESSION['logged'])){ ?>		    			
		      		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> Login</a>
						<ul class="dropdown-menu">
							<div class="container-fluid">
								<form action="" class="form" dest="<?php echo $_SESSION['url'] ?>/logs/index.php" output=".feedback-login">
									<div class="form-group">
										<label for="" class="text-muted small">Email: </label>
										<input type="email" class="form-control filter-input" name="email" placeholder="email here" autofocus="true" required="true"></div>
									<div class="form-group">
										<label for="" class="text-muted small">Password: </label>
										<input type="password" class="form-control filter-input" name="password" placeholder="password here" required="true"></div>
									<div class="hidden"><input type="hidden" name="login" value="login"></div>
									<div class="form-group"><input type="submit" class="form-control btn btn-primary" value="Login"></div>
								</form>
								<p class="red feedback-login text-center"></p>
							</div>
						</ul>
		      		</li>
		      		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-plus fa-fw"></i> Signup</a>
	              		<ul class="dropdown-menu">
	              			<div class="container-fluid">
								<form action="" class="form" dest="<?php echo $_SESSION['url'] ?>/logs/index.php" output=".feedback-signup">
									<div class="form-group">
										<label for="" class="text-muted small">Name: </label>
										<input type="text" class="form-control filter-input" name="name" placeholder="name here" autofocus="true" required="true">
									</div>
									<div class="form-group">
										<label for="" class="text-muted small">Email: </label>
										<input type="email" class="form-control filter-input" name="email" placeholder="email here" required="true">
									</div>
									<div class="form-group">
										<label for="" class="text-muted small">Password: </label>
										<input type="password" class="form-control filter-input" name="password" placeholder="password here" required="true">
									</div>
									<div class="form-group">
										<label for="" class="text-muted small">Retype Password: </label>
										<input type="password" class="form-control filter-input" name="retypePassword" placeholder="password here" required="true">
									</div>
									<div class="hidden"><input type="hidden" name="signup" value="signup"></div>
									<div class="form-group"><input type="submit" class="form-control btn btn-primary" value="Signup"></div>
								</form>
								<p class="red feedback-signup text-center"></p>
							</div>
	              		</ul>
	          		</li>
	          		<?php }else{ ?>
					<li><a href="" class="settings"><i class="fa fa-cogs fa-fw"></i> Settings</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i><?php echo $_SESSION['user_name'] ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $_SESSION['url'] ?>/logs/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
						</ul>
					</li>
	          		<?php } ?> 
		    	</ul>
		  	</div>
		</div>
	</nav>

	<?php  
		$image = '';
		if (isset($_SESSION['image']))
			$image = $_SESSION['url'].'/assets/img/'.$_SESSION['image'];
		else 
			$image = $_SESSION['url'].'/assets/img/icon.jpg';

		$result = $conn->query("SELECT * FROM programmes");

		if (isset($_SESSION['user_id'])) {
	?>
	<nav class="nav navbar-default side-nav">
		<form action="" class="navbar-form form" dest="<?php echo $_SESSION['url'] ?>/home/settings.php" output="#ajaxContent">
			<div class="form-group text-center">
				<input type="file" class="hidden" name="img" id="swapImgId">
				<img src="<?php echo $image; ?>" id="swapImg" alt="" style="width: 120px; height: 120px; padding:5px;" class="center-block img-circle img-thumbnail spec-ajax" trigger="#swapImgId">
			</div>
			<div class="form-group" style="margin: 10px 0px;">
				<label for="" class="text-muted small">Your Name: </label>
				<input type="text" class="form-contro filter-input" name="name" required="true" value="<?php echo $_SESSION['user_name']; ?>">
			</div>
			<div class="form-group" style="margin: 10px 0px;">
				<label for="" class="text-muted small">Your Email Address: </label>
				<input type="email" class="form-contro filter-input" name="email" required="true" value="<?php echo $_SESSION['user_email']; ?>">
			</div>
			<div class="form-group" style="margin: 10px 0px;">
				<label for="" class="text-muted small">Year: </label>
				<select name="year" id="" class="form-control filter-input" style="width: 100%;">
					<option value="<?php echo $_SESSION['year'] ?>">Current year: <?php echo $_SESSION['year']; ?></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="text-muted small">Programme of Study</label>
				<input type="text" list="programmes" class="form-control filter-input" value="<?php echo $_SESSION['programme']; ?>" name="programme">
				<datalist id="programmes">
					<?php  
						foreach ($result as $row)
							echo '<option value="'.$row['name'].'">';
					?>
				</datalist>
			</div>
			<input type="submit" class="hidden" value="submit" id="updateUser">
		</form>
		<hr>
		<p class="text-center"><a href="" class="spec-ajax" dest="<?php echo $_SESSION['url'] ?>/home/password.php" output="#ajaxContent" modal="true">Change password? </a></p>
	</nav>
	<?php } ?>
</header>
