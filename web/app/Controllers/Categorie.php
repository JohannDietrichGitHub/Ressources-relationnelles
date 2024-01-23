<?php

namespace App\Controllers;

use App\Models\M_Categorie;

class Categorie extends BaseController
{
    public function getCategories(): array
    {
        $categorie = new M_Categorie();
        $categories = $categorie->findAll();
        return $categories;
    }
}