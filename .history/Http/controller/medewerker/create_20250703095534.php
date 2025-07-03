<?php

use Core\App;
use Core\Validator;
use Core\Database;

$first = $_POST['first'];
$middle = $_POST['middle'] ?? null;
$last = $_POST['last'];
$type = $_POST['type'] ?? '';

$db = App::resolve(Database::class);

