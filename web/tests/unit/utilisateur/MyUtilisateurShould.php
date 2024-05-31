<?php

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Test\CIUnitTestCase;
use App\Models\M_Utilisateur;

class MyUtilisateurShould extends CIUnitTestCase
{
    
    public function testRecuperationIdRole()
    {
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->recupIdRole();
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testRecuperationIdUtilisateurAPartirDuMail()
    {   
        $mail = 'florian.mathis@viacesi.fr';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->verifCompte($mail);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testConversionCiviliteMonsieur()
    {   
        $civilite = 'Monsieur';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->convertir_civilite($civilite);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testConversionCiviliteMadame()
    {   
        $civilite = 'Madame';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->convertir_civilite($civilite);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testConversionCiviliteAutre()
    {   
        $civilite = 'Autre';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->convertir_civilite($civilite);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testRecuperationNomUtilisateurSelonSonId()
    {   
        $idUtilisateur = '3';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->recupNomUtilisateurParID($idUtilisateur);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testRecuperationRoleSelonSonId()
    {   
        $idRole = '3';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->recupRoleParID($idRole);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testBlocageCommentaire()
    {   
        $idCommentaire = '2';
        $idUtilisateur = '40';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->bloquerCommentaire($idCommentaire, $idUtilisateur);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testRecuperationVingtPremiersUtilisateursHorsAdmin()
    {   
        $_SESSION['user_id'] = '27';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->affichageUtilisateurs();
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }

    public function testPromouvoirUtilisateur()
    {   
        $idRole = '2';
        $idUtilisateur = '3';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->promouvoirUtilisateur($idRole, $idUtilisateur);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }

    public function testActivationUtilisateur()
    {   
        $etatUtilisateur = '1';
        $idUtilisateur = '3';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->activationUtilisateur($etatUtilisateur, $idUtilisateur);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }

    public function testDesactivationUtilisateur()
    {   
        $etatUtilisateur = '2';
        $idUtilisateur = '3';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->activationUtilisateur($etatUtilisateur, $idUtilisateur);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }

    public function testAffichageGestionProfil()
    {   
        $_SESSION['user_id'] = '3';
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->gestionProfil();
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }

    public function testAffichageInscription()
    {   
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->inscription();
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }

    public function testAffichageMotDePasseOublie()
    {   
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->mdpOublie();
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }

    public function testAffichageAdministrerUtilisateur()
    {   
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Utilisateur();
    
        // Appelle la méthode à tester
        $result = $controller->administrerUtilisateur();
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertNotEmpty($result);
    }
}