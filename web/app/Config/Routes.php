<?php

use App\Controllers\Ressource;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Accueil::index');

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

//affiche une ressources précise avec tout les détails
$routes->get('/ressource/(:num)', 'Ressource::afficherRessource/$1');
//page permettant l'ajout de ressources
$routes->get('/ressource/ajout', 'Ressource::ajouterRessource');
$routes->post('/ressource/ajout', 'Ressource::ajouterRessource');
//page permettant la supression de ressources
$routes->get('/ressource/suppression', 'Ressource::supprimerRessource');
$routes->post('/ressource/suppression', 'Ressource::supprimerRessource');
//page permettant la modification de ressources
$routes->get('/ressource/modification', 'Ressource::modifierRessource');
$routes->post('/ressource/modification', 'Ressource::modifierRessource');


