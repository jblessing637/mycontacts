<?php
session_start();
$required = array (
	'contact_firstname',
	'contact_lastname',
	'contact_email',
	'contact_phone',
);
require('../config/app.php');
require('../lib/functions.php');
require('../config/db.php');
//extract post data to variable
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
		header('Location:../?p=form_add_contact');
		die();
	}
}
if(is_numeric($contact_phone) && strlen($contact_phone)==10 && strpos($contact_email, '@') && strpos($contact_email, '.')){
//at this point, as a result of 'extract', we can refer to, for example, the submitted last name as $contact_lastname instead of $_POST['contact_lastname']
//connect to the DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//execute query
$sql = "INSERT INTO contacts (contact_firstname, contact_lastname, contact_email, contact_phone, group_id) VALUES ('$contact_firstname', '$contact_lastname', '$contact_email', '$contact_phone', $contact_group)" ;
$conn->query($sql);
//close DB connenction
$conn->close();
//store message into session
$_SESSION['message']= array(
		'type'=>'success',
		'text'=>"<strong>$contact_firstname $contact_lastname</strong> has been added to your contacts",
);
//redirect to list
header('Location:../?p=list_contacts');}
elseif(is_numeric($contact_phone) && strlen($contact_phone)==10){
	//store message into session
	$_SESSION['message']= array(
			'type'=>'danger',
			'text'=>'Enter a valid email',
	);
	//store form data into session data
	$_SESSION['POST']= $_POST;
	//set location header
	header('Location:../?p=form_add_contact');
}elseif(strpos($contact_email, '@') && strpos($contact_email, '.')){
	//store message into session
	$_SESSION['message']= array(
			'type'=>'danger',
			'text'=>'The phone number has to be a phone number with the area code',
	);
	//store form data into session data
	$_SESSION['POST']= $_POST;
	//set location header
	header('Location:../?p=form_add_contact');
}else{
	//store message into session
	$_SESSION['message']= array(
			'type'=>'danger',
			'text'=>'Enter a valid email and phone number',
	);
	//store form data into session data
	$_SESSION['POST']= $_POST;
	//set location header
	header('Location:../?p=form_add_contact');
}
?>