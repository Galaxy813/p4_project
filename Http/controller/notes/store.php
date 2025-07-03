<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

// Verzamel gegevens
$gebruikerId = $_SESSION['user']['id'] ?? null;
$bericht = $_POST['Bericht'] ?? '';
$type = $_POST['type'] ?? '';
$datum = $_POST['date'] ?? null;

$errors = [];

// Validatie
if (!Validator::string($bericht, 1, 200)) {
    $errors['Bericht'] = 'Een bericht van maximaal 200 tekens is verplicht.';
}
if (!in_array($type, ['notificatie', 'klacht', 'review'])) {
    $errors['type'] = 'Selecteer een geldig type.';
}
if (!$datum || !Validator::date($datum)) {
    $errors['date'] = 'Vul een geldige datum in die niet in het verleden ligt.';
}

if (!empty($errors)) {
    return view("events/index.view.php", [
        'heading' => 'Home',
        'errors' => $errors
    ]);
}

try {
    // Bereken het volgende unieke Nummer
    $stmt = $db->query("SELECT MAX(Nummer) AS max FROM melding");
    $maxNummer = $stmt->find()['max'] ?? 0;
    $nieuwNummer = $maxNummer + 1;

    // Voeg de melding toe
    $db->query('INSERT INTO melding (Nummer, Bericht, GebruikerId, Type, Datumaangemaakt, Datumgewijzigd) 
    VALUES (:Nummer, :Bericht, :GebruikerId, :Type, :Datumaangemaakt, NOW())', [
        'Nummer' => $nieuwNummer,
        'Bericht' => $bericht,
        'GebruikerId' => $gebruikerId,
        'Type' => $type,
        'Datumaangemaakt' => $datum  // hier je eigen datumvariabele
    ]);

    $_SESSION['success'] = "Melding is succesfol gestuurd!";
    // Redirect
    header('Location: /');
    exit;

} catch (Exception $e) {
    error_log('Database fout: ' . $e->getMessage());

    return view("events/index.view.php", [
        'heading' => 'Home',
        'errors' => ['database' => 'Er is een fout opgetreden bij het opslaan van de melding. Probeer het later opnieuw.']
    ]);
}
