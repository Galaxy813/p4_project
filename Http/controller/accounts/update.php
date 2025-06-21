<?php

use Core\App;
use Core\Database;
use Core\Validator;

try {
    $id = (int) ($_POST['id'] ?? 0);
    $first = trim($_POST['first'] ?? '');
    $middle = trim($_POST['middle'] ?? null);
    $last = trim($_POST['last'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($id === 0) {
        header('Location: /accounts/create');
        exit;
    }

    $db = App::resolve(Database::class);

    // Haal de bestaande gebruiker op
    $account = $db->query('SELECT * FROM gebruiker WHERE Id = :id', [
        'id' => $id
    ])->findOrFail();

    // Validatie
    $errors = [];

    if ($first === '') {
        $errors['first'] = 'Voornaam is verplicht.';
    }

    if ($last === '') {
        $errors['last'] = 'Achternaam is verplicht.';
    }

    if (!Validator::email($email)) {
        $errors['email'] = 'Graag een geldig e-mailadres.';
    } else {
        // Controleer of e-mail al bestaat bij een andere gebruiker
        $count = $db->query(
            'SELECT COUNT(*) as total FROM gebruiker WHERE Gebruikersnaam = :email AND Id != :id',
            [
                'email' => $email,
                'id' => $id
            ]
        )->find()['total'];

        if ($count > 0) {
            $errors['email'] = 'De e-mail is al in gebruik en kan niet veranderd worden.';
        }
    }

    if (!empty($errors)) {
        return view('accounts/edit.view.php', [
            'errors' => $errors,
            'account' => $account
        ]);
    }

    // Update de gebruiker
    $db->query('
        UPDATE gebruiker
        SET Voornaam = :first,
            Tussenvoegsel = :middle,
            Achternaam = :last,
            Gebruikersnaam = :email
        WHERE Id = :id
    ', [
        'id' => $id,
        'first' => $first,
        'middle' => $middle,
        'last' => $last,
        'email' => $email
    ]);

    header('Location: /accounts/create');
    exit;

} catch (Exception $e) {
    // Foutafhandeling
    error_log('Fout bij het bijwerken van een account: ' . $e->getMessage());

    // Toon een algemene foutpagina of geef een nette foutmelding terug
    return view('errors/general.php', [
        'message' => 'Er is iets misgegaan bij het verwerken van je aanvraag. Probeer het later opnieuw.'
    ]);
}
