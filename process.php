<?php
//Retrieve form data.
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$name = ($_GET['name']) ? $_GET['name'] : $_POST['name'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
$subject = ($_GET['subject']) ?$_GET['subject'] : $_POST['subject'];
$message = ($_GET['message']) ?$_GET['message'] : $_POST['message'];
 
// Server side validation for POST data
// Builds error array
if (!$name) 
	$errors[count($errors)] = 'Please enter your name.';
if (!$email) 
	$errors[count($errors)] = 'Please enter your email.';
if (!$message) 
	$errors[count($errors)] = 'Please enter your message.';
 
if (!$errors){
    $to = '<cstclair@noctrl.edu>';  
    $from = $name . ' <' . $email . '>';
    $subject = 'message from ' . $name;
    $message = $message;
 
    if (spamcheck($_REQUEST['email'])){  // true is valid data

// *****************************
// PROBLEM TESTING ON WAMP SERVER
// *****************************
//		$result = mail($to, $subject, $message, $from);
        $result=TRUE;
        if ($_POST) {
			if ($result) 
			   echo 'Thank you.  Your message has been sent.';
			else 
			   echo 'Sorry, unexpected error. Please try again later';
		} 
		else{ // AJAX script will use result
			echo $result;  
		}
	}
	else{
		echo "Invalid Input";
	}
} 
else{
	//display the errors message
	for ($i=0; $i<count($errors); $i++){
	 echo $errors[$i] . '<br/>';
	}
	echo '<a href="contact.php">Back</a>';
	exit;
}

// prevent email injection attack
function spamcheck($field){
	$field = filter_var($field, FILTER_SANITIZE_EMAIL);
	if (filter_var($field, FILTER_VALIDATE_EMAIL)){
		return TRUE;
	}
	else{
	    return FALSE;
	}
}