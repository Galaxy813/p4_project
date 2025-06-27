<?php

$meldingId = $_POST['MeldingId'] ?? null;
$nummer = $_POST['Nummer'] ?? null;
$bericht = $_POST['Bericht'] ?? null;
$errors = [];

// Validatie
if (!$meldingId || !is_numeric($meldingId)) {
    $errors[$nummer]['Bericht'] = 'Geen geldige melding gekoppeld aan deze feedback.';
}

if (!Validator::string($bericht, 10, 200)) {
    $errors[$nummer]['Bericht'] = 'Een bericht van minimaal 10/maximaal 200 tekens is verplicht.';
}

if (!empty($errors)) {
    // ... (je bestaande query + return view)
}

// Nieuwe feedback-Nummer bepalen (optioneel aanpassen op basis van feedback-tabel zelf)
$stmt = $db->query("SELECT MAX(Nummer) AS max FROM melding");
$maxNummer = $stmt->find()['max'] ?? 0;
$nieuwNummer = $maxNummer + 1;

// Feedback invoegen
$db->query('INSERT INTO feedback (MeldingId, Nummer, Bericht, Isactief, Datumaangemaakt, Datumgewijzigd)
VALUES (:MeldingId, :Nummer, :Bericht, 1, NOW(), NOW())', [
    'MeldingId' => $meldingId,
    'Nummer' => $nieuwNummer,
    'Bericht' => $bericht
]);

$_SESSION['success'] = "Feedback is succesvol opgeslagen!";
header('Location: /notes');
exit;
