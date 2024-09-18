<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/Exception.php";
require_once "PHPMailer/src/SMTP.php";

class Mailer {
    
    private ?PHPMailer $phpmailer = null;

    public function __construct()
    {
        $this->phpmailer = new PHPMailer(true);
        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = 'live.smtp.mailtrap.io';
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Port = 587;
        $this->phpmailer->Username = 'api';
        $this->phpmailer->Password = '837b0a61a809796b597f2135afb1200a';
    }

    public function testmail($to)
    {
        try
        {
            $this->phpmailer->setFrom('no-reply@8athala.com', 'LASTROGUE Online');
            $this->phpmailer->addAddress($to);

            $this->phpmailer->isHTML(true);
            $this->phpmailer->Subject = 'Here is the subject';
            $this->phpmailer->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->phpmailer->send();

            return true;
        }
        catch (Exception $e)
        {
            Common::WriteLog($this->phpmailer->ErrorInfo, __FUNCTION__);
            return false;
        }
    }
}
