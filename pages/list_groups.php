<h2>Groups</h2>
<?php
//connect to database
//new sqli(host, user, password, db name)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//read (select) contacts from database
$sql = "SELECT * FROM groups";
$results=$conn->query($sql);
echo "<ul>";
while(($group = $results->fetch_assoc()) != null) {
	extract($group);
	echo "<a href=\"?p=group&id=$group_id\"><li>$group_name</li></a>";
}
echo "</ul>";
$conn->close();