<?php

namespace App\Controllers;
use App\Models\M_Appartenir;
use App\Models\M_Categorie;
use App\Models\M_Exploiter;
use App\Models\M_Relation;
use App\Models\M_Ressource;
use CodeIgniter\I18n\Time;
use App\Controllers\Login;
$session = \Config\Services::session();

class Ressource extends BaseController
{
    public function afficherRessource($ressourceId): string
    {
        try {
            $ressourceModel = new M_Ressource();

            $ressource = $ressourceModel->find($ressourceId);
            $ressource->categorie = $this->recupCategorieRessource($ressource->RES_ID);
            $ressource->type = $this->recupTypeRessource($ressource->RES_ID);
            $ressource->relations = $this->recupRelationsRessource($ressource->RES_ID);

            $data = [
                'ressource' =>$ressource
            ];

            $content = view('scr_Ressource', $data);

            return $content;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de l\'affichage de la ressource.'; // Message d'erreur générique
        }
    }

    public function ajouterRessource()
    {
        if ($this->request->getPost()) {
            if (empty($this->request->getPost('ressource_titre')) || empty($this->request->getPost('ressource_contenu')) || empty($this->request->getPost('ressource_categorie')) || !is_null($this->request->getPost('ressource_relation')) &&  empty(array_filter($this->request->getPost('ressource_relation'))) || empty($this->request->getPost('ressource_type'))){
                session()->setFlashdata('error', 'Veuillez remplir tous les champs');
                $content = view('scr_AjouterRessource');
                return $content;
            }
            $idsRelation = $this->request->getPost('ressource_relations');
            // Récupérer les données du formulaire
            $ressourceData = [
                'RES_NOM' => $this->request->getPost('ressource_titre'),
                'RES_CONTENU' => $this->request->getPost('ressource_contenu'),
                'RES_VALIDE' => 'E',
                'RES_ETAT' => 'I',
                'RES_TYPE' => $this->request->getPost('ressource_type'),
                'RES_CAT_ID'=> $this->request->getPost('ressource_categorie'),
                'RES_DATE_CREATION' => Time::now(),
                'RES_DATE_MODIFICATION' => Time::now(),
                'RES_UTI_ID' => $_SESSION['user_id']
            ];
            if (self::verifScriptDansArray($ressourceData)) {
                session()->setFlashdata('error', 'Veuillez ne pas utiliser de balises script');
                $content = view("scr_AjouterRessource");
                return $content;
            }
            try {
                // Insérer les données dans la base de données
                $resourceModel = new M_Ressource();
                $resourceModel->insert($ressourceData);
            }
            catch (\Exception $e) {
                // Gérer l'exception, par exemple, afficher un message d'erreur
                session()->setFlashdata('error', 'Une erreur est survenue lors de l\'ajout de la ressource');
                log_message('error', $e->getMessage());
                return view('scr_AjouterRessource');
            }
            $ressourceId = $resourceModel->getInsertID();
            //gère l'enregistrement dans la table exploiter
            $exploiterModel = new M_Exploiter();
            $exploiterData = [
                'EXP_EXPLOITE' => 'N',
                'EXP_FAVORISE' => 'N',
                'EXP_RES_ID' => $ressourceId,
                'EXP_UTI_ID' => $_SESSION['user_id']
            ];
            $exploiterModel->insert($exploiterData);

            //gère l'enregistrement dans la table appartenir pour indiquer les différentes relations
            if (is_array($idsRelation) && count($idsRelation) > 1) {
                $relationModel = new M_Appartenir();
                foreach ($idsRelation as $idRelation) {
                    $relationData = [
                        'APP_ID_RES' => $ressourceId,
                        'APP_ID_REL' => $idRelation
                    ];
                    $relationModel->insert($relationData);
                }
            }elseif ($idsRelation !== null) {
                $relationModel = new M_Appartenir();
                $relationData = [
                    'APP_ID_RES' => $ressourceId,
                    'APP_ID_REL' => $idsRelation
                ];
                $relationModel->insert($relationData);
            }
        }
        else {
            $content = view("scr_AjouterRessource");
            return $content;
        }
        return redirect()->to(site_url('ressource/'.$ressourceId));
    }

