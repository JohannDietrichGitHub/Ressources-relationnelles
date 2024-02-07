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
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Ressource();

            //...
        }
    }

    
    public class DeleteRessource()
    {
        //...
    }

    public class ChangeRessource()
    {
        //...
    }

    public class ChangeRessourceState()
    {
        //...
    }

    public class ValidateRessource()
    {
        //...
    }

    public class ShowFeedRessources()
    {
        //...
    }

    public class ShowToCheckRessources()
    {
        //...
    }

}
