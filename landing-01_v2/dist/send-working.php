<?php
//Input values from form:
$name = $_POST['name'];
$name = urldecode(htmlspecialchars($name));
$email = $_POST['email'];
$email = urldecode(htmlspecialchars($email));

//Composer's autoload file loads all necessary files
require 'vendor/autoload.php';

$mail = new PHPMailer;

$mail->isSMTP();  // Set mailer to use SMTP
$mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'postmaster@m.adphone.biz'; // SMTP username from https://mailgun.com/cp/domains
$mail->Password = 'diHIjUfSAzeLY'; // SMTP password from https://mailgun.com/cp/domains
$mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'

$mail->From = 'hello@adphone.biz'; // The FROM field, the address sending the email
$mail->FromName = 'Adphone'; // The NAME field which will be displayed on arrival by the email client
$mail->addAddress($email);     // Recipient's email address and optionally a name to identify him
$mail->isHTML(true);   // Set email to be sent as HTML, if you are planning on sending plain text email just set it to false

// The following is self explanatory
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Подписка на рассылку «Рациональный малый»';
$mail->Body    = "<h3>Еще раз здравствуйте, {$name}!</h3>
                <p>Вы подписались на рассылку «Рациональный малый». </p>
                <p>Каждую неделю мы будем присылать вам советы о том, как сделать ваш бизнес эффективнее, используя недорогие или вообще бесплатные инструменты и методики.</p>
                <p>Узнавайте и используйте что-то новое каждый день, чтобы продавать и зарабатывать больше!</p>
                ---- <br/>
                Всегда вам рад,<br/>
                Рациональный Малый";
$mail->AltBody = "Еще раз здравствуйте, {$name}!\r\n
                Вы подписались на рассылку «Рациональный малый».\r\n
                Каждую неделю мы будем присылать вам советы о том, как сделать ваш бизнес эффективнее, используя недорогие или вообще бесплатные инструменты и методики.\r\n
                Узнавайте и используйте что-то новое каждый день, чтобы продавать и зарабатывать больше!\r\n
                ----\r\n
                Всегда вам рад,\r\n
                Рациональный Малый";

if(!$mail->send()) {
    echo "Message hasn't been sent.";
    echo 'Mailer Error: ' . $mail->ErrorInfo . "n";
} else {
    echo "Message has been sent :)";

}

//sending email to hello@adphone.biz
$mail->ClearAddresses();
$mail->addAddress("hello@adphone.biz");
$mail->Body = "<h3>Подписка на рассылку «Рациональный малый»</h3>
            <p>Имя: {$name} </p>
            <p>E-mail: {$email} </p>
            ---- <br/>
            Сообщение с лендинга «Рациональный малый»";


$mail->Send();
?>