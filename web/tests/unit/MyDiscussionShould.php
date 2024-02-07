<?php

use CodeIgniter\Test\CIUnitTestCase;

class MyDiscussionShould extends CIUnitTestCase
{
    public class ShowDiscussion
    {
        public function ShowDiscussionId1()
        {
            // Mettre en place vos préconditions de test si nécessaire
            $discussionId = 1;
        
            // Créer une instance contrôleur
            $controller = new \App\Controllers\Discussion();
        
            //...
        }

        public function ShowDiscussionNonExisting()
        {

        }
    }

}