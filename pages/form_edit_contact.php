<?php
//connect to the DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// execute a SELECT query
$sql = "SELECT * FROM contacts WHERE contact_id={$_GET['id']}";
$results = $conn->query($sql);
//store the values into variable
$contact = $results->fetch_assoc();
extract($contact);
$contact_group=$group_id;
//close the connection
$conn->close();?>
<form action="actions/update.php" method="post">
	<label>First Name</label>
	<input type="text" name="contact_firstname" value="<?php echo $contact_firstname;?>"/>
	<br/>
	<label>Last Name</label>
	<input type="text" name="contact_lastname" value="<?php echo $contact_lastname;?>"/>
	<br/>
	<label>Email</label>
	<input type="text" name="contact_email" value="<?php echo $contact_email;?>"/>
	<br/>
	<label>Phone</label>
	<input type="text" name="contact_phone" value="<?php echo $contact_phone;?>"/>
	<br/>
	<div class="control-group">
	<label class="control-label" for="contact_group">Group</label>
	<div class="controls">
	<select name="contact_group">
	<option value="0">Select a group</option>
	<?php 
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//query groups table
	$sql = "SELECT * FROM groups";
	$results=$conn->query($sql);
	if($conn->errno >0){
		$error= "<strong>MySQL Error # {$conn->errno}</strong>:";
		$error .="{$conn->error}<br/><strong>SQL</strong>$sql";
		$_SESSION['message']= array(
				'type'=>'danger',
				'text'=>"$error",
		);
		header("Location:../?p=list_contacts");
		die();
	}
	while(($group = $results->fetch_assoc()) != null){
		extract($group);
		if($contact_group==$group_id){
			$selected='selected="selected"';
		}else {
			$selected='';
		}
		echo "<option $selected value=\"$group_id\">$group_name</option>";
	}?>
	</select>
	</div>
	</div>
	<input type="hidden" name="contact_id" value="<?php echo $_GET['id'];?>"/>
	<div class="form-actions">
		<button type="submit" class="btn btn-warning">
			<i class="icon-edit icon-white"></i> Edit Contact
		</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>