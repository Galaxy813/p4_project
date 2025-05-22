<?php

use Core\App;
use Core\Database;
use Core\Validator;

$first = $_POST['first'];
$middle = $_POST['middle'] ?? null;
$last = $_POST['last'];
$email = $_POST['email'];
$password = $_POST['password'];

// Valideer formuliergegevens
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Graag een geldig e-mailadres.';
}

if (!Validator::string($password, 7, 80)) {
    $errors['password'] = 'Wachtwoord moet minimaal 7 tekens lang zijn.';
}

if (!empty($errors)) {
    return view('Regristration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

// Controleer of de gebruiker al bestaat
$existingUser = $db->query('SELECT * FROM gebruiker WHERE Gebruikersnaam = :email', [
    'email' => $email
])->find();

if ($existingUser) {
    header('Location: /');
    exit();
}

// Nieuwe gebruiker toevoegen
$db->query('
    INSERT INTO gebruiker (
        Voornaam,
        Tussenvoegsel,
        Achternaam,
        Gebruikersnaam,
        Wachtwoord,
        IsIngelogd,
        Ingelogd,
        Uitgelogd,
        Isactief,
        Datumaangemaakt,
        Datumgewijzigd
    ) VALUES (
        :first,
        :middle,
        :last,
        :email,
        :password,
        0,
        NULL,
        NULL,
        1,
        NOW(6),
        NOW(6)
    )
', [
    'first' => $first,
    'middle' => $middle,
    'last' => $last,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);

// Haal de gebruiker opnieuw op om in te loggen
$user = $db->query('SELECT * FROM gebruiker WHERE Gebruikersnaam = :email', [
    'email' => $email
])->find();

// Log de gebruiker in (zorg dat de login-functie correct werkt)
login($user);

// Redirect naar homepage
header('Location: /');
exit();
