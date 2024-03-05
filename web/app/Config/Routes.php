<?php

use App\Controllers\Ressource;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Accueil::index');

//Page de connexion et d'inscription
$routes->get('/connexion', 'Utilisateur::connexion');


//Page d'inscription
$routes->get('/inscription', 'Utilisateur::inscription');

// Inscription
$routes->get('/inscription/sinscrire', 'Utilisateur::sinscrire');
$routes->post('/inscription/sinscrire', 'Utilisateur::sinscrire');

// Connexion
$routes->get('/login/seConnecter', 'Utilisateur::seConnecter');
$routes->post('/login/seConnecter', 'Utilisateur::seConnecter');

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

$routes->post('/ajouterCommentaire', 'Commentaire::ajouterCommentaire');

$routes->post('/bloquerCommentaire/(:num)/(:num)', 'Utilisateur::bloquerCommentaire/$1/$2');

// Permet de se déconnecter
$routes->get('deconnexion', 'Accueil::deconnexion');

// Affichage page mot de passe oublié
$routes->get('/connexion/mdp_oublie', 'Utilisateur::mdpOublie');

// Nouveau mot de passe
$routes->get('/connexion/mdp_oublie/nouveau_mdp', 'Utilisateur::nouveauMdp');
$routes->post('/connexion/mdp_oublie/nouveau_mdp', 'Utilisateur::nouveauMdp');

// Connexion à l'API
$routes->get('/api', 'Api::index');
$routes->get('/api/(:alpha)/(:alpha)/(:alpha)', 'Api::index/$1/$2/$3');
$routes->get('/api/recuperer_ressources', 'Api::recupererRessources');