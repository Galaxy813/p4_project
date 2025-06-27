<?php

//alle main routes dat zit op de pagina!
$router->get('/', 'index.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');

$router->post('/note', 'notes/store.php');

$router->get('/note/create', 'notes/create.php');

$router->post('/note/feedback', 'notes/feedback.php')->only('auth');

$router->get('/register', 'Regristration/create.php')->only('guest');
$router->post('/register', 'Regristration/store.php');

$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/sessions', 'sessions/store.php')->only('guest');
$router->get('/logout', 'sessions/logout.php');

$router->get('/accounts/create', 'accounts/index.php')->only('auth');
$router->delete('/accounts/destroy', 'accounts/destroy.php');

$router->get('/edit', 'accounts/edit.php')->only('auth');
$router->patch('/update', 'accounts/update.php')->only('auth');
$router->get('/myAccount', 'accounts/myAccount.php')->only('auth');

$router->get('/medewerker/create', 'medewerker/index.php')->only('auth');
$router->get('/medewerker', 'medewerker/create.php');

