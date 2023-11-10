<?php
require_once 'vendor/autoload.php';
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
  ->setUsername('havrearpenteurs@gmail.com')
  ->setPassword('lfxpgykbopwlzdqt');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Corps du message
$body = '<p>Bonjour '.$_POST['pseudo'].' et bienvenue sur Le Havre des Arpenteurs !</p><p><br></p><p>Afin de valider votre compte veuillez cliquer sur lien ci-dessous :</p><p><br></p><p><a href="http://havrearpenteurs/activation/'.urlencode($_POST['pseudo']).'/'.urlencode($cle).'">Lien d\'activation.</a></p><p><br></p><hr>Ceci est un mail automatique. Merci ne pas y répondre.<br><p><br></p><p><br></p>';

$message = (new Swift_Message('Bienvenue sur Le Havre des Arpenteurs !'))
  ->setFrom(['havrearpenteurs@gmail.com' => 'Le Havre des Arpenteurs'])
  ->setTo([$_POST['email']])
  ->setBody($body)
  ->setContentType('text/html');

// Send the message
// $mailer->send($message);
try {
    $mailer->send($message);
}
catch (\Swift_TransportException $e) {
    echo $e->getMessage();
    die();
}
?>
