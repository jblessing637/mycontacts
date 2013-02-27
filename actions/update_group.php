<?php
session_start();
require('../config/db.php');
extract($_POST);
if(!isset($_POST['group_name']) || $_POST['group_name'] == ''){
	//store message into session
	$_SESSION['message']= array(
			'type'=>'danger',
			'text'=>'Wheres the stuff, man?',
	);
	//store form data into session data
	$_SESSION['POST']= $_POST;
	//set location header
	header("Location:../?p=form_edit_group&id={$_POST['group_id']}");
	die();
}else {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//execute query
	$sql = "UPDATE groups SET group_name='{$_POST['group_name']}' WHERE group_id='{$_POST['group_id']}'";
	$conn->query($sql);
	//close connection
	$conn->close();
	//redirect
	$_SESSION['message']= array(
			'type'=>'success',
			'text'=>"<strong>{$_POST['group_name']}</strong> has been changed",
	);
	header('Location:../?p=list_groups');
}