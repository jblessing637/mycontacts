<?php
//connect to the DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// execute a SELECT query
$sql = "SELECT * FROM groups WHERE group_id={$_GET['id']}";
$results = $conn->query($sql);
//store the values into variable
$group = $results->fetch_assoc();
extract($group);
//close the connection
$conn->close();?>
<form action="actions/update_group.php" method="post">
	<label>First Name</label>
	<input type="text" name="group_name" value="<?php echo $group_name;?>"/>
	<br/>
	<input type="hidden" name="group_id" value="<?php echo $_GET['id'];?>"/>
	<div class="form-actions">
		<button type="submit" class="btn btn-warning">
			<i class="icon-edit icon-white"></i> Edit Group
		</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>