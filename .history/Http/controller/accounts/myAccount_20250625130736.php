<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$gebruikerId = $_SESSION['user']['id'] ?? null;

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
", [
    'id' => $gebruikerId
])->get();

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
    WHERE melding.GebruikerId = :Id
", [
    'id' => $gebruikerId
])->get();

view("accounts/myAccount.php", [
    'heading' => 'My account',
    'mynotes' => $mynotes,
    'FeedbackNotes' => $FeedbackNotes
]);