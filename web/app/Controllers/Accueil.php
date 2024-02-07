<?php

namespace App\Controllers;

class Accueil extends BaseController
{
    public function index(): string
    {
        $content = view('Accueil');

        // return view('scr_Accueil');
        return $content;
    }
}
