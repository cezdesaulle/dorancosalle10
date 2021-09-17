<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../src/PHPMailer/src/Exception.php';
require '../src/PHPMailer/src/PHPMailer.php';
require '../src/PHPMailer/src/SMTP.php';



class MailController
{

    public static function send()
    {
        $mail = new PHPMailer(true);


            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dorancosalle220821@gmail.com';                     //SMTP username
            $mail->Password   = 'Doranco@salle22';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('dorancosalle220821@gmail.com', 'Joe User');     //Add a recipient

            $mail->addReplyTo('info@example.com', 'Information');


            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addEmbeddedImage('../public/upload/giphy.gif', 'giphy.gif');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            ob_start();
            include(VIEWS.'mail/mail.php');

            $mail->Body    = ob_get_clean();
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
           // echo 'Message has been sent';

            $_SESSION['messages']['success'][]='Mail envoyé';




    }

}
