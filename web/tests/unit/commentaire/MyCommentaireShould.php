<?php

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Test\CIUnitTestCase;
use App\Models\M_Commentaire;

class MyCommentaireShould extends CIUnitTestCase
{
    
    public function testCommentaireNonExistant()
    {
        // Créer une instance contrôleur
        $controller = new \App\Controllers\Commentaire();
    
        // Appelle la méthode à tester
        $result = $controller->afficherFeedCommentaires(40);
    
        // Effectuez les assertions appropriées sur le résultat retourné
        $this->assertEmpty($result);

        echo 'Résultat : ';
        var_dump($result);
    }

    /// A décommenter quand pas d'appel à la base
    /*public function testAjouterCommentaire()
    {
        $_POST['commentaire_contenu'] = 'Test commentaire contenu';
        $_POST['commentaire_uti_id'] = 3; // ID de l'utilisateur
        $_POST['commentaire_res_id'] = 1; // ID de la ressource
    
        // Créez un double de votre modèle de commentaire
        $commentaireModelMock = $this->getMockBuilder(M_Commentaire::class)
                                     ->onlyMethods(['insert'])
                                     ->getMock();
    
        // Définissez le comportement attendu du double
        $commentaireModelMock->expects($this->once())
                             ->method('insert')
                             ->with(['COM_CONTENU' => 'Test commentaire contenue', 'COM_UTI_ID' => 3, 'COM_RES_ID' => 1, 'COM_TSP_CRE' => '2024-05-05', 'COM_VISIBILITE' => 'A'])
                             ->willReturn(true); // Simule l'insertion réussie

        // Injecter le double dans le contrôleur
        $controller = new \App\Controllers\Commentaire($commentaireModelMock);

        // Appeler la méthode à tester
        $result = $controller->ajouterCommentaire();
        dd($result);
        // Vérifier le comportement
        $this->assertTrue($result); // Vérifier si l'ajout s'est effectué avec succès
    }*/
}