<?php

date_default_timezone_set('America/Sao_Paulo');

// Configurações do destinatário
// $recipientEmail = 'reizinhomandou25@gmail.com';
// $recipientName = 'Julio Cesar';

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendEmail($recipientEmail, $recipientName, $token) {

    // Configurações do Servidor
    $emailServer = 'smtp.gmail.com';

    $emailPort = 465;

    $emailUser = 'tecnico22asenac@gmail.com';

    $emailUserName = 'Técnico 22A';

    $emailUserPassword = 'zvfarpeztyqgtrhe';

    $subject = 'Sistema Senac - Ative sua conta!';

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    $mail->CharSet = 'UTF-8';

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    //Set the hostname of the mail server
    $mail->Host = $emailServer;
    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = $emailPort;

    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $emailUser;

    //Password to use for SMTP authentication
    $mail->Password = $emailUserPassword;

    //Set who the message is to be sent from
    //Note that with gmail you can only use your account address (same as `Username`)
    //or predefined aliases that you have configured within your account.
    //Do not use user-submitted addresses in here
    $mail->setFrom($emailUser, $emailUserName);

    //Set an alternative reply-to address
    //This is a good place to put user-submitted addresses
    // $mail->addReplyTo('tecnico2022asenac@gmail.com', 'Técnico 22A');

    //Set who the message is to be sent to
    $mail->addAddress($recipientEmail, $recipientName);

    //Set the subject line
    $mail->Subject = $subject;

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

    //Replace the plain text body with one created manually
    // $mail->AltBody = 'This is a plain-text message body';

    $bodyEmail = <<<EMAIL

    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Senac_logo.svg/2560px-Senac_logo.svg.png" width="200px">

    <h3>Olá $recipientName, bem-vindo ao Sistema Senac</h3>

    <p>Ative o seu login acessando o link abaixo!</p>

    <br><a href="http://localhost/datatable/backend/activeUser.php?token=$token">Ativa Acesso</a><br>

    <small>Esse é um E-mail automático, não responda</small><br>

    <small>Em caso de dúvidas, entre em contato: contato@sistema.com</small>
EMAIL;

    $mail->Body = $bodyEmail;
    $mail->isHTML(true);

    //Attach an image file
    // $mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        // echo 'Mailer Error: ' . $mail->ErrorInfo;

        return false;
    } else {
        return true;
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }

}