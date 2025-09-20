<?php

function HealthCheck($service) {
    $addr = $service['addr'];
    $port = $service['port'];
    try {
      if($port == 80 || $port == 443){

        if($port == 80){
          $addr = 'http://'.$addr;
        }else{
          $addr = 'https://'.$addr;
        }
        // Initialisation cURL
        $ch = curl_init($addr);
        // Paramètres cURL pour requête HEAD
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $codeHttp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // Vérifie si le code est entre 200 et 399
        return (($codeHttp >= 200 && $codeHttp < 400) || $codeHttp == 401);
      }else{

        $socket = @fsockopen($addr, $port, $errno, $errstr, 1);
        return ($socket !== false);
      }
    } catch (\Throwable $th) {
      return false;
    }
    return false; // Service non reconnu
}
