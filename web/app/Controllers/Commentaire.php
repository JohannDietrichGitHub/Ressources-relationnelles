<?php

namespace App\Controllers;
use App\Models\M_Appartenir;
use App\Models\M_Commentaire;
use CodeIgniter\I18n\Time;

class Commentaire extends BaseController
{
    public function afficherCommentaire($commentaireId): string
    {
        $commentaireModel = new M_Commentaire();

        $commentaire = $commentaireModel->find($commentaireId);

        $data = [
            'commentaire' =>$commentaire
        ];

        $content = view('Commentaire', $data);

        return $content;
    }

    public function ajouterCommentaire()
    {
        if ($this->request->getPost()) {
            if (empty($this->request->getPost('commentaire_txt')))
                session()->setFlashdata('error', 'Veuillez remplir tous les champs');
                $content = view('scr_AjouterCommentaire');//Vue à créer
                return $content;
            }
            // Récupérer les données du formulaire
            $commentaireData = [
                'commentaire_txt' => $this->request->getPost('commentaire_txt'),
                'commentaire_visibilite' => $this->request->getPost('ressource_contenu'),
                'commentaire_ressource' => $this->request->getPost('commentaire_ressource'),
                'commentaire_date' => Time::now(),
                'commentaire_utilisateur' => 3 //a remplacer par le futur id de l'utilisateur
            ];
            if (self::verifScriptDansArray($commentaireData)) {
                session()->setFlashdata('error', 'Veuillez ne pas utiliser de balises script');
                $content = view("scr_AjouterCommentaire");//Vue à créer
                return $content;
            }
            try {
                // Insérer les données dans la base de données
                $commentaireModel = new M_Commentaire();
                $commentaireModel->insert($commentaireData);
            }
            catch (\Exception $e) {
                // Gérer l'exception, par exemple, afficher un message d'erreur
                session()->setFlashdata('error', 'Une erreur est survenue lors de l\'ajout de la ressource');
                log_message('error', $e->getMessage());
                return view('scr_AjouterCommentaire');
            }
            $commentaireId = $commentaireModel->getInsertID();
        }
        else {
            $content = view("scr_AjouterCommentaire");
            return $content;
        }
}

    public function supprimerCommentaire()
    {
        if ($this->request->getPost()) {
            if (empty($this->request->getPost('commentaire_Id'))){
                session()->setFlashdata('error', 'Veuillez remplir tous les champs');
            }
            $commentaireId = $this->request->getPost('commentaire_Id');
            $commentaireModel = new M_Commentaire();
            $commentaire = $commentaireModel->find($commentaireId);
            if ($commentaire === null) {
                session()->setFlashdata('error', 'Le commentaire n\'existe pas');
            }
            $commentaireData = [
                'commentaire_visibilite' => 'I',
            ];
            $ressourceModel->update($commentaireId, $commentaireData);
        }
        else {
            $content = view("scr_Ressource");
            return $content;
        }
        return redirect()->to(site_url('/'));
    }

    public function modifierRessource()
    {
        //A voir
    }