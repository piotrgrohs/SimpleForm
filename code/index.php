<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';


if(isset($_POST['message'])){
        $mail = new PHPMailer(true);
    try {
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;     
                        // Enable verbose debug output
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host       = "mailhog"; // SMTP server
        $mail->Port       = 1025;  
        $mail->Username   = 'testmail@gmail.com';               // SMTP username
        $mail->Password   = 'Test';                             // SMTP password

        $mail->setFrom('testmail@gmail.com');
        $mail->addAddress('testmail@gmail.com');     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '[inc]'.$_POST['subject'];
        $mail->Body    = $_POST['message'];
        if(isset($_FILES['uploaded_file'])){
            $uploaddir = 'uploads/';
            $uploadfile = $uploaddir . basename($_FILES['uploaded_file']['name']);
            move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadfile);
            $mail->AddAttachment($uploadfile);
        }
        $mail->send();
        
        echo '<h3 class="text-center"><span class="badge badge-success">Wysłano!</span></h3>';
    } catch (Exception $e) {
        echo '<h3 class="text-center"><span class="badge badge-danger>Nie powiodło się wysłanie zgłoszenia</span></h3>';
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
      }

?>
<?php include 'main.html';?>
