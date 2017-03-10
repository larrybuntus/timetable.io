<?php while($row = $result->fetch_assoc()){ 
		$id = $row['id'];
		$course = $row['course'];
		$start_time = date("H:i", strtotime($row['start_time']));
		$end_time = date("H:i", strtotime($row['end_time']));
		$venue = $row['venue'];
		$lecturer = $row['lecturer'];
	?>
	<tr class="schedule<?php echo $id ?>">
		<td class="text-center">
			<label class="label--checkbox"><input type="checkbox" name="schedule[]" class="check" value="<?php echo $id; ?>"></label>
		</td>
		<td>
			<div class="drop-container">
				<a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $course; ?></a>
				<div class="dropdown-menu">
					<li><a href="" class="spec-ajax" dest="<?php echo $_SESSION['url'] ?>/home/update.php" output="#ajaxContent" modal="true" id="<?php echo $id; ?>"><i class="fa fa-pencil-square-o fa-fw"></i> Update</a></li>
					<li><a href="" class="spec-ajax" dest="<?php echo $_SESSION['url'] ?>/home/delete.php" fade=".schedule<?php echo $id ?>" output="#nothing" id="<?php echo $id; ?>"><i class="fa fa-trash fa-fw"></i> Delete</a></li>
				</div>
			</div>
		</td>
		<td><?php echo $start_time.' - '.$end_time; ?></td>
		<td><?php echo $venue; ?></td>
		<td><?php echo $lecturer; ?></td>
	</tr>
<?php } ?>