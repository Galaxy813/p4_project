<?php

use Core\App;
use Core\Database;
use Core\Validator;

$naam = $_POST['naam'];
$beschrijving = $_POST['beschrijving'];
$datum = $_POST['datum'];
$tijd = $_POST['time'];


// // Valideer formuliergegevens
// $errors = [];


// if (!empty($errors)) {
//     return view('events/index.view.php', [
//         'errors' => $errors
//     ]);
// }

$db = App::resolve(Database::class);

$db->query('
    INSERT INTO events (
        Naam,
        Beschrijving,
        Datum,
        Tijd,
        Isactief,
        Datumaangemaakt,
        Datumgewijzigd
    ) VALUES (
        :naam,
        :beschrijving,
        :datum,
        :tijd,
        1,
        NOW(6),
        NOW(6)
    )
', [
    'naam' => $naam,
    'beschrijving' => $beschrijving,
    'datum' => $datum,
    'tijd' => $tijd
]);

// // Controleer of de gebruiker al bestaat

// // Redirect naar homepage
header('Location: /');
exit();