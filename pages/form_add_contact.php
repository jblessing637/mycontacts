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
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">
			<i class="icon-plus-sign icon-white"></i> Add Contact
		</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>