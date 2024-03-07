<?php

namespace App\Controllers;
$session = \Config\Services::session();

class Accueil extends BaseController
{

    public function index(): string
    {
        $content = view('Accueil');
        return $content;
    }
    public function faq()
    {
        $content = view('scr_FAQ');
        return $content;
    }

    public function deconnexion()
    {
    $session = \Config\Services::session();

    // Destruction de la session
    $session->destroy();

    // Redirection vers la page d'accueil 
    return redirect()->to('');
    }
}
