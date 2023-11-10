<?php
require_once 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
  ->setUsername('havrearpenteurs@gmail.com')
  ->setPassword('ccskiuwtneofrrgy');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Corps du message
$body = '<p>Bonjour '.$_POST['login'].' !</p><p><br></p><p>Vous avez demandé une réinitialisation de votre mot de passe.</p><p>Afin de définir un nouveau mot de passe veuillez cliquer sur lien ci-dessous :</p><p><br></p><p><a href="http://havrearpenteurs/reinitialisation/'.urlencode($_POST['login']).'/'.urlencode($cle).'">Lien d\'activation</a></p><p><br></p><hr>Ceci est un mail automatique. Merci ne pas y répondre.<br><p><br></p><p><br></p>';

$message = (new Swift_Message('Récupération mot de passe - Le Havre des Arpenteurs !'))
  ->setFrom(['havrearpenteurs@gmail.com' => 'Le Havre des Arpenteurs'])
  ->setTo([$_POST['email']])
  ->setBody($body)
  ->setContentType('text/html');

// Send the message
$mailer->send($message);
?>
