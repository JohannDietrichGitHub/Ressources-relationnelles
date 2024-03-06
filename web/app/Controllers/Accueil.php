<?php

namespace App\Controllers;

class Accueil extends BaseController
{
    public function index(): string
    {
        $session = \Config\Services::session();
        
        $content = view('Accueil');

        // return view('scr_Accueil');
        return $content;
    }
    public function faq()
    {
        $content = view('scr_FAQ');
        return $content;
    }

    public function deconnexion()
    {
    // Instanciation de la session
    $session = \Config\Services::session();
    
    // Destruction de la session
    $session->destroy();

    // Redirection vers la page d'accueil 
    return redirect()->to('');
    }
}
