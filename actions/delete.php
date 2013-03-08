<?php
session_start();
require('../config/db.php');
//connect to the DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM contacts WHERE contact_id={$_POST['id']}";
$results = $conn->query($sql);
//store the values into variable
$contact = $results->fetch_assoc();
extract($contact);
//execute query
$sql = "DELETE FROM contacts WHERE contact_id={$_POST['id']}";
$conn->query($sql);
if($conn->errno >0){
	$error= "<strong>MySQL Error # {$conn->errno}</strong>:";
	$error .="{$conn->error}<br/><strong>SQL</strong>$sql";
	$_SESSION['message']= array(
			'type'=>'danger',
			'text'=>"$error",
	);
	header("Location:../?p=list_contacts");
	die();
}
//close connection

$conn->close();
//store message in session data
$_SESSION['message']= array(
		'type'=>'success',
		'text'=>"<strong>$contact_firstname $contact_lastname</strong> no longer exists",
);
//redirect
header('Location:../?p=list_contacts');