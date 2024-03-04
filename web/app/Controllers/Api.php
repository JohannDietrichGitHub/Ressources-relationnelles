<?php

namespace App\Controllers;

use App\Models\M_Ressource;

class Api extends BaseController {

    public function index($parametre) {
        // Appeler la méthode correspondante en fonction du paramètre
        switch ($parametre) {
            case 'recupererRessources':
                return $this->recupererRessources();
            case 'inscription':
                return $this->inscription();
            case 'connexion':
                return $this->connexion();
            default:
                // Si le paramètre n'est pas valide, renvoyer une réponse appropriée
                return 'Paramètre non valide';
        }
    }

    public function recupererRessources() {
        $ressourceModel = new M_Ressource();
        $ressources = $ressourceModel->where('RES_ETAT', 'A')->where('RES_VALIDE', 'O')->orderBy('RES_DATE_MODIFICATION', 'DESC')->findAll(25);
        $data = [
            'ressources' => $ressources
        ];
        // Vous pouvez également appeler une vue pour afficher les données, si nécessaire
        return $this->response->setJSON($data);
    }

    public function inscription() {
        // Logique pour gérer l'inscription
        return ['message' => 'Fonction d\'inscription appelée'];
    }

    public function authentification() {
        // Logique pour gérer l'authentification
        return ['message' => 'Fonction d\'authentification appelée'];
    }
}
