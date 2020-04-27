<?php

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


function sendEmail($to, $subject, $message){
	$mail = new PHPMailer(true);

	try {
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = SMTP_EMAIL;                     // SMTP username
		$mail->Password   = SMTP_PASSWORD;                               // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		$mail->CharSet = 'UTF-8';

		//Recipients
		$mail->setFrom(SMTP_EMAIL, 'Site');
		$mail->addAddress($to);     // Add a recipient
		

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;

		$mail->send();
		// echo 'Message has been sent';
		return true;
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	// mail($to, $subject, $message);
}