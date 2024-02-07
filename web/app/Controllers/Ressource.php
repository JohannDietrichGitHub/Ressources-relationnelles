<?php

namespace App\Controllers;
use App\Models\M_Appartenir;
use App\Models\M_Ressource;
use CodeIgniter\I18n\Time;

class Ressource extends BaseController
{
    public function afficherRessource($ressourceId): string
    {
        $ressourceModel = new M_Ressource();

        $ressource = $ressourceModel->find($ressourceId);

        $data = [
            'ressource' =>$ressource
        ];

        $content = view('scr_Ressource', $data);

        return $content;
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
                'RES_EXPLOITE' => 'O',
                'RES_ETAT' => 'I',
                'RES_TYPE' => $this->request->getPost('ressource_type'),
                'RES_CAT_ID'=> $this->request->getPost('ressource_categorie'),
                'RES_DATE_CREATION' => Time::now(),
                'RES_DATE_MODIFICATION' => Time::now(),
                'RES_UTI_ID' => 3 //a remplacer par le futur id de l'utilisateur
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
            //gère l'enregistrement dans la table appartenir pour indiquer les différentes relations
            $ressourceId = $resourceModel->getInsertID();
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
        if ($this->request->getPost()) {
            if (empty($this->request->getPost('ressource_id'))){
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
        }
        else {
            $content = view("scr_SupprimerRessource");
            return $content;
        }
        return redirect()->to(site_url('/'));
    }

    public function modifierRessource()
    {
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
                'RES_DATE_MODIFICATION' => Time::now()
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
    }

    public function afficherFeedRessources($arrayRessourcesId)
    {

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

}