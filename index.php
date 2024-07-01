<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

// Counter
$counterFile = 'counter.txt';

if (!file_exists($counterFile)) {
    // Datei erstellen und den initialen Wert auf 0 setzen
    file_put_contents($counterFile, '0');
}

// Datei öffnen und den aktuellen Zählerwert lesen
$counter = (int)file_get_contents($counterFile);

// Zähler um 1 erhöhen
$counter++;

// Aktualisierten Zählerwert zurück in die Datei schreiben
file_put_contents($counterFile, (string)$counter);

echo $ip,"\n";
?>
