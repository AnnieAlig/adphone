<?php 
//Input values from form:
$name = $_POST['name'];
$name = urldecode(htmlspecialchars($name));
$email = $_POST['email'];
$email = urldecode(htmlspecialchars($email));

//Sending email with user info to hello@adphone.biz (without mailgun, php only):
$email_text .= "<h3>Подписка на рассылку «Рациональный малый»</h3>
<p>Имя: {$name} </p>
<p>E-mail:{$email} </p>
---- <br/>
Сообщение с лендинга «Рациональный малый»";

$headers .= 'From: hello@adphone.biz' . "\r\n" ."Content-type: text/html\r\n";
mail('hello@adphone.biz', "Подписка на рассылку «Рациональный малый»", $email_text, $headers);

// Include the Autoloader (see https://github.com/mailgun/mailgun-php for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

// Instantiate the client.
$mgClient = Mailgun::create('aef080324dbe18170bb770cba108c5f5-47317c98-927077a6');
$domain = "m.adphone.biz";

// Make the call to the client.
$result = $mgClient->messages()->send($domain, array(
    'from'    => 'Adphone <hello@adphone.biz>',
    'to'      => $email,
    'subject' => 'Подписка на рассылку «Рациональный малый»',
    'text'    => "Еще раз здравствуйте, {$name}!\r\n
                Вы подписались на рассылку «Рациональный малый».\r\n
                Каждую неделю мы будем присылать вам советы о том, как сделать ваш бизнес эффективнее, используя недорогие или вообще бесплатные инструменты и методики.\r\n
                Узнавайте и используйте что-то новое каждый день, чтобы продавать и зарабатывать больше!\r\n
                ----\r\n
                Всегда вам рад,\r\n
                Рациональный Малый",
    'html'    => "<h3>Еще раз здравствуйте, {$name}!</h3>
                <p>Вы подписались на рассылку «Рациональный малый». </p>
                <p>Каждую неделю мы будем присылать вам советы о том, как сделать ваш бизнес эффективнее, используя недорогие или вообще бесплатные инструменты и методики.
                Узнавайте и используйте что-то новое каждый день, чтобы продавать и зарабатывать больше!</p>
                ---- <br/>
                Всегда вам рад,<br/>
                Рациональный Малый"
));

echo $result;
?>