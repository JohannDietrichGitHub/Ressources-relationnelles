<?php

use CodeIgniter\Test\CIUnitTestCase;

class MyRessourceShould extends CIUnitTestCase
{
    public class ShowRessource
    {
        public function ShowRessourceID1()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 1;
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
        
            // Appelle la méthode à tester
            $result = $controller->afficherRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }

        public function ShowRessourceNonExisting()
        {
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
        
            // Appelle la méthode à tester
            $result = $controller->afficherRessource(999);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }
    }

    public class AddRessource
    {
        public function AddRessourceId1()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 1;

            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();

            // Appelle la méthode à tester
            $result = $controller->ajouterRessource($ressourceId);

            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }
    }

    
    public class DeleteRessource()
    {
        public function DeleteRessourceId1()
        {
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
            
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 1;
            $create = $controller->ajouterRessource($ressourceId);
                
            // Appelle la méthode à tester
            $result = $controller->supprimerRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }

        public function DeleteRessourceNonExisting()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 999;
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
        
            // Appelle la méthode à tester
            $result = $controller->supprimerRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }
    }

    public class ChangeRessource()
    {
        public function ChangerRessourceId1()
        {
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
            
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 1;
            $create = $controller->ajouterRessource($ressourceId);
                
            // Appelle la méthode à tester
            $result = $controller->modifierRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }

        public function ChangeRessourceNonExisting()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 999;
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
        
            // Appelle la méthode à tester
            $result = $controller->modifierRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }
    }

    public class ChangeRessourceState()
    {
        public function ChangeRessourceStateId1()
        {
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
            
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 1;
            $create = $controller->ajouterRessource($ressourceId);
                
            // Appelle la méthode à tester
            $result = $controller->modifierEtatRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }

        public function ChangeRessourceStateNonExisting()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 999;
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
        
            // Appelle la méthode à tester
            $result = $controller->modifierEtatRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }
    }

    public class ValidateRessource()
    {
        public function ValiderRessourceId1()
        {
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
            
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 1;
            $create = $controller->validerRessource($ressourceId);
                
            // Appelle la méthode à tester
            $result = $controller->validerRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }

        public function ValiderRessourceNonExisting()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 999;
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
        
            // Appelle la méthode à tester
            $result = $controller->validerRessource($ressourceId);
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }
    }

    public class ShowFeedRessources()
    {
        //Tests non réalisés
    }

    public class ShowToCheckRessources()
    {
        public function ShowRessourcesToCheck()
        {
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();
            
            // Mettre en place vos préconditions de test si nécessaire
            $ressourceId = 1;
            $create = $controller->validerRessource($ressourceId);
        
            // Appelle la méthode à tester
            $result = $controller->afficherRessourcesAVerifier();
        
            // Effectuez les assertions appropriées sur le résultat retourné
            $this->assertStringContainsString('<div class="ressource">', $result);
        }
    }

}
