<?php

namespace App\Controllers;
$session = \Config\Services::session();

class Accueil extends BaseController
{

    public function index(): string
    {
        try {
            $content = view('Accueil');
            return $content;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Une erreur s\'est produite lors du chargement de la page d\'accueil.');
            return redirect()->to('');
        }
    }

    public function faq()
    {
        try {
            $content = view('scr_FAQ');
            return $content;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Une erreur s\'est produite lors du chargement de la page FAQ.');
            return redirect()->to('');
        }
    }

    public function deconnexion()
    {
        try {
            $session = \Config\Services::session();

            // Destruction de la session
            $session->destroy();

        // Redirection vers la page d'accueil 
        return redirect()->to('');
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            session()->setFlashdata('error', 'Une erreur s\'est produite lors de la déconnexion.');
            return redirect()->to('');
        }
    }

}
