<div class="navbar">
<div class="navbar-inner">
<a class="brand" href="./">MyContacts</a>
<ul class="nav">
<?php foreach($pages as $file =>$text):?>
<li><a href="./?p=<?php echo $file?>"><?php echo $text?></a>
<?php endforeach?>
</ul>
<form method="get" class="form-inline pull-right">
	<input type="hidden" name="p" value="list_contacts"/>
	<div class="input-append">
		<input type="text" name="q" />
		<button type="submit" class="add-on"><i class="icon-search"></i><img src="pictures/chrisgreenscreen.png" alt="chris" width="13px" height="13px" /></button>
	</div>
</form>
</div>
</div>