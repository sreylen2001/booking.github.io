<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function send_email($to, $subject, $sms, $cc_mail = "", $file_path = "")
{
    $mail = new PHPMailer(true);
    try {
        
        $mail->isSendmail();// tell to use smtp
        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPAuth = true;  // use smpt auth
        $mail->SMTPSecure = "tls"; // or ssl
        $mail->Host = 'sandbox.smtp.mailtrap.io'; // mail host (mail provider)
        $mail->Port = 2525;
        $mail->Username = 'bc97ec3abcb57d';
        $mail->Password = '418c8fd3b00491';
        $mail->setFrom("geekyshows@gmail.com", "iBooking");
        $mail->Subject = $subject;
        $mail->MsgHTML($sms);
        // check if have cc email
        if($cc_mail){
            $mail->AddCC($cc_mail);
        }         
        $mail->addAddress($to);
        if($file_path){
            $mail->AddAttachment(public_path($file_path)); 
        }
        $mail->send();

        // dd($mail);
        // $mail->Send();
        //dd($mail->send());

    }catch (Exception $e) {
        
    }

    return 1;
}
?>

