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

    public function crear_correo($email_solicitante, $email_tecnico, $id_ticket, $asunto_ticket, $detalle_ticket, $estatus_ticket)
    {
        $mensaje  = "<html lang='es'><body>";
        $mensaje .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
        $mensaje .= "<tr><td>";
        $mensaje .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $mensaje .= "<thead><tr><th colspan='4' style='background-color:#026034; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#ffffff; font-size:30px;' >Soporte tecnico UTJ</th></tr></thead>";
        $mensaje .= "<tbody>
       <tr>
       <td colspan='4' style='padding:15px;'>
       <center>
       <p style='font-size:19px;'><strong>ID del ticket: ".$id_ticket." </strong><br/> ".$asunto_ticket."</p>
       <p style='font-size:13px; color: #ec971f'><strong>Estatus:</strong> ".$estatus_ticket. "</p>
       </center>
       <p style='font-size:17px;'><strong>Detalle del problema: </strong><br/> ".$detalle_ticket."</p>
       <p style='font-size:15px;'><strong>Tecnico asigando: </strong> ".$email_tecnico."</p>
       <hr/>
       <center><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>¡Gracias por reportarnos su problema! Buscaremos una solución para su producto lo mas pronto posible.</p></center>
       </td>
       </tr></tbody>";
        $mensaje .= "</table>";
        $mensaje .= "</td></tr>";
        $mensaje .= "</table>";
        $mensaje .= "</body></html>";

        try {
            $this->setFrom(AUTH_USERNAME);
            $this->addAddress($email_solicitante);
            $this->addAddress($email_tecnico);
            $this->Subject = "ID ".$id_ticket." - ".$asunto_ticket;
            $this->Body = $mensaje;
            $this->isHTML();

            if(!$this->send()){
                throw new Exception($this->ErrorInfo);
            }

        }catch (Exception $e){
            echo 'Error al mandar el correo: '. $e->getMessage();
        }
    }

    public function responder_correo($email_solicitante, $id_ticket, $asunto_ticket, $detalle_ticket, $estatus_ticket, $ticket_solucion,  $correo_tecnico)
    {
        $estatus = "";
        $color = "";
        switch ($estatus_ticket){
            case 'Pendiente':
                $estatus = "Pendiente";
                $color = "#b49100";
                break;
            case 'En proceso':
                $estatus = "En proceso";
                $color = "#ffd304";
                break;
            case 'Resuelto':
                $estatus = "Resuelto";
                $color = "#026034";
                break;
        }

        $mensaje  = "<html lang='es'><body>";
        $mensaje .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
        $mensaje .= "<tr><td>";
        $mensaje .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $mensaje .= "<thead><tr><th colspan='4' style='background-color:#026034; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#ffffff; font-size:30px;' >Soporte tecnico UTJ</th></tr></thead>";
        $mensaje .= "<tbody>
       <tr>
       <td colspan='4' style='padding:15px;'>
       <center>
       <p style='font-size:19px;'><strong>ID del ticket: ".$id_ticket." </strong><br/> ".$asunto_ticket."</p>
       <p style='font-size:13px; color: $color'><strong>Estatus:</strong> ".$estatus. "</p>
       </center>
       <p style='font-size:17px;'><strong>Detalle del problema: </strong><br/> ".$detalle_ticket."</p>
       <p style='font-size:15px;'><strong>Solucion del pronlema: </strong><br/> ".$ticket_solucion."</p>
        <p style='font-size:15px;'><strong>Tecnico que soluciono el problema: </strong> ".$correo_tecnico."</p>
       <hr/>
       <center><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>¡Gracias por reportarnos su problema! Buscaremos una solución para su producto lo mas pronto posible.</p></center>
       </td>
       </tr></tbody>";
        $mensaje .= "</table>";
        $mensaje .= "</td></tr>";
        $mensaje .= "</table>";
        $mensaje .= "</body></html>";

        try {
            $this->setFrom(AUTH_USERNAME);
            $this->addAddress($email_solicitante);
            $this->addAddress($correo_tecnico);
            $this->Subject = "ID ".$id_ticket." - ".$asunto_ticket;
            $this->Body = $mensaje;
            $this->isHTML();

            if(!$this->send()){
                throw new Exception($this->ErrorInfo);
            }

        }catch (Exception $e){
            echo 'Error al mandar el correo: '. $e->getMessage();
        }
    }
}