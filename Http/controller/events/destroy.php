<?php

use Core\App;
use Core\Database;
use Core\Validator;

$id = (int) ($_POST['id']);

if (!$id) {
    // Redirect to homepage if no ID is provided
    header('Location: /');
    exit(); 
}

$db = App::resolve(Database::class);

$events = $db->query('
    DELETE FROM aurora.events
    WHERE Id = :id
', [
    'id' => $id
]);

// Check if the event was successfully deleted
if ($events) {
    // Redirect to homepage if deletion was successful
    header('Location: /');
    exit();
} else {
    // Handle the error, e.g., redirect back with an error message
    header('Location: /?error=Event not found or could not be deleted');
    exit();
}

// Redirect to homepage if no event was found or deletion failed
header('Location: /');

