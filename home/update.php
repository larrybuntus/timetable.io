<?php  
	session_start();
	require_once("../core/db.php");
	require_once("../core/functions.php");
	$func = new myFunc;

	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		$day = $_POST['day'];
		$course = $_POST['course'];
		$stime = $_POST['stime'];
		$etime = $_POST['etime'];
		$venue = $_POST['venue'];
		$lecturer = $_POST['lecturer'];

		$result = $func->myResult("SELECT * FROM timetables WHERE start_time BETWEEN ? AND ? AND day = ? AND id != ?","sssi",array($stime,$etime,$day,$id));

		if ($result->num_rows > 0) {
			echo '<p class="red text-center">Oops, clashing time schedule</p>';
			exit();
		}

		if(strtotime($stime) >= strtotime($etime)){
			echo '<p class="red text-center">Ending time cannot be less than or equal to starting time</p>';
			exit();
		}

		$stmt = $conn->prepare("UPDATE timetables SET day = ?, course = ?, start_time = ?, end_time = ?, venue = ?, lecturer = ? WHERE id = ?");
		$stmt->bind_param("ssssssi",$day,$course,$stime,$etime,$venue,$lecturer,$id);

		if ($stmt->execute() === false) {
			echo '<p class="lead text-center">An unexpected error occured</p>';
		}else
			echo '<p class="lead text-center">Schedule updated</p>';
		exit();

	}

	$row = $func->myFetch("SELECT * FROM timetables WHERE id = ?","i",array($_POST['id']));
	$id = $row['id'];
	$day = $row['day'];
	$course = $row['course'];
	$start_time = date("H:i", strtotime($row['start_time']));
	$end_time = date("H:i", strtotime($row['end_time']));
	$venue = $row['venue'];
	$lecturer = $row['lecturer'];
?>
<div class="container-fluid">
	<p class="lead text-center">Update Schedule</p>
	<form class="form" output="#feedback-update" dest="<?php echo $_SESSION['url']; ?>/home/update.php">
		<div class="form-group">
			<label for="" class="text-muted small">Choose Different Day</label>
			<select class="form-control filter-input" name="day">
				<option value="<?php echo $day; ?>">Select different day ...</option>
				<option value="mon">Monday</option>
				<option value="tue">Tuesday</option>
				<option value="wed">Wednesday</option>
				<option value="thu">Thursday</option>
				<option value="fri">Friday</option>
				<option value="sat">Saturday</option>
				<option value="sun">Sunday</option>
			</select>
		</div>

		<div class="form-group">
			<label for="" class="text-muted small">Course</label>
			<?php $result = $func->myResult("SELECT DISTINCT(course) FROM timetables WHERE user_id = ?","i",array($_SESSION['user_id'])); ?>
			<input type="text" list="courses" class="form-control filter-input" placeholder="course name here" required="true" autocomplete="true" name="course" value="<?php echo $course; ?>">
			<datalist id="courses">
				<?php while($row = $result->fetch_assoc()) 
						echo '<option value="'.$row['course'].'">';
				?>
			</datalist>
		</div>
		
		<div class="form-group">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-6">
						<label for="" class="text-muted small">Start Time</label>
						<input type="time" class="form-control filter-input" name="stime" required="true" value="<?php echo $start_time ?>">
					</div>
					<div class="col-xs-6">
						<label for="" class="text-muted small">End Time</label>
						<input type="time" class="form-control filter-input" name="etime" required="true" value="<?php echo $end_time ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="text-muted small">Venue</label>
			<?php $result = $func->myResult("SELECT DISTINCT(venue) FROM timetables WHERE user_id = ?","i",array($_SESSION['user_id'])); ?>
			<input type="text" list="venue" class="form-control filter-input" placeholder="venue name here" required="true" autocomplete="true" name="venue" value="<?php echo $venue; ?>">
			<datalist id="venue">
				<?php while($row = $result->fetch_assoc()) 
						echo '<option value="'.$row['venue'].'">';
				?>
			</datalist>
		</div>
		<div class="form-group">
			<label for="" class="text-muted small">Lecturer</label>
			<?php $result = $func->myResult("SELECT DISTINCT(lecturer) FROM timetables WHERE user_id = ?","i",array($_SESSION['user_id'])); ?>
			<input type="text" list="lecturer" class="form-control filter-input" placeholder="lecturer name here" autocomplete="true" name="lecturer" value="<?php echo $lecturer; ?>">
			<datalist id="lecturer">
				<?php while($row = $result->fetch_assoc()) 
						echo '<option value="'.$row['lecturer'].'">';
				?>
			</datalist>
		</div>
		<div class="hidden">
			<input type="hidden" name="submit" value="submit">
			<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
		</div>
		<div class="form-group">
			<input type="submit" class="form-control btn btn-primary" value="Add">
		</div>
	</form>
	<div id="feedback-update"></div>
</div>