<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

// Verzamel gegevens
$meldingId = $_POST['MeldingId'] ?? null;
$bericht = $_POST['Bericht'] ?? '';

$errors = [];

// Validatie
if (!Validator::string($bericht, 10, 200)) {
    $errors[$meldingId]['Bericht'] = 'Een bericht van minimaal 10 en maximaal 200 tekens is verplicht.';
}

if (!empty($errors)) {
    // Haal meldingen op voor herladen van de pagina
    $notes = $db->query("
        SELECT 
            melding.Id AS MeldingId,
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
    ")->get();

    return view("notes/index.view.php", [
        'errors' => $errors,
        'notes' => $notes
    ]);
}

try {
    // Zoek het hoogste Nummer in zowel 'melding' als 'feedback'
    $stmt = $db->query("
        SELECT MAX(max_nummer) AS max FROM (
            SELECT MAX(Nummer) AS max_nummer FROM melding
            UNION
            SELECT MAX(Nummer) FROM feedback
        ) AS gecombineerde_max
    ");
    $maxNummer = $stmt->find()['max'] ?? 0;
    $nieuwNummer = $maxNummer + 1;

    // Voeg de feedback toe
    $db->query('
        INSERT INTO feedback (MeldingId, Nummer, Bericht, Isactief, Datumaangemaakt, Datumgewijzigd)
        VALUES (:MeldingId, :Nummer, :Bericht, 1, NOW(), NOW())
    ', [
        'MeldingId' => $meldingId,
        'Nummer' => $nieuwNummer,
        'Bericht' => $bericht
    ]);

    $_SESSION['success'] = "Feedback is succesvol gestuurd!";
    header('Location: /notes');
    exit;

} catch (Exception $e) {
    error_log('Database fout: ' . $e->getMessage());

    return view("notes/index.view.php", [
        'heading' => 'Home',
        'errors' => ['database' => 'Er is een fout opgetreden bij het opslaan van de feedback. Probeer het later opnieuw.']
    ]);
}
