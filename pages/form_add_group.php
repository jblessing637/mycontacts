<h2>New Group</h2>
<form class="form-horizonatal" action="actions/add_group.php" method="post">
<div class="control-group">
<label class="control-label" for="group_name">Group Name</label>
<div class="controls">
			<?php echo input('group name', 'Group Name')?>
		</div>
	</div>
		<div class="form-actions">
		<button type="submit" class="btn btn-primary">
			<img src="pictures/chrisgreenscreen.png" alt="chris" width="25px" height="25px" /> Add Group
		</button>
		<button type="button" class="btn" onclick="window.history.go(-1)"><img src="pictures/chrisgreenscreen.png" alt="chris" width="25px" height="25px" />Cancel</button>
	</div>
</form>