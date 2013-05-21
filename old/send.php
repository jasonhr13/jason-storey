<?PHP

$to = "jasons@thwebco.com";
$subject = "Contact Form";
$message = "Name: " . $name_txt;
$message .= "\nEmail: " . $email_txt;
$message .= "\n\nMessage: " . $message_txt;
$headers = "From: $email_txt";
$headers .= "\nReply-To: $email_txt";

mail ($to,$subject,$message,$headers);

?>