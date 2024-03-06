<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Categorie extends Model {

protected $table = 'categorie';
protected $primaryKey = 'CAT_ID';
protected $allowedFields = [
    'CAT_NOM'
];

protected $returnType = 'object';
}
