<h2>Groups</h2>
<?php
//connect to database
//new sqli(host, user, password, db name)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//read (select) contacts from database
$sql = "SELECT * FROM groups";
$results=$conn->query($sql);
echo '<table class="table"><tr><th>Group Name</th><th>Edit</th><th>Delete</th></tr>';
while(($group = $results->fetch_assoc()) != null) {
	extract($group);
	echo "<tr><td><a href=\"?p=group&id=$group_id\">$group_name</a></td>";
	echo "<td><a href=\"./?p=form_edit_group&id=$group_id\" ><button type=\"submit\" class=\"btn btn-warning\"><img src=\"pictures/chrisgreenscreen.png\" alt=\"chris\" width=\"25px\" height=\"25px\" /></button></a></td>";
	echo "<td><form style=\"display:inline;\" method=\"post\" action = \"actions/delete_group.php\"><button type=\"submit\" class=\"btn btn-danger\"><img src=\"pictures/chrisgreenscreen.png\" alt=\"chris\" width=\"25px\" height=\"25px\" /></button><input type=\"hidden\" name=\"id\" value=\"$group_id\"/></form></td></tr>";
}
echo "</table>";
$conn->close();