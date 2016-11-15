<?php

include_once '../../../../../wp-load.php';
$error = 0;
$destinatario = get_field('destinatario', 14); // ID página Contacto
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_STRING);
$mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING);

if (empty($destinatario) || empty($nombre) || empty($correo) || empty($mensaje)) {
    $error++;
}
$asunto = 'Nuevo contacto desde {%= name %}';
if ($error > 0) {
    echo '{"exito":"noexito", "mensaje":"Campos incompletos"}';
    die();
}

try {
    require 'PHPMailerAutoload.php';
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'email-smtp.us-east-1.amazonaws.com';
    $mail->SMTPAuth = true;
    $mail->Username = '';
    $mail->Password = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25;
    $mail->CharSet = 'UTF-8';
    $mail->From = '';
    $mail->FromName = $nombre;
    $mail->addReplyTo($correo, $nombre);
    $mail->addAddress($destinatario);
    $mail->isHTML(true);
    $mail->Subject = 'Nuevo contacto desde {%= name %}';

    $body = file_get_contents(getcwd() . '/contacto.html', dirname(__FILE__));
    $placeholders = array('[destinatario]', '[nombre]', '[correo]', '[institucion]', '[asunto]', '[mensaje]', '[titulo]');
    $values = array($destinatario, $nombre, $correo, $institucion, $asunto, $mensaje, $titulo);
    $mail->msgHTML(str_replace($placeholders, $values, $body));
    $mail->AltBody = 'Para ver este mensaje, por favor use su correo electrónico en modo HTML';
    $mail->send();
    echo json_encode(array('exito' => "exito"));
} catch (phpmailerException $e) {
    echo json_encode(array('exito' => "noexito", 'message' => 'phpmailerException: ' . $e->errorMessage()));
} catch (Exception $e) {
    echo json_encode(array('exito' => "noexito", 'message' => 'Exception: ' . $e->getMessage()));
}