<?php
session_start();
$required = array (
		'contact_firstname',
		'contact_lastname',
		'contact_email',
		'contact_phone',
);
require('../config/db.php');
extract($_POST);
foreach($required as $r) {
	if(!isset($_POST[$r]) || $_POST[$r] == ''){
		//store message into session
		$_SESSION['message']= array(
				'type'=>'danger',
				'text'=>'Wheres the stuff, man?',
		);
		//store form data into session data
		$_SESSION['POST']= $_POST;
		//set location header
		header("Location:../?p=form_edit_contact&id={$_POST['contact_id']}");
		die();
	}
}
if(is_numeric($contact_phone) && strlen($contact_phone)==10){
//connect to the DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//execute query
$sql = "UPDATE contacts SET contact_firstname='{$_POST['contact_firstname']}', contact_lastname='{$_POST['contact_lastname']}', contact_email='{$_POST['contact_email']}', contact_phone='{$_POST['contact_phone']}', group_id='{$_POST['contact_group']}' WHERE contact_id='{$_POST['contact_id']}'";
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
//redirect
$_SESSION['message']= array(
		'type'=>'success',
		'text'=>"<strong>$contact_firstname $contact_lastname's</strong> information has been changed",
);
header('Location:../?p=list_contacts');}
else{
	//store message into session
	$_SESSION['message']= array(
			'type'=>'danger',
			'text'=>'The Phone Number is supposed to be a phone number with the area code',
	);
	//store form data into session data
	$_SESSION['POST']= $_POST;
	//set location header
	header("Location:../?p=form_edit_contact&id={$_POST['contact_id']}");
}
?>