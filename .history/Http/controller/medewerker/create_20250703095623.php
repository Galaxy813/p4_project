<?php

use Core\App;
use Core\Validator;
use Core\Database;

$first = $_POST['first'];
$middle = $_POST['middle'] ?? null;
$last = $_POST['last'];
$type = $_POST['type'] ?? '';

$db = App::resolve(Database::class);

// Valideer formuliergegevens
$errors = [];

if (!Validator::string($first, 2, 50)) {
    $errors['first'] = 'Voornaam moet minimaal 2 en maximaal 50 tekens lang zijn.';
}

if ($middle && !Validator::string($middle, 0, 50)) {
    $errors['middle'] = 'Tussenvoegsel moet maximaal 50 tekens lang zijn.';
}

if (!Validator::string($last, 2, 50)) {
    $errors['last'] = 'Achternaam moet minimaal 2 en maximaal 50 tekens lang zijn.';
}

if (!in_array($type, ['Beheerder', 'Ticketmanager', 'VootstelManager'])) {
    $errors['type'] = 'Ongeldige medewerkersoort geselecteerd.';
}

