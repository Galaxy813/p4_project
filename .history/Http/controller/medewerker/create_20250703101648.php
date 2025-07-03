<?php

use Core\App;
use Core\Validator;
use Core\Database;

$first = $_POST['first'];
$middle = $_POST['middle'] ?? null;
$last = $_POST['last'];
$type = $_POST['type'] ?? '';



// Valideer formuliergegevens
$errors = [];

if (!Validator::string($first, 2, 50)) {
    $errors['first'] = 'Voornaam moet minimaal 2 en maximaal 50 tekens lang zijn.';
}


if (!Validator::string($last, 2, 50)) {
    $errors['last'] = 'Achternaam moet minimaal 2 en maximaal 50 tekens lang zijn.';
}

if (!empty($errors)) {
    return view('medewerker/create.view.php', [
        'errors' => $errors
    ]);
}

try {

    $db = App::resolve(Database::class);
    // Controleer of de gebruiker al bestaat
    $existingUser = $db->query('SELECT * FROM gebruiker WHERE Voornaam = :first AND Tussenvoegsel = :middle AND Achternaam = :last', [
        'first' => $first,
        'middle' => $middle,
        'last' => $last
    ])->find();

    if ($existingUser) {
        header('Location: /medewerker');
        exit();
    }
    // Bereken het volgende unieke Nummer
    $stmt = $db->query("SELECT MAX(Nummer) AS max FROM melding");
    $maxNummer = $stmt->find()['max'] ?? 0;
    $nieuwNummer = $maxNummer + 1;
    // Nieuwe gebruiker toevoegen
    $db->query('
        INSERT INTO gebruiker (Voornaam, Tussenvoegsel, Achternaam)
        VALUES (:first, :middle, :last)
    ', [
        'first' => $first,
        'middle' => $middle,
        'last' => $last
    ]);

    // Haal de laatste toegevoegde gebruiker op om de GebruikerId te krijgen
    $gebruikerId = $db->query('SELECT LAST_INSERT_ID() AS Id')->find()['Id'];

    // Voeg medewerker toe
    $db->query('
        INSERT INTO medewerker (GebruikerId, Medewerkersoort)
        VALUES (:gebruikerId, :type)
    ', [
        'gebruikerId' => $gebruikerId,
        'type' => $type
    ]);

    header('Location: /medewerker');
} catch (Exception $e) {
    error_log('Fout bij toevoegen medewerker: ' . $e->getMessage());
    
    return view('medewerker/create.view.php', [
        'errors' => ['general' => 'Er is een fout opgetreden bij het toevoegen van de medewerker.']
    ]);
}