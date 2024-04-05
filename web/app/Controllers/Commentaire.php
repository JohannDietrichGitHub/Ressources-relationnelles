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
        try {
            $commentaireModel = new M_Commentaire();
    
            // Récupérer le commentaire par son ID
            $commentaire = $commentaireModel->find($commentaireId);
    
            // Vérifier si le commentaire existe
            if ($commentaire === null) {
                throw new Exception('Le commentaire demandé n\'existe pas.');
            }
    
            // Si le commentaire existe, préparer les données à passer à la vue
            $data = [
                'commentaire' => $commentaire
            ];
    
            // Charger la vue du commentaire avec les données
            $content = view('Commentaire', $data);
    
            // Retourner le contenu de la vue
            return $content;
        } catch (Exception $e) {
            // En cas d'erreur, journaliser l'erreur et retourner un message d'erreur générique
            log_message('error', $e->getMessage());
            return 'Une erreur s\'est produite lors de l\'affichage du commentaire.';
        }
    }
    public function afficherFeedCommentaires($idRessource): array
    {
        try {
            $commentaireModel = new M_Commentaire();
            $commentaireArray = $commentaireModel->where('COM_RES_ID', $idRessource)->where('COM_ID_COMMENTAIRE_REPONDU', null)->where('COM_VISIBILITE', "A")->findAll('25');
            return $commentaireArray;
        } catch (\Exception $e) {
            // En cas d'erreur, journaliser l'erreur et retourner une tableau vide
            log_message('error', $e->getMessage());
            return [];
        }
    }

    public function afficherFeedSousCommentaires($idCommentaire)
    {
        try {
            $commentaireModel = new M_Commentaire();
            $commentaireArray = $commentaireModel->where('COM_ID_COMMENTAIRE_REPONDU', $idCommentaire)->where('COM_VISIBILITE', "A")->findAll('3');
            return $commentaireArray;
        } catch (\Exception $e) {
            // En cas d'erreur, journaliser l'erreur et retourner une tableau vide
            log_message('error', $e->getMessage());
            return [];
        }
    }


    public function ajouterCommentaire()
    {
        try {
            if ($this->request->getPost() && !empty($this->request->getPost('commentaire_contenu')) && empty($this->request->getPost('commentaire_contenu_reponse'))) {
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
        } catch (\Exception $e) {
            // En cas d'erreur, journaliser l'erreur et rediriger avec un message d'erreur
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Une erreur s\'est produite lors de l\'ajout du commentaire.');
            return redirect()->to(site_url('/'));
        }
    }

    public function supprimerCommentaire()
    {
        try {
            if ($this->request->getPost()) {
                if ($this->request->getPost()) {

                } else {
                    $content = view("scr_Ressource");
                    return $content;
                }
                return redirect()->to(site_url('/'));
            }
            return redirect()->to(site_url('/'));
        } catch (\Exception $e) {
            // En cas d'erreur, journaliser l'erreur et rediriger avec un message d'erreur
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Une erreur s\'est produite lors de la suppression du commentaire.');
            return redirect()->to(site_url('/'));
        }
    }

    public function modifierCommentaire()
    {
        try {
        $commentaireId = $this->request->getPost('commentaire_id');
        $nouveauContenu = $this->request->getPost('nouveau_contenu');

        // Vérifier si les données requises sont présentes
        if (empty($commentaireId) || empty($nouveauContenu)) {
            throw new \Exception('Les données requises sont manquantes.');
        }

        // Charger le modèle du commentaire
        $commentaireModel = new M_Commentaire();

        // Récupérer le commentaire à modifier
        $commentaire = $commentaireModel->find($commentaireId);

        // Vérifier si le commentaire existe
        if (!$commentaire) {
            throw new \Exception('Le commentaire spécifié n\'existe pas.');
        }

        // Mettre à jour le contenu du commentaire
        $commentaire->commentaire_txt = $nouveauContenu;
        $commentaire->commentaire_date_modif = date('Y-m-d H:i:s');

        // Enregistrer les modifications
        $commentaireModel->save($commentaire);

        // Redirection avec un message de succès
        session()->setFlashdata('success', 'Le commentaire a été modifié avec succès.');
        return redirect()->to(site_url('/'));
        } catch (\Exception $e) {
        // En cas d'erreur, journaliser l'erreur et rediriger avec un message d'erreur
        log_message('error', $e->getMessage());
        session()->setFlashdata('error', 'Une erreur s\'est produite lors de la modification du commentaire.');
        return redirect()->to(site_url('/'));
        }
    }

}