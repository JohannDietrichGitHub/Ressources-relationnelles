<?php

namespace App\Controllers;
use App\Models\M_Utilisateur;
use App\Models\M_Role;

class Inscription extends BaseController
{
    public function inscription(): string
    {
        
        // Si le formulaire est soumis
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username'); // Assurez-vous que le nom du champ correspond à votre formulaire
            $password = $this->request->getPost('password');

            // Si les informations d'identification sont valides, redirigez l'utilisateur
            if ($this->isValidCredentials($username, $password)) {
                return redirect()->to('accueil'); // Remplacez 'accueil' par la page où vous souhaitez rediriger après la connexion
            } else {
                // Si les informations d'identification ne sont pas valides, vous pouvez afficher un message d'erreur
                $data['error'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
        }
        
       // [TODO] Remettre en place le header et footer lorsque ces parties seront faites.
        $content  = view('header');
        $content .= view('scr_inscription');
        $content .= view('footer');
        return $content;
    }

    public function processRegister()
    {
        // Récupérer les données du formulaire
        $civilite = $this->request->getPost('dropdownMenuButton1');
        $name = $this->request->getPost('nom');
        $firstname = $this->request->getPost('prenom');
        $birthdate = $this->request->getPost('dateNaissance');
        $address = $this->request->getPost('adresse');
        $cp = $this->request->getPost('cp');
        $city = $this->request->getPost('ville');
        $phonenumber = $this->request->getPost('tel');
        $mail = $this->request->getPost('email');
        $password = $this->request->getPost('mdp');
        $confirmPassword = $this->request->getPost('confirm_password');
    
        // Vérification si le mot de passe correspond à la confirmation         
        if ($password != $confirmPassword) {
            return redirect()->to('login')->with('errorconnect', 'Les mots de passe ne correspondent pas.');
        }
        

        // Récupération de l'identifiant du rôle 
        $roleId = $this->recupIdRole();     
        
        $newCivilite = $this->convertir_civilite($civilite);

        if ($roleId !== null)
        {          
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Enregistrement de l'utilisateur dans la base de données
            $utilisateurModel = new M_Utilisateur();
            $data = [
                'UTI_CIVILITE' => $newCivilite,
                'UTI_NOM' => $name,
                'UTI_PRENOM' => $firstname,
                'UTI_DATE_NAISSANCE' => $birthdate,
                'UTI_ADRESSE' => $address, 
                'UTI_CP' => $cp,
                'UTI_VILLE' => $city,
                'UTI_MDP' => $hashedPassword,
                'UTI_NUM_TEL' => $phonenumber,
                'UTI_MAIL' => $mail,
                'UTI_ID_ROL' => $roleId,
                'UTI_DATE_CREATION' => date('Y-m-d H:i:s'), 
                'UTI_ETAT' => "A", // Par défaut lorsque l'utilisateur est créé il devient actif.
             //  'UTI_ACT_ID' => '' // Cette zone sera remplie lorsque l'utilisateur participera à une activité.
            ];
        //    dd($data);
            $utilisateurModel->insert($data);
        
            return redirect()->to('')->with('success', 'Inscription réussie ! Connectez-vous maintenant.');
        }
        else 
        {      
        // Le rôle n'existe pas, afficher un message d'erreur ou prendre une autre action
            return redirect()->to('')->with('error', 'Erreur lors de la création de l\'utilisateur. Le rôle n\'existe pas.');
        }
    }   

    public function recupIdRole()
    {
        // Récupérer l'ID du rôle utilisateur
        $roleModel = new M_Role();
        $role = $roleModel->where('ROL_NOM', 'Utilisateur classique')->first();

      //  dd($role);
        if ($role)
        {
            return $role->ROL_ID;
        }
        else
        {
            return null;
        }
    }

    private function convertir_civilite($civilite) {
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
    }

    
}
