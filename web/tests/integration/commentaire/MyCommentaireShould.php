<?php

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Test\CIUnitTestCase;

/// 
/// ------ LANCER LES TESTS D'INTEGRATION 'COMMENTAIRE' ------
///
/// 1. Se mettre à la racine du projet
/// 2. Configurer le chemin dans le fichier phpunit.xml
/// 3. Lancer la commande "vendor/bin/phpunit --testsuite Commentaire --testdox"

class MyCommentaireShould extends CIUnitTestCase
{
    public function testAffichageCommentaireAvecIdRessource()
    {
        // Mettre en place vos préconditions de test si nécessaire
        $ressourceId = 1;
    
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
    
        // Appelle la méthode à tester
        $result = $controller->afficherFeedCommentaires($ressourceId);
        
        // Vérification si donnée non vide en retour
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testAffichageCommentaireAvecIdCommentaireReponse()
    {
        // Mettre en place vos préconditions de test si nécessaire
        $commentaireReponseId = 3;
    
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
    
        // Appelle la méthode à tester
        $result = $controller->afficherFeedCommentaires($commentaireReponseId);
        
        // Vérification si donnée non vide en retour
        $this->assertNotEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function testCommentaireNonExistant()
    {
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
    
        // Appelle la méthode à tester
        $result = $controller->afficherFeedCommentaires(99999);
    
        // Vérification si donnée vide en retour
        $this->assertEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }
    /// A décommenter si pas de modification en base
    public function testAjouterCommentaire()
    {
        // Récupération du dernier commentaire par ID de commentaire
        $commentaireModel = new \App\Models\M_Commentaire();
        $commentaireDernier = $commentaireModel->selectMax('COM_ID')->first();
        $this->assertNotNull($commentaireDernier);
        // Simuler les valeurs POST
        $_POST['commentaire_contenu'] = 'Test intégration commentaire ajouté';
        $_POST['commentaire_uti_id'] = 3; // ID de l'utilisateur
        $_POST['commentaire_res_id'] = 1; // ID de la ressource
        $_POST['commentaire_contenu_reponse'] = " ";
    
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
    
        // Appelle la méthode à tester
        $result = $controller->ajouterCommentaire();

        // Récupération du commentaire ajouté
        $commentaireAjoute = $commentaireModel->selectMax('COM_ID')->first();
        $this->assertNotNull($commentaireAjoute);

        // Vérification si id dernier commentaire < id commentaire créé
        $this->assertGreaterThan($commentaireDernier, $commentaireAjoute, 'L\'ID du commentaire ajouté doit être supérieur à l\'ID du dernier commentaire.');
        echo 'Résultat : ID de commentaire suivant ajouté dans la base de données - ';
        var_dump($commentaireAjoute->COM_ID);
    }
}