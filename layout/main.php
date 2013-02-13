<?php
if(isset($_SESSION['message'])){
	//display message
	echo "<div class=\"alert alert-{$_SESSION['message']['type']}\">{$_SESSION['message']['text']}</div>";
	unset($_SESSION['message']);
}
//store the 'p' parameter from the qs into a variable
if(isset($_GET['p'])) {
	$p=$_GET['p'];
}else {
	$p=DEFAULT_PAGE;
}
include("pages/$p.php");