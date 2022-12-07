<?php 

	require '../app/UCCMailer.php';
	$UCCMailer = new UCCMailer;

	$destino = 'yfortegar@ucn.edu.co';
	$nombreDestino = 'Yadir Ortega';
	$copia = 'dfagudelom@ucn.edu.co';

	$mensajeHTML = '<p>Mensaje <b>HTML<b> desde UCC.</p>';
	$ruta = 'dashboard/?cv=05e062bf28fd8ddc3e3e3f2cfdbb1a34';
	$mensaje = $UCCMailer->htmlBody($mensajeHTML, $nombreDestino, $ruta);
	
	// Importar PHPMailer
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Requerir a PHPMailer
    include '../PHPMailer/src/Exception.php';
    include '../PHPMailer/src/PHPMailer.php';
    include '../PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    try {
    	#$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    	$mail->isSMTP();                                            
    	$mail->Host       = $UCCMailer->MyHost;                          
    	$mail->SMTPAuth   = true;
    	$mail->Username   = $UCCMailer->MyUsername;                      // SMTP username
    	$mail->Password   = $UCCMailer->MyPassword;                      // SMTP password
    	$mail->CharSet    = PHPMailer::CHARSET_UTF8;
    	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    	$mail->Port       = $UCCMailer->MyPort;

    	//Recipientes
    	$mail->setFrom($UCCMailer->MyUsername, $UCCMailer->FromUser);
    	$mail->addAddress('yfortegar@ucn.edu.co', 'YADIR ORTEGA');     // Add a recipient
    	#$mail->addAddress($mail_admin);                       // Name is optional
    	#$mail->addReplyTo('info@example.com', 'Information');
    	$mail->addCC($copia);
    	#$mail->addBCC('bcc@example.com');

    	// Attachments
    	#$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    	#$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    	// Content
    	$mail->isHTML(true);                                  // Set email format to HTML
    	$mail->Subject = 'UCC Pruebas';
    	$mail->Body    = $mensaje;
    	#$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    	$mail->send();

    	#return true;
    	echo "Enviado";	
	}catch (Exception $e) {
    	#return false;
    	echo "No enviado";
	}
?>