    public function supprimerRessource()
    {
        try {
            if ($this->request->getPost()) {
                if (empty($this->request->getPost('ressource_id'))) {
                    session()->setFlashdata('error', 'Veuillez remplir tous les champs');
                    $content = view('scr_SupprimerRessource');
                    return $content;
                }
                $ressourceId = $this->request->getPost('ressource_id');
                $ressourceModel = new M_Ressource();
                $ressource = $ressourceModel->find($ressourceId);
                if ($ressource === null) {
                    session()->setFlashdata('error', 'La ressource n\'existe pas');
                    $content = view('scr_SupprimerRessource');
                    return $content;
                }
                $ressourceData = [
                    'RES_ETAT' => 'I',
                    'RES_DATE_MODIFICATION' => Time::now()
                ];
                $ressourceModel->update($ressourceId, $ressourceData);
            } else {
                $content = view("scr_SupprimerRessource");
                return $content;
            }
            return redirect()->to(site_url('/'));
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de la suppression de la ressource.'; // Message d'erreur générique
        }
    }

    public function modifierRessource()
    {
        try {
            if ($this->request->getPost('ressource_id') && $this->request->getPost('ressource_titre') == null) {
                if (empty($this->request->getPost('ressource_id'))) {
                    session()->setFlashdata('error', 'Veuillez remplir tous les champs');
                    $content = view('scr_ModifierRessource');
                    return $content;
                }
                $ressourceId = $this->request->getPost('ressource_id');
                $ressourceModel = new M_Ressource();
                $ressource = $ressourceModel->find($ressourceId);
                if ($ressource === null) {
                    session()->setFlashdata('error', 'La ressource n\'existe pas');
                    $content = view('scr_ModifierRessource');
                    return $content;
                }
                $data['ressource'] = $ressource;
                $content = view('scr_ModifierRessource', $data);
                return $content;
            }
            if ($this->request->getPost('ressource_titre')) {
                $ressourceData = [
                    'RES_NOM' => $this->request->getPost('ressource_titre'),
                    'RES_CONTENU' => $this->request->getPost('ressource_contenu'),
                    'RES_TYPE' => $this->request->getPost('ressource_type'),
                    'RES_CAT_ID' => $this->request->getPost('ressource_categorie'),
                    'RES_DATE_MODIFICATION' => Time::now(),
                    'RES_VALIDE' => 'E'
                ];
                if (self::verifScriptDansArray($ressourceData)) {
                    session()->setFlashdata('error', 'Veuillez ne pas utiliser de balises script');
                    $content = view("scr_ModifierRessource");
                    return $content;
                }
                $ressourceId = $this->request->getPost('ressource_id_cacher');
                $ressourceModel = new M_Ressource();
                $ressourceModel->update($ressourceId, $ressourceData);
                $idsRelation = $this->request->getPost('ressource_relations');
                if (is_array($idsRelation) && count($idsRelation) > 1) {
                    $relationModel = new M_Appartenir();
                    $relationModel->where('APP_ID_RES', $ressourceId)->delete();
                    foreach ($idsRelation as $idRelation) {
                        $relationData = [
                            'APP_ID_RES' => $ressourceId,
                            'APP_ID_REL' => $idRelation
                        ];
                        $relationModel->insert($relationData);
                    }
                } elseif ($idsRelation !== null) {
                    $relationModel = new M_Appartenir();
                    $relationModel->where('APP_ID_RES', $ressourceId)->delete();
                    $relationData = [
                        'APP_ID_RES' => $ressourceId,
                        'APP_ID_REL' => $idsRelation
                    ];
                    $relationModel->insert($relationData);
                }
                return redirect()->to(site_url('/'));
            }
            return view('scr_ModifierRessource');
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de la modification de la ressource.'; // Message d'erreur générique
        }
    }


    public function afficherRessources()
    {
        try {
            $ressourceModel = new M_Ressource();
            $ressources = $ressourceModel->where('RES_ETAT', 'A')->where('RES_VALIDE', 'O')->orderBy('RES_DATE_MODIFICATION', 'DESC')->findAll(25);
            foreach ($ressources as &$ressource) {
                $ressource->categorie = $this->recupCategorieRessource($ressource->RES_ID);
                $ressource->type = $this->recupTypeRessource($ressource->RES_ID);
                $ressource->relations = $this->recupRelationsRessource($ressource->RES_ID);
            }
            $data = [
                'groupeDeRessources' => $ressources
            ];
            $content = view('scr_Ressource', $data);
            return $content;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de l\'affichage des ressources.'; // Message d'erreur générique
        }
    }


