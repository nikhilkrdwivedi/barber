<?php

if (array_key_exists("send", $_GET)){

	$emailTo = "princeparaste78@gmail.com";
	$subject = "Contact";
	$body = $_GET['cmessage'];
	$header = "From: ".$_GET['cemail'];
	$var = mail($emailTo, $body, $subject, $header);
	if($var==true){
		echo "Message sent successfully...";
	} 
	else
	{
		echo "Message could not be sent...";
	}
}
?>
