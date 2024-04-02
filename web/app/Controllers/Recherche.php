<?php

namespace App\Controllers;

use App\Models\M_Ressource;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use App\Controllers\Exception;
use App\Controllers\Ressource;

$session = \Config\Services::session();

class Recherche extends Controller
{

    public function index()
    {



        //Gestion de la requête pour récupérer la zone nom du lien
        $request = \Config\Services::request();
        $request = service('request');
        $nomRecherche = $request->getVar('nom');

        //Recherche SQL dans la BDD
        $resultatsID = $this->rechercherSQL($nomRecherche);

        //initialisation du tableau
        $resultats = [];

        foreach ($resultatsID as $id) {
            $ressourceModel = new M_Ressource();

            // Recherchez la recette par ID
            $ressource = $ressourceModel->find($id->res_id);


            $ressource->categorie = Ressource::recupCategorieRessource($ressource->RES_ID);
            $ressource->type = Ressource::recupTypeRessource($ressource->RES_ID);
            $ressource->relations = Ressource::recupRelationsRessource($ressource->RES_ID);

            $resultats[] = $ressource;


        }


        $data = [
            'resultats' => $resultats
        ];

        $content = view('scr_Recherche', $data);
        
        return $content;
    }



    private function rechercherSQL($_nomRecherche)
    {

        $_nomRecherche = strval($_nomRecherche);
        $ressourceModel = new M_Ressource();
        $resultats = $ressourceModel->select('res_id')
            ->where('res_nom LIKE', '%' . $_nomRecherche . '%')
            ->where('RES_ETAT', 'A')
            ->where('RES_VALIDE', 'O')
            ->findAll();

        return $resultats;
    }
}
