<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if (!$form->validate($email, $password)) {
    return view('sessions/create.php', [
        'errors' => $form->errors()
    ]);
}

try {
    // Zoek gebruiker op basis van email
    $user = $db->query('SELECT * FROM gebruiker WHERE Gebruikersnaam = :email', [
        'email' => $email
    ])->find();

    if ($user && password_verify($password, $user['Wachtwoord'])) {
        // Haal rol op
        $role = $db->query('SELECT Naam FROM rol WHERE GebruikerId = :id', [
            'id' => $user['Id']
        ])->find();

        $_SESSION['user'] = [
    'id' => $user['Id'],
    'Voornaam' => $user['Voornaam'],
    'Achternaam' => $user['Achternaam'],
    'role' => $role['Naam'] ?? 'Geen rol gevonden'
];

        header('Location: /');
        exit();
    }

    // Als gebruiker niet bestaat of wachtwoord niet klopt
    return view('sessions/create.view.php', [
        'errors' => [
            'email' => 'Email-adres of wachtwoord verkeerd'
        ]
    ]);

} catch (Exception $e) {
    // Foutafhandeling: log het of toon een generieke foutmelding
    error_log('Login fout: ' . $e->getMessage());

    return view('sessions/create.view.php', [
        'errors' => [
            'general' => 'Er is een fout opgetreden tijdens het inloggen. Probeer het later opnieuw.'
        ]
    ]);
}
