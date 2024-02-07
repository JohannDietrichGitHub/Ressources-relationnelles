<?php

use App\Controllers\Ressource;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Accueil::index');

//Page de connexion et d'inscription
$routes->get('/connexion', 'Login::login');

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
//affiche un feed de ressources
$routes->get('/ressources', 'Ressource::afficherRessources');
//page permettant l'ajout de ressources
$routes->get('/ressource/ajout', 'Ressource::ajouterRessource');
$routes->post('/ressource/ajout', 'Ressource::ajouterRessource');
//page permettant la supression de ressources
$routes->get('/ressource/suppression', 'Ressource::supprimerRessource');
$routes->post('/ressource/suppression', 'Ressource::supprimerRessource');
//page permettant la modification de ressources
$routes->get('/ressource/modification', 'Ressource::modifierRessource');
$routes->post('/ressource/modification', 'Ressource::modifierRessource');
//page permettant la validation des ressources
$routes->get('/ressource/validation', 'Ressource::validerRessource');
//route permettant la validation ou la non validation d'une ressource
$routes->post('/ressource/update-ressource-status/(:num)/(:alpha)', 'Ressource::modifierEtatRessource/$1/$2');
$routes->get('/ressource/update-ressource-status/(:num)/(:alpha)', 'Ressource::modifierEtatRessource/$1/$2');