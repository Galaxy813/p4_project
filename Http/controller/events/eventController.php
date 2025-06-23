<?php

use Core\App;
use Core\Database;

// Get the database instance
$db = App::resolve(Database::class);

// Fetch all events from the database
$events = $db->query("SELECT * FROM aurora.events")->get();

// Render the events index view
view("events/index.view.php", [
    "events" => $events,
    "heading" => "Evenementen overzicht"
]);