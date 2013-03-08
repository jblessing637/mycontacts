<?php
session_start();
require('../config/app.php');
require('../lib/functions.php');
require('../config/db.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "INSERT INTO groups (group_name) VALUES ('{$_POST['group_name']}')" ;
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
$conn->close();
$_SESSION['message']= array(
		'type'=>'success',
		'text'=>"<strong>{$_POST['group_name']}</strong> has been added to your groups",
);
header('Location:../?p=list_groups');