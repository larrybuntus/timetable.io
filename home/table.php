<?php 
	$days = array("Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

	$result = $func->myResult("SELECT * FROM timetables WHERE user_id = ? and day = ? ORDER BY start_time ASC","is",array($_SESSION['user_id'], 'mon'));

?>
<div class="table-container">
	<div class="table-inner container">
		<p class="lead text-center"><?php echo date("l jS M, Y") ?> | <span class="time"></span> GMT</p>
		<div class="flex-container">
			<div class="days-container">
				<div class="days">
					<div class="day">
						<p class="lead"><a  href="" class="spec-ajax active" dest="<?php echo $_SESSION['url'] ?>/home/days.php" output=".days-schedule" id="Monday">Monday</a></p>
					</div>
					<?php foreach ($days as $day): ?>
						
					<div class="day">
						<p class="lead"><a href="" class="spec-ajax" dest="<?php echo $_SESSION['url'] ?>/home/days.php" output=".days-schedule" id="<?php echo $day; ?>"><?php echo $day; ?></a></p>
					</div>

					<?php endforeach ?>
				</div>
			</div>
			<div class="timetable">
				<div class="table-responsive main-table">
					<nav class="navbar navbar-white navbar-static-top">
						<ul class="nav navbar-nav nav-pills">
							<li><a href="" class="spec-ajax" dest="<?php echo $_SESSION['url'] ?>/home/new.php" output="#ajaxContent" modal="true">ADD</a></li>
							<li><a href="" id="delete" class="hidden spec-ajax" trigger=".delChecked">REMOVE</a></li>
							<li class="visible-xs pull-right"><a href="#" class="selected" style="margin: 0;"></a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right nav-pills">
							<li class="hidden-xs"><a href="#" class="selected"></a></li>
						</ul>
					</nav>
					<form action="" id="course" class="form" dest="<?php echo $_SESSION['url'] ?>/home/delete.php" output="#ajaxContent" checkout="tr">
						<table class="table table-hover sortable" style="white-space: nowrap;">
							<thead>
								<tr>
									<th></th>
									<th title="course name">Courses</th>
									<th title="starting time and ending time">Time (GMT)</th>
									<th title="location of course">Venue</th>
									<th title="lecturer of course">Lecturer</th>
								</tr>
							</thead>
							<tbody class="days-schedule">
								<?php include "content.php" ?>
							</tbody>
						</table>
						<div class="hidden">
							<input type="hidden" name="submit" value="submit">
							<input type="submit" class="delChecked" value="delChecked">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	if (isset($_SESSION['programme_id']) && isset($_SESSION['year'])) {
		include "chat/index.php"; 
		include "repo/index.php";
	}
?>

<?php include("notify.php"); ?>