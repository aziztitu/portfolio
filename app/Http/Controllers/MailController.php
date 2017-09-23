<?php

namespace App\Http\Controllers;

require_once __DIR__."/../../libs/php_mailer/class.phpmailer.php";
require_once __DIR__."/../../libs/php_mailer/class.smtp.php";

use Illuminate\Http\Request;
use PHPMailer;

class MailResponse
{
    public $success = 0;
    public $message = "";
}

class MailController extends Controller
{
    const self_email = "aziztitu1996@gmail.com";

    //
    public function sendMessage()
    {
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['subject']) || !isset($_POST['message'])) {
            $response = new MailResponse();
            $response->message = "Values missing";
            $response->success = 0;
            return json_encode($response);
        }

        $msg = "From: " . $_POST['name'] . " (" . $_POST['email'] . ")<br/><br/>" . $_POST['message'];

        return $this->sendMail($_POST['name'], MailController::self_email, $_POST['subject'], $msg);
    }

    private function sendMail($name, $to_email, $subject, $mailing_data)
    {
        $response = new MailResponse();

        $name = $this->validateText($name);
        $to_email = $this->validateEmail($to_email);
        $subject = $this->validateText($subject);
        $mailing_data = $this->validateText($mailing_data);

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        $body = $mailing_data;

        $mail->IsSMTP();

        $mail->Host = 'aziztitu.com';
        $mail->Username = 'mailer@aziztitu.com';
        $mail->Password = 'Mailer1431';
//$mail->Host = 'smtp.gmail.com';
//$mail->Username = 'seamlessaziz@gmail.com';
//$mail->Password = '';

        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->SetFrom($mail->Username, $name." through aziztitu.com");
        $mail->Subject = $subject;
        $mail->MsgHTML($body);

        $mail->AddAddress($to_email, "Azee");

//$mail->AddAddress('abc2@gmail.com', 'title2'); /* ... */

        $result = $mail->send();
        if ($result == true) {
            $response->success = 1;
            $response->message = "Mail Sent";
        }else {
            $response->success = 0;
            $response->message = "Error while sending mail";
        }

        return json_encode($response);
    }


    private function validateText($str)
    {
        $s = trim($str);
        $s = stripslashes($s);
        $s = htmlspecialchars($s);
        $s = filter_var($s, FILTER_SANITIZE_STRING);
        return $s;
    }

    private function validateEmail($str)
    {
        $str = $this->validateText($str);
        $str = filter_var($str, FILTER_SANITIZE_EMAIL);
        if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
            $resarray = array();
            $resarray["success"] = 0;
            $resarray["message"] = "Invalid Email";
            echo json_encode($resarray);
            die();
        }

        return $str;
    }

}
