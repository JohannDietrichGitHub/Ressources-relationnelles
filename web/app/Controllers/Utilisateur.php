<?php

namespace App\Controllers;
use App\Models\M_Utilisateur;
use App\Models\M_Role;
use App\Models\M_Commentaire;
use Config\Encryption;

$session = \Config\Services::session();

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
                        'name'   => 'cookie_id',
                        'value'  => $user->UTI_ID,
                        'expire' => '3600',
                        'path'   => '/',
                        'secure' => TRUE, 
                        'httponly' => TRUE, 
                        'encrypt' => TRUE 
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
                return redirect()->to('')->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
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
            'mdp' => 'required'
        ];
        
        $validation->setRules($rules);

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

    // Affichage vue mot de passe oublié
    public function administrerUtilisateur(): string
    {
        $content = view('scr_AdministrerUtilisateur');

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
        
        if(empty($utilisateurAModifier)){
            return redirect()->to('/connexion/mdp_oublie')->with('error', 'Utilisateur inconnu, veuillez réessayer');
        }

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
                $content = view('scr_mdpOublie', ['utilisateur' => $utilisateurAModifier]);
                return $content;
            }

            // Mise à jour de la ligne dans la base de données

            $utilisateurModel->update($utilisateurAModifierId, $utilisateurData);
            
            $user = $utilisateurModel->authenticate($utilisateurAModifier->UTI_MAIL, $motDePasse);
            
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
                $session->set('id_role', $user->UTI_ID_ROL);

                return redirect()->to('')->with('success', 'Le mot de passe a été modifié.');
                
            } 
            else {
                return redirect()->to('connexion')->with('error', 'Compte introuvable, veuillez réessayer.');
            }
        }

        $content = view('scr_mdpOublie');

        return $content;
    }

    public static function recupNomUtilisateurParID($id): string
    {
        $utilisateurModel = new M_Utilisateur();
        $utilisateur = $utilisateurModel->where('UTI_ID', $id)->first();
        if ($utilisateur)
        {
            return $utilisateur->UTI_PRENOM ." ". $utilisateur->UTI_NOM;
        }
        else
        {
            return 'steve';
        }
    }

    public static function recupRoleParID($id): string
    {
        $utilisateurModel = new M_Utilisateur();
        $utilisateur = $utilisateurModel->where('UTI_ID', $id)->first();
        if ($utilisateur)
        {
            $roleModel = new M_Role();
            $role = $roleModel->where('ROL_ID', $utilisateur->UTI_ID_ROL)->first();
            if ($role)
            {
                return $role->ROL_NOM;
            }
        }
        return "Utilisateur classique";
    }

    public function bloquerCommentaire($id, $sessionId): string
    {
        if (isset($sessionId) && $this::recupRoleParID($sessionId) === "Modérateur") {
            $commentaireModel = new M_Commentaire();
            $commentaire = $commentaireModel->where('COM_ID', $id)->first();
            if ($commentaire) {
                $commentaire->COM_VISIBILITE = "I";
                $commentaireModel->save($commentaire);
                return "ok";
            }
        }
        else {
            return "Pas connecté";
        }
    }

    // Fonction permettant de récupérer les 20 premiers utilisateurs
    public function affichageUtilisateurs(): string
    {
        $utilisateurConnecte=$_SESSION['user_id'];

        $utilisateurModel = new M_Utilisateur();

        // L'identifiant de l'utilisateur connecté n'est pas récupéré
        $utilisateurs = $utilisateurModel
            ->where('UTI_ID !=', $utilisateurConnecte)
            ->where('UTI_ID !=', 0)
            ->findAll(20);
        $data = [
            'utilisateurs' => $utilisateurs
        ];
      
        $content = view('scr_AdministrerUtilisateur', $data);
        return $content;
    }

    // Fonction permettant de promouvoir un utilisateur ($idUtilisateur) à un nouveau rôle ($idRole)
    public function promouvoirUtilisateur($idRole, $idUtilisateur)
    {
       $utilisateurModel = new M_Utilisateur();
       $utilisateurAModifier = $utilisateurModel->find($idUtilisateur);

        $utilisateurData = [
            'UTI_ID_ROL' => $idRole
        ];

        if ($this->verifScriptDansDonnees($utilisateurData)) {
            session()->setFlashdata('error', 'Veuillez ne pas utiliser de balises script');
            $content = view('scr_AdministrerUtilisateur', ['utilisateur' => $idUtilisateur]);
            return $content;
        }

        // Mise à jour de la ligne dans la base de données
        $utilisateurModel->update($idUtilisateur, $utilisateurData);

        $utilisateurs = $utilisateurModel->findAll(20);
        $data = [
            'utilisateurs' => $utilisateurs
        ];

        return redirect()->to('/administrer_utilisateur')->with('success', 'Utilisateur mis à jour');

        $content = view('scr_AdministrerUtilisateur', $data);
        return $content;
    }

    // Fonction permettant d'activer/désactiver ($etatUtilisateur) un utilisateur ($idUtilisateur)

    public function activationUtilisateur($etatUtilisateur, $idUtilisateur)
    {
    
       $utilisateurModel = new M_Utilisateur();
       $utilisateurAModifier = $utilisateurModel->find($idUtilisateur);

       // Si l'utilisateur est désactivé, on le réactive.
       if($etatUtilisateur == 1){
            $nouvelEtatUtilisateur = "A";
       }
       // Si l'utilisateur est activé, on le désactive
       elseif($etatUtilisateur == 2){
            $nouvelEtatUtilisateur = "I";
       }

        $utilisateurData = [
            'UTI_ETAT' => $nouvelEtatUtilisateur
        ];

        if ($this->verifScriptDansDonnees($utilisateurData)) {
            session()->setFlashdata('error', 'Veuillez ne pas utiliser de balises script');
            $content = view('scr_AdministrerUtilisateur', ['utilisateur' => $idUtilisateur]);
            return $content;
        }

        // Mise à jour de la ligne dans la base de données
        $utilisateurModel->update($idUtilisateur, $utilisateurData);

        // Nouvelle lecture 
        $utilisateurs = $utilisateurModel->findAll(20);
        $data = [
            'utilisateurs' => $utilisateurs
        ];

        return redirect()->to('/administrer_utilisateur')->with('success', 'Utilisateur mis à jour');

        $content = view('scr_AdministrerUtilisateur', $data);
        return $content;
    }

    // Affichage vue gestion du profil
    public function gestionProfil(): string
    {
        $utilisateurModel = new M_Utilisateur();
        /* ------ CHIFFRAGE DES DONNEES - A LAISSER EN COMMENTAIRE POUR L'INSTANT ------
        $encryption = new Encryption();

        $cleCp = $encryption->returnCleCp();
        $cleTel = $encryption->returnCleTel();
        
        $ivLength = $encryption->returnIvLength();
        $iv = $encryption->returnIv($ivLength);
        */

        $idUser=$_SESSION['user_id'];
        $utilisateur = $utilisateurModel->find($idUser);

        $data = [
            'utilisateur' => $utilisateur
        ];

        /* ------ CHIFFRAGE DES DONNEES - A LAISSER EN COMMENTAIRE POUR L'INSTANT ------
        $numTel = $utilisateur->UTI_NUM_TEL;
        $cp = $utilisateur->UTI_CP;

        $donneesDecryptesAvecIVTel = base64_encode($iv . $numTel);
        $donneesDecryptesAvecIVCp = base64_encode($iv . $cp);

        // Déchiffrer les données
        $donneesDecrypteTel = base64_decode($donneesDecryptesAvecIVTel);
        $donneesDecrypteCp = base64_decode($donneesDecryptesAvecIVCp);
        $ivTel = substr($donneesDecrypteTel, 0, $ivLength);
        $ivCp = substr($donneesDecrypteCp, 0, $ivLength);
    //    dd($ivCp);
        $donneesDecryptesSansIVTel = substr($donneesDecrypteTel, $ivLength);
        $donneesDecryptesSansIVCp = substr($donneesDecrypteCp, $ivLength);
        $cpDeCrypte = openssl_decrypt($donneesDecryptesSansIVCp, 'aes-256-cbc', $cleCp, 0, $ivCp);  
        $numTelDecrypte = openssl_decrypt($donneesDecryptesSansIVTel, 'aes-256-cbc', $cleTel, 0, $ivTel);
    //    dd($numTelDecrypte);
    */
                

        $content = view('scr_GestionProfil', $data);

        return $content;
    }
  
    public function modifierProfil($utilisateurAModifierId)
    {
        $utilisateurModel = new M_Utilisateur();
        $utilisateurAModifier = $utilisateurModel->find($utilisateurAModifierId);

        if ($this->request->getPost()){
            // Gestion civilité
            $civilite = $this->request->getPost('civilite');
            if($civilite != "M" && $civilite != "Mme" && $civilite != "Aut")
            {
                $newCivilite = $this->convertir_civilite($civilite);
            }
            else {
                $newCivilite = $civilite;
            }
          
        /* ------ CHIFFRAGE DES DONNEES - A LAISSER EN COMMENTAIRE POUR L'INSTANT ------
            // Création des clés
            $encryption = new Encryption();

            $cleCp = $encryption->returnCleCp();
            $cleTel = $encryption->returnCleTel();
            
            // Récupération des IV 
            $ivLength = $encryption->returnIvLength();
            $iv = $encryption->returnIv($ivLength);
            
            // Récupération du numéro de téléphone
            $numTel = $this->request->getPost('numTel');
            // Récupération du numéro de code postal
            $cp = $this->request->getPost('cp');

            // Chiffrer le numéro de téléphone
            $numTelCrypte = openssl_encrypt($numTel, 'aes-256-cbc', $cleTel, 0, $iv);

            // Chiffrer le code postal
            $cpCrypte = openssl_encrypt($cp, 'aes-256-cbc', $cleCp, 0, $iv);

            // Stocker l'IV avec les données chiffrées (par exemple, en les concaténant)
            $donneesDecryptesAvecIVTel = base64_encode($iv . $numTelCrypte);
            $donneesDecryptesAvecIVCp = base64_encode($iv . $cpCrypte); 
            */

            $utilisateurData = [
                'UTI_CIVILITE' => $newCivilite,
                'UTI_NOM' => $this->request->getPost('nom'),
                'UTI_PRENOM' => $this->request->getPost('prenom'), 
                'UTI_ADRESSE' => $this->request->getPost('adresse'),
                'UTI_CP' => $this->request->getPost('cp'),
             //   'UTI_CP' => $cpCrypte,
                'UTI_VILLE' => $this->request->getPost('ville'),
                'UTI_NUM_TEL' => $this->request->getPost('numTel')
             //   'UTI_NUM_TEL' => $numTelCrypte
            ];
        
            if ($this->verifScriptDansDonnees($utilisateurData)) {
                session()->setFlashdata('error', 'Veuillez ne pas utiliser de balises script');
                $content = view('scr_GestionProfil', ['utilisateur' => $utilisateurAModifier]);
                return $content;
            }
            // Mise à jour de la ligne dans la base de données
            $utilisateurModel->update($utilisateurAModifierId, $utilisateurData);

        /* ------ DECHIFFRAGE DES DONNEES - A LAISSER EN COMMENTAIRE POUR L'INSTANT ------
            // Déchiffrer les données
            $donneesDecrypteTel = base64_decode($donneesDecryptesAvecIVTel);
            $donneesDecrypteCp = base64_decode($donneesDecryptesAvecIVCp);
            $ivTel = substr($donneesDecrypteTel, 0, $ivLength);
            $ivCp = substr($donneesDecrypteCp, 0, $ivLength);
            $donneesDecryptesSansIVTel = substr($donneesDecrypteTel, $ivLength);
            $donneesDecryptesSansIVCp = substr($donneesDecrypteCp, $ivLength);
            $numTelDecrypte = openssl_decrypt($donneesDecryptesSansIVTel, 'aes-256-cbc', $cleTel, 0, $ivTel);
            $cpDeCrypte = openssl_decrypt($donneesDecryptesSansIVCp, 'aes-256-cbc', $cleCp, 0, $ivCp);  
            */
            return redirect()->to('/gestion_profil')->with('success', 'Les données du profil ont été mis à jour');
        }

        $content = view('scr_GestionProfil', $data);
        return $content;
    }

}
