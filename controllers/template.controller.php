<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

class ControllerTemplate
{

    public function ctrShowTemplate()
    {
        include 'views/template.php';
    }

    /*=============================================
    Ruta Principal o Dominio del sitio
    =============================================*/
    static public function url()
    {
        return "localhost";
    }

    /*=============================================
Función para enviar correos electrónicos
=============================================*/
    // static public function sendEmail($name, $subject, $email, $message, $url)
    // {

    //     date_default_timezone_set("America/Argentina/Buenos_Aires");

    //     $mail = new PHPMailer;

    //     $mail->CharSet = 'UTF-8';
    //     $mail->isMail();
    //     $mail->setFrom("info@controlstock.com.ar", "Sistema de Ventas");
    //     $mail->Subject = "Hola " . $name . " - " . $subject;
    //     $mail->addAddress($email);
    //     $mail->msgHTML('
    //                 <div style="background-color:#5fee00; font-size: 18px; ">
    //                 Hola, ' . $name . ':
    //                 <p>' . $message . '</p>
    //                 <a href="' . $url . '">Click aquí para ingresar</a><br><br>
    //                 Si no esperabas este mensaje, puedes eliminarlo.
    //             </div>
    //                 ');

    //     $send = $mail->Send();
    //     if (!$send) {
    //         return $mail->ErrorInfo;
    //     } else {
    //         return "ok";
    //     }
    // }
}
