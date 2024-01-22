<?php

namespace App\Controllers;
use App\Models\M_Utilisateur;
use App\Models\M_Role;

class Login extends BaseController
{
    public function login(): string
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
        
        $content  = view('header');
        $content .= view('scr_Login');
        $content .= view('footer');

        // return view('scr_Accueil');
        return $content;
    }

    public function seConnecter()
    {
        // Si le formulaire est soumis
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username'); 
            $password = $this->request->getPost('password');
            $utilisateurModel = new M_Utilisateur();
            $user = $utilisateurModel->authenticate($username, $password);
            if ($user) {
                return redirect()->to('')->with('success', 'Connexion réussie !');
            } else {
                return redirect()->to('login')->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
            }
        }       
        $content  = view('header');
        $content .= view('scr_Login');
        $content .= view('footer');

        // return view('scr_Accueil');
        return $content;
    }

    public function processRegister()
    {
        
        // Récupérer les données du formulaire
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        $civilite = $this->request->getPost('civilite');
        $mail = $this->request->getPost('mail');

        // Vérification si le mot de passe correspond à la confirmation         
        if ($password != $confirmPassword) {
            return redirect()->to('login')->with('errorconnect', 'Les mots de passe ne correspondent pas.');
        }

        $roleId = $this->recupIdRole();        
        if ($roleId !== null)
        {          
            

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Enregistrement de l'utilisateur dans la base de données
       
            $utilisateurModel = new M_Utilisateur();
            $data = [
                'UTI_Nom' => $username,
                'UTI_Mdp_Hash' => $hashedPassword,
                'UTI_Civilite' => $civilite,
                'UTI_mail' => $mail,
                'UTI_Rol_Id' => $roleId,
                'UTI_Date_Creation' => date('Y-m-d H:i:s'), 
                'UTI_ETAT' => "A", // Par défaut lorsque l'utilisateur est créé il devient actif.
            ];
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
}
