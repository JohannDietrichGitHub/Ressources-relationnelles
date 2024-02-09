<?php

namespace App\Controllers;
use App\Models\M_Utilisateur;
use App\Models\M_Role;

class Utilisateur extends BaseController
{
    public $recupIdRoleCalled = false;
    // Affichage de la page de connexion
    public function connexion(): string
    {
        if ($this->request->getMethod() === 'post') {
            $nomUtilisateur = $this->request->getPost('nomUtilisateur'); 
            $mdp = $this->request->getPost('mdp');

            if ($this->isValidCredentials($nomUtilisateur, $mdp)) {
                return redirect()->to('Accueil'); 
            } else {
                $data['error'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
        }
        $content = view('scr_Login');

        return $content;
    }

    // Fonction de connexion
    // L'utilisateur valide sa connexion
    public function seConnecter()
    {
        // Test si le formulaire est soumis en entrée
        if ($this->request->getMethod() === 'post') {
            $nomUtilisateur = $this->request->getPost('mail'); 
            $mdp = $this->request->getPost('mdp');
            $utilisateurModel = new M_Utilisateur();

            $user = $utilisateurModel->authenticate($nomUtilisateur, $mdp);

            // Vérification si l'utilisateur existe, et s'il est bien Actif
            if ($user && $user->UTI_ETAT == 'A') {
                      
                $resteConnecte = $this->request->getPost('resteconnecte');
                if ($resteConnecte) {
                    helper('cookie');
                    $cookie_data = [
                        'name'   => 'remember_me_cookie',
                        'value'  => $user->UTI_ID,
                        'expire' => 86400 * 30, // Expiration du cookie (30 jours ici)
                        'secure' => FALSE, 
                    ];
                    set_cookie($cookie_data);
                }

                // On remplit le $session avec les données que l'on souhaite 
                $session = \Config\Services::session();
                $session->set('user_id', $user->UTI_ID);
                $session->set('id_role', $user->UTI_ID_ROL);

                return redirect()->to('')->with('success', 'Connexion réussie !');
            } 
            else {
                return redirect()->to('login')->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
            }
            
        }       
        $content = view('scr_Login');

        return $content;
    }

    public function inscription()
    {
        $content = view('scr_inscription');
        return $content;
    }

    public function sinscrire()
    {
        // Récupérer les données du formulaire
        $civilite = $this->request->getPost('civilite');
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $dateNaiss = $this->request->getPost('dateNaissance');
        $adresse = $this->request->getPost('adresse');
        $cp = $this->request->getPost('cp');
        $ville = $this->request->getPost('ville');
        $tel = $this->request->getPost('tel');
        $mail = $this->request->getPost('mail');
        $mdp = $this->request->getPost('mdp');
        $confirmmdp = $this->request->getPost('mdpConfirmer');

        $validation = \Config\Services::validation();

        // Définir les règles de validation pour chaque champ
        $rules = [
            'civilite' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'dateNaissance' => 'required',
            'adresse' => 'required',
            'cp' => 'required|numeric',
            'ville' => 'required',
            'tel' => 'required|numeric',
            'mail' => 'required|valid_email',
        ];
        
        $validation->setRules($rules);
        
     //   dd($validation); 

        // Vérifier si les règles de validation sont respectées
        if ($validation->withRequest($this->request)->run()) {
 
            $newCivilite = $this->convertir_civilite($civilite);

            // Vérification si le mot de passe correspond à la confirmation         
            if ($mdp != $confirmmdp || $mdp == null) {
                return redirect()->to('inscription')->with('error', 'Les mots de passe ne correspondent pas.');
            }

            // Récupération de l'ID du rôle utilisateur
            $roleId = $this->recupIdRole();     
        
            // Vérification si le compte déjà présent en base
            $verifCompte = $this->verifCompte($mail);
            
            if($verifCompte !== null){
                return redirect()->to('scr_Login')->with('error', 'Le compte est déjà associé à une adresse mail, veuillez réessayer.');
            }
            else{   
                if ($roleId !== null)
                {          
                    $hashedmdp = password_hash($mdp, PASSWORD_BCRYPT);

                    // Enregistrement de l'utilisateur dans la base de données
                    $utilisateurModel = new M_Utilisateur();
                    $data = [
                        'UTI_CIVILITE' => $newCivilite,
                        'UTI_NOM' => $nom,
                        'UTI_PRENOM' => $prenom,
                        'UTI_DATE_NAISSANCE' => $dateNaiss,
                        'UTI_ADRESSE' => $adresse,
                        'UTI_CP' => $cp,
                        'UTI_VILLE' => $ville,
                        'UTI_NUM_TEL' => $tel,
                        'UTI_MAIL' => $mail,
                        'UTI_MDP' => $hashedmdp,
                        'UTI_DATE_CREATION' => date('Y-m-d H:i:s'), 
                        'UTI_ETAT' => "A",
                        'UTI_ID_ROL' => $roleId
                    ];

                    $utilisateurModel->insert($data);

                    $user = $utilisateurModel->authenticate($mail, $mdp);
                    if ($user) {

                        // On remplit le $session avec l'identifiant de l'utilisateur
                        $session = \Config\Services::session();
                        $session->set('user_id', $user->UTI_ID);
                        
                        return redirect()->to('')->with('success', 'Connexion réussie !');
                    } 
                    else {
                        return redirect()->to('inscription')->with('error', 'Mail ou mot de passe incorrect.');
                    }
                }
                else 
                {                    
                    return redirect()->to('')->with('error', 'Erreur lors de la création de l\'utilisateur. Le rôle n\'existe pas.');
                }
            }
        } 
        else 
        {
       /* [TODO] A voir si possibilité de rajouter message personnalisé
          $validation->setError('civilite', 'Veuillez saisir votre civilité');
            $validation->setError('nom', 'Veuillez saisir votre nom');
            $validation->setError('prenom', 'Veuillez saisir votre prénom');
            $validation->setError('adresse', 'Veuillez saisir votre adresse');
            $validation->setError('ville', 'Veuillez saisir votre ville');
            $validation->setError('cp', 'Veuillez saisir votre code postal');
            $validation->setError('tel', 'Veuillez saisir votre numéro de téléphone');
            $validation->setError('mail', 'Veuillez saisir votre email');
            $validation->setError('dateNaiss', 'Veuillez saisir votre date de naissance');*/
                // Itérer sur les règles et vérifier si chaque champ est rempli

            // Le formulaire n'est pas valide, affichez les erreurs 
            return redirect()->to('inscription')->withInput()->with('validation', $validation);
        }
    }   

    // Fonction de récupération de l'ID du rôle à partir du nom du rôle 
    public function recupIdRole()
    {
        $roleModel = new M_Role();
        $role = $roleModel->where('ROL_NOM', 'Utilisateur classique')->first();

        if ($role)
        {
            return $role->ROL_ID;
        }
        else
        {
            return null;
        }
        // Mettez à jour la propriété pour indiquer que la méthode a été appelée
        $this->recupIdRoleCalled = true;
    }

    // Fonction de vérification du compte à partir du mail en entrée
    public function verifCompte($mail)
    {
        $utilisateurModel = new M_Utilisateur();
        $utilisateur = $utilisateurModel->where('UTI_MAIL', $mail)->first();

        if ($utilisateur)
        {
            return $utilisateur->UTI_ID;
        }
        else
        {
            return null;
        }
    }

    // Fonction permettant, à partir du libellé de civilité en entrée, de retourner la civilité de l'utilisateur
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

    private function verifScriptDansDonnees($utilisateurData) {
        foreach ($utilisateurData as $key => $value) {
            if (preg_match('/<script>/', $value)) {
                // Si une balise <script> est trouvée dans une valeur, renvoyez une erreur
                return true;
            }
        }
        return false;
    }

    // Affichage vue mot de passe oublié
    public function mdpOublie(): string
    {
        $content = view('scr_mdpOublie');

        return $content;
    }

    // Fonction de modification du mot de passe 
    public function nouveauMdp()
    {
        // Récupération des données en entrée
        $mail = $this->request->getPost('mail');
        $motDePasse = $this->request->getPost('mdp');
        // Recherche de l'ID utilisateur à partir du mail
        $utilisateurModel = new M_Utilisateur();
        $utilisateurAModifier = $utilisateurModel->where('UTI_MAIL =', $mail)->first();
        
        $utilisateurAModifierId = $utilisateurAModifier->UTI_ID;

        if($motDePasse){
            $motDePasseHache = password_hash($motDePasse, PASSWORD_BCRYPT); 
        }
        else{
            return redirect()->to('/connexion/mdp_oublie')->with('error', 'Mot de passe vide, veuillez réessayer');
        }
        
        if ($this->request->getPost()){
            $utilisateurData = [
                'UTI_MDP' => $motDePasseHache
            ];
            if ($this->verifScriptDansDonnees($utilisateurData)) {
                session()->setFlashdata('error', 'Veuillez ne pas utiliser de balises script');
                $content .= view('scr_mdpOublie', ['utilisateur' => $utilisateurAModifier]);
                return $content;
            }
            // Mise à jour de la ligne dans la base de données
            $utilisateurModel->update($utilisateurAModifierId, $utilisateurData);

            $user = $utilisateurModel->authenticate($utilisateurAModifier->UTI_NOM, $motDePasse);

            if ($user && $user->UTI_ETAT == 'A') {
                      
                $resteConnecte = $this->request->getPost('resteconnecte');
                if ($resteConnecte) {
                    helper('cookie');
                    $cookie_data = [
                        'name'   => 'remember_me_cookie',
                        'value'  => $user->UTI_ID,
                        'expire' => 86400 * 30, // Expiration du cookie (30 jours ici)
                        'secure' => FALSE, // Changez en TRUE si vous utilisez HTTPS
                    ];
                    set_cookie($cookie_data);
                }
                // On remplit le $session avec les données que l'on souhaite 
                $session = \Config\Services::session();
                $session->set('user_id', $user->UTI_ID);
                $session->set('id_role', $user->UTI_ROL_ID);

                return redirect()->to('')->with('success', 'Le mot de passe a été modifié.');
                
            } 
            else {
                return redirect()->to('connexion')->with('error', 'Compte introuvable, veuillez réessayer.');
            }
        }

        $content = view('scr_mdpOublie');

        return $content;
    }
}