    public function afficherRessourcesUtilisateur()
    {
        try {
            $ressourceModel = new M_Ressource();
            $ressources = $ressourceModel->where('RES_UTI_ID', $_SESSION['user_id'])->orderBy('RES_DATE_MODIFICATION', 'DESC')->findAll();
            foreach ($ressources as &$ressource) {
                $ressource->categorie = $this->recupCategorieRessource($ressource->RES_ID);
                $ressource->type = $this->recupTypeRessource($ressource->RES_ID);
                $ressource->relations = $this->recupRelationsRessource($ressource->RES_ID);
            }
            $data = [
                'vosRessources' => $ressources
            ];
            $content = view('scr_VosRessources', $data);
            return $content;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de l\'affichage de vos ressources.'; // Message d'erreur générique
        }
    }

    public function afficherRessourcesAVerifier(): array
    {
        try {
            $ressourceModel = new M_Ressource();

            $builder = $ressourceModel->builder();

            $query = $builder
                ->select()
                ->where('RES_VALIDE', 'E')
                ->orderBy('RES_DATE_MODIFICATION')
                ->get();

            $result = $query->getResult();
            return $result;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return []; // Retourner un tableau vide en cas d'erreur
        }
    }

    public function modifierEtatRessource(int $ressourceId, $action)
    {
        try {
            // Ajouter une vérification que ce soit bien un administrateur qui fait la requête

            if ($action == 'valider') {
                $resourceData = [
                    'RES_VALIDE' => 'O',
                    'RES_ETAT' => 'A',
                ];
            } else {
                $resourceData = [
                    'RES_VALIDE' => 'N',
                    'RES_ETAT' => 'A',
                ];
            }

            $resourceModel = new M_Ressource();
            $resourceModel->update($ressourceId, $resourceData);

            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'message' => 'Une erreur s\'est produite lors de la modification de l\'état de la ressource.']);
        }
    }

    public function validerRessource()
    {
        return view('scr_validerRessources');
    }

    public static function verifScriptDansArray($data): bool
    {
        foreach ($data as $key => $value) {
            if (str_contains($value, '<script>')) {
                // Si une balise <script> est trouvée dans une valeur, renvoyez une erreur
                return true;
            }
        }
        return false;
    }

    public static function recupCategorieRessource(int $ressourceId): string
    {
        $modelRessource = new M_Ressource();
        $ressource = $modelRessource->find($ressourceId);
        $categorie = $ressource->RES_CAT_ID;
        $categorieModel = new M_Categorie();
        $categorie = $categorieModel->find($categorie);
        return $categorie->CAT_NOM;
    }

    public static function recupTypeRessource(int $ressourceId): string
    {
        $modelRessource = new M_Ressource();
        $ressource = $modelRessource->find($ressourceId);
        return $ressource->RES_TYPE;
    }

    public static function recupRelationsRessource(int $ressourceId): array
    {
        $relations = [];
        $modelAppartenir = new M_Appartenir();
        $relationsArray = $modelAppartenir->where('APP_ID_RES', $ressourceId)->findAll();
        foreach ($relationsArray as $relation) {
            $relationModel = new M_Relation();
            $relation = $relationModel->find($relation->APP_ID_REL);
            $relations[] = $relation->REL_TYPE;
        }
        return $relations;
    }

    public function modifierFavoris(int $idRessource)
    {
        $modelExploiter = new M_Exploiter();
        $favorisExistant = $modelExploiter->where('EXP_RES_ID', $idRessource)->where('EXP_UTI_ID', $_SESSION['user_id'])->first();

        if ($favorisExistant) {
            if ($favorisExistant->EXP_FAVORISE == "O") {
                $modelExploiter->update($favorisExistant->EXP_ID, ['EXP_FAVORISE' => 'N']);
            } else {
                $modelExploiter->update($favorisExistant->EXP_ID, ['EXP_FAVORISE' => 'O']);
            }
        } else {
            $data = [
                'EXP_EXPLOITE' => 'N',
                'EXP_FAVORISE' => 'O',
                'EXP_RES_ID' => $idRessource,
                'EXP_UTI_ID' => $_SESSION['user_id']
            ];
            $modelExploiter->insert($data);
        }
    }
    public static function estEnFavoris(int $idRessource): bool
    {
        if(isset($_SESSION['user_id'])) {
            $idUtilisateur = $_SESSION['user_id'];
            $modelExploiter = new M_Exploiter();
            $favorisExistant = $modelExploiter->where('EXP_RES_ID', $idRessource)->where('EXP_UTI_ID', $idUtilisateur)->first();
            if ($favorisExistant && $favorisExistant->EXP_FAVORISE == "O") {
                return true;
            }
        }
        return false;
    }

    public function afficherRessourceAccueil(int $nombre = 1)
    {
        try {
            $ressourceModel = new M_Ressource();
            $ressourceModel->where('RES_ETAT', 'A')->where('RES_VALIDE', 'O');

            // Compter le nombre de résultats
            $idMax = $ressourceModel->countAllResults();
            $idMin = 1;

            //Si jamais on a moins de recettes dans la BDD que celles que l'on veut afficher
            if($idMax < $nombre){
                $nombre = $idMax;
            }

            $valeurs = [];
            while (count($valeurs) < $nombre) {
            $valeur = $ressourceModel->orderBy('RAND()')->where('RES_ETAT', 'A')->where('RES_VALIDE', 'O')->first()->RES_ID;
            if (!in_array($valeur, $valeurs)){
                $valeurs[] = $valeur;
            }
            }

            $ressourcesAAfficher = [];
            foreach( $valeurs as $valeur){
                $ressourcesAAfficher[] = $ressourceModel->select()->where('RES_ID', $valeur)->where('RES_ETAT', 'A')->where('RES_VALIDE', 'O')->first();
            }

            $htmlRessource = '';

            foreach ($ressourcesAAfficher as $ressource) {
                $texteRessource = esc($ressource->RES_NOM);

                //Modèle de la CARD affiché sur l'accueil
                $htmlRessource .= '<div class="card text-black mx-1 bg-light mb-3">
                                    <div class="card-body">
                                    <a class="ressources-link card-title h4" href="./ressource/'. esc($ressource->RES_ID). '">'. $texteRessource .'</a>
                                    <p class="card-text">' . esc(substr(strip_tags($ressource->RES_CONTENU), 0, 200)) .'...</p>
                                    </div>
                                    <div class="card-header e"><a class="custom-text-dark-blue" style="text-decoration: none" href="./ressource/'.esc($ressource->RES_ID).'">Voir plus</div>
                                    </div>';
            }

            echo($htmlRessource );
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            echo 'Une erreur s\'est produite lors de l\'affichage des ressources d\'accueil.';
        }
    }

    public function afficherFeedRessourcesFavorites()
    {
        try {
            if(isset($_SESSION['user_id'])) {
                $ressourceModel = new M_Ressource();
                $relationExploiter = new M_Exploiter();
                $ressourceFavorites = $relationExploiter->where('EXP_FAVORISE', 'O')->where('EXP_UTI_ID', $_SESSION['user_id'])->findAll();
    
                
                if(!$ressourceFavorites == []){
                    $favoriteResourceIds = [];
                    foreach ($ressourceFavorites as $relation) {
                        $favoriteResourceIds[] = $relation->EXP_RES_ID;
                    }
    
                    $ressources = $ressourceModel->whereIn('RES_ID', $favoriteResourceIds)->findAll();
                    foreach ($ressources as &$ressource) {
                        $ressource->categorie = $this->recupCategorieRessource($ressource->RES_ID);
                        $ressource->type = $this->recupTypeRessource($ressource->RES_ID);
                        $ressource->relations = $this->recupRelationsRessource($ressource->RES_ID);
                    }  
                }else{
                    $ressources = '';
                }
    
                $data = [
                    'ressourcesFavorites' => $ressources
                ];
                $content = view('scr_AfficherFavoris', $data);
                return $content;
            }else {
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false; // Retourner false en cas d'erreur
        }
    }
}