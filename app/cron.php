<?php

require '/var/www/html/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

include('/var/www/html/data_init.php');
include('/var/www/html/checker.php');

//Executé par la CLI, donc une potentielle tâche CRON. (préférablement toutes les 24h)
$checks = array();
foreach ($services as $service) {
  if(!HealthCheck($service)){
    array_push($checks, $service);
  }
}
// On envoit ici le mail avec les données SMTP et on se sert du tableau checks pour l'affichage du mail.
if(!empty($checks)){
  // Configuration des paramètres SMTP
  $mail = new PHPMailer(true);
  $mail->IsSMTP();
  $mail->SMTPDebug = 2;
  $mail->Host = $smtp['smtp_host'];
  $mail->Port = intval($smtp['smtp_port']);
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Username = $smtp['smtp_username'];
  $mail->Password = $smtp['smtp_password'];
  $mail->SMTPOptions = array(                                 
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );

  $html_content = '<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Statut des Services</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
<h2 style="text-align: center; color: #333;">HealthChecker</h2>
<h3 style="text-align: center; color: #626262;">Some services are down !</h3>

<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
  <thead>
    <tr style="background-color: #343a40; color: #fff;">
      <th style="padding: 10px; border: 1px solid #dee2e6; text-align: left;">Service (Port)</th>
      <th style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">Disponibilité</th>
    </tr>
  </thead>
  <tbody>
';

foreach ($services as $service) {
  if(!HealthCheck($service)){
    $html_content .= '
      <tr style="background-color: #f8d7da;">
        <td style="padding: 10px; border: 1px solid #dee2e6;">'.$service['displayname'].' ('.$service['port'].')</td>
        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
          ❌
        </td>
      </tr>';
  }
  else {

    $html_content .= '
      <tr>
        <td style="padding: 10px; border: 1px solid #dee2e6;">'.$service['displayname'].' ('.$service['port'].')</td>
        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: center;">
          ✅
        </td>
      </tr>';
  }
}

$html_content .= '</tbody>
  </table>
</body>
</html>';
  
  // Envoi de l'email
  $mail->SetFrom($smtp['smtp_username'], 'HealthChecker');
  $mail->AddAddress($smtp['smtp_reciever'], 'Administrator');
  $mail->Subject = 'Rapport HealthChecker !';
  $mail->Body = $html_content;
  $mail->IsHTML(true);
  
  if($mail->Send()) {
      echo 'Email sent successfully!';
  } else {
      echo 'Email sending failed: ' . $mail->ErrorInfo;
  }
}
