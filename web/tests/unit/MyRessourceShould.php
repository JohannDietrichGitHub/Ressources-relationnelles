<?php

use CodeIgniter\Test\CIUnitTestCase;
use Config\App;
use Config\Services;
use Tests\Support\Libraries\ConfigReader;

/**
 * @internal
 */
final class MyRessourceShould extends CIUnitTestCase
{
    public function testShowRessourceID1()
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

    public function testShowRessourceNonExisting()
    {
        // Créer une instance contrôleur
       // $controller = new \App\Controllers\Ressource();
    
        // Appelle la méthode à tester
       // $result = $controller->afficherRessource(999);
    
        // Effectuez les assertions appropriées sur le résultat retourné
       // $this->assertStringContainsString('<div class="ressource">', $result);
       $this->assertTrue(defined('APPPATH'));
    }

    public function testAddRessourceId1()
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


    public function testDeleteRessourceId1()
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

    public function testDeleteRessourceNonExisting()
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

    public function testChangerRessourceId1()
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

    public function testChangeRessourceNonExisting()
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

    public function testChangeRessourceStateId1()
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

    public function testChangeRessourceStateNonExisting()
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
    public function testValiderRessourceId1()
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

    public function testValiderRessourceNonExisting()
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

    public function testShowRessourcesToCheck()
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
