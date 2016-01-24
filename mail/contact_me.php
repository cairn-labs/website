<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Create the email and send the message
$to = 'sbrother@gmail.com'; 
$email_subject = "Cairn Labs Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$from = 'noreply@sandbox222571a8071848e98d118aaba9201f47.mailgun.org';

$mg = new Mailgun(getenv('MAILGUN_KEY'));
$domain = "sandbox222571a8071848e98d118aaba9201f47.mailgun.org";
$mg->sendMessage($domain, array('from'    => $from, 
                                'to'      => $to, 
                                'subject' => $email_subject, 
                                'text'    => $email_body));

return true;
?>