<?php
$name = ($_GET['name']) ? $_GET['name'] : $_POST['name'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
$subject = ($_GET['subject']) ?$_GET['subject'] : $_POST['subject'];
$message = ($_GET['message']) ?$_GET['message'] : $_POST['message'];

$to = 'cstclair@noctrl.edu';  
$from = $name . ' <' . $email . '>';

$result = mail($to, $subject, $message, $from);
if ($result){
	echo "mail sent";
}
else{
	echo "no mail sent";
}
?>