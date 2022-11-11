<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtpmail.jakarta.go.id';    //10.15.39.87'; //              
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'noreply-sims@jakarta.go.id';                     
        $mail->Password   = 'Sims@Dki2022!';                              
        $mail->SMTPSecure = ''; //'tls'; //PHPMailer::ENCRYPTION_STARTTLS; //'tls'; //PHPMailer::ENCRYPTION_SMTPS; //            
        $mail->Port       = 587;
        $mail->smtpConnect([
            'ssl'       =>  [
                'verify_peer'   =>  false,
                'verify_peer_name'  =>  false,
                'allow_self_signed' =>  false
            ]
        ]);
        $mail->smtpClose();                                
    
        //Recipients
        $mail->setFrom('noreply-sims@jakarta.go.id', 'Testing');
        $mail->addAddress('yonocahyono85@gmail.com', 'Yono Cahyono');     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else{
   
    echo "Please use method POST";
    
}