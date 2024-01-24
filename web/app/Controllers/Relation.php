<?php

namespace App\Controllers;

use App\Models\M_Relation;

class Relation extends BaseController
{
    public function getRelations(): array
    {
        $model = new M_Relation();
        $relations = $model->findAll();
        return $relations;
    }
}