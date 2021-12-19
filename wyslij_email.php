<?php
	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}


	if(isset($_POST['nazwa']) && $_POST['nazwa']!=""){
		$nazwa=$_POST['nazwa'];
		$dokogo=$_POST['dokogo'];
		$temat=$_POST['temat'];
		$wiadomosc=$_POST['wiadomosc'];
		$haslo=$_POST['haslo'];
		$email_nadawcy=$_POST['email_usera'];

	}

	echo $nazwa;
	echo $dokogo;
	echo $temat;
	echo $wiadomosc;
	echo $email_nadawcy;
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'PHPMailer/vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP

		//tu napisac ifa na sprawdzanie domeny maila 
	    
		$domain_name = substr(strrchr($email_nadawcy, "@"), 1);
        echo "Domain name is :" . $domain_name;
        
        if($domain_name=="gmail.com"){
        $email_host="smtp.gmail.com";
        } elseif($domain_name=="op.pl" || $domain_name=="onet.pl"){
        $email_host="smtp.poczta.onet.pl";
        } elseif($domain_name=="wp.pl"){
        $email_host="smtp.wp.pl";
        }

	    $mail->Host       = $email_host;                    // Set the SMTP server to send through



	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = $email_nadawcy;                     // SMTP username
	    $mail->Password   = $haslo;                               // SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //kto wysyla
	    $mail->setFrom($email_nadawcy, $nazwa);
	    //do kogo wysylac
	    $mail->addAddress($dokogo, $nazwa);     // Add a recipient
	    
	    


	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $temat;
	    $mail->Body    = $wiadomosc;
	    $mail->AltBody = $wiadomosc;

	    $mail->send();
		$_SESSION["dzialanie"]= true;
	    echo '<script type="text/javascript">alert("Poprawnie wysłano wiadomość email!");</script>';
	    
	    header("Location: skomunikuj_sie.php");

	} catch (Exception $e) {
		$_SESSION["dzialanie"]= false;
	    echo "Wystąpił błąd! Spróbuj ponownie później. Mailer Error: {$mail->ErrorInfo}";
	    
	    header("Location: skomunikuj_sie.php");
	}

?>