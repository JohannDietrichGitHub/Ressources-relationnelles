<?php

namespace App\Controllers;

class Accueil extends BaseController
{
    public function index(): string
    {
        $content  = view('header');
        $content .= view('Accueil');
        $content .= view('footer');

        // return view('scr_Accueil');
        return $content;
    }
}
