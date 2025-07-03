<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

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
        ) AS VolledigeNaam,
        CASE
            WHEN EXISTS (
                SELECT 1 FROM feedback WHERE feedback.MeldingId = melding.Id
            ) THEN 'Has Feedback'
            ELSE 'No Feedback'
        END AS FeedbackStatus
    FROM melding
    LEFT JOIN gebruiker ON melding.GebruikerId = gebruiker.Id
")->get();

view("notes/index.view.php", [
    'notes' => $notes
]);