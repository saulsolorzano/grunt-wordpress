<?php
/**
 * Reactor
 *
 * @package     RisingPhoenex
 * @author      {%= author_name %} <{%= author_email %}>
 * @version     1.0.0
 */
class Correo {

    private $username = '';
    private $password = '';
    private $from = '';

    public function __construct($username, $password, $from) {
        $this->username = $username;
        $this->password = $password;
        $this->from = $from;


        /*
         * Envio de correos mediante ajax - Formulario de contacto
         *  */

        add_action('wp_ajax_nopriv_contacto', array($this, 'contacto_ajax'));
        add_action('wp_ajax_contacto', array($this, 'contacto_ajax'));
        /*
         * Envio de correos mediante ajax - Formulario de contacto
         *  */

        add_action('wp_ajax_nopriv_contacto', array($this, 'contacto_ajax_trabajo'));
        add_action('wp_ajax_contacto', array($this, 'contacto_ajax_trabajo'));
    }

    public function mailer($nombre, $correo, $destinatario, $subject, $body) {
        try {
            require 'mail/PHPMailerAutoload.php';
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'email-smtp.us-east-1.amazonaws.com';
            $mail->SMTPAuth = true;
            $mail->Username = $this->username;
            $mail->Password = $this->password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 25;
            $mail->CharSet = 'UTF-8';
            $mail->From = $this->from;
            $mail->FromName = $nombre;
            $mail->addReplyTo($correo, $nombre);
            $mail->addAddress($destinatario);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->msgHTML($body);
            $mail->AltBody = 'Para ver este mensaje, por favor use su correo electrónico en modo HTML';
            $mail->send();
            echo json_encode(array('exito' => "exito"));
            die();
        } catch (phpmailerException $e) {
            echo json_encode(array('exito' => "noexito", 'message' => 'phpmailerException: ' . $e->errorMessage()));
            die();
        } catch (Exception $e) {
            echo json_encode(array('exito' => "noexito", 'message' => 'Exception: ' . $e->getMessage()));
            die();
        }
    }


}
