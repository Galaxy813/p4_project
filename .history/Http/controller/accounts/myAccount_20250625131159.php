<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// Haal gebruiker-ID uit sessie
$gebruikerId = $_SESSION['user']['id'] ?? null;

if (!$gebruikerId) {
    // Eventueel redirect of foutmelding als niet ingelogd
    header('Location: /login');
    exit;
}

// Haal alle meldingen van deze gebruiker op
$mynotes = $db->query("
    SELECT 
        melding.Id AS MeldingId,
        melding.Bericht,
        melding.Type,
        CONCAT(
            COALESCE(gebruiker.Voornaam, 'Onbekend'), ' ',
            COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
            COALESCE(gebruiker.Achternaam, '')
        ) AS VolledigeNaam
    FROM melding
    LEFT JOIN gebruiker ON melding.GebruikerId = gebruiker.Id
    WHERE melding.GebruikerId = :id
    ORDER BY melding.Datumaangemaakt DESC
", [
    'id' => $gebruikerId
])->get();

// Haal alle feedback op die bij de meldingen van deze gebruiker horen
$FeedbackNotes = $db->query("
    SELECT 
        feedback.Id AS FeedbackId,
        feedback.MeldingId,
        feedback.Bericht AS FeedbackBericht,
        feedback.Datumaangemaakt AS FeedbackDatum,
        melding.Nummer AS MeldingNummer,
        melding.Type,
        melding.Opmerking AS MeldingOpmerking,
        CONCAT(
            COALESCE(gebruiker.Voornaam, 'Onbekend'), ' ',
            COALESCE(gebruiker.Tussenvoegsel, ''), ' ',
            COALESCE(gebruiker.Achternaam, '')
        ) AS VolledigeNaam
    FROM feedback
    LEFT JOIN melding ON feedback.MeldingId = melding.Id
    LEFT JOIN gebruiker ON melding.GebruikerId = gebruiker.Id
    WHERE melding.GebruikerId = :id
    ORDER BY feedback.Datumaangemaakt DESC
", [
    'id' => $gebruikerId
])->get();

// Groepeer feedback per melding zodat je die makkelijk in de view kunt gebruiken
$feedbackPerMelding = [];

foreach ($FeedbackNotes as $feedback) {
    $meldingId = $feedback['MeldingId'];
    if (!isset($feedbackPerMelding[$meldingId])) {
        $feedbackPerMelding[$meldingId] = [];
    }
    $feedbackPerMelding[$meldingId][] = $feedback;
}

// Stuur data naar de view
view("accounts/myAccount.php", [
    'heading' => 'My account',
    'mynotes' => $mynotes,
    'feedbackPerMelding' => $feedbackPerMelding,
]);
