<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Categorie extends Model {

protected $table = 'categorie';
protected $primaryKey = 'categorie_id';
protected $allowedFields = [
    'categorie_libel'
];

protected $returnType = 'object';
}
