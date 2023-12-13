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
        try{
            $this->isSMTP();
            $this->Host=SMTP;
            $this->Port=SMTP_PORT;
            $this->SMTPSecure=SMTP_SECURE;
            $this->SMTPAuth=true;
            $this->Username=AUTH_USERNAME;
            $this->Password=AUTH_PASSWORD;
        }catch (Exception $e){
            echo 'Error al mandar el correo: '. $e->getMessage();
        }
    }

    public function crear_correo($email_ticket, $id_ticket, $asunto_ticket, $mensaje_ticket, $estatus_ticket, $cc_correo = null)
    {
        $message  = "<html><body>";
        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
        $message .= "<tr><td>";
        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $message .= "<thead><tr height='80'><th colspan='4' style='background-color:#026034; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#ffffff; font-size:34px;' >Soporte tecnico UTJ</th></tr></thead>";
        $message .= "<tbody>
       <tr>
       <td colspan='4' style='padding:15px;'>
       <p style='font-size:20px;'><strong>ID:  </strong>  ".$id_ticket." - ".$asunto_ticket."</p>
       <p style='font-size:18px;'><strong>Detalle: </strong> ".$mensaje_ticket."</p>
       <p style='font-size:14px; color: #ec971f'><strong>Estatus:</strong> ".$estatus_ticket. "</p>
       <hr/>
       <img src='/Logo-UTJ-Verde.png' alt='logo UTJ' style='height:auto; width:100%; max-width:100%;' />
       <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>¡Gracias por reportarnos su problema! Buscaremos una solución para su producto lo mas pronto posible.</p>
       </td>
       </tr></tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";;

        try {
            $this->setFrom(AUTH_USERNAME);
            $this->addAddress($email_ticket);
            $this->Subject = "ID ".$id_ticket." - ".$asunto_ticket;
            $this->Body = $message;
            $this->isHTML();

            if(!$this->send()){
                throw new Exception($this->ErrorInfo);
            }

        }catch (Exception $e){
            echo 'Error al mandar el correo: '. $e->getMessage();
        }
    }

    public function responder_correo($email_ticket, $id_ticket, $asunto_ticket, $mensaje_ticket, $estatus_ticket, $cc_correo = null)
    {
        $message  = "<html><body>";
        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
        $message .= "<tr><td>";
        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $message .= "<thead><tr height='80'><th colspan='4' style='background-color:#026034; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#ffffff; font-size:34px;' >Soporte tecnico UTJ</th></tr></thead>";
        $message .= "<tbody>
       <tr>
       <td colspan='4' style='padding:15px;'>
       <p style='font-size:20px;'><strong>ID:  </strong>  ".$id_ticket." - ".$asunto_ticket."</p>
       <p style='font-size:18px;'><strong>Detalle: </strong> ".$mensaje_ticket."</p>
       <p style='font-size:14px; color: #026034'><strong>Estatus:</strong> ".$estatus_ticket. "</p>
       <hr/>
       <img src='/Logo-UTJ-Verde.png' alt='logo UTJ' style='height:auto; width:100%; max-width:100%;' />
       <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>¡Gracias por reportarnos su problema! Buscaremos una solución para su producto lo mas pronto posible.</p>
       </td>
       </tr></tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";;

        try {
            $this->setFrom(AUTH_USERNAME);
            $this->addAddress($email_ticket);
            $this->Subject = "ID ".$id_ticket." - ".$asunto_ticket;
            $this->Body = $message;
            $this->isHTML();

            if(!$this->send()){
                throw new Exception($this->ErrorInfo);
            }

        }catch (Exception $e){
            echo 'Error al mandar el correo: '. $e->getMessage();
        }
    }
}