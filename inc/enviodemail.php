<?php
    include_once('funciones.php');
    include('connect.php');

    // email de la BD
    $sql =  "SELECT email_contacto FROM sitio";
    $result = mysqli_query($enlace, $sql);
    $a_email = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $email_destino = $a_email['email_contacto'];

    //$email_destino = "maximiliano.zavala@davinci.edu.ar";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once("./PHPMailer-master/src/Exception.php");
    require_once("./PHPMailer-master/src/PHPMailer.php");
    require_once("./PHPMailer-master/src/SMTP.php");

    if (isset($_POST['mensaje'])) {

        $mail = new PHPMailer(true);


        $nombre_contacto = $_POST['nombre'];
        $email_contacto = $_POST['correo'];
        $tel_contacto = $_POST['telefono'];
        $dtodest = $_POST['departamento'];
        $mensaje = $_POST['mensaje'];


        try {
            $mail->setFrom("sneakerhousetp@hotmail.com", "Sneaker House");
            $mail->addAddress("$email_destino", "$dtodest");
            $mail->Subject = "Contacto a $dtodest";
            $mail->Body = "Nombre: $nombre_contacto \nEmail: $email_contacto \nTelefono: $tel_contacto \nMensaje: $mensaje";
            /* SMTP parámetros. */
            /* Solicitar a PHPMailer que use SMTP. */
            $mail->isSMTP();
            /* SMTP dirección del server. */
            $mail->Host = 'smtp.live.com';
            /* Usar autenticación SMTP. */
            $mail->SMTPAuth = TRUE;
            /* Elegir el sistema de encriptación. */
            $mail->SMTPSecure = 'tls';
            /* SMTP usuario de autenticación. */
            $mail->Username = 'sneakerhousetp@hotmail.com';
            /* SMTP clave de autenticación. */
            $mail->Password = 'produccionweb21';
            /* SMTP puerto. */
            $mail->Port = 587;
            /* Enviar el eMail. */
            if (!$mail->send()) {
                error_log("MAILER: No se pudo enviar el correo!");
            }
            MensajeEmergente("Tu mensaje fue enviado correctamente", "verde");
        } catch (Exception $e) {
            $msjerror = $e->errorMessage();
            MensajeEmergente($msjerror, 'rojo');
        }
    }
?>