    <?php

    use Core\App;
    use Core\Database;
    use Core\Validator;

    $id = (int) ($_POST['id'] ?? 0);
    $first = $_POST['first'];
    $middle = $_POST['middle'] ?? null;
    $last = $_POST['last'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Valideer formuliergegevens
    $errors = [];

    $db = App::resolve(Database::class);

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
        $errors['emailUnique'] = 'De gegevens bestaan al die je heb ingvuld.';
    }
}

    if (!Validator::string($password, 7, 80)) {
        $errors['password'] = 'Wachtwoord moet minimaal 7 tekens lang zijn.';
    }

    if (!empty($errors)) {
        return view('Regristration/create.view.php', [
            'errors' => $errors
        ]);
    }

    try {
        $db = App::resolve(Database::class);

        // Controleer of de gebruiker al bestaat
        $existingUser = $db->query('SELECT * FROM gebruiker WHERE Gebruikersnaam = :email', [
            'email' => $email
        ])->find();

        if ($existingUser) {
            header('Location: /register');
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

        // Redirect naar loginpagina
        header('Location: /login');
        exit();

    } catch (Exception $e) {
        // Log de fout en toon een algemene foutmelding
        error_log('Registratiefout: ' . $e->getMessage());

        return view('Regristration/create.view.php', [
            'errors' => [
                'general' => 'Er is een fout opgetreden tijdens de registratie. Probeer het later opnieuw.'
            ]
        ]);
    }
