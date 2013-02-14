<?php
//connect to the DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// execute a SELECT query
$sql = "SELECT * FROM contacts WHERE contact_id={$_GET['id']}";
$results = $conn->query($sql);
//store the values into variable
$contact = $results->fetch_assoc();
extract($contact);
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
	<input type="hidden" name="contact_id" value="<?php echo $_GET['id'];?>"/>
	<div class="form-actions">
		<button type="submit" class="btn btn-warning">
			<i class="icon-edit icon-white"></i> Edit Contact
		</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>