<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Page de connexion et d'inscription
$routes->get('/login', 'Login::login');

//Page d'inscription
$routes->get('/inscription', 'Inscription::inscription');

// Inscription
$routes->get('/inscription/processRegister', 'Inscription::processRegister');
$routes->post('/inscription/processRegister', 'Inscription::processRegister');

// Connexion
$routes->get('/login/seConnecter', 'Login::seConnecter');
$routes->post('/login/seConnecter', 'Login::seConnecter');

