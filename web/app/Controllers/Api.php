<?php

namespace App\Controllers;

use App\Models\M_Ressource;
use App\Models\M_Categorie;
use App\Models\M_Utilisateur;
use App\Controlers\Utilisateur;

class Api extends BaseController {
    
    public function index($parametre, $parametrePrimaire, $parametreSecondaire)
    {
        try {
            $this->logger->info('Un message d\'info');
    
            // Appeler la méthode correspondante en fonction du paramètre
            switch ($parametre) {
                case 'recupererRessources':
                    return $this->recupererRessources();
                case 'connexion':
                    return $this->connexion($parametrePrimaire, $parametreSecondaire);
                case 'recupererInfoUtilisateur':
                    return $this->recupererInfoUtilisateur($parametrePrimaire);
                default:
                    // Si le paramètre n'est pas valide, renvoyer une réponse appropriée
                    return 'Paramètre non valide';
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de l\'exécution de l\'action.';
        }
    }
    
    public function recupererRessources()
    {
        try {
            $ressourceModel = new M_Ressource();
            $ressources = $ressourceModel->where('RES_ETAT', 'A')->where('RES_VALIDE', 'O')->orderBy('RES_DATE_MODIFICATION', 'DESC')->findAll(25);
    
            $categorieModel = new M_Categorie();
            $categories = [];  // Tableau pour stocker les catégories
    
            foreach ($ressources as $ressource) {
                // Utilisez find au lieu de findAll pour obtenir une seule catégorie
                $categorie = $categorieModel->find($ressource->RES_CAT_ID);
    
                // Ajoutez la catégorie au tableau des catégories
                if (!empty($categorie)) {
                    $categories[] = $categorie;
                }
            }
    
            $data = [
                'ressources' => $ressources,
                'categories' => $categories
            ];
    
            // Vous pouvez également appeler une vue pour afficher les données, si nécessaire
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de la récupération des ressources.';
        }
    }
    
    // Récupération des informations utilisateur à partir de son mail et mot de passe
    public function connexion($email, $motdepasse)
    {
        try {
            $utilisateurModel = new M_Utilisateur();
            $user = $utilisateurModel->authenticate($email, $motdepasse);
    
            $data = [
                'utilisateur' => $user
            ];
    
            if ($user) {
                return $this->response->setJSON($data);
            } else {
                return $this->response->setJSON(false);
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de la connexion.';
        }
    }
    
    // Récupération des informations de l'utilisateur à partir de son identifiant unique
    public function recupererInfoUtilisateur($idUtilisateur)
    {
        try {
            $utilisateurModel = new M_Utilisateur();
            $utilisateur = $utilisateurModel->find($idUtilisateur);
    
            $data = [
                'utilisateur' => $utilisateur
            ];
    
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de la récupération des informations utilisateur.';
        }
    }
    
    // Modification des données de l'utilisateur
    public function modifierUtilisateur($idUtilisateur, $nomUtilisateur, $prenomUtilisateur, $adresseUtilisateur, $cpUtiliasteur, $villeUtilisateur, $telUtilisateur)
    {
        try {
            $adresse_formatee = str_replace("-", " ", $adresseUtilisateur);
    
            $utilisateurModel = new M_Utilisateur();
            $utilisateurData = [
                'UTI_NOM' => $nomUtilisateur,
                'UTI_PRENOM' => $prenomUtilisateur,
                'UTI_ADRESSE' => $adresse_formatee,
                'UTI_CP' =>  $cpUtiliasteur,
                'UTI_VILLE' => $villeUtilisateur,
                'UTI_NUM_TEL' => $telUtilisateur
            ];
    
            // Mise à jour de la ligne dans la base de données
            $utilisateurModel->update($idUtilisateur, $utilisateurData);
    
            $data = [
                'utilisateur' => $utilisateurData
            ];
    
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de la modification de l\'utilisateur.';
        }
    }
    
    // Inscription d'un utilisateur dans la base de données
    public function inscription($civiliteUtilisateur, $nomUtilisateur, $prenomUtilisateur, $dateNaiss, $adresseUtilisateur, $cpUtiliasteur, $villeUtilisateur, $telUtilisateur, $mailUtilisateur, $motDePasse, $motDePasseConfirme)
    {
        try {
            $this->logger->info($dateNaiss);
    
            $adresse_formatee = str_replace("-", " ", $adresseUtilisateur);
    
            $newCivilite = $this->convertir_civilite($civiliteUtilisateur);
    
            // Convertir la date au format timestamp
            $timestamp = strtotime($dateNaiss);
    
            // Reformater la date en yyyy-mm-dd
            $dateConvertie = date('Y-m-d', $timestamp);
    
            if ($motDePasse == $motDePasseConfirme || $motDePasse != null) {
                $hashedmdp = password_hash($motDePasse, PASSWORD_BCRYPT);
                $utilisateurModel = new M_Utilisateur();
                $utilisateurData = [
                    'UTI_CIVILITE' => $newCivilite,
                    'UTI_NOM' => $nomUtilisateur,
                    'UTI_PRENOM' => $prenomUtilisateur,
                    'UTI_DATE_NAISSANCE' => $dateConvertie,
                    'UTI_ADRESSE' => $adresse_formatee,
                    'UTI_CP' => $cpUtiliasteur,
                    'UTI_VILLE' => $villeUtilisateur,
                    'UTI_NUM_TEL' => $telUtilisateur,
                    'UTI_MAIL' => $mailUtilisateur,
                    'UTI_MDP' => $hashedmdp,
                    'UTI_DATE_CREATION' => date('Y-m-d H:i:s'), 
                    'UTI_ETAT' => "A",
                    'UTI_ID_ROL' => 3
                ];
                $utilisateurModel->insert($utilisateurData);
    
                $data = [
                    'utilisateur' => $utilisateurData
                ];
    
                return $this->response->setJSON($data);
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de l\'inscription de l\'utilisateur.';
        }
    }
    
    // Fonction permettant, à partir du libellé de civilité en entrée, de retourner la civilité de l'utilisateur
    private function convertir_civilite($civilite)
    {
        try {
            switch ($civilite) {
                case 'Monsieur':
                    return 'M';
                case 'Madame':
                    return 'Mme';
                case 'Autre':
                    return 'Aut';
                default:
                    return '';
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return '';
        }
    }
}
