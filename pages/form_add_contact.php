<h2>New Contact</h2>
<form class="form-horizonatal" action="actions/add_contact.php" method="post">
	<div class="control-group">
		<label class="control-label" for="contact_firstname">First Name</label>
		<div class="controls">
			<?php echo input('contact_firstname', 'required')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_lastname">Last Name</label>
		<div class="controls">
			<?php echo input('contact_lastname', 'required')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_email">Email</label>
		<div class="controls">
			<?php echo input('contact_email', 'required')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_phone">Phone Number</label>
		<div class="controls">
			<?php echo input('contact_phone','5555555555');?>
		</div>
	</div>
	<div class="control-group">
	<label class="control-label" for="contact_group">Group</label>
	<div class="controls">
	<select name="contact_group">
	<option value="0">Select a Group</option>
	<?php 
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//query groups table
	$sql = "SELECT * FROM groups";
	$results=$conn->query($sql);
	while(($group = $results->fetch_assoc()) != null){
		extract($group);
		echo "<option value=\"$group_id\">$group_name</option>";
	}?>
	</select>
	</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">
			<i class="icon-plus-sign icon-white"></i> Add Contact
		</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>
