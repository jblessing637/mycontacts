<h2>Contacts</h2>
<?php
//connect to database
//new sqli(host, user, password, db name)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//read (select) contacts from database
if(isset($_GET['sort']) && $_GET['sort']!=''){
	$orderby="ORDER BY contact_{$_GET['sort']}";
}else {
	$orderby='ORDER BY contact_lastname, contact_firstname';
}
$sql = "SELECT * FROM contacts LEFT JOIN groups ON contacts.group_id=groups.group_id $orderby";
$results=$conn->query($sql);
//if there is an error on sql query display error and kill script
if($conn->errno >0){
	echo $conn->error;
	die();
}
//loop over contacts and display them
echo '<table class="table"><tr><th><a href="./?p=list_contacts&sort=firstname">First Name</a></th><th><a href="./?p=list_contacts&sort=lastname">Last Name</a></th><th>Email</th><th>Phone</th><th>Group</th><th>Edit</th><th>Delete</th></tr>';
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	if($contact_phone != null){
	$phone = format_phone($contact_phone);}
	else {$phone = '-';}
	echo "<tr><td>$contact_firstname</td><td>$contact_lastname</td><td><a href=\"mailto:$contact_email\"> $contact_email</a></td><td>$phone</td><td><a href=\"?p=group&id=$group_id\" class=\"label label-success\">$group_name</a></td><td><a href=\"./?p=form_edit_contact&id=$contact_id\" ><button type=\"submit\" class=\"btn btn-warning\"><img src=\"pictures/chrisgreenscreen.png\" alt=\"chris\" width=\"25px\" height=\"25px\" /></button></a></td>";
	echo "<td><form style=\"display:inline;\" method=\"post\" action = \"actions/delete.php\"><button type=\"submit\" class=\"btn btn-danger\"><img src=\"pictures/chrisgreenscreen.png\" alt=\"chris\" width=\"25px\" height=\"25px\" /></button><input type=\"hidden\" name=\"id\" value=\"$contact_id\"/></form></td></tr>";
}
echo '</table>';
//close database connection
$conn->close();