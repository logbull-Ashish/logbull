<?php

//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
//$name = ($_GET['name']) ? $_GET['name'] : $_POST['name'];
//echo "name";
//$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
//$telephone = ($_GET['telephone']) ?$_GET['telephone'] : $_POST['telephone'];
//$company = ($_GET['company']) ?$_GET['company'] : $_POST['company'];
//$requestedservices = ($_GET['requested_services']) ?$_GET['requested_services'] : $_POST['requested_services'];
//$sendmailyourself = ($_GET['sendmailyourself']) ?$_GET['sendmailyourself'] : $_POST['sendmailyourself'];
//$comment = ($_GET['comment']) ?$_GET['comment'] : $_POST['comment'];


$name =$_POST['name'];
//echo "name";
$email = $_POST['email'];
$telephone =$_POST['telephone'];
$company = $_POST['company'];
$requestedservices = $_POST['requested_services'];
$sendmailyourself = $_POST['sendmailyourself'];
$comment = $_POST['comment'];
//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the email
if (!$name) $errors[count($errors)] = 'Please enter your name.';
if (!$email) $errors[count($errors)] = 'Please enter your email.';
if (!$telephone) $errors[count($errors)] = 'Please enter your telephone.';
if (!$company) $errors[count($errors)] = 'Please enter your company.'; 
if (!$comment) $errors[count($errors)] = 'Please enter your comment.'; 

//if the errors array is empty, send the mail


	//recipient - replace your email here
//	$to = 'wowthemesnet@gmail.com';	
//	$to = "yashokeerti@logbullit.com";
	//sender - from the form
//	$from = " $email ";
	
	//subject and the html message
//	$subject = "Message from " $name ;	
	//$message = 	"Name: " $name "<br/><br/>Email: " $email "<br/><br/>Telephone: " $telephone "<br/><br>Company: " $company "<br/><br>Requested Services: " $requestedservices "<br/><br>Message: " nl2br($comment) "<br/>";

//$message="Name:"$name"   ""Email:""$email"" ""Phone No.:""$telephone"" ""Comapny:""$company"" ""Comments:""$comment";
$message=echo "Name:"$name;
	//send the mail
//	$result = sendmail($to, $subject, $message, $from);
	$result = sendmail($email,$message);
	
	//if POST was used, display the message straight away
	if ($_POST) {
		if ($result) echo 'Thank you! We have received your message.';
//		else echo 'Sorry, unexpected error. Please try again later';
		
	//else if GET was used, return the boolean value so that 
	//ajax script can react accordingly
	//1 means success, 0 means failed
	} else {
		echo $result;	
	}

//if the errors array has values
 //else {
	//display the errors message
//	for ($i=0; $i<count($errors); $i++) echo $errors[$i] . '<br/>';
//	echo '<a href="index.html">Back</a>';
//	exit;
//}
//Simple mail function with HTML header
function sendmail($email,$message)
{
date_default_timezone_set('Etc/UTC');
echo './PHPMailer-master/PHPMailerAutoload.php';
require './PHPMailer-master/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "smtp.gmail.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "ashish@logbullit.com";
//Password to use for SMTP authentication
$mail->Password = "062608491";
//Set who the message is to be sent from
$mail->setFrom('ashish@logbullit.com', 'First Last');
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($email, 'Contact To');
//Set the subject line
$mail->Subject = 'You have new contact';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

$mail->msgHTML($message);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
echo 'Thank you! We have received your message.';
}

}
?>
