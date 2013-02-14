<h2>Contacts</h2>
<?php
//connect to database
//new sqli(host, user, password, db name)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//read (select) contacts from database
//check for a search string
if(isset($_GET['q']) && $_GET['q']!='') {
	$where = "WHERE contact_lastname LIKE '%{$_GET['q']}%'";
	$search_message = "<p>Contacts with last name containing \"{$_GET['q']}\"</p>";
	$show_all = '<a href="./?p=list_contacts">Show all contacts</a>';
}else {
	$where = '';
	$search_message='';
	$show_all='';
}

if(isset($_GET['sort']) && $_GET['sort']!=''){
	$orderby="ORDER BY contact_{$_GET['sort']}";
}else {
	$orderby='ORDER BY contact_lastname, contact_firstname';
}
$sql = "SELECT * FROM contacts $where $orderby";
$results=$conn->query($sql);
//if there is an error on sql query display error and kill script
if($conn->errno >0){
	echo $conn->error;
	die();
}
echo $search_message;
echo $show_all;
//loop over contacts and display them
echo '<table class="table"><tr><th><a href="./?p=list_contacts&sort=firstname">First Name</a></th><th><a href="./?p=list_contacts&sort=lastname">Last Name</a></th><th>Email</th><th>Phone</th><th>Edit</th><th>Delete</th></tr>';
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	if($contact_phone != null){
	$phone = format_phone($contact_phone);}
	else {$phone = '-';}
	echo "<tr><td>$contact_firstname</td><td>$contact_lastname</td><td><a href=\"mailto:$contact_email\"> $contact_email</a></td><td>$phone</td><td><a href=\"./?p=form_edit_contact&id=$contact_id\" >Edit</a></td>";
	echo "<td><form style=\"display:inline;\" method=\"post\" action = \"actions/delete.php\"><input type=\"hidden\" name=\"id\" value=\"$contact_id\"/><input type=\"submit\" value=\"delete\"/></form></td></tr>";
}
echo '</table>';
//close database connection
$conn->close();