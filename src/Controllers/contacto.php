<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailUsuario = $_SESSION['email'] ?? '';
    $mensaje = $_POST['contacto'] ?? '';

    if (empty($emailUsuario) || empty($mensaje)) {
        echo "<div class='alert alert-danger'>Debe completar todos los campos.</div>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'losmuchachosdelinapifts@gmail.com'; // Tu Gmail
        $mail->Password   = 'yeiyijxtixrzcylq'; // Sin espacios
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente y destinatario
        $mail->setFrom('losmuchachosdelinapifts@gmail.com', 'Consulta Web');
        $mail->addAddress('losmuchachosdelinapifts@gmail.com', 'Contacto La Canchita de los Pibes');
        $mail->addReplyTo($emailUsuario, 'Consulta Web'); // Responder al correo del usuario
        //$mail->addBCC(''); // este campo se puede usar para agregar un correo adicional si es necesario
        // Configuración del contenido del correo
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = 'Nueva consulta desde el formulario de contacto';
        $mail->Body    = "<p><b>Usuario:</b> $emailUsuario</p>
                          <p><b>Consulta:</b><br>$mensaje</p>";

        $mail->send();
        echo "<div class='alert alert-success'>¡Consulta enviada correctamente!</div>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error al enviar la consulta: {$mail->ErrorInfo}</div>";
    }
} else {
    echo "<div class='alert alert-warning'>Acceso no permitido.</div>";
}
