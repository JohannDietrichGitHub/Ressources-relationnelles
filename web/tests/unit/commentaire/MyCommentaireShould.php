<?php

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Test\CIUnitTestCase;

class MyCommentaireShould extends CIUnitTestCase
{
    public function testCommentaireNonExistant()
    {
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
    
        // Appelle la méthode à tester
        $result = $controller->afficherFeedCommentaires(99999);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    public function DeleteCommentaireId1()
    {
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
        
        // Mettre en place vos préconditions de test si nécessaire
        $commentaireId = 1;
        $create = $controller->ajouterCommentaire($commentaireId);
            
        // Appelle la méthode à tester
        $result = $controller->supprimerCommentaire($commentaireId);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertStringContainsString('<div class="commentaire">', $result);
    }

    public function DeleteRessourceNonExisting()
    {
        // Mettre en place vos préconditions de test si nécessaire
        $commentaireId = 999;
    
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
    
        // Appelle la méthode à tester
        $result = $controller->supprimerCommentaire($commentaireId);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertStringContainsString('<div class="commentaire">', $result);
    }
}