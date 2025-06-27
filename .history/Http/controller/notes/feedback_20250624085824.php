<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

// Verzamel gegevens
$nummer = $_POST['Nummer'] ?? null;
$gebruikerId = $_POST['GebruikerId'] ?? '';
$FeedbackType = $_POST['FeedbackType'] ?? '';
$bericht = $_POST['Bericht'];

$errors = [];

// Validatie
if (!Validator::string($bericht, 10, 200)) {
    $errors[$nummer]['Bericht'] = 'Een bericht van minimaal 10 tekens/maximaal 200 tekens is verplicht.';
}

if (!empty($errors)) {
    $notes = $db->query("
        SELECT 
            melding.Nummer,
            melding.Bericht,
            melding.GebruikerId,
            melding.Type,
            CONCAT(
                COALESCE(gebruiker.Voornaam, 'Onbekend'), ' ',
                COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
                COALESCE(gebruiker.Achternaam, '')
            ) AS VolledigeNaam
        FROM melding
        LEFT JOIN gebruiker ON melding.GebruikerId = gebruiker.Id
        WHERE Type != 'Feedback'
    ")->get();

    return view("notes/index.view.php", [
        'errors' => $errors,
        'notes' => $notes
    ]);
}

try {
    // Bereken het volgende unieke Nummer
    $stmt = $db->query("SELECT MAX(Nummer) AS max FROM melding");
    $maxNummer = $stmt->find()['max'] ?? 0;
    $nieuwNummer = $maxNummer + 1;

    // Voeg de melding toe
    $db->query('INSERT INTO melding (Nummer, Bericht, GebruikerId, Type, Datumaangemaakt, Datumgewijzigd) 
VALUES (:Nummer, :Bericht, :GebruikerId, :Type, NOW(), NOW())', [
        'Nummer' => $nieuwNummer,
        'Bericht' => $bericht,
        'GebruikerId' => $gebruikerId,
        'Type' => $FeedbackType
    ]);
    // Redirect
    $_SESSION['success'] = "feedback is succesfol gestuurd!";

    header('Location: /notes');
    exit;
} catch (Exception $e) {
    error_log('Database fout: ' . $e->getMessage());

    return view("notes/index.view.php", [
        'heading' => 'Home',
        'errors' => ['database' => 'Er is een fout opgetreden bij het opslaan van de melding. Probeer het later opnieuw.']
    ]);
}
