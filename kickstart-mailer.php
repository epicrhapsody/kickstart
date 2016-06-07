<?php
$name=$_POST['name'];
$email=$_POST['email'];
$telefon=$_POST['telefon'];
$option=$_POST['option'];
$choose=$_POST['choose'];
$check=$_POST['check'];
$nachricht=$_POST['nachricht'];

# -=-=-=- MIME BOUNDARY
$mime_boundary = "-----=".md5(time());
# -=-=-=- MAIL HEADERS
$to = "kvomwege@ddbj.de";

$subject = "Eine Anfrage";
$headers = "From: Kickstart <kvomwege@ddbj.de>\n";
$headers .= "Reply-To: $name $email\n";
$headers .= "BCC: ";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";

$message .= "--$mime_boundary\n";
$message .= "Content-Type: text/html; charset=UTF-8\n";
$message .= "Content-Transfer-Encoding: 8bit\n\n";

$message .= "<html>\n";
$message .= "<body style=\"font-family: Arial, Verdana, Geneva, sans-serif; font-size:14px; color:#000;\">\n";


$message .="<ul style=\"margin: 0;list-style-type: none;\">";


if (empty ($name)){
	$message .="";
} else {
	$message .="<li>";
	$message .="<span style=\"width:130px;display:inline-block;margin-bottom:7px;\">Name:</span> ";
	$message .="$name";
    $message .="</li>";    
}

if (empty ($email)){
	$message .="";
} else {
	$message .="<li>";
	$message .="<span style=\"width:130px;display:inline-block;margin-bottom:7px;\">E-mail:</span> ";
	$message .="$email";
    $message .="</li>";    
}

if (empty ($telefon)){
	$message .="";
} else {
	$message .="<li>";
	$message .="<span style=\"width:130px;display:inline-block;margin-bottom:7px;\">Telefon:</span> ";
	$message .="$telefon";
    $message .="</li>";    
}

if (empty ($option)){
	$message .="";
} else {
	$message .="<li>";
	$message .="<span style=\"width:130px;display:inline-block;margin-bottom:7px;\">Option:</span> ";
	$message .="$option";
    $message .="</li>";    
}

if (empty ($choose)){
	$message .="";
} else {
	$message .="<li>";
	$message .="<span style=\"width:130px;display:inline-block;margin-bottom:7px;\">Auswahl:</span> ";
	$message .="$choose";
    $message .="</li>";    
}

if (empty ($check)){
	$message .="";
} else {
	$message .="<li>";
	$message .="<span style=\"width:130px;display:inline-block;margin-bottom:7px;\">Check:</span> ";
	$message .="$check";
    $message .="</li>";    
}

if (empty ($nachricht)){
	$message .="";
} else {
	$message .="<li>";
	$message .="<span style=\"width:130px;display:inline-block;margin-bottom:7px;\">Nachricht:</span> ";
	$message .="$nachricht";
    $message .="</li>";    
}

$message .="</ul>";


$message .= "</body>\n";
$message .= "</html>\n";
# -=-=-=- FINAL BOUNDARY
$message .= "--$mime_boundary--\n\n";
# -=-=-=- SEND MAIL
$mail_sent = @mail( $to, $subject, $message, $headers );
//echo $mail_sent ? "Mail sent" : "Mail failed";
if($mail_sent)
{
header('Location:./?msg=yes');
}
else
{
header('Location:./?msg=no');
}
?>
