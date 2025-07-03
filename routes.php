<?php

//alle main routes dat zit op de pagina!
$router->get('/', 'events/eventController.php');
$router->get('/NieuweEvent', 'events/create.php');
$router->post('/addEvenement', 'events/add.php');
$router->delete('/destroyEvenement', 'events/destroy.php');



$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');

$router->get('/note/create', 'notes/create.php');

$router->get('/register', 'Regristration/create.php')->only('guest');
$router->post('/register', 'Regristration/store.php');

$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->get('/logout', 'sessions/logout.php');

$router->get('/accounts/create', 'accounts/index.php')->only('auth');
$router->get('/accounts', 'accounts/create.php');

$router->get('/medewerker/create', 'medewerker/index.php')->only('auth');
$router->get('/medewerker', 'medewerker/create.php');










// $router->get('/note', 'notes/show.php');
// $router->delete('/note', 'notes/destroy.php');

// $router->get('/note/edit', 'notes/edit.php');
// $router->patch('/note', 'notes/update.php');

// $router->post('/notes', 'notes/store.php');