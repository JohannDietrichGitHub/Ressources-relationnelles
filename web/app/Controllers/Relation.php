<?php

namespace App\Controllers;

use App\Models\M_Relation;

class Relation extends BaseController
{
    public function getRelations(): array
    {
        try {
            $model = new M_Relation();
            $relations = $model->findAll();
            return $relations;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }    
}