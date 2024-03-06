<?php

use CodeIgniter\Test\CIUnitTestCase;

class MyCommentaireShould extends CIUnitTestCase
{
    public class ShowCommentaire
    {
        public function ShowCommentaireID()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $commentaireId = 1;
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Commentaire();
        
            // Appelle la méthode à tester
            $result = $controller->afficherCommentaire($commentaireId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="commentaire">', $result);
        }

        public function ShowCommentaireNonExisting()
        {
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Commentaire();
        
            // Appelle la méthode à tester
            $result = $controller->afficherCommentaire(999);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="commentaire">', $result);
        }
    }
    public class AddCommentaire
    {
        public function AjouterCommentaireId()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $commentaireId = 1;

            // Créer une instance contrôleur
            $controller = new \App\Controllers\Commentaire();

            // Appelle la méthode à tester
            $result = $controller->ajouterCommentaire($commentaireId);

            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="commentaire">', $result);
        }
    }

    public class DeleteCommentaire()
    {
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

    public class AfficherFeedSousCommentaire()
    {
        
    }

    

}