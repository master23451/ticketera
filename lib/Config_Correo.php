<?php

require "PHPMailer/src/SMTP.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Config_Correo extends PHPMailer
{
    public function __construct()
    {
        parent::__construct();
        $this->isSMTP();
        $this->Host=SMTP;
        $this->Port=SMTP_PORT;
        $this->SMTPSecure=SMTP_SECURE;
        $this->SMTPAuth=true;
        $this->Username=AUTH_USERNAME;
        $this->Password=AUTH_PASSWORD;
    }

    public function crear_correo($email_ticket, $asunto_ticket, $mensaje_ticket)
    {
        $this->setFrom(AUTH_USERNAME);
        $this->addAddress($email_ticket);
        $this->Subject = $asunto_ticket;
        $this->msgHTML($mensaje_ticket);

        if($this->send()){
            echo "mensaje enviado con exito";
        }
    }
}