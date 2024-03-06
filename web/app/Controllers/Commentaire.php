<?php

namespace App\Controllers;
use App\Models\M_Appartenir;
use App\Models\M_Commentaire;
use App\Models\M_Exploiter;
use App\Models\M_Ressource;
use CodeIgniter\I18n\Time;

class Commentaire extends BaseController
{
    public function afficherCommentaire($commentaireId): string
    {
        $commentaireModel = new M_Commentaire();

        $commentaire = $commentaireModel->find($commentaireId);

        $data = [
            'commentaire' => $commentaire
        ];

        $content = view('Commentaire', $data);

        return $content;
    }
    public function afficherFeedCommentaires($idRessource): array
    {
        $commentaireModel = new M_Commentaire();
        $commentaireArray = $commentaireModel->where('COM_RES_ID', $idRessource)->where('COM_ID_COMMENTAIRE_REPONDU', null)->where('COM_VISIBILITE', "A")->findAll('25');
        return $commentaireArray;
    }

    public function afficherFeedSousCommentaires($idCommentaire)
    {
        $commentaireModel = new M_Commentaire();
        $commentaireArray = $commentaireModel->where('COM_ID_COMMENTAIRE_REPONDU', $idCommentaire)->where('COM_VISIBILITE', "A")->findAll('3');
        return $commentaireArray;
    }


    public function ajouterCommentaire()
    {
        if ($this->request->getPost() && !empty($this->request->getPost('commentaire_contenu'))) {
            if (empty($this->request->getPost('commentaire_contenu'))) {
                session()->setFlashdata('error', 'Veuillez remplir tous les champs');
            }
            $COM_CONTENU = $this->request->getPost('commentaire_contenu');
            $COM_UTI_ID = $this->request->getPost('commentaire_uti_id');
            $COM_RES_ID = $this->request->getPost('commentaire_res_id');
            $commentaireData = [
                'COM_CONTENU' => $COM_CONTENU,
                'COM_UTI_ID' => $COM_UTI_ID,
                'COM_RES_ID' => $COM_RES_ID,
                'COM_TSP_CRE' => Time::now(),
                'COM_VISIBILITE' => "A"
            ];
            $commentaireModel = new M_Commentaire();
            $commentaireModel->insert($commentaireData);
            return redirect()->to(site_url('/ressource/' . $COM_RES_ID));
        } elseif ($this->request->getPost() && !empty($this->request->getPost('commentaire_contenu_reponse'))) {
            if (empty($this->request->getPost('commentaire_contenu_reponse'))) {
                session()->setFlashdata('error', 'Veuillez remplir tous les champs');
            }
            if ($this->request->getPost('commentaire_id_commentaire_repondu_reponse') !== null) {
                $commentaireID = $this->request->getPost('commentaire_id_commentaire_repondu_reponse');
            } else {
                session()->setFlashdata('error', 'Veuillez sélectionner un commentaire à répondre');
                return redirect()->to(site_url('/ressource/' . $this->request->getPost('commentaire_res_id')));
            }
            $COM_CONTENU = $this->request->getPost('commentaire_contenu_reponse');
            $COM_UTI_ID = $this->request->getPost('commentaire_uti_id_reponse');
            $COM_RES_ID = $this->request->getPost('commentaire_res_id_reponse');
            $commentaireData = [
                'COM_RES_ID' => $COM_RES_ID,
                'COM_CONTENU' => $COM_CONTENU,
                'COM_ID_COMMENTAIRE_REPONDU' => $commentaireID,
                'COM_UTI_ID' => $COM_UTI_ID,
                'COM_TSP_CRE' => Time::now(),
                'COM_VISIBILITE' => "A"
            ];
            $commentaireModel = new M_Commentaire();
            $commentaireModel->insert($commentaireData);
            return redirect()->to(site_url('/ressource/' . $COM_RES_ID));
        }else {
            $content = view("scr_Ressource");
            return $content;
        }
    }

    public function supprimerCommentaire()
    {
        if ($this->request->getPost()) {

        } else {
            $content = view("scr_Ressource");
            return $content;
        }
        return redirect()->to(site_url('/'));
    }

    //public function modifierCommentaire(){}
}