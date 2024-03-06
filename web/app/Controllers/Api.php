<?php

namespace App\Controllers;

use App\Models\M_Ressource;
use App\Models\M_Categorie;
use App\Models\M_Utilisateur;

class Api extends BaseController {

    public function index($parametre, $parametrePrimaire, $parametreSecondaire) {

        $this->logger->info('Un message d\'info');
        

        // Appeler la méthode correspondante en fonction du paramètre
        switch ($parametre) {
            case 'recupererRessources':
                return $this->recupererRessources();
            case 'inscription':
                return $this->inscription();
            case 'connexion':
                return $this->connexion($parametrePrimaire, $parametreSecondaire);
            default:
                // Si le paramètre n'est pas valide, renvoyer une réponse appropriée
                return 'Paramètre non valide';
        }
    }

    public function recupererRessources() {
        $ressourceModel = new M_Ressource();
        $ressources = $ressourceModel->where('RES_ETAT', 'A')->where('RES_VALIDE', 'O')->orderBy('RES_DATE_MODIFICATION', 'DESC')->findAll(25);
        
        $categorieModel = new M_Categorie();
        $categories = array();  // Tableau pour stocker les catégories
    
        foreach ($ressources as $ressource) {
            // Utilisez find au lieu de findAll pour obtenir une seule catégorie
            $categorie = $categorieModel->where('CAT_ID', $ressource->RES_CAT_ID)->find();
    
            // Ajoutez la catégorie au tableau des catégories
            if (!empty($categorie)) {
                $categories[] = $categorie[0];
            }
        }

        $data = [
            'ressources' => $ressources,
            'categories' => $categories
        ];

        // Vous pouvez également appeler une vue pour afficher les données, si nécessaire
        return $this->response->setJSON($data);
    }

    public function inscription() {
        // Logique pour gérer l'inscription
        return ['message' => 'Fonction d\'inscription appelée'];
    }

    public function connexion($email, $motdepasse) {
        $utilisateurModel = new M_Utilisateur();
        $user = $utilisateurModel->authenticate($email, $motdepasse);

        $data = [
            'utilisateur' => $user
        ];
        
        if($user)
        {
            return $this->response->setJSON($data);
        }
        else
        {
            return $this->response->setJSON(false);
        }
    }
}
