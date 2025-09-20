<?php

// services
$jsonFile = '/app/services.json';
// Créer un tableau initial
$services = array();
if (!file_exists($jsonFile)) {
    // Convertir le tableau en JSON
    $jsonData = json_encode($services);
    // Écrire le JSON dans le fichier
    file_put_contents($jsonFile, $jsonData);
} else {
    // Lire le contenu du fichier JSON dans une chaîne
    $jsonString = file_get_contents($jsonFile);
    // Décoder la chaîne JSON en un tableau PHP
    $services = json_decode($jsonString, true);
}

//portals
$jsonFile = '/app/portals.json';
// Créer un tableau initial
$portals = array();
if (!file_exists($jsonFile)) {
    // Convertir le tableau en JSON
    $jsonData = json_encode($portals);
    // Écrire le JSON dans le fichier
    file_put_contents($jsonFile, $jsonData);
} else {
    // Lire le contenu du fichier JSON dans une chaîne
    $jsonString = file_get_contents($jsonFile);
    // Décoder la chaîne JSON en un tableau PHP
    $portals = json_decode($jsonString, true);
}

//smtp
$jsonFile = '/app/smtp.json';
// Créer un tableau initial
$smtp = array();
$smtp['smtp_username'] = '';
$smtp['smtp_password'] = '';
$smtp['smtp_host'] = '';
$smtp['smtp_port'] = '';
$smtp['smtp_reciever'] = '';
if (!file_exists($jsonFile)) {
    // Convertir le tableau en JSON
    $jsonData = json_encode($smtp);
    // Écrire le JSON dans le fichier
    file_put_contents($jsonFile, $jsonData);
} else {
    // Lire le contenu du fichier JSON dans une chaîne
    $jsonString = file_get_contents($jsonFile);
    // Décoder la chaîne JSON en un tableau PHP
    $smtp = json_decode($jsonString, true);
}

