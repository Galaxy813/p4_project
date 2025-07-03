<?php

use Core\App;
use Core\Database;

$id = (int) ($_POST['id'] ?? 0);

if (!$id) {
    header('Location: /');
    exit();
}

try {
    $db = App::resolve(Database::class);

    $db->query('
        DELETE FROM voorstelling
        WHERE Id = :id
    ', [
        'id' => $id
    ]);

    $_SESSION['success'] = "De voorstelling is succesvol verwijderd";
    header('Location: /');
    exit();

} catch (PDOException $e) {
    // Algemene foutmelding in de sessie (geen technische details)
    $_SESSION['error'] = "Er is een fout opgetreden bij het verwijderen van de voorstelling.";
    header('Location: /');
    exit();
}

// Redirect to homepage if no event was found or deletion failed
