<?php

use Core\App;
use Core\Database;
use Core\Validator;

$first = $_POST['first'];
$middle = $_POST['middle'] ?? null;
$last = $_POST['last'];
$email = $_POST['email'];
$password = $_POST['password'];

//validate the form inputs
$errors = [];
    if (!Validator::email($email)) {
        $errors['email'] = 'Graag een geldig email adress';
    }   

    if (!Validator::string($password, 7, 80)) {
        $errors['password'] = 'Wachtwoord moet meer dan 7 characters zijn';
    }   


    if (!empty($errors)) {
        return view('Regristration/create.view.php', [
            'errors' => $errors
        ]);
    }

    $db = App::resolve(Database::class);
//check if the account already exists
$user = $db->query('SELECT * FROM gebruiker WHERE Gebruikersnaam = :email', [
    'email' => $email
])->find();
    //if yes, redirect to a login page.
    if ($user) {
        header('location: /');
        exit();
    }
    //if not, save one to the database, and then log the user in and redirect
    $db->query('INSERT INTO gebruiker(Voornaam, Tussenvoegsel, Achternaam, Gebruikersnaam, Wachtwoord) 
    VALUES(:first, :middle, :last, :email, :password)', [
        'first' => $first,
        'middle' => $middle,
        'last' => $last,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login($user);

    header('location: /');
    exit();

