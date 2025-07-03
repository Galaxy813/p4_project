<?php

use Core\App;
use Core\Database;

// Haal en valideer ID
$id = (int) ($_POST['id'] ?? 0);

dd($id);

if ($id === 0) {
    // Geen geldige ID, redirect of foutmelding
    header('Location: /medewerker/create');
    exit;
}

$db = App::resolve(Database::class);

